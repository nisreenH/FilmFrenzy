<?php
    session_start();
    require_once('../vendor/autoload.php');
    $client = new \GuzzleHttp\Client();
    require_once '../php/connection.php';
    // if(isset($_GET['movieId'])){
    //     $movieId = $_GET['movieId'];
    //}
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
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <!-- <link rel="stylesheet" href="../css/movieDetails.css"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="../js/main.js"></script>
        <!-- <script src="../js/movieDetails.js" defer></script> -->
        <script src="../js/userProfile.js"></script>
        <link rel="stylesheet" href="../css/userProfile.css">
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
                        <img src="<?php echo isset($_SESSION['avatar']) ? $_SESSION['avatar'] : '../img/user-avatar.png'; ?>" alt="" class="profile-picture navbar-profile-picture" >
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

    <section class="profile-header">
    <div class="container user-avatar">
        <div class="row user-avatar justify-content-center">
            <!-- <div class="card"> -->
                <div class="col-lg-6 col-md-9 profile-avatar-sec">
                    <div class="avatar-frame">
                       <img src="<?php echo isset($_SESSION['avatar']) ? $_SESSION['avatar'] : '../img/user-avatar.png'; ?>" alt="user-avatar" id="profile-pic">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 text-center">
                    <h1><?php echo htmlspecialchars($fetched_username); ?></h1>
                    <p>@<?php echo htmlspecialchars($fetched_username); ?></p>
                </div>
                <div class="col-lg-3 col-md-3 text-center">
                    <button id="edit-profile-btn" class="btn btn-primary" type="button">Edit Profile</button>
                </div>
            <!-- </div> -->
        </div>
    </div>
