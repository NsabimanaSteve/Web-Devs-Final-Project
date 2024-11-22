<?php
require_once 'db_connect.php'; // Include database connection

$query = "SELECT 
            c.class_id, 
            c.class_name, 
            c.schedule_time, 
            c.max_slots, 
            c.available_slots, 
            t.specialization AS trainer_specialization, 
            i.image_url 
          FROM Classes c
          LEFT JOIN Trainers t ON c.trainer_id = t.trainer_id
          LEFT JOIN Images i ON c.image_id = i.image_id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $classes = [];
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row;
    }
    echo json_encode($classes);
} else {
    echo json_encode(["message" => "No classes found"]);
}
?>

