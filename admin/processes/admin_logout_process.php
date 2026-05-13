<?php
// FILE LOCATION: process/admin_logout_process.php

session_start();
session_destroy();

header("Location: ../admin/login.php");
exit;
?>