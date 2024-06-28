<?php
    session_start();
    require_once('../vendor/autoload.php');
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
        <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="../js/main.js"></script>
        <script src="../js/registrationFunctions.js"></script>
    </head>
    <!-- The bg-dark class sets the background color of the body to dark, and data-bs-theme="dark" is a Bootstrap 5 attribute
        that applies a dark theme to Bootstrap components. This will ensure that all Bootstrap components, including the navbar,
         follow the dark theme. -->
         <header>
                <!-- .navbar-expand-md sets the drop down navbar for small screens only
                    (.navbar-expand-lg sets the drop down navbar for medium & small screens)
                    .fixed-top:  navbar remains fixed at the top of the viewport, regardless of scrolling -->
            <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary"  data-bs-theme="dark">
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
                            <li><a class="dropdown-item" href="..php/Profile.php#mylists">My List</a></li>
                            <li><a class="dropdown-item" href="../php/moviesYouLikedPage.php">My Favorites</a></li>
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
                    <!-- <form class="d-flex d-none d-lg-block" role="search">
                            <div class="input-group">
                                <input class="form-control pe-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search text-white"></i>
                                </button>
                            </div>
                    </form> -->
                    <?php
                        if(isset($_SESSION['username'])){
                    ?>
                    <div class="nav-item dropdown ps-3 pe-4 d-none d-lg-block">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span  class=" dropdown-toggle"></span>
                        <img src="<?php echo isset($_SESSION['avatar']) ? $_SESSION['avatar'] : '../img/user-avatar.png'; ?>" alt="" class="profile-picture navbar-profile-picture" onclick= "window.location.href = 'Profile.php';">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="../php/Profile.php#mylists">My List</a></li>
                        <li><a class="dropdown-item" href="../php/moviesYouLikedPage.php">My Favorites</a></li>
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
        <div class="row mt-5"><h1 class="display-4 mt-5 text-center" style="font-family:var(--popins); margin-top 70px;;"> Browse By <br> <b class="text-center" style="color:#4dbf00;">FilmFrenzy's Movie Browser</b></h1></div>
        <section class="filter-browsing-menu" style="margin-top:60px;">
        <div class="container border rounded text-center pt-3 bg-dark">
            <form id="filtering-form" enctype="multipart/form-data" method="POST" action="../php/filterbrowsing.php">
                <div class="row jutsify-content-end">
                    <div class="col-12 col-md-6 col-lg-3 col-xl-2 mb-3">
                        <select name="genre" id="genre" class="form-select">
                            <option value="">Genre</option>
                            <option value="28">Action</option>
                            <option value="12">Adventure</option>
                            <option value="16">Animation</option>
                            <option value="35">Comedy</option>
                            <option value="80">Crime</option>
                            <option value="99">Documentary</option>
                            <option value="18">Drama</option>
                            <option value="10751">Family</option>
                            <option value="14">Fantasy</option>
                            <option value="36">History</option>
                            <option value="27">Horror</option>
                            <option value="10402">Music</option>
                            <option value="9648">Mystery</option>
                            <option value="10749">Romance</option>
                            <option value="878">Science Fiction</option>
                            <option value="10770">TV Movie</option>
                            <option value="53">Thriller</option>
                            <option value="10752">War</option>
                            <option value="37">Western</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 col-xl-2 mb-3">
                        <select name="sort_by" id="sort_by" class="form-select">
                            <option value="">Sort By</option>
                            <option value="popularity.desc">Popularity (Descending)</option>
                            <option value="popularity.asc">Popularity (Ascending)</option>
                            <option value="release_date.desc">Release Date (Newest First)</option>
                            <option value="release_date.asc">Release Date (Oldest First)</option>
                            <option value="revenue.desc">Revenue (Descending)</option>
                            <option value="revenue.asc">Revenue (Ascending)</option>
                            <option value="vote_average.desc">Rating (Highest First)</option>
                            <option value="vote_average.asc">Rating (Lowest First)</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 col-xl-2 mb-3">
                    <select name="year" id="year" class="form-select">
                        <option value="">Year</option>
                        <?php for ($year = date('Y'); $year >= 1900; $year--): ?>
                            <option value="<?= $year ?>"><?= $year ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                    <div class="col-12 col-md-6 col-lg-3 col-xl-2 mb-3">
                        <select name="language" id="language" class="form-select">
                            <option value="">Language</option>
                            <option value="en">English</option>
                            <option value="ar">Arabic</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                            <!-- Add more languages as needed -->
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 col-xl-2 mb-3">
                        <button type="submit" class="btn  w-100" style="background-color:#4dbf00; color:white; font-family:var(--popins);">Filter Movies</button>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 col-xl-2 mb-3 justify-content-end">
                            <form class="d-flex d-none d-lg-block" role="search">
                                    <div class="input-group">
                                        <input class="form-control pe-2" type="search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="bi bi-search text-white"></i>
                                        </button>
                                    </div>
                            </form>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <section class="filter-browsing" style="">
    <div id="filter-params" class="container text-center bg-dark border rounded" style="font-size: small; color: white;">
        <!-- Selected filter parameters will be displayed here -->
    </div>
        <div id="movies-container" class="container text-center bg-dark border rounded">
            <!-- Movie posters will be inserted here by JavaScript -->
        </div>
    </section>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filtering-form');
    const moviesContainer = document.getElementById('movies-container');
    const filterParamsDiv = document.getElementById('filter-params');
    let currentPage = 1; // Track the current page
    let queryData = {};  // Store form data for pagination

    function displayFilterParams(params) {
        const { genre, sort_by, language, year } = params;
        const genreText = genre ? `Genre: ${genre}` : 'Genre: Any';
        const sortByText = sort_by ? `Sort By: ${sort_by}` : 'Sort By: Default';
        const languageText = language ? `Language: ${language}` : 'Language: Any';
        const yearText = year ? `Year: ${year}` : 'Year: Any';

        filterParamsDiv.innerHTML = `${genreText} | ${sortByText} | ${languageText} | ${yearText}`;
    }

    function fetchMovies(page = 1) {
        // Add the page to the query data
        queryData.page = page;

        // Fetch movies from server
        fetch('../php/filterbrowsing.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(queryData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
                return;
            }

            // Clear movies container if it's a new search (page 1)
            if (page === 1) {
                moviesContainer.innerHTML = '';
            }

            let movieCounter = (page - 1) * 30; // Adjust starting counter based on page
            let row;

            // Iterate through each movie in the response data
            data.forEach(movie => {
                if (movieCounter % 5 === 0) {
                    if (movieCounter !== (page - 1) * 30) {
                        moviesContainer.appendChild(row); // Append previous row
                    }
                    row = document.createElement('div');
                    row.classList.add('row');
                    row.classList.add('justify-content-center');
                }

                // Create a movie card element
                const movieCard = document.createElement('div');
                movieCard.classList.add('col-12', 'col-md-6', 'col-lg-2');
                movieCard.innerHTML = `
                    <div class="mx-1" style="width: fit-content; margin-right: -10px;">
                        <div class="movie-wrapper text-center" style="padding: 50px 0px;">
                            <a href="../php/movieDetails.php?movieId=${movie.id}" class="movie-link">
                                <div class="item movie-list-item" style="150px;">
                                    <div class="card movie-card">
                                        <img src="${movie.poster_url}" alt="${movie.title}" class="card-img-top movie-list-item-img">
                                        <span class="movie-list-item-watched"><i class="fa-regular fa-eye"></i></span>
                                        <span class="movie-list-item-liked"><i class="fa-solid fa-heart"></i></span>
                                    </div>
                                    <!--<div class="movie-info">
                                        <h5>${movie.title}</h5>
                                        <p>${movie.genres.join(', ')}</p>
                                    </div>-->
                                </div>
                            </a>
                        </div>
                    </div>
                `;

                row.appendChild(movieCard); // Append movie card to the row
                movieCounter++;
            });

            if (movieCounter % 5 !== 0) {
                moviesContainer.appendChild(row); // Append the last row if it's not full
            }

            // Add "Next" button
            const nextButton = document.createElement('button');
            nextButton.textContent = 'Next';
            nextButton.classList.add('btn', 'btn-primary', 'mt-3', 'next-button');
            nextButton.addEventListener('click', function() {
                currentPage++;
                fetchMovies(currentPage);
                nextButton.remove(); // Remove the current "Next" button after clicking
            });
            moviesContainer.appendChild(nextButton);
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        currentPage = 1; // Reset to the first page on new search
        const formData = new FormData(form);
        queryData = Object.fromEntries(formData.entries());
        displayFilterParams(queryData); 
        fetchMovies(currentPage); // Initial fetch
    });

    // Initial load of movies on page load
    form.dispatchEvent(new Event('submit'));
});

    </script>
    