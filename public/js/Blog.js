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

//like buttons (changing the src of the image and the number of likes)
const likeBtns = document.querySelectorAll(".like-btn");
    likeBtns.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            let img, nbLikes;
            e.preventDefault();
            if(e.target.tagName == 'BUTTON') {
                img = e.target.querySelector('img');
                nbLikes = e.target.querySelector('p');
            } else {
                img = e.target.parentElement.querySelector('img');
                nbLikes = e.target.parentElement.querySelector('p');
            }
            const currentSrc = img.getAttribute('src');
            const newSrc = currentSrc.includes('like.svg') ? '../public/images/like-active.svg' : '../public/images/like.svg';
            img.setAttribute('src', newSrc);
            nbLikes.textContent = currentSrc.includes('like.svg') ? parseInt(nbLikes.textContent) + 1 : parseInt(nbLikes.textContent) - 1;
        });
    });

//removing the refresh from the articles && truncating the description
const posts = document.querySelectorAll('.blog-article');

    // Truncate text to a specified length without cutting words in half and only taking the three first lines
    function truncateText(text, limit) {
        let lastSpaceIndex = text.lastIndexOf(' ', limit);
        if (lastSpaceIndex === -1) {
            return text;
        }
        let truncatedText;
        if(text.length < 200){
            truncatedText=text;
        } else {
            truncatedText = text.substring(0, lastSpaceIndex);
        }
        let lines = truncatedText.split('\n');
        if (lines.length > 3) {
            lines=lines.slice(0,3);
            lines = lines.join('<br>');
            return lines+' ...';
        } else {
            return lines.join('<br>') + ' ...';
        }
    }
    

    // Truncate text in each post
    posts.forEach(function(post) {
        const description = post.querySelector('.blog-description');
        const originalText = description.textContent;
        description.innerHTML = truncateText(originalText,200);

        post.addEventListener('click', function(e,index) {
            e.preventDefault();
            e.stopPropagation();
            console.log(post.id);
            if(!e.target.closest('.blog-article-content-info')){
                window.location.href = `/blog/article?id=${post.id}`;
            }
        });
    });

// dropdown menu animation and event listener
const dropdownButtons = document.querySelectorAll('.more-btn');
const dropdownMenus = document.querySelectorAll('.dropdown-menu');

    // Attach click event listener to each dropdown button
    dropdownButtons.forEach(function(button, index) {
        button.addEventListener('click', function(event) {
            const menu = dropdownMenus[index];
            console.log(index);
            menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

            dropdownMenus.forEach(function(otherMenu, otherIndex) {
                if (index !== otherIndex) {
                    otherMenu.style.display = 'none';
                }
            });
        });
    });

    // Close dropdown menus when clicking outside of them
    document.addEventListener('click', function(event) {
        dropdownMenus.forEach(function(menu) {
            if (!menu.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    });

    // redirecting to the deletePost/editPost page
    dropdownMenus.forEach(function(menu) {
        menu.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-btn')) {
                const postId = event.target.dataset.postId;
                // Confirm deletion with the user
                if (confirm('Are you sure you want to delete this post?')) {
                    window.location.href = `/blog/deletePost?id=${postId}`;
                }
            } else if (event.target.classList.contains('edit-btn')) {
                const postId = event.target.dataset.postId;
                window.location.href = `/editPost?id=${postId}`;
            }
        });
    });


