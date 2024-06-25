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
                        
                        $query = "SELECT movie_id FROM favorites WHERE user_id = ?";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param("i", $userId);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        $likedMovieIds = [];
                        while ($row = $result->fetch_assoc()) {
                            $likedMovieIds[] = $row['movie_id'];
                        }
                        
                        $stmt->close();
                        // $con->close();
                        
                        $apiKey = '90565206247f3b7768d9b25bbedf68d8';
                        $client = new \GuzzleHttp\Client();
                        $movies = [];

                            foreach ($likedMovieIds as $movieId) {
                                try {
                                    // Request movie details from TMDb API
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
                                    // Log the error or handle it as needed
                                    error_log('Error fetching movie details: ' . $e->getMessage());
                                }
                            }
                        @header('Content-Type: application/json'); // Set the content type header
                        // echo json_encode($posters);
                        ?>
                        
                       