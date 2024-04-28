<?php
    session_start();
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
        <script src="../js/main.js"></script>
    </head>
    <!-- The bg-dark class sets the background color of the body to dark, and data-bs-theme="dark" is a Bootstrap 5 attribute 
        that applies a dark theme to Bootstrap components. This will ensure that all Bootstrap components, including the navbar,
         follow the dark theme. -->
         <header>
                <!-- .navbar-expand-md sets the drop down navbar for small screens only 
                    (.navbar-expand-lg sets the drop down navbar for medium & small screens)
                    .fixed-top:  navbar remains fixed at the top of the viewport, regardless of scrolling -->
            <nav class="navbar navbar-expand-lg fixed-top"  data-bs-theme="dark">
            <!-- <nav class="navbar navbar-expand-lg fixed-top"  style="background-color: rgba(255, 255, 255, 0.7);"> -->
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
                        // $isLoggedin = false;
                        // if ($isLoggedin) {
                    if(isset($_SESSION['username'])){
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
                    // $isLoggedin = false;
                    // if ($isLoggedin) {
                        if(isset($_SESSION['username'])){
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
                        <li><a class="dropdown-item" href="../php/logout.php"> Sign Out </a></li>
                        </ul>
                    </div>
                    <?php
                        } else{
                    ?>
                        <a class="login-link ps-3 pe-4 d-none d-lg-block" href="../php/login.php">
                            <i class="bi bi-person-fill me-1"></i> Sign In
                        </a>

                    <?php
                    }
                    ?>
                </div>
            </nav>
        </header>
    <body class="bg-dark"  data-bs-theme="dark">

        <div class="container-fluid main-body">
            <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner" id="carouselInner">
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
                    <div class="carousel-item <?=$activeClass?>" data-bs-interval="1500">
                        <div class="carousel-overlay"></div> <!-- Overlay for gradient effect -->
                        <img src="https://image.tmdb.org/t/p/original<?=$backdropPath?>" class="d-block w-100" alt="<?=$title?>">
                        <div class="carousel-caption d-none d-md-block mb-4" style="color:white; font-weight:600;">
                           <h5 style="font-size:30px">
                               <div class="featured-content" id="carousel">
                                 <div class="featured-desc">
                                    <!-- <button class="featured-button">Get started!</button> -->
                                 </div>
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
            <!-- login form -->
             <section class="home">
                   <div class="form-container">
                   <i class="fa-regular fa-circle-xmark form_close"></i>
                    <div class="form login-form">
                        <form action="#">
                            <h2>Login</h2>
                            <div class="input-box">
                                <input type="email" placeholder="enter your email address." required />
                                <i class="fa-regular fa-envelope email"></i>
                            </div>
                            <div class="input-box">
                                <input type="password" placeholder="enter your password." required />
                                <i class="fa-solid fa-lock password"></i>
                            </div>
                            <div class="option-field">
                                <!-- <span class="checkbox">
                                    <input type="checkbox" id="check">
                                    <label for="check">Remember me</label>
                                </span> -->
                                <a href="#" class="forgot-password">Forgot password?</a>
                            </div>
                            <button class="button">Login Now</button>
                            <div class="login-signup">
                                 Don't have an account <a href="#" id="signup">Signup</a>
                            </div>
                        </form>
                    </div>
                    <div class="form signup-form">
                        <form action="#">
                            <h2>Signup</h2>
                            <div class="input-box">
                                <input type="email" placeholder="enter your email address."  required />
                                <i class="fa-regular fa-envelope email"></i>
                            </div>
                            <div class="input-box">
                                <input type="password" placeholder="create password." required />
                                <i class="fa-solid fa-lock password"></i>
                            </div>
                            <div class="input-box">
                                <input type="password" placeholder="confirm password." required />
                                <i class="fa-solid fa-lock password"></i>
                            </div>
                            <button class="button">Signup Now</button>
                            <div class="login-signup">
                                 already have an account <a href="#" id="login">Login</a>
                            </div>
                        </form>
                    </div>
                   </div>
             </section>

            <!-- end of login form -->
            
    <!-- End of Movie Carousel -->

    <!-- Service Section -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <!-- FilmFrenzy Features -->
            <div class="col-md-12">
                <div class="service-list-container">
                    <div class="service-list-title">
                        <h1 style="margin-bottom: 1px;">FilmFrenzy Features</h1>
                        <hr style="margin-top: 0px;">
                    </div>
                    <div class="service-list-wrapper">
                        <div class="service-list">
                            <div class="row">
                                <!-- Rating Feature -->
                                <div class="service-list-item col-md-4">
                                    <div class="notification">
                                        <div class="notiglow"></div>
                                        <div class="notiborderglow"></div>
                                        <div class="notititle">Rating</div>
                                        <div class="notibody">Give each movie a five-star rating (with half).</div>
                                    </div>
                                </div>
                                <!-- Journal Feature -->
                                <div class="service-list-item col-md-4">
                                    <div class="notification">
                                        <div class="notiglow"></div>
                                        <div class="notiborderglow"></div>
                                        <div class="notititle">Journal</div>
                                        <div class="notibody">Keep a journal of the movies you view.</div>
                                    </div>
                                </div>
                                <!-- Reviews Feature -->
                                <div class="service-list-item col-md-4">
                                    <div class="notification">
                                        <div class="notiglow"></div>
                                        <div class="notiborderglow"></div>
                                        <div class="notititle">Reviews</div>
                                        <div class="notibody">Create and read reviews, and follow friends and fellow members to see their reviews.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Watchlists Feature -->
                                <div class="service-list-item col-md-4">
                                    <div class="notification">
                                        <div class="notiglow"></div>
                                        <div class="notiborderglow"></div>
                                        <div class="notititle">Watchlists</div>
                                        <div class="notibody">Create watchlists of movies you want to view and share lists on any subject.</div>
                                    </div>
                                </div>
                                <!-- News Feature -->
                                <div class="service-list-item col-md-4">
                                    <div class="notification">
                                        <div class="notiglow"></div>
                                        <div class="notiborderglow"></div>
                                        <div class="notititle">News</div>
                                        <div class="notibody">Stay up-to-date with news about every movie, director, and actor.</div>
                                    </div>
                                </div>
                                <!-- Likes Feature -->
                                <div class="service-list-item col-md-4">
                                    <div class="notification">
                                        <div class="notiglow"></div>
                                        <div class="notiborderglow"></div>
                                        <div class="notititle">Likes</div>
                                        <div class="notibody">Leave a "like" on your favorite movies, lists, and reviews.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of FilmFrenzy Features -->
        </div>
    </div>
    <!-- End of Service Section -->
</div>
    <!-- start of card carousel -->
    <div class="container"> 
        <div class="service-list-title row" style="transform: translate(0, 70%);">
                      <div class="col-6">
                        <h1 style="margin-bottom: 1px;">New Realeases</h1>
                      </div>
                      <div class="col-6 text-right" style="transform: translate(90%,0);">
                        <h2><a href="#" style="text-decoration: none; color: inherit;">more</a></h2>
                      </div>
                        <hr style="margin-top: 0px;">
        </div>
        <div class="row">
            <div class="col-12">
            <div class="owl-carousel owl-theme">
            <?php
            // Iterate through each movie in the results array
            foreach ($popularMoviesList->results as $movie) {
                // Extract movie details
                $movieId = $movie->id;
                $title = $movie->title;
                $posterPath = $movie->poster_path;
                ?>
                <div class="mx-1" style="width: fit-content; margin-right: -10px;">
                        <div class="movie-wrapper" style="padding: 50px 0px">
                            <a href="../php/movieDetails.php?movieId=<?= $movie->id ?>" class="movie-link">
                                <div class="item movie-list-item" style="150px">
                                    <div class="card movie-card">
                                        <img src="https://image.tmdb.org/t/p/original<?= $movie->poster_path ?>" alt="<?= $movie->title ?>" class="card-img-top movie-list-item-img">
                                        <span class="movie-list-item-watched"><i class="fa-regular fa-eye"></i></span>
                                        <span class="movie-list-item-liked"><i class="fa-solid fa-heart"></i></span>
                                        <!-- Button for Add to Favorites -->
                                        <!-- <button onclick="addMovietoFavorites(<?= $movieId ?>)" class="btn btn-sm btn-outline-primary position-absolute top-0 start-0 mt-2 ms-2" style="background: linear-gradient(to right, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0)); border-color: rgba(255, 255, 255, 0.5); color: white;">
                                            <i class="fas fa-heart"></i> Add to Favorites
                                        </button> -->
                                        <!-- <button onclick="addMovietoFavorites(<?= $movieId ?>)"  class="btn btn-sm btn-outline-primary position-absolute top-0 start-0 mt-2 ms-2 add-to-favorites" data-movie-id="<?= $movie->id ?>" style="background: linear-gradient(to right, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0)); border-color: rgba(255, 255, 255, 0.5); color: white;">
                                            <i class="fas fa-heart"></i> Add to Favorites
                                        </button> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- <button onclick="addMovietoFavorites(<?= $movieId ?>)" data-movie-id="<?= $movie->id ?>" style="background: linear-gradient(to right, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0)); border-color: rgba(255, 255, 255, 0.5); color: white;">
                                            <i class="fas fa-heart"></i> Add to Favorites
                        </button> -->
                        <button  class="btn btn-sm btn-outline-primary position-absolute top-0 start-0 mt-2 ms-2 add-to-favorites" data-movie-id="<?= $movie->id ?>" style="background: linear-gradient(to right, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0)); border-color: rgba(255, 255, 255, 0.5); color: white;">
                                            <i class="fas fa-heart"></i> Add to Favorites
                        </button>
                    </div>
               
                <?php
            }
            ?>      
    </div>
            </div>
        </div>
        
</div>
<!-- end of card carousel -->
<!-- start oscar section -->
<section class="gradient-section">
    <div class="gradient-overlay"></div>
    <div class="container-fluid content">
      <div class="row">
        <div class="col-6">
          <!-- <img src="../img/pngwing.com (1).png" alt=""> -->
        </div>
       
    </div>
    <div class="ring-container">
    <div class="ring"></div>
    <div class="ring"></div>
    <div class="ring"></div>
    <div class="ring"></div>
    <div class="ring"></div>
    <div class="ring"></div>
  </div>
  </section>
<!-- end of oscar sections  -->
<!-- start of popular section -->
<section>
    <div class=" popular-container container">
        <div class="row">
            <div class="col-8 popular-reviews-column">
                <h1 class="popular-title">Popular Reviews</h1>
                <hr>
                <div class="border rounded p-2 gradient-background">
                  <div class="wrapper">
                    <div class="row">
                        <div class="col-2 poster-column mt-5">
                            <div class="card" style="width:6rem; height: 7rem;">
                                 <img src="../img/opPoster.jpg" alt="" class="card-img-top img-popular-poster img-fluid">
                            </div>
                        </div>
                        <div class="col-10 review-column">
                            <div class="row mt-1">
                                <div class="col-5 review-username"><i class="fa-regular fa-user p-2"></i>@mhmadiab</div>
                                <div class="col-3 review-rate">*****</div>
                                <div class="col-2 review-like"><i class="fa-solid fa-heart p-2"></i></i>330</div>
                                <div class="col-2 review-cmnt"><i class="fa-regular fa-comment p-2"></i>30</div>
                            </div>
                            <div class="row movie-name my-3">
                                <h2>Oppenhimer 2023</h2>
                            </div>
                            <div class="row">
                                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolore odio tenetur nisi, voluptates aut fugit impedit illum doloremque saepe inventore dicta debitis similique ea? Beatae, ratione sapiente minima itaque animi, porro alias quam amet distinctio, non blanditiis odio accusamus asperiores!</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-2 poster-column mt-5">
                            <div class="card" style="width:6rem; height: 7rem;">
                                 <img src="../img/opPoster.jpg" alt="" class="card-img-top img-popular-poster img-fluid">
                            </div>
                        </div>
                        <div class="col-10 review-column">
                            <div class="row mt-1">
                                <div class="col-5 review-username"><i class="fa-regular fa-user p-2"></i>@mhmadiab</div>
                                <div class="col-3 review-rate">*****</div>
                                <div class="col-2 review-like"><i class="fa-solid fa-heart p-2"></i></i>330</div>
                                <div class="col-2 review-cmnt"><i class="fa-regular fa-comment p-2"></i>30</div>
                            </div>
                            <div class="row movie-name my-3">
                                <h2>Oppenhimer 2023</h2>
                            </div>
                            <div class="row">
                                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolore odio tenetur nisi, voluptates aut fugit impedit illum doloremque saepe inventore dicta debitis similique ea? Beatae, ratione sapiente minima itaque animi, porro alias quam amet distinctio, non blanditiis odio accusamus asperiores!</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-2 poster-column mt-5">
                            <div class="card" style="width:6rem; height: 7rem;">
                                 <img src="../img/opPoster.jpg" alt="" class="card-img-top img-popular-poster img-fluid">
                            </div>
                        </div>
                        <div class="col-10 review-column">
                            <div class="row mt-1">
                                <div class="col-5 review-username"><i class="fa-regular fa-user p-2"></i>@mhmadiab</div>
                                <div class="col-3 review-rate">*****</div>
                                <div class="col-2 review-like"><i class="fa-solid fa-heart p-2"></i></i>330</div>
                                <div class="col-2 review-cmnt"><i class="fa-regular fa-comment p-2"></i>30</div>
                            </div>
                            <div class="row movie-name my-3">
                                <h2>Oppenhimer 2023</h2>
                            </div>
                            <div class="row">
                                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolore odio tenetur nisi, voluptates aut fugit impedit illum doloremque saepe inventore dicta debitis similique ea? Beatae, ratione sapiente minima itaque animi, porro alias quam amet distinctio, non blanditiis odio accusamus asperiores!</p>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-4 popular-lists-column">
                <h1 class="popular-title">Popular Lists</h1>
                <hr>
                <div class="border rounded shadow shadow-lg">
                    <div class="card gradient-overlay2">
                        <img src="../img/pastlivesPoster.jpg" alt="" class="popular-lists-img rounded">
                        <div class="card1-container">
                            <div class="card1">
                                <img src="../img/pastlivesPoster.jpg" alt="Card 1">
                            </div>
                            <div class="card1">
                                <img src="../img/pastlivesPoster.jpg" alt="Card 2">
                            </div>
                            <div class="card1">
                                <img src="../img/opPoster.jpg" alt="Card 2">
                            </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
        <div class="service-list-title row" style="transform: translate(0, 70%);">
                      <div class="col-6">
                        <h1 style="margin-bottom: 1px;">New Realeases</h1>
                      </div>
                      <div class="col-6 text-right" style="transform: translate(90%,0);">
                        <h2><a href="#" style="text-decoration: none; color: inherit;">more</a></h2>
                      </div>
                        <hr style="margin-top: 0px;">
        </div>
        <div class="row">
            <div class="col-12">
            <div class="owl-carousel owl-theme">
            <?php
            // Iterate through each movie in the results array
            foreach ($popularMoviesList->results as $movie) {
                // Extract movie details
                $title = $movie->title;
                $posterPath = $movie->poster_path;
                ?>
                <div class="mx-1" style="width: fit-content; margin-right: -10px;">
                        <div class="movie-wrapper" style="padding: 50px 0px">
                            <a href="movie_page.php?movie_id=<?= $movie->id ?>" class="movie-link">
                                <div class="item movie-list-item" style="150px">
                                    <div class="card movie-card">
                                        <img src="https://image.tmdb.org/t/p/original<?= $movie->poster_path ?>" alt="<?= $movie->title ?>" class="card-img-top movie-list-item-img">
                                        <span class="movie-list-item-watched"><i class="fa-regular fa-eye"></i></span>
                                        <span class="movie-list-item-liked"><i class="fa-solid fa-heart"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
               
                <?php
            }
            ?>      
    </div>
            </div>
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