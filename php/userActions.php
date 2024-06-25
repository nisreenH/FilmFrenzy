<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit('Unauthorized');
}

if (!isset($_POST['movie_id'])) {
    http_response_code(400);
    exit('Movie ID is required');
}

$movieId = $_POST['movie_id'];
$userId = $_SESSION['user_id'];

// Check if the movie is already in the watchlist and remove it
$removeWatchlistQuery = "DELETE FROM watchlist WHERE user_id = ? AND movie_id = ?";
$stmt = $con->prepare($removeWatchlistQuery);
$stmt->bind_param("ii", $userId, $movieId);
$stmt->execute();
$stmt->close();

// Insert the movie into the favorites table
$insertQuery = "INSERT INTO favorites (user_id, movie_id) VALUES (?, ?)";
$stmt = $con->prepare($insertQuery);
$stmt->bind_param("ii", $userId, $movieId);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo 'Movie added to favorites successfully';
} else {
    echo 'Failed to add movie to favorites';
}

$stmt->close();
$con->close();
?>
