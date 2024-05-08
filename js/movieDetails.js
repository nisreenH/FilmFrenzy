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
const stars = document.querySelectorAll(".stars i");
console.log(stars);
//index1 is where the number of stars are saved
stars.forEach((star, index1)=>{
           star.addEventListener("click", ()=>{
                stars.forEach((star, index2)=>{
                    console.log(index1);
                    index1 >= index2 ? star.classList.add("active-star") : star.classList.remove("active-star") ;
                    // const starsCount = document.querySelectorAll(".stars i .active-star");
console.log("star count ");
                });
           });
});


/*end rating stars*/