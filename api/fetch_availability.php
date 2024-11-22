<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $trainer_id = $_GET['trainer_id'];

    $stmt = $conn->prepare("SELECT available_date, available_time FROM Availability WHERE trainer_id = ?");
    $stmt->bind_param("i", $trainer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $availability = [];
    while ($row = $result->fetch_assoc()) {
        $availability[] = $row;
    }

    echo json_encode($availability);
}
?>
