<?php
session_start();
require 'config.php';
if (isset($_SESSION['user'])) {
    $userid = (int)$_SESSION['user'];
    $stmt = "SELECT * FROM users WHERE id = $userid";
    $query = mysqli_query($conn, $stmt);
    $user = mysqli_fetch_assoc($query);
} else {
    header('location:login.php');
}