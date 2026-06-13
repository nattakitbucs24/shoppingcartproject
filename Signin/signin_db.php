<?php

session_start();
require_once '../db.php';

if (isset($_POST['signin'])) {

    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if (empty($login) || empty($password)) {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบ";
        header("location: signin.php");
        exit();
    }

    try {

        $sql = "SELECT * FROM users 
WHERE email = :email 
OR username = :username 
OR phone = :phone
LIMIT 1";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":email", $login);
        $stmt->bindParam(":username", $login);
        $stmt->bindParam(":phone", $login);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            if (password_verify($password, $user['password'])) {

                session_regenerate_id(true);

                if ($user['role'] == 'admin') {

                    $_SESSION['admin_login'] = $user['id'];
                    $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ";

                    header("location: ../admin/index.php");
                    exit();
                } else {

                    $_SESSION['user_login'] = $user['id'];
                    $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ";

                    header("location: ../index.php");
                    exit();
                }
            } else {

                $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
                header("location: signin.php");
                exit();
            }
        } else {

            $_SESSION['error'] = "ไม่พบผู้ใช้งาน";
            header("location: signin.php");
            exit();
        }
    } catch (PDOException $e) {

        echo "Database error: " . $e->getMessage();
    }
}