const exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-url')
    const name = button.getAttribute('data-bs-name')
    const ctime = button.getAttribute('data-bs-ctime')
    const mtime = button.getAttribute('data-bs-mtime')
    const dataExtension = button.getAttribute('data-bs-extension')
    const size = button.getAttribute('data-bs-size')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body')
    const modalBodyClose = exampleModal.querySelector('.modal-footer-close')
    const modalTitleInfo = exampleModal.querySelector('.modal-title-info')

    const modalTitleInfoName = exampleModal.querySelector('.modal-title-name')
    const modalTitleInfoCtime = exampleModal.querySelector('.modal-title-ctime')
    const modalTitleInfoMtime = exampleModal.querySelector('.modal-title-mtime')
    const modalTitleInfoExtension = exampleModal.querySelector('.modal-title-extension')
    const modalTitleInfoSize = exampleModal.querySelector('.modal-title-size')

    var x = document.getElementById("myAudio");

    function pauseAudio() {
        x.pause();
    }


    extension = recipient.split('.').pop();

    modalTitle.textContent = `Preview and Information about ${name}`
    modalTitleInfo.textContent = `Info about ${name}`

    modalTitleInfoName.textContent = name
    modalTitleInfoCtime.textContent = ctime
    modalTitleInfoMtime.textContent = mtime
    modalTitleInfoExtension.textContent = dataExtension
    modalTitleInfoSize.textContent = size


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

            break;

        case "wav":
        case "aiff":
        case "mp3":
        case "aac":
        case "flac":
        case "alac":
            modalBodyInput.innerHTML = `<audio id='myAudio' controls src="${recipient}"></audio>`;
            modalBodyClose.innerHTML = `<button onclick="pauseAudio()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>`;

            break;

        case "pdf":
            modalBodyInput.innerHTML = `<embed src="${recipient}" width="100%" height="800px"/>`;

            break;

        case "zip":
            modalBodyInput.innerHTML = `<a href='${recipient}'><img src="assets/zip.png" alt="Zip Icon" width="100%" height="500"></img></a>`;

            break;

        case "txt":
            modalBodyInput.innerHTML = `<a href='${recipient}'><img src="assets/txt.png" alt="Text Icon" width="100%" height="500"></img></a>`;

            break;

        default:
            modalBodyInput.innerHTML = recipient
            break;
    }
})


