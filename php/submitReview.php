<?php
session_start();
require_once '../php/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

    $userId = $_SESSION['user_id'];
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['movie_id']) || !isset($data['review_text'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input']);
        exit;
    }

    $movieId = $data['movie_id'];
    $reviewText = $data['review_text'];

    $query = "INSERT INTO reviews (user_id, movie_id, review_text) VALUES (?, ?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("iis", $userId, $movieId, $reviewText);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Review submitted successfully']);
    } else {
        echo json_encode(['error' => 'Failed to submit review']);
    }

    $stmt->close();
    $con->close();
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>
