<?php
require_once 'User.php';

$email = trim($_POST['email']);
$password = $_POST['password'];

if (User::login($email, $password)) {
    header('Location: dashboard.php');
    exit();
}

header('Location: login.php?Err=1');
exit();
