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