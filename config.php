<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "nsrcford_db_project_php";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$base_url = "http://localhost/nsrcford_project_php";
