<?php
session_start();

// ลบ session
unset($_SESSION['user_login']);
unset($_SESSION['admin_login']);

// ทำลาย session
session_destroy();

// กลับหน้าแรก
header("Location: index.php");
exit();