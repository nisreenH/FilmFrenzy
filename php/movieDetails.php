<?php
    session_start();
    require_once('../vendor/autoload.php');
    $client = new \GuzzleHttp\Client();
    
    if(isset($_GET['movieId'])){
        $movieId = $_GET['movieId'];
    }
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
    <body class="bg-dark"  data-bs-theme="dark">
    <header>
                <!-- .navbar-expand-md sets the drop down navbar for small screens only 
                    (.navbar-expand-lg sets the drop down navbar for medium & small screens)
                    .fixed-top:  navbar remains fixed at the top of the viewport, regardless of scrolling -->
            <nav class="navbar navbar-expand-lg fixed-top bg-dark"  data-bs-theme="dark">
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
                        $genreNames .= $genre->name; // Append the current genre name

                        // Append a comma if it's not the last genre
                        if ($key < count($genres) - 1) {
                            $genreNames .= ", ";
                        }
                    }

                    //Format revenue with commas and add currency symbol
                    $revenueFormatted = number_format($movie->revenue, 0, '.', ',');
                    $revenueFormatted = '$' . $revenueFormatted;

                    // Format release date
                    $releaseDateFormatted = date('F j, Y', strtotime($movie->release_date));

                    // Format vote average to display only one digit after the decimal point
                    $voteAverageFormatted = number_format($movie->vote_average, 1);
                    //   echo $movieDetailsResponse->getBody();      
             ?>
            <div class="card mb-3 mt-4 ms-2">
                <div class="row g-0">
                    <div class="col-md-5">
                    <img src="https://image.tmdb.org/t/p/original<?=$backdropPath?>"  class="img-fluid rounded-start" style="height:100%" alt="...">
                    </div>
                    <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?=$movie->title?></h5>
                        <p class="card-text"><small class="text-body-secondary">Runtime: <?=$movie->runtime?>min</small></p>
                        <p class="card-text"><small class="text-body-secondary">Release Date: <?=$releaseDateFormatted?></small></p>
                        <p class="card-text"><small class="text-body-secondary"> Genre: <?=$genreNames?></small></p>
                        <p class="card-text"><small class="text-body-secondary"> Boxoffice Revenue: <?=$revenueFormatted?></small></p>
                        <p class="card-text"><?=$movie->overview?></p>
                        <p class="card-text"><small class="text-body-secondary"><i class="bi  bi-star-fill text-warning"></i> <?=$voteAverageFormatted?>/10</small></p>
                    </div>
                    </div>
                </div>
            </div>
          
            <?php }?>

<!-- MOVIE CREDITS -->
<!-- <h2>Top Cast: </h2> -->
<div class="container mt-3">
    <div class="">
        <h3 class="text-center">
            <span class="border border-dark p-2 bg-dark" style="color:rgb(77 191 0 / 70%);">Top Cast</span>
        </h3>
    </div>
<div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 g-4 ms-2 border border-3">
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
            <div class="col">
                <div class="card h-100 castCard">
                <img src="https://image.tmdb.org/t/p/original<?=$actor->profile_path?>" id="actorImage"  class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-center mb-0"> <?=$actor->name?> </h5>
                    <p class="card-text text-center" style="rgb(196 193 190 / 60%)"> <?=$actor->character?> </p>
                </div>
                </div>
            </div>
<?php } } }?>

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