<?php
    session_start();
    require_once('../vendor/autoload.php');
    $client = new \GuzzleHttp\Client();
    require_once '../php/connection.php';
    // if(isset($_GET['movieId'])){
    //     $movieId = $_GET['movieId'];
    //}
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
        <link rel="stylesheet" href="../css/movieDetails.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="../js/main.js"></script>
        <script src="../js/movieDetails.js" defer></script>
        <style>
        /* Custom styles */
         .header{
            margin-top: 85px;
         }
         .card{
            object-fit: cover;
            margin: 20px; 
            box-shadow: 0 3px 10px #8b8585;
         }
         #article-title{
                font-size: 30px;
                font-family: "Abril Fatface", serif;
                font-weight: 400;
                font-style: bold;
                color: #4dbf00;
                }
        #article-text{
            font-size: 15px;
            font-family: var(--roboto);
        }
        .navbar{
            box-shadow: 0 3px 10px #8b8585;
        }
        #scrollToTopBtn{
            display: none;
            position:fixed;
            bottom: 20px; right: 20px;
            color: #4dbf00;
        }
        </style>
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
    <section class="header" style="background-image: url('../img/Untitled-d5.png');">
        <?php
            use GuzzleHttp\Client;
            use GuzzleHttp\Exception\RequestException;

            // Function to fetch news from the API
            function fetchNews() {
                $client = new Client();
                
                try {
                 

                    $client = new \GuzzleHttp\Client();

                    $response = $client->request('GET', 'https://imdb8.p.rapidapi.com/news/v2/get-by-category?category=MOVIE&first=20&country=US&language=en-US', [
                        'headers' => [
                            'x-rapidapi-host' => 'imdb8.p.rapidapi.com',
                            'x-rapidapi-key' => 'c08e66a1f4mshd7169b5e33e18c9p16ae5djsnaea437567782',
                        ],
                    ]);

                    // echo $response->getBody();

                    $statusCode = $response->getStatusCode();
                    if ($statusCode == 200) {
                        $body = $response->getBody(); // Get the response body
                        $data = json_decode($body, true); // Decode the JSON response as an associative array
                        
                        $articles = [];
                        if (isset($data['data']['news']['edges']) && is_array($data['data']['news']['edges'])) {
                            // Extract title and plain text from each article
                            foreach ($data['data']['news']['edges'] as $edge) {
                                $node = $edge['node'];
                                $title = $node['articleTitle']['plainText'] ?? 'Title not available';
                                $plainText = $node['text']['plainText'] ?? 'Plain text not available';
                                $imageUrl = $node['image']['url'] ?? 'Image not available';
                                
                                $articles[] = [
                                    'title' => $title,
                                    'plainText' => $plainText,
                                    'imageUrl' => $imageUrl,
                                ];
                            }
                        } else {
                            echo 'No articles found.';
                        }
                        return $articles;
                    } else {
                        echo 'Failed to fetch data. Status code: ' . $statusCode;
                    }
                } catch (RequestException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
                return [];
            }
            // Fetch news
            $articles = fetchNews();
            ?>
      <div class="container mt-5">
            <div class="row w-100 h-100 text-center">
                 <p class="display-4 mt-3" style="font-family: var(--popins);">News Page by FilmFrenzy</p>
            </div>
            <button id="scrollToTopBtn" class="btn btn-success btn-floating"  onclick="scrollToTop()" title="Go to top">
                <i class="fas fa-arrow-up"></i>
            </button>
            <?php foreach ($articles as $article): ?>
                <div class="row my-4" style="border-bottom: 1.2px solid #ffff;">
                    <div class="col-lg-7">
                        <h1 id="article-title"><?php echo $article['title']; ?></h1>
                        <p id="article-text"><?php echo $article['plainText']; ?></p>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <img src="<?php echo $article['imageUrl']; ?>" alt="Article Image" >
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <footer>
    <div class="footer-section mt-5">
        <div class="container footer-container p-5">
            <div class="row footer-row">
                <div class="col-lg-5 col-sm-6">
                    <div class="single-box">
                         <h1><a class="navbar-brand logo ps-2 order-first" href="#">News Page by FilmFrenzy</a></h1>
                         <p class="footer-message my-2">"Stay tuned for the latest updates and exclusive insights into the world of cinema. Explore captivating stories, behind-the-scenes glimpses, and breaking news about your favorite movies and stars on our dedicated news page."
                         </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                     <div class="single-box">
                        <h3>Helpful links</h3>
                        <ul>
                        <li><a href="index.php">Home</a></li>
                            <li><a href="newsPage.php">News</a></li>
                            <li><a href="MoviesPage.php">Movies</a></li>
                            <li><a href="Profile.php">Profile</a></li>
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
<script>
    window.addEventListener('scroll', function() {
    var newsSection = document.querySelector('.header'); // Get the news section element
    var newsRowHeight = document.querySelector('.row.my-4') ? document.querySelector('.row.my-4').offsetHeight : 0; // Get the height of a single news row
    var scrollToTopBtn = document.getElementById('scrollToTopBtn');
    var scrollPosition = window.scrollY;

    // Calculate the scroll position threshold (10 rows of news)
    var scrollThreshold = 10 * newsRowHeight;

    // Show scroll-to-top button if scroll position is greater than the threshold
    if (scrollPosition > scrollThreshold) {
        scrollToTopBtn.style.display = 'block';
    } else {
        scrollToTopBtn.style.display = 'none';
    }
});

        // Function to scroll back to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth' // Smooth scroll behavior
            });
        }
</script>
