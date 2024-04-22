var textContent = [
    { title: "Track films you’ve watched.", button: "Get started!" },
    { title: "Save those you want to see.", button: "Get started!" },
    { title: "Tell your friends what’s good.", button: "Get started!" }
    // Add more text content as needed
];

// Function to update the carousel with new text content
function updateCarousel() {
    var carousel = document.getElementById('carouselExampleAutoplaying');
    var currentIndex = 0;
    var carouselItems = carousel.querySelectorAll('.carousel-item');
    
    // Start cycling through text content
    var intervalId = setInterval(function() {
        currentIndex = (currentIndex + 1) % textContent.length;
        
        // Update text content for each carousel item
        carouselItems.forEach(function(item) {
            var featuredDesc = item.querySelector('.featured-desc');
            featuredDesc.innerHTML = '';
            
            var title = document.createElement('h5');
            title.textContent = textContent[currentIndex].title;
            featuredDesc.appendChild(title);
    
            var button = document.createElement('button');
            button.classList.add('featured-button');
            button.textContent = textContent[currentIndex].button;
            featuredDesc.appendChild(button);
        });
    }, 15000); // Change text content every 15 seconds (15 * 1000 milliseconds)
};

// Call the function initially to start the carousel


window.onload = function() {
    updateCarousel();
    $('.carousel').carousel({ interval: 15000 }); // Start cycling through images every 15 seconds
};




//arrow

$(document).ready(function() {
    $('.arrow-icon').on('click', function() {
        // Make an AJAX request to fetch more movie data
        $.ajax({
            url: 'https://api.themoviedb.org/3/discover/movie',
            type: 'GET',
            dataType: 'json',
            data: {
                include_adult: false,
                include_video: false,
                language: 'en-US',
                page: 2, // Change this to the next page or implement pagination logic
                sort_by: 'popularity.desc',
                api_key: '90565206247f3b7768d9b25bbedf68d8'
            },
            success: function(response) {
                if (response.results) {
                    var postersLimit = 5;
                    var postersDisplayed = 0;

                    // Iterate through the new movie data
                    $.each(response.results, function(index, movie) {
                        if (postersDisplayed >= postersLimit) {
                            return false; // Exit the loop if the limit is reached
                        }

                        var title = movie.title;
                        var posterPath = movie.poster_path;

                        // Append the new movie poster to the existing list
                        $('.movie-list').append(
                            '<div class="movie-list-item col-lg-3 col-md-4 col-sm-6 mb-4">' +
                            '<img src="https://image.tmdb.org/t/p/original' + posterPath + '" alt="' + title + '" class="movie-list-item-img img-fluid">' +
                            '<span class="movie-list-item-watched"><i class="fa-regular fa-eye"></i></span>' +
                            '<span class="movie-list-item-liked"><i class="fa-solid fa-heart"></i></span>' +
                            '</div>'
                        );

                        postersDisplayed++;
                    });
                } else {
                    console.log('No results found');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch movie data:', error);
            }
        });
    });
});


var movieItems = document.querySelectorAll('.movie-list-item');

// Loop through each movie item element
movieItems.forEach(function(item) {
    // Do something with each movie item element
    console.log(item);
});

