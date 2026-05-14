<?php
session_start();
require_once '../config/db_connect.php';   // Adjust path if your config is elsewhere

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>