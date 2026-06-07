<?php
require_once 'User.php';

if (!User::checkLoggedInUser()) {
    header('Location: login.php');
    exit();
}

$errorMessage = '';

if (isset($_GET['Err'])) {
    $errorMessage = 'Please complete the required flight information';
}
?>
<html>
<head>
    <title>Add flight</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add a flight</h1>
        <div class="message"><?php echo htmlspecialchars($errorMessage); ?></div>

        <form method="post" action="save_flight.php">
            <fieldset>
                <legend>Flight details</legend>

                <label>Aircraft</label>
                <input type="text" name="aircraft" placeholder="Tecnam P2006T">
                <br>

                <label>Departure</label>
                <input type="text" name="departure_airport" placeholder="GMMB">
                <br>

                <label>Arrival</label>
                <input type="text" name="arrival_airport" placeholder="GMME">
                <br>

                <label>Date</label>
                <input type="date" name="flight_date">
                <br>

                <label>Duration minutes</label>
                <input type="number" name="duration_minutes" min="1">
                <br>

                <label>Flight type</label>
                <select name="flight_type">
                    <option value="VFR">VFR</option>
                    <option value="IFR">IFR</option>
                    <option value="Night">Night</option>
                    <option value="Simulator">Simulator</option>
                </select>
                <br>

                <label>Instructor</label>
                <input type="text" name="instructor_name" placeholder="Optional">
                <br>

                <label>Landings</label>
                <input type="number" name="landings" min="0" value="0">
                <br>

                <label>Remarks</label>
                <textarea name="remarks"></textarea>
                <br>

                <input type="submit" value="Save flight">
                <a href="dashboard.php">Cancel</a>
            </fieldset>
        </form>
    </div>
</body>
</html>
