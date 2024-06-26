<?php
session_start();
require_once '../php/connection.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

if (isset($_POST['list_id']) && isset($_POST['movie_id'])) {
    $listId = $_POST['list_id'];
    $movieId = $_POST['movie_id'];

    $query = "DELETE FROM list_items WHERE list_id = ? AND movie_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $listId, $movieId);

    if ($stmt->execute()) {
        echo "Movie removed from list successfully.";
    } else {
        echo "Error: Could not remove movie from list.";
    }

    $stmt->close();
    $con->close();
}
?>