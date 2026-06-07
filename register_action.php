<?php
require_once 'User.php';

$firstName = trim($_POST['first_name']);
$lastName = trim($_POST['last_name']);
$email = trim($_POST['email']);
$password = $_POST['password'];

if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
    header('Location: register.php?Err=1');
    exit();
}

if (User::register($firstName, $lastName, $email, $password)) {
    header('Location: dashboard.php');
    exit();
}

header('Location: register.php?Exists=1');
exit();
