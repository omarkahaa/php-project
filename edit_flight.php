<?php
require_once 'User.php';
require_once 'FlightRecord.php';

if (!User::checkLoggedInUser()) {
    header('Location: login.php');
    exit();
}

$id = (int) $_GET['id'];
$flight = FlightRecord::getFlightById($id, $_SESSION['user_id']);

if (empty($flight)) {
    header('Location: dashboard.php');
    exit();
}

$errorMessage = '';

if (isset($_GET['Err'])) {
    $errorMessage = 'Please complete the required flight information';
}
?>
<html>
<head>
    <title>Edit flight</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit flight</h1>
        <div class="message"><?php echo htmlspecialchars($errorMessage); ?></div>

        <form method="post" action="update_flight.php">
            <fieldset>
                <legend>Flight details</legend>

                <input type="hidden" name="id" value="<?php echo htmlspecialchars($flight['id']); ?>">

                <label>Aircraft</label>
                <input type="text" name="aircraft" value="<?php echo htmlspecialchars($flight['aircraft']); ?>">
                <br>

                <label>Departure</label>
                <input type="text" name="departure_airport" value="<?php echo htmlspecialchars($flight['departure_airport']); ?>">
                <br>

                <label>Arrival</label>
                <input type="text" name="arrival_airport" value="<?php echo htmlspecialchars($flight['arrival_airport']); ?>">
                <br>

                <label>Date</label>
                <input type="date" name="flight_date" value="<?php echo htmlspecialchars($flight['flight_date']); ?>">
                <br>

                <label>Duration minutes</label>
                <input type="number" name="duration_minutes" min="1" value="<?php echo htmlspecialchars($flight['duration_minutes']); ?>">
                <br>

                <label>Flight type</label>
                <select name="flight_type">
                    <option value="VFR" <?php if ($flight['flight_type'] == 'VFR') echo 'selected'; ?>>VFR</option>
                    <option value="IFR" <?php if ($flight['flight_type'] == 'IFR') echo 'selected'; ?>>IFR</option>
                    <option value="Night" <?php if ($flight['flight_type'] == 'Night') echo 'selected'; ?>>Night</option>
                    <option value="Simulator" <?php if ($flight['flight_type'] == 'Simulator') echo 'selected'; ?>>Simulator</option>
                </select>
                <br>

                <label>Instructor</label>
                <input type="text" name="instructor_name" value="<?php echo htmlspecialchars($flight['instructor_name']); ?>">
                <br>

                <label>Landings</label>
                <input type="number" name="landings" min="0" value="<?php echo htmlspecialchars($flight['landings']); ?>">
                <br>

                <label>Remarks</label>
                <textarea name="remarks"><?php echo htmlspecialchars($flight['remarks']); ?></textarea>
                <br>

                <input type="submit" value="Update flight">
                <a href="dashboard.php">Cancel</a>
            </fieldset>
        </form>
    </div>
</body>
</html>
