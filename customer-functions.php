<?php
require_once 'config.php';
require_once 'database.php';

session_start();

/* ==============================
   CSRF PROTECTION
============================== */

function generateCSRF()
{
	if (empty($_SESSION['csrf_token'])) {
		$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	}
	return $_SESSION['csrf_token'];
}

function verifyCSRF($token)
{
	if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
		die("Invalid CSRF token");
	}
}

/* ==============================
   LOGIN ATTEMPT LIMIT
============================== */

function checkLoginAttempts()
{
	if (!isset($_SESSION['login_attempt'])) {
		$_SESSION['login_attempt'] = 0;
	}

	if ($_SESSION['login_attempt'] >= 5) {
		die("Too many login attempts. Try again later.");
	}
}

/* ==============================
   LOGIN
============================== */

function doCustomerLogin()
{
	global $pdo;

	checkLoginAttempts();
	verifyCSRF($_POST['csrf_token']);

	$userName = trim($_POST['txtUserName'] ?? '');
	$password = $_POST['txtUserPassword'] ?? '';

	if ($userName === '' || $password === '') {
		return 'กรุณากรอกข้อมูลให้ครบ';
	}

	$stmt = $pdo->prepare("SELECT user_id, user_password 
                           FROM tbl_user 
                           WHERE user_name = :username");
	$stmt->execute(['username' => $userName]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($user && password_verify($password, $user['user_password'])) {

		session_regenerate_id(true);
		$_SESSION['plaincart_customer_id'] = $user['user_id'];
		$_SESSION['login_attempt'] = 0;

		$pdo->prepare("UPDATE tbl_user 
                       SET user_last_login = NOW() 
                       WHERE user_id = :id")
			->execute(['id' => $user['user_id']]);

		header('Location: index.php');
		exit;
	}

	$_SESSION['login_attempt']++;
	return 'Username หรือรหัสผ่านไม่ถูกต้อง';
}

/* ==============================
   REGISTER
============================== */

function doCustomerRegister()
{
	global $pdo;

	verifyCSRF($_POST['csrf_token']);

	$userName  = trim($_POST['txtUserName']);
	$password  = $_POST['txtUserPassword'];
	$email     = trim($_POST['txtUserEmail']);

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		die("Invalid email");
	}

	if (strlen($password) < 6) {
		die("Password too short");
	}

	$stmt = $pdo->prepare("SELECT user_id FROM tbl_user WHERE user_name = :username");
	$stmt->execute(['username' => $userName]);

	if ($stmt->rowCount() > 0) {
		die("Username already exists");
	}

	$hashPassword = password_hash($password, PASSWORD_DEFAULT);

	$pdo->prepare("INSERT INTO tbl_user
        (user_name, user_password, user_regdate, user_role)
        VALUES (:username, :password, NOW(), 'customer')")
		->execute([
			'username' => $userName,
			'password' => $hashPassword
		]);

	header("Location: login.php");
	exit;
}

/* ==============================
   UPDATE PROFILE
============================== */

function updateProfile()
{
	global $pdo;

	verifyCSRF($_POST['csrf_token']);

	$userId = $_SESSION['plaincart_customer_id'];

	$stmt = $pdo->prepare("UPDATE tbl_user
        SET user_email = :email
        WHERE user_id = :id");

	$stmt->execute([
		'email' => trim($_POST['txtUserEmail']),
		'id'    => $userId
	]);
}

/* ==============================
   CHANGE PASSWORD
============================== */

function changePassword()
{
	global $pdo;

	verifyCSRF($_POST['csrf_token']);

	$userId = $_SESSION['plaincart_customer_id'];
	$oldPass = $_POST['txtOldPassword'];
	$newPass = $_POST['txtPassword'];

	$stmt = $pdo->prepare("SELECT user_password FROM tbl_user WHERE user_id = :id");
	$stmt->execute(['id' => $userId]);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$user || !password_verify($oldPass, $user['user_password'])) {
		die("Old password incorrect");
	}

	$newHash = password_hash($newPass, PASSWORD_DEFAULT);

	$pdo->prepare("UPDATE tbl_user
        SET user_password = :pass
        WHERE user_id = :id")
		->execute([
			'pass' => $newHash,
			'id'   => $userId
		]);
}

/* ==============================
   LOGOUT
============================== */

function doCustomerLogout()
{
	session_unset();
	session_destroy();
	header("Location: index.php");
	exit;
}