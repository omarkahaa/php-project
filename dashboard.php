<?php
require_once 'User.php';
require_once 'FlightRecord.php';

if (!User::checkLoggedInUser()) {
    header('Location: login.php');
    exit();
}

$flights = FlightRecord::getAllFlights($_SESSION['user_id']);
$summary = FlightRecord::getSummary($_SESSION['user_id']);
?>
<html>
<head>
    <title>My flight logbook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container large">
        <div class="top-bar">
            <div>
                <h1>My flight logbook</h1>
                <p class="small-text">Connected as <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
            </div>
            <div>
                <a href="new_flight.php">Add flight</a>
                <a href="logout_action.php">Logout</a>
            </div>
        </div>

        <div class="stats">
            <p><strong>Total flights:</strong> <?php echo htmlspecialchars($summary['total_flights']); ?></p>
            <p><strong>Total time:</strong> <?php echo htmlspecialchars(FlightRecord::formatDuration($summary['total_minutes'])); ?></p>
            <p><strong>Total landings:</strong> <?php echo htmlspecialchars($summary['total_landings']); ?></p>
        </div>

        <table>
            <tr>
                <th>Date</th>
                <th>Aircraft</th>
                <th>Route</th>
                <th>Duration</th>
                <th>Type</th>
                <th>Instructor</th>
                <th>Landings</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($flights as $flight) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($flight['flight_date']); ?></td>
                    <td><?php echo htmlspecialchars($flight['aircraft']); ?></td>
                    <td><?php echo htmlspecialchars($flight['departure_airport'] . ' → ' . $flight['arrival_airport']); ?></td>
                    <td><?php echo htmlspecialchars(FlightRecord::formatDuration($flight['duration_minutes'])); ?></td>
                    <td><?php echo htmlspecialchars($flight['flight_type']); ?></td>
                    <td><?php echo htmlspecialchars($flight['instructor_name']); ?></td>
                    <td><?php echo htmlspecialchars($flight['landings']); ?></td>
                    <td><?php echo htmlspecialchars($flight['remarks']); ?></td>
                    <td>
                        <a href="edit_flight.php?id=<?php echo htmlspecialchars($flight['id']); ?>">Edit</a>
                        <a href="delete_flight_action.php?id=<?php echo htmlspecialchars($flight['id']); ?>" onclick="return confirm('Delete this flight?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
