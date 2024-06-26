<?php
session_start();
require_once '../php/connection.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

if (isset($_POST['list_id']) && isset($_POST['movie_id'])) {
    $listId = $_POST['list_id'];
    $movieId = $_POST['movie_id'];

    $query = "INSERT INTO list_items (list_id, movie_id) VALUES (?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $listId, $movieId);

    if ($stmt->execute()) {
        echo "Movie added to list successfully.";
    } else {
        echo "Error: Could not add movie to list.";
    }

    $stmt->close();
    $con->close();
}
?>
