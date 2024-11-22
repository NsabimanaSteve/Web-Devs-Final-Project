<?php
require_once 'db_connect.php'; // Include database connection

$query = "SELECT 
            t.trainer_id, 
            CONCAT(t.first_name, ' ', t.last_name) AS name, 
            t.specialization, 
            t.fun_fact, 
            t.favorite_quote
          FROM Trainers t";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $trainers = [];
    while ($row = $result->fetch_assoc()) {
        $trainers[] = $row;
    }
    // Return as JSON for AJAX calls or API usage
    header('Content-Type: application/json');
    echo json_encode($trainers);
} else {
    echo json_encode(["message" => "No trainers found"]);
}
?>