</section>
<!-- popup  -->
<div id="profileModal" class="modal">
    <div class="card popup-card">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="card-inner">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h5 class="modal-title">Edit Profile</h5>
            </div>
            <form id="upload-form" enctype="multipart/form-data" method="POST" action="../php/upload.php">
                <div class="form-group text-center">
                    <label for="input-file">Update Image</label>
                    <input type="file" accept="image/jpeg, image/png, image/jpg" id="input-file" name="avatar" class="form-control-file">
                    <button id="delete-avatar" class="btn btn-danger ml-2" type="button">Delete</button>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="username">Update Username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Enter new username">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="password">Update Password</label>
                                <input type="password" id="password" name="password" class="form-control mb-2" placeholder="Enter new password">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <div id="message" class="alert" role="alert" style="display: none;"></div>
                <button id="save-avatar" class="btn btn-primary" type="button">Save Changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Get the modal
    var modal = document.getElementById("profileModal");

    // Get the button that opens the modal
    var btn = document.getElementById("edit-profile-btn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<section class="body-profile-content">
    <div class="container body-container">
        <div class="row movies-liked">
            <div class="container"> 
                <!-- likes -->
                <div class="service-list-title row" style="transform: translate(0, 70%);">
                            <div class="col-6">
                                <h1 style="margin-bottom: 1px;">Movies You Liked</h1>
                            </div>
                            <div class="col-6 text-right d-flex justify-content-end">
                                <h2><a href="moviesYouLikedPage.php" style="text-decoration: none; color: inherit;"><i class="fa-solid fa-layer-group mx-1" style="color:#4dbf00;"></i>more</a></h2>
                            </div>
                            <hr style="margin-top: 0px;">
                </div>
                <div class="container mt-5">
                        <div class="row" id="poster-container">
                            <?php
                                // Include the getfavorites.php script to fetch posters
                                $movies = [];
                                require_once 'getfavorites.php'; // Replace with the actual path

                                // Limit the number of posters displayed
                                $limit = 4;

                                // Loop through the movies array with a for loop
                                for ($i = 0; $i < min($limit, count($movies)); $i++):
                                    $movie = $movies[$i];
                                    $posterPath = $movie['poster_path'];
                                    $movieId = $movie['id'];
                                    ?>
                                    <div class="col-md-3">
                                        <a href="movieDetails.php?movieId=<?php echo $movieId; ?>">
                                            <img src="https://image.tmdb.org/t/p/w500/<?php echo $posterPath; ?>" class="poster-img" alt="Movie Poster">
                                        </a>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                </div>
                <!-- watchlist -->
                <div class="service-list-title row" style="transform: translate(0, 70%);">
                            <div class="col-6">
                                <h1 style="margin-bottom: 1px;">Your Watchlist</h1>
                            </div>
                            <div class="col-6 text-right d-flex justify-content-end">
                                <h2><a href="watchListPage.php" style="text-decoration: none; color: inherit;"><i class="fa-solid fa-layer-group mx-1" style="color:#4dbf00;"></i>more</a></h2>
                            </div>
                            <hr style="margin-top: 0px;">
                </div>
                <div class="container mt-5">
                        <div class="row" id="poster-container">
                            <?php
                                // Include the getfavorites.php script to fetch posters
                                $movies = [];
                                require_once 'getwatchlist.php'; // Replace with the actual path

                                // Limit the number of posters displayed
                                $limit = 4;

                                // Loop through the movies array with a for loop
                                for ($i = 0; $i < min($limit, count($movies)); $i++):
                                    $movie = $movies[$i];
                                    $posterPath = $movie['poster_path'];
                                    $movieId = $movie['id'];
                                    ?>
                                    <div class="col-md-3">
                                        <a href="movieDetails.php?movieId=<?php echo $movieId; ?>">
                                            <img src="https://image.tmdb.org/t/p/w500/<?php echo $posterPath; ?>" class="poster-img" alt="Movie Poster">
                                        </a>
                                    </div>
                                <?php endfor; ?>
                        </div>
                    </div>
                </div>
              <!-- lists -->
              <div class="service-list-title row" style="transform: translate(0, 70%);">
                            <div class="col-6">
                                <h1 style="margin-bottom: 1px;">Your Lists</h1>
                            </div>
                            <div class="col-6 text-right d-flex justify-content-end">
                                <h2><a href="watchListPage.php" style="text-decoration: none; color: inherit;"><i class="fa-solid fa-layer-group mx-1" style="color:#4dbf00;"></i>more</a></h2>
                            </div>
                            <hr style="margin-top: 0px;">
                </div>
                <?php
                    require_once '../php/connection.php'; // Ensure this file includes your database connection

                    if (!isset($_SESSION['user_id'])) {
                        die("Error: User not logged in.");
                    }

                    $userId = $_SESSION['user_id'];

                    // Fetch user's lists
                    $query_lists = "SELECT list_id, list_name FROM lists WHERE user_id = ?";
                    $stmt_lists = $con->prepare($query_lists);
                    $stmt_lists->bind_param("i", $userId);
                    $stmt_lists->execute();
                    $result_lists = $stmt_lists->get_result();

                    // Array to store movies organized by lists
                    $lists = [];

                    $apiKey = '90565206247f3b7768d9b25bbedf68d8';
                    $client = new \GuzzleHttp\Client();

                    // Iterate through each list
                    while ($row_list = $result_lists->fetch_assoc()) {
                        $listId = $row_list['list_id'];
                        $listName = $row_list['list_name'];

                        // Initialize array for current list's movies
                        $movies = [];

                        // Fetch movies in the current list
                        $query_list_items = "SELECT movie_id FROM list_items WHERE list_id = ?";
                        $stmt_list_items = $con->prepare($query_list_items);
                        $stmt_list_items->bind_param("i", $listId);
                        $stmt_list_items->execute();
                        $result_list_items = $stmt_list_items->get_result();

                        // Iterate through each movie in the list
                        while ($row_list_item = $result_list_items->fetch_assoc()) {
                            $movieId = $row_list_item['movie_id'];

                            try {
                                // Fetch movie details from TMDB API
                                $response = $client->request('GET', "https://api.themoviedb.org/3/movie/{$movieId}?language=en-US", [
                                    'headers' => [
                                        'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MDU2NTIwNjI0N2YzYjc3NjhkOWIyNWJiZWRmNjhkOCIsInN1YiI6IjY1ZmVkNzU0MDkyOWY2MDE3ZTliZGUyMSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.DW9RlEQ4PPwEzMPv8vutOwT8SAD1j47bBX7F1_RIANk',
                                        'Accept' => 'application/json',
                                    ],
                                ]);

                                // Decode the response
                                $movieDetails = json_decode($response->getBody()->getContents(), true);

                                // Check if poster path is available
                                if (isset($movieDetails['poster_path'])) {
                                    // Construct full poster URL
                                    $posterPath = $movieDetails['poster_path'];
                                    $posterUrl = "https://image.tmdb.org/t/p/w500{$posterPath}";

                                    // Add movie details to current list's movies array
                                    $movies[] = [
                                        'id' => $movieId,
                                        'poster_url' => $posterUrl
                                    ];
                                }
                            } catch (\GuzzleHttp\Exception\ClientException $e) {
                                error_log('Error fetching movie details: ' . $e->getMessage());
                            }
                        }

                        // Add current list and its movies to the lists array
                        $lists[] = [
                            'list_id' => $listId,
                            'list_name' => $listName,
                            'movies' => $movies
                        ];

                        // Close statement for current list items
                        $stmt_list_items->close();
                    }

                    // Close statements and database connection
                    $stmt_lists->close();
                    $con->close();

                    // Output the lists array as JSON for use in JavaScript or further processing
                    //  echo json_encode($lists);
                    ?>
                     <div class="container my-5">
                            <div class="row lists-row">
                                <?php foreach ($lists as $list) : ?>
                                    <div class="col-md-6 my-3">
                                        <h2><?php echo htmlspecialchars($list['list_name']); ?>
                                        <span>
                                            <a href="listType.php?list_id=<?php echo htmlspecialchars($list['list_id']); ?>" style="text-decoration: none; color: inherit; padding-left:50px;">
                                                <i class="fa-solid fa-layer-group mx-1" style="color:#4dbf00;"></i>more
                                            </a>
                                        </span>
                                         </h2>
                                        <div class="overlapping-cards">
                                            <?php 
                                            $moviesToDisplay = array_slice($list['movies'], 0, 4);
                                            foreach ($moviesToDisplay as $index => $movie) : 
                                            ?>
                                                <div class="card card<?php echo $index + 1; ?>" style="z-index: <?php echo count($moviesToDisplay) - $index; ?>;">
                                                    <img src="<?php echo $movie['poster_url']; ?>" class="card-img-top" alt="Movie Poster">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
            </div>
        </div>
    </div>

</section>
<footer>
    <div class="footer-section mt-5">
        <div class="container footer-container p-5">
            <div class="row footer-row">
                <div class="col-lg-5 col-sm-6">
                    <div class="single-box">
                         <h1><a class="navbar-brand logo ps-2 order-first" href="#">Film Frenzy</a></h1>
                         <p class="footer-message my-2">Lights, camera, action! Thanks for being part of our blockbuster journey through the world of cinema.
                            And remember to always be a FILMER.
                         </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                     <div class="single-box">
                        <h3>Helpful links</h3>
                        <ul>
                            <li><a href="">Home</a></li>
                            <li><a href="">News</a></li>
                            <li><a href="">Movies</a></li>
                            <li><a href="">Profile</a></li>
                        </ul>
                     </div>
                </div>
                <div class="col-lg-3 col-md-2 ">
                    <div class="single-box">
                            <h3>References</h3>
                            <ul>
                                <li><a href="">TMDB</a></li>
                                <li><a href="">GitHub</a></li>
                                <li><a href="">IMDB</a></li>
                                <li><a href="">Letterboxd</a></li>
                                <li><a href="">UIVERSE</a></li>
                                <li><a href="">Bootstrap</a></li>
                                <li><a href="">W3schools</a></li>
                            </ul>
                    </div>
                </div>
            </div>
            <hr>
             <div class="container">
                <div class="row d-flex jutsify-content-center text-center">
                    <div class="col-lg-3 col-sm-6 socials"><a href="#"><i class="fa-brands fa-instagram"></i></a></div>
                    <div class="col-lg-3 col-sm-6 socials "><a href="#"><i class="fa-brands fa-github"></i></a></div>
                    <div class="col-lg-3 col-sm-6 socials"><a href="#"><i class="fa-brands fa-facebook"></i></a></div>
                    <div class="col-lg-3 col-sm-6 socials "><a href="#"><i class="fa-brands fa-discord"></i></a></div>
                </div>
                <div class="row">
                    <h4 class="copyrights">@2024 All rights reserved</h4>
                </div>
             </div>
        </div>
    </div>
</footer>

</body>
</html>



<!-- script for handling uploading and delete and save user info and avatar -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let profilePic = document.getElementById("profile-pic");
    let navbarProfilePic = document.querySelector(".navbar-profile-picture");
    let inputFile = document.getElementById("input-file");
    let saveButton = document.getElementById("save-avatar");
    let deleteButton = document.getElementById("delete-avatar");
    let usernameInput = document.getElementById("username");
    let passwordInput = document.getElementById("password");

    let messageDiv = document.getElementById("message");

    function displayMessage(message, success) {
        messageDiv.textContent = message;
        messageDiv.style.display = "block";
        messageDiv.className = success ? "alert alert-success" : "alert alert-danger";
    }

    if (profilePic && inputFile && saveButton && deleteButton && navbarProfilePic) {
        saveButton.addEventListener("click", function() {
            let file = inputFile.files[0];
            let username = usernameInput.value;
            let password = passwordInput.value;

            let formData = new FormData();
            if (file && (file.type === "image/jpeg" || file.type === "image/png" || file.type === "image/jpg")) {
                formData.append("avatar", file);
            }
            formData.append("username", username);
            formData.append("password", password);

            fetch("../php/upload.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.avatarUrl) {
                        profilePic.src = data.avatarUrl;
                        navbarProfilePic.src = data.avatarUrl;
                    }
                    
                    displayMessage("Profile updated successfully!", true);
                } else {
                    displayMessage("Failed to update profile: " + data.message, false);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                displayMessage("An error occurred while updating the profile.", false);
            });
        });

        deleteButton.addEventListener("click", function() {
            fetch("../php/delete-avatar.php", {
                method: "POST"
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let defaultAvatarUrl = '../img/user-avatar.png';
                    profilePic.src = defaultAvatarUrl;
                    navbarProfilePic.src = defaultAvatarUrl;
                    displayMessage("Avatar deleted successfully!", true);
                } else {
                    displayMessage("Failed to delete the avatar.", false);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                displayMessage("An error occurred while deleting the avatar.", false);
            });
        });
    } else {
        console.error("Profile picture, input file, save button, or delete button element not found.");
    }
});
</script>


<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../js/main.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    