document
    .getElementById("fileListContainer")
    .addEventListener("click", getFileInfo);

function getFileInfo(event) {
    let btnElement = event.target;
    console.log(btnElement);

    if (btnElement.classList.contains("fileBtn")) {
        //Get the path in the data-path attribute of the clicked element
        let filePath = btnElement.dataset.path;
        console.log(filePath);

        fetch("./modules/fileInfo.php" + "?" + "path=" + filePath, {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                renderFileInfo(data);
            })
            .catch((err) => console.log("Request failed: ", err));
    }
}

function renderFileInfo(data) {
    let fileSize = document.getElementById("fileSize");
    let fileCreationDate = document.getElementById("fileCreationDate");
    let fileContent = document.getElementById("fileContent");

    fileSize.innerHTML = "Size: " + data["size"];
    fileCreationDate.innerHTML = "Creation date: " + data["creationDate"];
    fileContent.innerHTML = "Content: " + data["content"];
}

function showMedia(mediaFile, mediaType) {
    console.log(mediaType);

    let media = document.getElementById("mediaModal");
    switch (mediaType) {
        case "webp":
        case "png":
        case "jpg":
        case "jpeg":
        case "jfif":
        case "pjpeg":
        case "pjp":
        case "avif":
        case "apng":
            media.innerHTML = "<img src=" + mediaFile + "></img>";
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
            media.innerHTML = "<video src=" + mediaFile + " ></video>";
            console.log(mediaType);

            break;

        case "wav":
        case "aiff":
        case "mp3":
        case "aac":
        case "flac":
        case "alac":
            media.innerHTML = "<audio src=" + mediaFile + "></audio>";
            console.log(mediaType);

            break;
        case NULL: // Handle no file extension
            break;
    }

}