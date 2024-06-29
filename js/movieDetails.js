/*filter-menu*/
document.addEventListener("DOMContentLoaded", function() {
    const filterMenu = document.getElementById("filter-menu");
    const items = document.querySelectorAll(".items .card-text");

    // Function to toggle visibility of items based on selected filter
    function toggleItems(targetFilter) {
        items.forEach(function(item) {
            const itemFilters = item.classList;
            if (itemFilters.contains(targetFilter) || targetFilter === "all") {
                item.classList.remove("hidden");
            } else {
                item.classList.add("hidden");
            }
        });
    }

    // Initial display based on the current filter
    const currentFilter = filterMenu.querySelector(".current").dataset.filter;
    toggleItems(currentFilter);

    // Event listener for filter menu clicks
    filterMenu.addEventListener("click", function(event) {
        const targetFilter = event.target.dataset.filter;

        // Remove 'current' class from all filter menu items
        filterMenu.querySelectorAll("li").forEach(function(item) {
            item.classList.remove("current");
        });

        // Add 'current' class to the clicked filter menu item
        event.target.classList.add("current");

        // Toggle visibility of items based on selected filter
        toggleItems(targetFilter);
    });
});

/*end filter-menu*/
/* rating stars*/
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll(".stars i");
    const starCountDisplay = document.getElementById("star-count-display");
    const cancelRating = document.querySelector(".cancel-rating");
    const starContainer = document.querySelector(".stars");
    const movieId = starContainer.getAttribute("data-movie-id");
     
    console.log('Fetching rating for movieId:', movieId); // Add this line for debugging
    fetchUserRating(movieId);
    // Function to update the star UI
    // const updateStarUI = (rating) => {
    //     stars.forEach(star => {
    //         star.classList.remove("active-star");
    //         if (parseInt(star.getAttribute("data-value")) <= rating) {
    //             star.classList.add("active-star");
    //         }
    //     });
    // };

    // // Function to set rating and update UI
    // const setRating = (rating) => {
    //     // Update star UI
    //     updateStarUI(rating);

    //     // Update rating display
    //     starContainer.setAttribute("data-rating", rating);
    //     starCountDisplay.textContent = rating > 0 ? `Rating: ${rating} out of 5` : "";

    //     // Send rating to the server
    //     sendRatingToServer(movieId, rating);
    // };

    // // Fetch user's existing rating for the movie
    // function fetchUserRating(movieId) {
    //     const xhr = new XMLHttpRequest();
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState === XMLHttpRequest.DONE) {
    //             if (xhr.status === 200) {
    //                 const response = JSON.parse(xhr.responseText);
    //                 if (response.rating !== null) {
    //                     // Update UI with existing rating
    //                     updateStarUI(response.rating);
    //                     starContainer.setAttribute("data-rating", response.rating);
    //                     starCountDisplay.textContent = `Rating: ${response.rating} out of 5`;
    //                 }
    //             } else {
    //                 console.error('Error fetching rating:', xhr.statusText);
    //             }
    //         }
    //     };
    //     xhr.open('GET', `get_rating.php?movieId=${encodeURIComponent(movieId)}`, true);
    //     xhr.send();
    // }

    

    // Event listeners for stars
    stars.forEach(star => {
        star.addEventListener("click", () => {
            const rating = parseInt(star.getAttribute("data-value"));
            setRating(rating);
        });

        star.addEventListener("mouseover", () => {
            const rating = parseInt(star.getAttribute("data-value"));
            stars.forEach(star => {
                star.classList.remove("active-star");
                if (parseInt(star.getAttribute("data-value")) <= rating) {
                    star.classList.add("active-star");
                }
            });
        });

        star.addEventListener("mouseout", () => {
            const rating = parseInt(starContainer.getAttribute("data-rating"));
            updateStarUI(rating);
        });
    });

    // Event listener for cancel rating button
    cancelRating.addEventListener("click", () => {
        setRating(0); // Sets rating to 0 (cancel)
    });

    // Function to send rating to server
    function sendRatingToServer(movieId, rating) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    console.log('Rating saved successfully:', response);
                } else {
                    console.error('Failed to send rating:', xhr.statusText);
                }
            }
        };
        console.log('Sending request:', { movieId, rating });
        xhr.open('POST', 'save_rating.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(`movieId=${encodeURIComponent(movieId)}&rating=${encodeURIComponent(rating)}`);
    }
});



/*end rating stars*/

/* start add to favorites(likes)*/
document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-favorites').forEach(button => {
            button.addEventListener('click', function(event) {
                const movieId = event.target.dataset.movieId;

                // Add the scaling effect
                event.target.classList.add('scale-up');
                event.target.addEventListener('animationend', function() {
                    event.target.classList.remove('scale-up');
                }, { once: true });

                addMovietoFavorites(movieId);
            });
        });

        function addMovietoFavorites(movieId) {
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Request was successful, handle the response if needed
                        console.log(xhr.responseText);
                        document.querySelector(`.add-to-watchlist[data-movie-id="${movieId}"]`).disabled = true;
                    } else {
                        // Request failed, handle errors if needed
                        console.error('Failed to add to favorites:', xhr.statusText);
                    }
                }
            };
            xhr.open('POST', 'addFavorite.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('movie_id=' + encodeURIComponent(movieId));
        }
    });
/*end of favorites(liked)*/

/* start add to watchlist*/
document.querySelectorAll('.add-to-watchlist').forEach(button => {
    button.addEventListener('click', function(event) {
        const movieId = event.target.dataset.movieId;

        // Add the scaling effect
        event.target.classList.add('scale-up');
        event.target.addEventListener('animationend', function() {
            event.target.classList.remove('scale-up');
        }, { once: true });

        addMovieToWatchlist(movieId);
    });
});

function addMovieToWatchlist(movieId) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                document.querySelector(`.add-to-favorites[data-movie-id="${movieId}"]`).disabled = true;
            } else {
                console.error('Failed to add to watchlist:', xhr.statusText);
            }
        }
    };
    xhr.open('POST', 'addToWatchlist.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('movie_id=' + encodeURIComponent(movieId));
}

/*end of add to watchlist*/

/*start reviews*/
document.addEventListener('DOMContentLoaded', function() {
    const reviewForm = document.getElementById('review-form');
    if (!reviewForm) {
        console.error('Review form not found');
        return;
    }

    const submitButton = reviewForm.querySelector('button[type="submit"]');
    if (!submitButton) {
        console.error('Submit button not found');
        return;
    }

    const movieId = submitButton.getAttribute('data-movie-id');
    if (!movieId) {
        console.error('Movie ID not found');
        return;
    }

    reviewForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const reviewText = document.getElementById('floatingTextarea2').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'submitReview.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const messageDiv = document.getElementById('review-message');
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        messageDiv.innerHTML = '<p class="text-success">Review submitted successfully!</p>';
                        reviewForm.reset();
                    } else {
                        messageDiv.innerHTML = `<p class="text-danger">${response.error}</p>`;
                    }
                } else {
                    console.error('Error:', xhr.statusText);
                }
            }
        };

        const data = JSON.stringify({
            movie_id: movieId,
            review_text: reviewText
        });

        xhr.send(data);
    });
});

 
/*end reviews*/

/* start lists */



/*end lists*/