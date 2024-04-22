<?php
    require_once('../vendor/autoload.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    </head>
    <!-- The bg-dark class sets the background color of the body to dark, and data-bs-theme="dark" is a Bootstrap 5 attribute 
        that applies a dark theme to Bootstrap components. This will ensure that all Bootstrap components, including the navbar,
         follow the dark theme. -->
    <body class="bg-dark"  data-bs-theme="dark">
        <header>
                <!-- .navbar-expand-md sets the drop down navbar for small screens only 
                    (.navbar-expand-lg sets the drop down navbar for medium & small screens)
                    .fixed-top:  navbar remains fixed at the top of the viewport, regardless of scrolling -->
            <nav class="navbar navbar-expand-lg fixed-top bg-dark"  data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand logo ps-2 order-first" href="#">Film Frenzy</a>
                    <div class="d-flex align-items-center">
                        <form class="d-block d-none  d-sm-block d-md-block d-lg-none flex-grow-1" role="search">
                                <div class="input-group">
                                    <input class="form-control pe-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="bi bi-search text-white"></i>
                                    </button>
                                </div>
                        </form>
                    <?php
                    $isLoggedin = false;
                    if ($isLoggedin) {
                    ?> 
                        <div class="nav-item dropdown ms-3 d-block d-lg-none">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span  class=" dropdown-toggle"></span>
                            <img src="../img/user-avatar.png" alt="" class="profile-picture">
                            </a>
                            <ul class="dropdown-menu ">
                            <li><a class="dropdown-item" href="#">My List</a></li>
                            <li><a class="dropdown-item" href="#">My Favorites</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"> Sign Out </a></li>
                            </ul>
                        </div>
                    <?php
                        } else{
                    ?>
                        <a class="login-link  ms-3 d-block d-lg-none" href="#">
                            <i class="bi bi-person-fill me-1"></i> Sign In
                        </a>
                    <?php
                        }
                    ?>
                        <div class="" style="padding-top: 11px;">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse order-md-last order-sm-last order-xs-last order-xxs-last order-lg-first" id="navbarSupportedContent">
                        <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0"> -->
                        <ul class="navbar-nav ps-3">
                            <li class="nav-item menu-list-items">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item menu-list-items">
                                <a class="nav-link" href="#">Create Account</a>
                            </li>
                            <li class="nav-item menu-list-items">
                                <a class="nav-link" href="#">Members</a>
                            </li>
                            <!-- <li class="nav-item menu-list-items">
                                <a class="nav-link" href="#">Sign In</a>
                            </li> -->
                            <li class="nav-item menu-list-items">
                                <a class="nav-link" href="#">Movies</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                            </li> -->
                        </ul>
                        <!-- <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> -->
                        <form class="d-flex  d-xs-block d-sm-none ps-3 pe-1" role="search">
                            <div class="input-group" style="max-width:80%">
                                <input class="form-control pe-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search text-white"></i>
                                </button>
                            </div>
                        </form>                       
                    </div>
                    <form class="d-flex d-none d-lg-block" role="search">
                            <div class="input-group">
                                <input class="form-control pe-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search text-white"></i>
                                </button>
                            </div>
                    </form>
                    <?php
                    $isLoggedin = false;
                    if ($isLoggedin) {
                    ?> 
                    <div class="nav-item dropdown ps-3 pe-4 d-none d-lg-block">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span  class=" dropdown-toggle"></span>
                        <img src="../img/user-avatar.png" alt="" class="profile-picture">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">My List</a></li>
                        <li><a class="dropdown-item" href="#">My Favorites</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"> Sign Out </a></li>
                        </ul>
                    </div>
                    <?php
                        } else{
                    ?>
                        <a class="login-link ps-3 pe-4 d-none d-lg-block" href="#">
                            <i class="bi bi-person-fill me-1"></i> Sign In
                        </a>

                    <?php
                    }
                    ?>
                </div>
            </nav>
        </header>
        <div class="container-fluid main-body">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="15000">
                <div class="carousel-inner">
                      <!-- Dynamically generate carousel items using PHP -->
                      <?php
                        $apiKey = '90565206247f3b7768d9b25bbedf68d8';
                        $client = new \GuzzleHttp\Client();
                        $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc', [
                        'headers' => [
                            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MDU2NTIwNjI0N2YzYjc3NjhkOWIyNWJiZWRmNjhkOCIsInN1YiI6IjY1ZmVkNzU0MDkyOWY2MDE3ZTliZGUyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DW9RlEQ4PPwEzMPv8vutOwT8SAD1j47bBX7F1_RIANk',
                            'accept' => 'application/json',
                        ],
                        ]);
                    
                    // Get the response body as a string
                    $responseBody = $response->getBody()->getContents();
                    
                    // Decode the JSON string into an object
                    $popularMoviesList = json_decode($responseBody);
                    

                    // FETCHING 1 RECORD BASED ON INDEX CORRECT VERSION
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
                  <?php
                    if ($popularMoviesList !== null && isset($popularMoviesList->results)) {
                        // Iterate through each movie in the results array
                            foreach ($popularMoviesList->results as $index => $movie){
                            // Accessing specific first movie
                            $activeClass = ($index === 0) ? 'active' : '';
                            $title = $movie->title;
                            $backdropPath = $movie->backdrop_path;
                            // Output the title and backdrop path for each movie
                            // echo "Movie Title: $title <br>";       

                    ?>
                    <div class="carousel-item <?=$activeClass?>">
                        <div class="carousel-overlay"></div> <!-- Overlay for gradient effect -->
                        <img src="https://image.tmdb.org/t/p/original<?=$backdropPath?>" class="d-block w-100" alt="<?=$title?>">
                        <div class="carousel-caption d-none d-md-block mb-4" style="color:white; font-weight:600;">
                           <h5 style="font-size:30px">
                               <div class="featured-content" id="carousel">
                                 <div class="featured-desc"></div>
                               </div>
                           </h5>
                        </div>
                    </div>
                    <?php 
                    } } else {
                        echo "Failed to decode or access movie data.";
                    }
                  ?>
                </div>
            </div> 
            <!-- CAROUSEL END -->
            <div class="container">
    <div class="content-container">
        <div class="movie-list-container row">
            <div class="movie-list-wrapper col-md-10 offset-md-1">
                <div class="row justify-content-between">
                    <div class="movie-list-title col-lg-6">
                        <h1 class="movie-list-title">New Releases</h1>
                    </div>
                    <div class="col-6 d-flex justify-content-end arrow-icon">
                        <i class="fa-solid fa-arrow-right" id="arrow"></i>
                    </div>
                </div>
                <div class="movie-list-container-outer">
                    <div class="movie-list-container-inner">
                        <div class="movie-list row">
                        <?php
                            // TMDb API key
                            $apiKey = '90565206247f3b7768d9b25bbedf68d8';
                            // Authorization token
                            $authToken = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MDU2NTIwNjI0N2YzYjc3NjhkOWIyNWJiZWRmNjhkOCIsInN1YiI6IjY1ZmVkNzU0MDkyOWY2MDE3ZTliZGUyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DW9RlEQ4PPwEzMPv8vutOwT8SAD1j47bBX7F1_RIANk';

                            // Guzzle HTTP client
                            $client = new \GuzzleHttp\Client();

                            // Request to fetch popular movies
                            $response = $client->request('GET', 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc', [
                                'headers' => [
                                    'Authorization' => 'Bearer ' . $authToken,
                                    'accept' => 'application/json',
                                ],
                            ]);

                            // Get the response body as a string
                            $responseBody = $response->getBody()->getContents();

                            // Decode the JSON string into an object
                            $popularMoviesList = json_decode($responseBody);

                            // Check if decoding was successful and if results are available
                            if ($popularMoviesList !== null && isset($popularMoviesList->results)) {
                                // Limit the number of posters to 4
                                $postersLimit = 6;

                                // Counter to keep track of posters displayed
                                $postersDisplayed = 0;

                                // Iterate through each movie in the results array
                                foreach ($popularMoviesList->results as $movie) {
                                    // Break loop if the number of posters displayed exceeds the limit
                                    if ($postersDisplayed >= $postersLimit) {
                                        break;
                                    }

                                    $title = $movie->title;
                                    $posterPath = $movie->poster_path;

                                    // Output the movie poster as a list item
                                    ?>
                                    <div class="movie-list-item col-lg-2 col-md-4 col-sm-6 mb-4">
                                        <img src="https://image.tmdb.org/t/p/original<?=$posterPath?>" alt="<?=$title?>" class="movie-list-item-img img-fluid">
                                        <!-- Add your additional features here -->
                                        <span class="movie-list-item-watched"><i class="fa-regular fa-eye"></i></span>
                                        <span class="movie-list-item-liked"><i class="fa-solid fa-heart"></i></span>
                                    </div>
                                    <?php

                                    // Increment the counter for posters displayed
                                    $postersDisplayed++;
                                }
                            } else {
                                // Display error message if unable to fetch movie data
                                echo "Failed to decode or access movie data.";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="service-list-container container">
   <div class="service-list-title">
      <h1 >FilmFrenzy lets you...</h1>
   </div>
   <div class="service-list-wrapper">
      <div class="service-list">
         <div class="row">
            <div class="service-list-item col-md-4">
               <div class="notification">
                  <div class="notiglow"></div>
                  <div class="notiborderglow"></div>
                  <div class="notititle">Rating</div>
                  <div class="notibody">
                     To document and communicate your response,
                     your response, give each movie a five-star rating(with half).
                  </div>
               </div>
            </div>
            <div class="service-list-item col-md-4">
               <div class="notification">
                  <div class="notiglow"></div>
                  <div class="notiborderglow"></div>
                  <div class="notititle">Journal</div>
                  <div class="notibody">keep a journal of the movie you view.</div>
               </div>
            </div>
            <div class="service-list-item col-md-4">
               <div class="notification">
                  <div class="notiglow"></div>
                  <div class="notiborderglow"></div>
                  <div class="notititle">Reviews</div>
                  <div class="notibody">Create reviews, and read those of your friends and fellow members by following them.</div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="service-list-item col-md-4">
               <div class="notification">
                  <div class="notiglow"></div>
                  <div class="notiborderglow"></div>
                  <div class="notititle">Watchlists</div>
                  <div class="notibody">Create a watchlist of movies you want to view and share lists of movies on any subject.</div>
               </div>
            </div>
            <div class="service-list-item col-md-4">
               <div class="notification">
                  <div class="notiglow"></div>
                  <div class="notiborderglow"></div>
                  <div class="notititle">News</div>
                  <div class="notibody">keep up to date for every movie,director and actors news.</div>
               </div>
            </div>
            <div class="service-list-item col-md-4">
               <div class="notification">
                  <div class="notiglow"></div>
                  <div class="notiborderglow"></div>
                  <div class="notititle">Likes</div>
                  <div class="notibody">Leave a "like" on your favorite movies, lists and reviews to show some love.</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
        </div> 
  
            <!-- BODY CONTENT ENDS HERE -->
        </div>


        <div class="container-fluid">
        <div class="owl-carousel owl-theme">
            <?php
            // Iterate through each movie in the results array
            foreach ($popularMoviesList->results as $movie) {
                // Extract movie details
                $title = $movie->title;
                $posterPath = $movie->poster_path;
                ?>
                <div class="owel-item-active" style="width:170px;">
                <div class="owel-stage-outer" style="padding-top:50px; padding-bottom:50px;">
                <div class="item" style="margin-right:5px;" >
                    <div class="card movie-card">
                        <img src="https://image.tmdb.org/t/p/original<?=$posterPath?>" alt="<?=$title?>" class="card-img-top">
                        <span class="movie-list-item-watched"><i class="fa-regular fa-eye"></i></span>
                        <span class="movie-list-item-liked"><i class="fa-solid fa-heart"></i></span>
                    </div>
                </div>
            </div>
                </div>
               
                <?php
            }
            ?>
            
            
    </div>
</div>


            
<!-- </div> -->




        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../js/main.js"></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script>
                 $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
        </script>
    </body>
</html>