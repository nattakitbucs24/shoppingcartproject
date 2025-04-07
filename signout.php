<?php
    session_start(); // เริ่มต้น session
    // ลบค่าของ session ที่เกี่ยวข้อง
    unset($_SESSION['user_login']);
    unset($_SESSION['admin_login']);
    
    // ล้างข้อมูลทั้งหมดของ session
    session_destroy();

    // รีไดเร็กไปยังหน้า index.php
    header('Location: index.php');
    exit(); // ทำให้การรีไดเร็กเกิดขึ้นทันที
?>