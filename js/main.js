/*start of navbar*/



/*end of navbar*/
/*start of carousel*/
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
    }, 1500); // Change text content every 15 seconds (15 * 1000 milliseconds)
};

// Call the function initially to start the carousel


window.onload = function() {
    updateCarousel();
   $('.carousel').carousel({ interval: 250 }); // Start cycling through images every 15 seconds
};


// this code detects clicking add to favorites and calls an AJAX request  to the server to insert the movie ID into the database
    // Add event listener to all "Add to Favorites" buttons
    document.querySelectorAll('.add-to-favorites').forEach(button => {
        button.addEventListener('click', addToFavorites);
    });

    function addToFavorites(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Get the movie ID from the data attribute of the clicked button
        const movieId = event.target.dataset.movieId;

        // Send an AJAX request to the server to insert the movie ID into the database
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Request was successful, handle the response if needed
                    console.log(xhr.responseText);
                } else {
                    // Request failed, handle errors if needed
                    console.error('Failed to add to favorites:', xhr.statusText);
                }
            }
        };
        xhr.open('POST', '../php/userActions.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('movie_id=' + encodeURIComponent(movieId));
    }

//  function addMovietoFavorites(movieId) {

//               // Get the movie ID from the data attribute of the clicked button
//             //   const movieId = event.target.dataset.movieId;
//       alert(movieId);
//               // Send an AJAX request to the server to insert the movie ID into the database
//               const xhr = new XMLHttpRequest();
//               xhr.onreadystatechange = function() {
//                   if (xhr.readyState === XMLHttpRequest.DONE) {
//                       if (xhr.status === 200) {
//                           // Request was successful, handle the response if needed
//                           console.log(xhr.responseText);
//                       } else {
//                           // Request failed, handle errors if needed
//                           console.error('Failed to add to favorites:', xhr.statusText);
//                       }
//                   }
//               };
//               xhr.open('POST', '../php/userActions.php', true);
//               xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//               xhr.send('movie_id=' + encodeURIComponent(movieId));
//     };

