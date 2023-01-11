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

        fetch("modules/fileInfo.php" + "?" + "path=" + filePath, {
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
