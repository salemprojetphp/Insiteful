//selection of filter buttons
const filterBtns = document.querySelectorAll(".filter-btn");
let activeFilterBtns = document.querySelector(".selected");
filterBtns.forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        //removing the selected class from the active button
        activeFilterBtns.classList.remove('selected');
        e.target.classList.add('selected');
        activeFilterBtns = e.target;
    });
});

//adding post 
function addPost(title,description,pathToImage){
    // Create a new link element
    const blogLink = document.createElement("a");

    // Set the href attribute for the link
    blogLink.classList.add("blog-article");
    blogLink.classList.add("bg-white");
    blogLink.classList.add("shadow-sm");
    blogLink.classList.add("mb32");
    console.log(blogLink);

    // Set the innerHTML of the link to the provided blog content
    blogLink.innerHTML = `
        <div class="blog-preview">
        <img src="${pathToImage}" width="258" height="200" alt="Hello blog world">
        </div>
        <div class="blog-article-content">
        <h2 class="h3 mb16 black">${title}</h2>
        <div class="blog-description gray mb24">${description}</div>
        <div class="blog-article-content-info flex caption gray">
            <div class="flex">
                <img src="image/user.png" width="24" height="24" alt="author">
                <span class="ml8 mr24">Irae Hueck Costa</span>
                    Apr 14, 2023
            </div>
            <div class="flex">
                <span class="ml8">1 min read</span>
            </div>
        </div>
        </div>
    `;

    // Append the new link to an existing container (e.g., with ID "blogContainer")
    const existingContainer = document.getElementById("blogContainer");
    existingContainer.appendChild(blogLink);
}
