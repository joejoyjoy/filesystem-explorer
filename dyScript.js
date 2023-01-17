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
    const modalTitleInfo = exampleModal.querySelector('.modal-title-info')

    const modalTitleInfoName = exampleModal.querySelector('.modal-title-name')
    const modalTitleInfoCtime = exampleModal.querySelector('.modal-title-ctime')
    const modalTitleInfoMtime = exampleModal.querySelector('.modal-title-mtime')
    const modalTitleInfoExtension = exampleModal.querySelector('.modal-title-extension')
    const modalTitleInfoSize = exampleModal.querySelector('.modal-title-size')



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
            modalBodyInput.innerHTML = `<figure>
                                            <figcaption>Listen to the T-Rex:</figcaption>
                                                <audio
                controls
                src="/media/cc0-audio/t-rex-roar.mp3">
                <a href="/media/cc0-audio/t-rex-roar.mp3">
                    Download audio
                </a>
            </audio>
        </figure>
        <audio src="${recipient}" width="100%"></audio>`;
            
            console.log(mediaType);

            break;

        case "pdf":
            modalBodyInput.innerHTML = `<embed src="${recipient}" width="100%" height="800px"/>`;

            break;

        default:
            modalBodyInput.innerHTML = recipient
            break;
    }
})