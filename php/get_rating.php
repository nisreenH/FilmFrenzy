<?php
session_start();
header('Content-Type: application/json');

require_once '../php/connection.php'; // Adjust the path to your connection file

if (isset($_GET['movieId']) && isset($_SESSION['user_id'])) {
    $movieId = $_GET['movieId'];
    $userId = $_SESSION['user_id']; // Assuming you have the user ID stored in the session
    error_log("Fetching rating for movieId: " . $movieId);
    try { 
        $stmt = $conn->prepare("SELECT rating FROM ratings WHERE user_id = ? AND movie_id = ?");
        $stmt->bind_param("ii", $userId, $movieId);
        $stmt->execute();
        $stmt->bind_result($rating);
        $stmt->fetch();
        $stmt->close();

        if ($rating !== null) {
            echo json_encode(['rating' => $rating]);
        } else {
            echo json_encode(['rating' => null]);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid input']);
}
?>
