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

// image preview +verify if image is valid
const imageInput = document.querySelector('input[name="image"]');
const firstColorInput = document.querySelector('input[name="bg-color1"]');
const secondColorInput = document.querySelector('input[name="bg-color2"]');
const imagePreview = document.querySelector('.image-preview');
const imagePreviewimg = document.querySelector('.image-preview-image');
const deleteImageButton = document.getElementById('no-img-btn');

function isImage(file) {
    const acceptedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/tiff', 'image/webp', 'image/svg+xml'];
    return file && acceptedImageTypes.includes(file.type);
}

imageInput.addEventListener('input', function(event) {
    const file = imageInput.files[0];
    const reader = new FileReader();

    if (!isImage(file)) {
        event.preventDefault(); 
        window.alert('Invalid image file');
        imageInput.value = null; 
        imagePreviewimg.src =''; 
        return;
    }

    reader.onload = function() {
        imagePreviewimg.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    }
});

// delete imageinput and preview
deleteImageButton.addEventListener('click', function(event) {
    event.preventDefault();
    imageInput.value = null;
    imagePreview.src = '';
});

// color preview
[firstColorInput,secondColorInput].forEach(
    element => element.addEventListener('input', function() {
        console.log('input');
        let bgColor1 = firstColorInput.value;
        let bgColor2 = secondColorInput.value;
        imagePreview.style.background = `linear-gradient(96.55deg, ${bgColor1} -25.2%, ${bgColor2} 55.15%)`;
    })
);
    
