<?php
session_start();
require_once('../vendor/autoload.php');
require_once '../php/connection.php';

// Get raw POST data
$input = file_get_contents('php://input');

// Attempt to decode JSON
$data = json_decode($input, true);

// Check if decoding was successful and if required fields are present
if (json_last_error() === JSON_ERROR_NONE && isset($data['genre'], $data['sort_by'], $data['language'], $data['page'], $data['year'])) {
    // Retrieve values
    $genre = $data['genre'];
    $sort_by = $data['sort_by'];
    $language = $data['language'];
    $page = $data['page'];
    $year = $data['year'];

    $apiKey = '90565206247f3b7768d9b25bbedf68d8';
    $client = new \GuzzleHttp\Client();
    $basePosterUrl = 'https://image.tmdb.org/t/p/w500';

    // Fetch genres from TMDB API
    try {
        $response = $client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list', [
            'query' => [
                'api_key' => $apiKey
            ]
        ]);

        $genresList = json_decode($response->getBody()->getContents())->genres;
        $genresMap = [];
        
        foreach ($genresList as $genreObj) {
            $genresMap[$genreObj->id] = $genreObj->name;
        }
    } catch (Exception $e) {
        // Handle API request error
        echo json_encode(['error' => 'Failed to fetch genres from TMDB API']);
        exit;
    }

    // Prepare query parameters
    $queryParams = [
        'api_key' => $apiKey,
        'include_adult' => 'true',
        'include_video' => 'false',
        'language' => $language,
        'sort_by' => $sort_by,
        'page' => $page
    ];

    if (!empty($genre)) {
        $queryParams['with_genres'] = $genre;
    }

    if (!empty($year)) {
        $queryParams['primary_release_year'] = $year;
    }

    // Fetch movies from TMDB API
    try {
        $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie', [
            'query' => $queryParams
        ]);

        $responseBody = $response->getBody()->getContents();
        $moviesList = json_decode($responseBody);

        $allMovies = [];
        foreach ($moviesList->results as $movie) {
            $posterUrl = $basePosterUrl . $movie->poster_path;

            // Map genre IDs to genre names
            $genres = array_map(function($genreId) use ($genresMap) {
                return $genresMap[$genreId] ?? 'Unknown';
            }, $movie->genre_ids);

            $allMovies[] = [
                'id' => $movie->id,
                'title' => $movie->title,
                'poster_url' => $posterUrl,
                'genres' => $genres
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($allMovies);
    } catch (Exception $e) {
        // Handle API request error
        echo json_encode(['error' => 'Failed to fetch movies from TMDB API']);
    }
} else {
    // Respond with error if JSON data is invalid or required fields are missing
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(['error' => 'Invalid JSON data or missing required fields']);
}
?>