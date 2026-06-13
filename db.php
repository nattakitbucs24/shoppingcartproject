<?php

$servername = "localhost";
$dbname     = "nsrcford_db_project_php";
$username   = "root";
$password   = "";

try {

  $conn = new PDO(
    "mysql:host=$servername;dbname=$dbname;charset=utf8mb4",
    $username,
    $password,
    [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // throw error
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // fetch assoc auto
      PDO::ATTR_EMULATE_PREPARES   => false,                  // real prepared statement
      PDO::ATTR_TIMEOUT            => 5                       // 5 sec timeout
    ]
  );
} catch (PDOException $e) {

  // production ห้ามโชว์ error จริง
  die("Database connection error.");
}