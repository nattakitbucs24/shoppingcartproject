<?php

session_start();
require_once '../db.php';

if (isset($_POST['signup'])) {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $c_password = trim($_POST['c_password']);
    $role = 'user';

    if (empty($username)) {
        $_SESSION['error'] = 'กรุณากรอก Username';
        header("location: signup.php");
        exit();
    }

    if (empty($email)) {
        $_SESSION['error'] = 'กรุณากรอกอีเมล';
        header("location: signup.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
        header("location: signup.php");
        exit();
    }

    if (empty($password)) {
        $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
        header("location: signup.php");
        exit();
    }

    if (strlen($password) < 5 || strlen($password) > 20) {
        $_SESSION['error'] = 'รหัสผ่านต้องมี 5 - 20 ตัวอักษร';
        header("location: signup.php");
        exit();
    }

    if ($password !== $c_password) {
        $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
        header("location: signup.php");
        exit();
    }

    try {

        // เช็ค email ซ้ำ
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->fetch()) {

            $_SESSION['warning'] = "อีเมลนี้ถูกใช้งานแล้ว 
            <a href='../Signin/signin.php'>คลิกที่นี่เพื่อเข้าสู่ระบบ</a>";

            header("location: signup.php");
            exit();
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password, role)
                VALUES (:username, :email, :password, :role)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $passwordHash);
        $stmt->bindParam(":role", $role);

        $stmt->execute();

        $_SESSION['success'] = "สมัครสมาชิกเรียบร้อย 
        <a href='../Signin/signin.php'>เข้าสู่ระบบ</a>";

        header("location: signup.php");
        exit();
    } catch (PDOException $e) {

        echo "Database error: " . $e->getMessage();
    }
}