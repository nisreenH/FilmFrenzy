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
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <?php
// Check if $popularMoviesList is null or undefined
if ($popularMoviesList !== null && isset($popularMoviesList->results)) {
    // Iterate through each movie in the results array
    foreach ($popularMoviesList->results as $movie) {
        // Extract movie details
        $title = $movie->title;
        $posterPath = $movie->poster_path;
        ?>
        <!-- HTML code for carousel item -->
        <div class="item">
            <div class="card">
                <img src="https://image.tmdb.org/t/p/original<?=$posterPath?>" alt="<?=$title?>" class="card-img-top">
                <div class="card-body text-center">
                    <div class="card-title">
                        <!-- Add movie title or any other information here if needed -->
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    // Display error message if unable to fetch movie data or if the data is not in the expected format
    echo "Failed to fetch or decode movie data, or the data is not in the expected format.";
}
?>
    <div class="container-fluid">
    <div class="owl-carousel owl-theme">
        <?php
        // Iterate through each movie in the results array
        foreach ($popularMoviesList->results as $movie) {
            // Extract movie details
            $title = $movie->title;
            $posterPath = $movie->poster_path;
            ?>
            <div class="item">
                <div class="card">
                    <img src="https://image.tmdb.org/t/p/original<?=$posterPath?>" alt="<?=$title?>" class="card-img-top">
                    <div class="card-body text-center">
                        <div class="card-title">
                            <!-- Add movie title or any other information here if needed -->
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<div class="movie-list-container-outer">
    <div class="movie-list-container-inner">
        <div class="movie-list row">
            <?php
            // Iterate through each movie in the results array
            foreach ($popularMoviesList->results as $movie) {
                // Extract movie details
                $title = $movie->title;
                $posterPath = $movie->poster_path;
                ?>
                <div class="movie-list-item col-lg-2 col-md-4 col-sm-6 mb-4">
                    <img src="https://image.tmdb.org/t/p/original<?=$posterPath?>" alt="<?=$title?>" class="movie-list-item-img img-fluid">
                    <!-- Add your additional features here -->
                    <span class="movie-list-item-watched"><i class="fa-regular fa-eye"></i></span>
                    <span class="movie-list-item-liked"><i class="fa-solid fa-heart"></i></span>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>


    
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