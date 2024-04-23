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





