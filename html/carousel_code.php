<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                      <!-- Dynamically generate carousel items using JavaScript -->
                      <?php
                        // require_once('vendor/autoload.php');
                        $apiKey = '90565206247f3b7768d9b25bbedf68d8';

                        $client = new \GuzzleHttp\Client();

                        $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc', [
                        'headers' => [
                            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MDU2NTIwNjI0N2YzYjc3NjhkOWIyNWJiZWRmNjhkOCIsInN1YiI6IjY1ZmVkNzU0MDkyOWY2MDE3ZTliZGUyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DW9RlEQ4PPwEzMPv8vutOwT8SAD1j47bBX7F1_RIANk',
                            'accept' => 'application/json',
                        ],
                        ]);

                    // echo $response->getBody();
                    
                    // Get the response body as a string
                    $responseBody = $response->getBody()->getContents();
                    
                    // Decode the JSON string into an object
                    $popularMoviesList = json_decode($responseBody);
                    

                    // FETCHING 1 RECORD CORRECT VERSION
                    // Check if decoding was successful
                    // if ($popularMoviesList !== null && isset($popularMoviesList->results[0])) {
                    //     // Accessing the first movie
                    //     $firstMovie = $popularMoviesList->results[0];
                    
                    //     // Accessing specific properties of the first movie
                    //     $title = $firstMovie->original_title;
                    //     $backdropPath = $firstMovie->backdrop_path;
                    
                    //     // Output the title and backdrop path
                    //     echo "Movie Title: $title <br>";
                    //     echo "Backdrop Path: $backdropPath <br>";
                    //     echo "Movie Title: $title <br>";
                    // } else {
                    //     // Handle the case when decoding or accessing the data fails
                    //     echo "Failed to decode or access movie data.";
                    // }
                 
                    // FETCHING ALL RECORDS CORRECT VERSION 
                    // Check if decoding was successful and if results are present
                    // if ($popularMoviesList !== null && isset($popularMoviesList->results)) {
                    //     // Iterate through each movie in the results array
                    //     foreach ($popularMoviesList->results as $movie) {
                    //         // Accessing specific properties of each movie
                    //         $title = $movie->title;
                    //         $backdropPath = $movie->backdrop_path;

                    //         // Output the title and backdrop path for each movie
                    //         echo "Movie Title: $title <br>";
                    //         echo "Backdrop Path: $backdropPath <br>";
                    //         echo "<hr>"; // Add a horizontal line for better readability
                    //     }
                    // } else {
                    //     // Handle the case when decoding or accessing the data fails
                    //     echo "Failed to decode or access movie data.";
                    // }
                    ?>

                  <!-- <div class="carousel-item active">
                    <img src="" class="d-block w-100" alt="...">
                  </div> -->
                  <?php
                    if ($popularMoviesList !== null && isset($popularMoviesList->results)) {
                        // Iterate through each movie in the results array
                        // foreach ($popularMoviesList->results as $movie) {
                            foreach ($popularMoviesList->results as $index => $movie){
                            // Accessing specific first movie
                            $activeClass = ($index === 0) ? 'active' : '';
                            $title = $movie->title;
                            $backdropPath = $movie->backdrop_path;

                            // Output the title and backdrop path for each movie
                            // echo "Movie Title: $title <br>";
                            // echo "Backdrop Path: $backdropPath <br>";
                            // echo "<hr>"; // Add a horizontal line for better readability
                    ?>