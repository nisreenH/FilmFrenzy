<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('../vendor/autoload.php');
require_once '../php/connection.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];

if ($con->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . $con->connect_error]);
    exit;
}

$query = "SELECT movie_id FROM watchlist WHERE user_id = ?";
$stmt = $con->prepare($query);

if ($stmt === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to prepare statement: ' . $con->error]);
    exit;
}

$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$watchlistMovieIds = [];
while ($row = $result->fetch_assoc()) {
    $watchlistMovieIds[] = $row['movie_id'];
}

$stmt->close();
// $con->close();

$apiKey = '90565206247f3b7768d9b25bbedf68d8';
$client = new \GuzzleHttp\Client();
$movies = [];

foreach ($watchlistMovieIds as $movieId) {
    try {
        $response = $client->request('GET', "https://api.themoviedb.org/3/movie/{$movieId}?language=en-US", [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MDU2NTIwNjI0N2YzYjc3NjhkOWIyNWJiZWRmNjhkOCIsInN1YiI6IjY1ZmVkNzU0MDkyOWY2MDE3ZTliZGUyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DW9RlEQ4PPwEzMPv8vutOwT8SAD1j47bBX7F1_RIANk',
                'Accept' => 'application/json',
            ],
        ]);
        $movieDetails = json_decode($response->getBody()->getContents(), true);
        if (isset($movieDetails['poster_path'])) {
            $movies[] = [
                'id' => $movieId,
                'poster_path' => $movieDetails['poster_path']
            ];
        }
    } catch (\GuzzleHttp\Exception\ClientException $e) {
        error_log('Error fetching movie details: ' . $e->getMessage());
    }
}

@header('Content-Type: application/json');
// echo json_encode($movies);
?>
