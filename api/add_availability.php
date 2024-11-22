<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trainer_id = $_POST['trainer_id'];
    $available_date = $_POST['available_date'];
    $available_time = $_POST['available_time'];

    $stmt = $conn->prepare("INSERT INTO Availability (trainer_id, available_date, available_time) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $trainer_id, $available_date, $available_time);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Availability added successfully"]);
    } else {
        echo json_encode(["error" => "Failed to add availability"]);
    }

    $stmt->close();
}
?>
