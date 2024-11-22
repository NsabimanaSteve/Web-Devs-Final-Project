<?php
include '../db_connect.php';

// Function to fetch all records from a table
function fetchAll($table) {
    global $conn;
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
