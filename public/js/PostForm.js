const titleInput = document.querySelector('input[name="title"]');
const contentInput = document.querySelector('textarea[name="content"]');
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

// image preview
const imageInput = document.querySelector('input[name="image"]');
const imagePreview = document.querySelector('.image-preview');
const deleteImageButton = document.getElementById('no-img-btn');
console.log(deleteImageButton);

imageInput.addEventListener('input', function(event) {
    const file = imageInput.files[0];
    const reader = new FileReader();

    reader.onload = function() {
        imagePreview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } 
});

deleteImageButton.addEventListener('click', function(event) {
    event.preventDefault();
    imageInput.value = null;
    imagePreview.src = '';
});

    
