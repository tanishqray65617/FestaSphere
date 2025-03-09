<?php
session_start();
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin-login.php");
    exit();
}

$servername = "localhost";  
$username = "root"; 
$password = ""; 
$database = "festa_sphere"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];
    $event_time = $_POST["event_time"];
    $event_club = $_POST["event_club"];
    $team_size = $_POST["team_size"];
    $event_price = $_POST["event_price"];

    $sql = "INSERT INTO events (event_name, event_date, event_time, event_club, team_size, event_price) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $event_name, $event_date, $event_time, $event_club, $team_size, $event_price);

    if ($stmt->execute()) {
        echo "<script>alert('Event Added Successfully'); window.location.href = 'admin-dashboard.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
