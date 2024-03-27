const form = document.querySelector('.add-post-form');
const formData = new FormData(form); // Create form data object
const titleInput = form.querySelector('input[name="title"]');
const contentInput = form.querySelector('textarea[name="content"]');
const submitButton = document.getElementById('add-btn');

//can't submit if title or content is empty
submitButton.addEventListener('click', function(event) {
    let isEmpty = false;
    // event.preventDefault();
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
    // if(!isEmpty){
    //     // Send form data asynchronously using AJAX
    //     fetch('AddForm.php', {
    //         method: 'POST',
    //         body: formData
    //     })
    //     .then(response => {
    //         if (response.ok) {
    //             // Handle successful form submission
    //             console.log('Form submitted successfully!');
    //             // Optionally, you can reset the form after successful submission
    //             form.reset();
    //         } else {
    //             // Handle errors
    //             console.error('Form submission failed!');
    //         }
    //     })
    //     .catch(error => {
    //         console.error('Error:', error);
    //     });
    // } else{
    //     console.log("empty fields");
    // }
});
// removing alert when user starts typing
titleInput.addEventListener('input', function() {
    if (this.value.trim() !== '') {
        this.classList.remove('bg-red');
    }
});
contentInput.addEventListener('input', function() {
    if (this.value.trim() !== '') {
        this.classList.remove('bg-red');
    }
});

