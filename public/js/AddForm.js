const form = document.querySelector('.add-post-form');
const formData = new FormData(form); // Create form data object
const titleInput = form.querySelector('input[name="title"]');
const contentInput = form.querySelector('textarea[name="content"]');
const submitButton = document.getElementById('add-btn');

//can't submit if title or content is empty
submitButton.addEventListener('click', function(event) {
    let isEmpty = false;
    if (titleInput.value.trim() === '') {
        titleInput.classList.add('bg-red');
        isEmpty = true;
    }
    if (contentInput.value.trim() === '') {
        contentInput.classList.add('bg-red');
        isEmpty = true;
    }
    if(isEmpty){
        event.preventDefault();
    }
});

// removing alert when user starts typing
[titleInput,contentInput].forEach(element => {  
    element.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            this.classList.remove('bg-red');
        }
    });
});

