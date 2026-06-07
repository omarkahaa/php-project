<?php
require_once 'User.php';

if (User::checkLoggedInUser()) {
    header('Location: dashboard.php');
    exit();
}

header('Location: login.php');
exit();
