<?php
session_start();
require_once '../php/connection.php'; // Adjust the path to your connection file

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

if (isset($_POST['rating']) && isset($_POST['movieId'])) {
    $rating = intval($_POST['rating']);
    $movieId = intval($_POST['movieId']);
    $userId = $_SESSION['user_id']; // Assuming user ID is stored in session

    // Log received data (for debugging purposes)
    error_log("Received rating: $rating, movieId: $movieId");

    // Check if movieId and rating are valid (add additional validation if necessary)
    if ($rating < 1 || $rating > 5 || $movieId <= 0) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid rating or movie ID']);
        exit();
    }

    // Insert or update the rating in the database
    $stmt = $con->prepare("INSERT INTO ratings (user_id, movie_id, rating) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE rating = ?");
    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $con->error]);
        exit();
    }

    $stmt->bind_param("iiii", $userId, $movieId, $rating, $rating);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Execute failed: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
?>
