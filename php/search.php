<?php
session_start();
require_once('../vendor/autoload.php');
require_once '../php/connection.php';

// Get raw POST data
$input = file_get_contents('php://input');

// Attempt to decode JSON
$data = json_decode($input, true);

// Check if decoding was successful and if required fields are present
if (json_last_error() === JSON_ERROR_NONE && isset($data['search_query'])) {
    // Retrieve the search query
    $search_query = $data['search_query'];

    $apiKey = '90565206247f3b7768d9b25bbedf68d8';
    $client = new \GuzzleHttp\Client();

    // Prepare query parameters
    $queryParams = [
        'api_key' => $apiKey,
        'query' => $search_query,
        'page' => 1
    ];

    // Fetch movie from TMDB API
    try {
        $response = $client->request('GET', 'https://api.themoviedb.org/3/search/movie', [
            'query' => $queryParams
        ]);

        $responseBody = $response->getBody()->getContents();
        $moviesList = json_decode($responseBody);

        if (count($moviesList->results) > 0) {
            // Get the first movie result
            $movie = $moviesList->results[0];
            $movieId = $movie->id;

            header('Content-Type: application/json');
            echo json_encode(['movieId' => $movieId]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'No movie found.']);
        }
    } catch (Exception $e) {
        // Handle API request error
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Failed to fetch movie from TMDB API']);
    }
} else {
    // Respond with error if JSON data is invalid or required fields are missing
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(['error' => 'Invalid JSON data or missing required fields']);
}
?>