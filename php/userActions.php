<?php
// Start or resume the session
session_start();
require_once 'connection.php';

// Check if the user is logged in (you may need to implement user authentication)
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit('Unauthorized');
}

// Check if the movie ID is provided in the request
if (!isset($_POST['movie_id'])) {
    http_response_code(400);
    exit('Movie ID is required');
}

// Get the movie ID from the request
$movieId = $_POST['movie_id'];
$userId = $_SESSION['user_id'];

// Insert the movie ID into the favorites table in the database (replace with your database connection code)
// Example:
// $userId = $_SESSION['user_id'];
// $stmt = $pdo->prepare("INSERT INTO favorites (user_id, movie_id) VALUES (?, ?)");
// $stmt->execute([$userId, $movieId]);
$Insertquery = "INSERT INTO favorites (user_id, movie_id) VALUES  ( '$userId','$movieId' )";
$result= mysqli_query($con,$Insertquery);

if(!$result){
  die("Error insert: " . mysqli_error($con) . "</br> Error number: " . mysqli_errno($con));
            }

// Respond with a success message
echo 'Movie added to favorites successfully';
$stmt->close();
$con->close();
?>
