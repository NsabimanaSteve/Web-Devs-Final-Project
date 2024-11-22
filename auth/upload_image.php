<?php
if (isset($_FILES['image'])) {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Save file path to database
        require_once 'db_connect.php';
        $category = $_POST['category'];
        $description = $_POST['description'];

        $query = "INSERT INTO Images (category, image_url, description) VALUES ('$category', '$target_file', '$description')";
        if ($conn->query($query)) {
            echo "Image uploaded and saved.";
        } else {
            echo "Database error: " . $conn->error;
        }
    } else {
        echo "Error uploading image.";
    }
}
?>
