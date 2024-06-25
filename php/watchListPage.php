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
    <div class="container mt-5">
         <div class="row"><h1 class="display-4 mt-5 text-center" style="font-family:var(--popins); margin-top 70px;;"> Your Watchlist</h1></div>
         <div class="row" id="poster-container">
        <?php
        $movies = [];
        require_once 'getwatchlist.php'; // Replace with the actual path
        
        $counter = 0;
        foreach ($movies as $movie):
            $posterPath = $movie['poster_path'];
            $movieId = $movie['id'];
            
            // Start a new row for every 4 posters
            if ($counter % 4 == 0 && $counter != 0) {
                echo '</div><div class="row">';
            }
        ?>
            <div class="col-lg-3 col-md-4 mb-4">
              <div class="card poster-liked-card">
                <a href="movieDetails.php?movieId=<?php echo $movieId; ?>">
                    <img src="https://image.tmdb.org/t/p/w500/<?php echo $posterPath; ?>" class="poster-img img-fluid" alt="Movie Poster">
                </a>
               </div>
            </div>
        <?php
            $counter++;
        endforeach;
        ?>
    </div>
    </div>



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


<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../js/main.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

