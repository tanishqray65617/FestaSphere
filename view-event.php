<?php
session_start();
include 'db_connect.php'; // Include database connection

// Fetch all events from the database
$sql = "SELECT * FROM events ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events - FestaSphere</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #121212; /* Dark mode */
            color: white;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background: #1e1e1e;
            color: white;
            margin-bottom: 20px;
        }
        .card-header {
            background: #ff5722; /* Vibrant Color */
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Upcoming Events</h2>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">' . htmlspecialchars($row['event_name']) . '</div>
                        <div class="card-body">
                            <p><strong>Club:</strong> ' . htmlspecialchars($row['event_club']) . '</p>
                            <p><strong>Date:</strong> ' . htmlspecialchars($row['event_date']) . '</p>
                            <p><strong>Time:</strong> ' . htmlspecialchars($row['event_time']) . '</p>
                            <p><strong>Team Size:</strong> ' . htmlspecialchars($row['team_size']) . '</p>
                            <p><strong>Entry Fee:</strong> ₹' . htmlspecialchars($row['pricing']) . '</p>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo "<p class='text-center'>No events available yet.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
