<?php
require_once 'User.php';
require_once 'FlightRecord.php';

if (!User::checkLoggedInUser()) {
    header('Location: login.php');
    exit();
}

$id = (int) $_GET['id'];
FlightRecord::deleteFlight($id, $_SESSION['user_id']);

header('Location: dashboard.php');
exit();
