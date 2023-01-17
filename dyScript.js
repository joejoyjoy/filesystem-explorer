const exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body')
    extension = recipient.split('.').pop();
    modalTitle.textContent = `New message to ${recipient}`
    switch (extension) {
        case "webp":
        case "png":
        case "jpg":
        case "jpeg":
        case "jfif":
        case "pjpeg":
        case "pjp":
        case "avif":
        case "apng":
            modalBodyInput.innerHTML = `<img src="${recipient}" width="100%"></img>`;
            console.log(mediaType);
            break;

        case "webm":
        case "mpg":
        case "mp2":
        case "mpeg":
        case "mpe":
        case "mpv":
        case "mp4":
        case "m4p":
        case "m4v":
        case "avi":
        case "wmv":
        case "mov":
        case "qt":
        case "flv":
        case "swf":
        case "avchd":
            modalBodyInput.innerHTML = `<video src="${recipient}" width="100%" autoplay></video>`;
            console.log(mediaType);

            break;

        case "wav":
        case "aiff":
        case "mp3":
        case "aac":
        case "flac":
        case "alac":
            modalBodyInput.innerHTML = `<audio src="${recipient}" width="100%"></audio>`;
            console.log(mediaType);

            break;
        default:
            modalBodyInput.innerHTML = recipient
            break;
    }
})