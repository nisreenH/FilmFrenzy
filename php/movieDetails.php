<?php
    session_start();
    require_once('../vendor/autoload.php');
    $client = new \GuzzleHttp\Client();
    
    if(isset($_GET['movieId'])){
        $movieId = $_GET['movieId'];
    }
    require_once '../php/connection.php';
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
        <link rel="stylesheet" href="../css/movieDetails.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="../js/main.js"></script>
        <script src="../js/movieDetails.js" defer></script>
    </head>
    <!-- The bg-dark class sets the background color of the body to dark, and data-bs-theme="dark" is a Bootstrap 5 attribute 
        that applies a dark theme to Bootstrap components. This will ensure that all Bootstrap components, including the navbar,
         follow the dark theme. -->
    <body class="bg-dark"  data-bs-theme="dark">
    <header>
                <!-- .navbar-expand-md sets the drop down navbar for small screens only 
                    (.navbar-expand-lg sets the drop down navbar for medium & small screens)
                    .fixed-top:  navbar remains fixed at the top of the viewport, regardless of scrolling -->
                    <nav class="navbar navbar-expand-lg fixed-top"  data-bs-theme="dark">
            <!-- <nav class="navbar navbar-expand-lg fixed-top"  style="background-color: rgba(255, 255, 255, 0.7);"> -->
                <div class="container-fluid">
                    <a class="navbar-brand logo ps-2 order-first" href="../php/index.php">Film Frenzy</a>
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
                        if(isset($_SESSION['username'])){
                            $username = $_SESSION['username'];
                            $query = "SELECT username, avatar FROM users WHERE username = ?";
                            $stmt = $con->prepare($query);
                            $stmt->bind_param('s', $username);
                            $stmt->execute();
                            $stmt->bind_result($fetched_username, $avatar);
                            $stmt->fetch();
                            $_SESSION['avatar'] = $avatar;
                            $stmt->close();
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
                            <li><a class="dropdown-item" href="../php/logout.php"> Sign Out </a></li>
                            </ul>
                        </div>
                    <?php
                        } else{
                    ?>
                        <a class="login-link  ms-3 d-block d-lg-none" href="../php/login.php">
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
                                <a class="nav-link active" aria-current="page" href="../php/index.php">Home</a>
                            </li>
                            <?php
                             if(!isset($_SESSION['username'])) {
                             ?> 
                            <li class="nav-item menu-list-items">
                                <a class="nav-link" id="registerBtn">Create Account</a>
                            </li>
                            <?php } ?>
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
                        <!-- <form class="d-flex  d-xs-block d-sm-none ps-3 pe-1" role="search">
                            <div class="input-group" style="max-width:80%">
                                <input class="form-control pe-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search text-white"></i>
                                </button>
                            </div>
                        </form>  -->
                        <form class="d-flex  d-xs-block d-sm-none ps-3 pe-1" role="search">
                            <div class="input-group" style="max-width:80%">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit" style="border: none;"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
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
                        if(isset($_SESSION['username'])){
                    ?> 
                    <div class="nav-item dropdown ps-3 pe-4 d-none d-lg-block">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span  class=" dropdown-toggle"></span>
                        <img src="<?php echo isset($_SESSION['avatar']) ? $_SESSION['avatar'] : '../img/user-avatar.png'; ?>" alt="" class="profile-picture navbar-profile-picture" onclick= "window.location.href = 'Profile.php';">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">My List</a></li>
                        <li><a class="dropdown-item" href="#">My Favorites</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../php/logout.php"> Sign Out </a></li>
                        </ul>
                    </div>
                    <?php
                        } else{
                    ?>
                        <!-- <a class="login-link ps-3 pe-4 d-none d-lg-block" href="../php/login.php" id="signInBtn"> -->
                        <a class=" nav-link login-link ps-3 pe-4 d-none d-lg-block" id="signInBtn">
                                <i class="bi bi-person-fill me-1"></i> Sign In
                        </a>

                    <?php
                    }
                    ?>
                </div>
            </nav>
        </header>
        <div class="container-fluid main-body">
             <!-- Move Details Card -->
             <?php             
           
             $movieDetailsResponse = $client->request('GET', "https://api.themoviedb.org/3/movie/{$movieId}?language=en-US", [
               'headers' => [
                 'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MDU2NTIwNjI0N2YzYjc3NjhkOWIyNWJiZWRmNjhkOCIsInN1YiI6IjY1ZmVkNzU0MDkyOWY2MDE3ZTliZGUyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DW9RlEQ4PPwEzMPv8vutOwT8SAD1j47bBX7F1_RIANk',
                 'accept' => 'application/json',
               ],
             ]);
            //  echo $movieDetailsResponse->getBody();

              // Get the response body as a string
              $movieDetailsResponseBody = $movieDetailsResponse->getBody()->getContents();
                    
              // Decode the JSON response into a PHP object
              $movie = json_decode($movieDetailsResponseBody);
           
            //   if ($movie !== null && isset($movie->results)) {
                if ($movie !== null) {
                    $title = $movie->title;
                    $backdropPath = $movie->backdrop_path; 
                    // genres is an array
                    $genres = $movie->genres;
                    $genreNames = "";
                    foreach ($genres as $key => $genre) {
                        $genreNames .= $genre->name; 

                        
                        if ($key < count($genres) - 1) {
                            $genreNames .= ", ";
                        }
                    }

                    
                    $revenueFormatted = number_format($movie->revenue, 0, '.', ',');
                    $revenueFormatted = '$' . $revenueFormatted;

                    
                    $releaseDateFormatted = date('F j, Y', strtotime($movie->release_date));

                    // Format vote average to display only one digit after the decimal point
                    $voteAverageFormatted = number_format($movie->vote_average, 1);
                    //   echo $movieDetailsResponse->getBody();  
                    
                    $posterBaseUrl = 'https://image.tmdb.org/t/p/w500';
                    $posterPath = $movie->poster_path;
                    $posterUrl = $posterBaseUrl . $posterPath;

                    $crewResponse = $client->request('GET', "https://api.themoviedb.org/3/movie/{$movieId}/credits?language=en-US", [
                        'headers' => [
                            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MDU2NTIwNjI0N2YzYjc3NjhkOWIyNWJiZWRmNjhkOCIsInN1YiI6IjY1ZmVkNzU0MDkyOWY2MDE3ZTliZGUyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DW9RlEQ4PPwEzMPv8vutOwT8SAD1j47bBX7F1_RIANk',
                            'accept' => 'application/json',
                        ],
                    ]);
                
                    
                    $crewResponseBody = $crewResponse->getBody()->getContents();
                
                 
                    $credits = json_decode($crewResponseBody);
                
                    
                    $director = "";
                    foreach ($credits->crew as $member) {
                        if ($member->job == "Director") {
                            $director = $member->name;
                            break;
                        }
                    }
             ?>
            <div class="container">
                <div class="row g-0">
                    <div class="col-lg-12 col-md-12">
                    <div class="image-container-movie-details-card">
                        <img src="https://image.tmdb.org/t/p/original<?=$backdropPath?>" class="img-fluid rounded-start movie-bg-img" alt="...">
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                    <div class="card-body">
                        <h5 class="movie-details-title">
                        <?=$movie->title?> 
                        <a href="#" class="movie-details-director">by <?=$director?></a>
                        </h5>
                        <p class="card-text movie-details-overview my-4"><?=$movie->overview?></p>
                        <button class="btn btn-primary my-5">
                        <a href="#review-section"><i class="fa-solid fa-arrow-down p-1"></i>Review</a>
                        </button>
                    </div>
                    </div>
                    <div class="col-lg-5 col-md-5 text-center">
                    <div class="card movie-details-poster-card">
                        <?php if (!empty($posterUrl)) { ?>
                        <img src="<?php echo $posterUrl; ?>" alt="<?php echo $title; ?> Poster" class="movie-details-poster-img">
                        <?php } else { ?>
                        <img src="placeholder_image_url" alt="Placeholder">
                        <?php } ?>
                    </div>
                    <?php
                        if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        $query = "SELECT username, avatar FROM users WHERE username = ?";
                        $stmt = $con->prepare($query);
                        $stmt->bind_param('s', $username);
                        $stmt->execute();
                        $stmt->bind_result($fetched_username, $avatar);
                        $stmt->fetch();
                        $_SESSION['avatar'] = $avatar;
                        $stmt->close();
                    ?>
                    <div class="border my-4 rounded service-wrapper" id="service-wrapper">
                        <div class="row my-3">
                        <div class="col-4 services-text">
                            <i class="fa-solid fa-heart p-1 add-to-favorites" data-movie-id="<?= $movie->id ?>"></i>Like
                        </div>
                        <div class="col-4 services-text">
                        <i class="fa-solid fa-bookmark p-1 add-to-watchlist" data-movie-id="<?= $movie->id ?>"></i>Watchlist
                        </div>
                        <div class="col-4 services-text">
                            <i class="fa-solid fa-list p-1"></i>List
                        </div>
                        </div>
                        <hr>
                        <div class="row rating-stars-box mb-3">
                        <div class="container stars-container">
                            <div class="stars text-center col-lg-12" data-rating="0" data-movie-id="<?= $movie->id ?>">
                            <i class="fa-solid fa-star" data-value="1"></i>
                            <i class="fa-solid fa-star" data-value="2"></i>
                            <i class="fa-solid fa-star" data-value="3"></i>
                            <i class="fa-solid fa-star" data-value="4"></i>
                            <i class="fa-solid fa-star" data-value="5"></i>
                            <span class="cancel-rating col-lg-2">&times;</span>
                            </div>
                        </div>
                        </div>
                        <div id="star-count-display"></div>
                        
                    </div>
                    </div>
                    <?php } else { ?>
                    <div class="row not-logged alert alert-warning mt-3">
                    <h4 class="text-center my-4 not-logged-text" style="font-family:var(--popins);">
                        <i class="fa-solid fa-triangle-exclamation"></i>Login to use FilmFrenzy Features!
                    </h4>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
             
<!-- filter-menu -->
<section class="filter-menu my-5">
        <div class="container">
            <div class="row">
                <!-- <h1 class="uppercase text-center">menu</h1> -->
                <ul id="filter-menu">
                    <li class="current filter-menu-element" data-filter="cast">CAST</li>
                    <li class="filter-menu-element" data-filter="details">DETAILS</li>
                    <li class="filter-menu-element" data-filter="review">REVIEWS</li>
                    <li class="filter-menu-element" data-filter="rating">RATING</li>
                </ul>
            </div>
        </div>
        <div class="row displayed-items">
            <div class="items text-center">
            <?php

                require_once('../vendor/autoload.php');
                require_once '../php/connection.php';

                if (isset($_GET['movieId'])) {
                    $movieId = $_GET['movieId'];

                } else {
                    die("Error: Movie ID parameter missing.");
                }

                // Fetch user details
                $username = $_SESSION['username'];
                $query = "SELECT username, avatar FROM users WHERE username = ?";
                $stmt = $con->prepare($query);
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $stmt->bind_result($fetched_username, $avatar);
                $stmt->fetch();
                $_SESSION['avatar'] = $avatar;
                $stmt->close();

                // Fetch reviews
                $query = "SELECT reviews.review_text, reviews.timestamp, users.username, users.avatar, ratings.rating
                            FROM reviews
                            JOIN users ON reviews.user_id = users.user_id
                            LEFT JOIN ratings ON reviews.user_id = ratings.user_id AND reviews.movie_id = ratings.movie_id
                            WHERE reviews.movie_id = ?";
                $stmt = $con->prepare($query);

                if (!$stmt) {
                    die("Prepare failed: (" . $con->errno . ") " . $con->error);
                }

                $stmt->bind_param("i", $movieId);
                if (!$stmt->execute()) {
                    die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
                }

                $result = $stmt->get_result();

                if (!$result) {
                    die("Getting result set failed: (" . $stmt->errno . ") " . $stmt->error);
                }

                $reviews = [];
                while ($row = $result->fetch_assoc()) {
                    $reviews[] = [
                        'review_text' => $row['review_text'],
                        'timestamp' => $row['timestamp'],
                        'username' => $row['username'],
                        'avatar' => $row['avatar'],
                        'rating' => $row['rating']
                    ];
                }

                $stmt->close();
                $con->close();
                ?>

                <div class="container mt-5">
                        <div class="row">
                            <div class="col-12 card-text review hidden">
                                <h3>Popular Reviews <hr style="postion:relative;"></h3>
                                <?php foreach ($reviews as $review): ?>
                                    <div class="row my-3">
                                        <div class="col-lg-3"><img src="<?= htmlspecialchars($review['avatar']) ?>" alt="Avatar" class="review-avatar"></div>
                                        <div class="col-lg-9 justify-content-start">
                                            <p class="username">Review by <b style="font-family:var(--popins); color:#4dbf00;"><?= htmlspecialchars($review['username']) ?></b>
                                            <?php if (!empty($review['rating'])): ?>
                                                
                                                    <?php for ($i = 0; $i < floor($review['rating']); $i++): ?>
                                                        <i class="bi bi-star-fill review-stars"></i>
                                                    <?php endfor; ?>
                                                    <?php if ($review['rating'] - floor($review['rating']) > 0): ?>
                                                        <i class="bi bi-star-half"></i>
                                                    <?php endif; ?>
                                            <?php endif; ?>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                              <p class="review-text mt-2 " style="font-family:var(--roboto);"><?= htmlspecialchars($review['review_text']) ?></p>
                                            </div>
                                        </div>
                                        <p class="row justify-content-end timestamp"><?= htmlspecialchars($review['timestamp']) ?></p>
                                        <hr style="postion:relative;">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <p class="card-text details"><b>Runtime:</b> <?=$movie->runtime?>min</p>
                <p class="card-text details"><b>Release Date:</b> <?=$releaseDateFormatted?></p>
                <p class="card-text details"><b> Genre:</b> <?=$genreNames?></p>
                <p class="card-text details"> <b>Boxoffice Revenue:</b> <?=$revenueFormatted?></p>
                
                <p class="card-text rating hidden"><i class="bi bi-star-fill text-warning"></i> <?=$voteAverageFormatted?>/10</p>
                <!-- <p class="card-text rating hidden" id="user-rating"><i class="fa-solid fa-star"></i>your rating : </p> -->
                <div class="container mt-3 card-text cast hidden">
                    <div class="row row-cols-2  row-cols-md-3 row-cols-sm-3 g-4 ms-5">
                    <!-- <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 g-4 ms-5 border border-3 rounded p-3"> -->
                            <?php
                                $movieCreditsResponse = $client->request('GET', "https://api.themoviedb.org/3/movie/{$movieId}/credits?language=en-US", [
                                'headers' => [
                                    'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MDU2NTIwNjI0N2YzYjc3NjhkOWIyNWJiZWRmNjhkOCIsInN1YiI6IjY1ZmVkNzU0MDkyOWY2MDE3ZTliZGUyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DW9RlEQ4PPwEzMPv8vutOwT8SAD1j47bBX7F1_RIANk',
                                    'accept' => 'application/json',
                                ],
                                ]);

                                // echo $movieCreditsResponse->getBody();

                                $movieCreditsResponseBody = $movieCreditsResponse->getBody()->getContents();
                                        
                                // Decode the JSON response into a PHP object
                                $movieCredits = json_decode($movieCreditsResponseBody);

                                if ($movieCredits !== null) {
                                    // cast is an array
                                    $castActors = $movieCredits->cast;
                                    foreach ($castActors as $key => $actor) {
                                        $actorName = $actor->name; // Append the current genre name
                                        // echo  $actorName ." cast Id ".$actor->cast_id ." ORDER ".$actor->order ."<br>";
                            
                                        // Append a comma if it's not the last genre
                                        // if ($key < count($genres) - 1) {
                                        //     $genreNames .= ", ";
                                        // }

                                        if($actor->order < 12){
                                            // echo  $actorName ." cast Id ".$actor->cast_id ." ORDER ".$actor->order ."<br>";
                                //         }
                                //     }
                                // }
                            ?>
                    <!-- CAST CARDS -->
                            <!-- <div class="row row-cols-1 row-cols-md-3 g-4"> -->
                                <div class="col-6">
                                    <div class="card h-100 castCard">
                                    <img src="https://image.tmdb.org/t/p/original<?=$actor->profile_path?>" id="actorImage"  class="card-img-top" alt="Actor Image">
                                    <div class="card-body">
                                        <h5 class="card-title text-center mb-0 actor-name"> <a href="#"><?=$actor->name?></a> </h5>
                                        <p class="card-title text-center mt-2 character-name"><?=$actor->character?></p>
                                    </div>
                                    </div>
                                </div>
                                
                    <?php } } }?>

                    </div>
                    </div>
                </div>

                
</section>
<!-- filter menu end   -->
<hr>
<!-- review section  -->
<section class="review-section text-center my-4" id="review-section">
    <form id="review-form">
      <div class="container review-container">
        <div class="form-floating row textarea-row">
                <textarea class="form-control bg-light textarea-row-text " placeholder="Leave a comment here" id="floatingTextarea2" style="height: 350px; "></textarea>
                <label for="floatingTextarea2" class="label-textarea" style="width:180px;">Write your review</label>
            </div>
            <button type="submit" class="featured-button row submit-row my-2 text-center" data-movie-id="<?= $movie->id ?>">Submit Review</button>
      </div>
    </form>
    <div id="review-message"></div>
</section>
<!-- review section end  -->



        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../js/main.js"></script>
        <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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