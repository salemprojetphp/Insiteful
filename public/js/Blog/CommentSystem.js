const commentBtn = document.querySelector(".comment-btn");
const form = document.querySelector("#comment-form");
const commentsContainer = document.querySelector('.comments');
const username = document.querySelector("main").id;
const nbComments = document.querySelector('.nb-comments');
let deleteCommentBtns= document.querySelectorAll('.delete-comment-btn');

commentBtn.addEventListener('click', function(e) {
    e.preventDefault();
    const comment = form.querySelector('textarea[name="comment"]').value;
    if(!comment) {
        return;
    }
    fetch(form.action, {
        method: 'POST',
        body: new FormData(form)
    })
    .then(response => {
        form.reset();
        const author = username;
        const currentDate = new Date();
        addComment(author, comment, "Just Now");
        deleteCommentBtns = document.querySelectorAll('.delete-comment-btn');
        deleteCommentBtns.forEach(btn => {
            btn.addEventListener('click', deleteComment);
        });
    })
    .catch(error => {
        console.error('Error submitting comment:', error);
    });
});

deleteCommentBtns.forEach(btn => {
    btn.addEventListener('click', deleteComment);
});

function addComment(author, content, time) {
    const commentHTML = `
        <div class="comment">
            <div class="comment-info flex">
                <div class="user">
                    <img src="../public/images/user.png" width="32" height="32" alt="author">
                    <span class="ml8 mr32">${author}</span>
                </div>
                <span class="caption gray">${time}</span>
                <button class="delete-comment-btn added-now">
                    <img src="../public/images/delete.png" alt="delete">
                </button>
            </div>
            <p class="comment-content">${content}</p>
        </div>
    `;
    commentsContainer.innerHTML = commentHTML + commentsContainer.innerHTML;
    deleteCommentBtns = document.querySelectorAll('.delete-comment-btn');
    nbComments.innerHTML = parseInt(nbComments.innerHTML) + 1;
}

function deleteComment(e) {
    e.preventDefault();
    const btn = e.target;
    const comment_id = btn.id;
    const comment = btn.closest('.comment');
    if (btn.classList.contains('added-now')) {
        fetch(`/deleteComment?id=null`, {
            method: 'GET'
        });
    } else {
        fetch(`/deleteComment?id=${comment_id}`, {
            method: 'GET'
        });
    }
    comment.remove();
    nbComments.innerHTML = parseInt(nbComments.innerHTML) - 1;
}


