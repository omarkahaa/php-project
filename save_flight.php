<?php
require_once 'User.php';
require_once 'FlightRecord.php';

if (!User::checkLoggedInUser()) {
    header('Location: login.php');
    exit();
}

$aircraft = trim($_POST['aircraft']);
$departureAirport = trim($_POST['departure_airport']);
$arrivalAirport = trim($_POST['arrival_airport']);
$flightDate = $_POST['flight_date'];
$durationMinutes = (int) $_POST['duration_minutes'];
$flightType = $_POST['flight_type'];
$instructorName = trim($_POST['instructor_name']);
$landings = (int) $_POST['landings'];
$remarks = trim($_POST['remarks']);

if (empty($aircraft) || empty($departureAirport) || empty($arrivalAirport) || empty($flightDate) || $durationMinutes <= 0) {
    header('Location: new_flight.php?Err=1');
    exit();
}

$flight = new FlightRecord(
    $_SESSION['user_id'],
    $aircraft,
    $departureAirport,
    $arrivalAirport,
    $flightDate,
    $durationMinutes,
    $flightType,
    $instructorName,
    $landings,
    $remarks
);

$flight->addFlight();

header('Location: dashboard.php');
exit();
