<?php

function createItem($urlItem)
{
    if (isset($_POST['submit'])) {
        $cfolder = $_POST['cfolder'];
        @mkdir("$urlItem/$cfolder", 0777, true);
    }

    if (isset($_POST['submitFile'])) {
        $cfile = $_POST['cfileName'];
        $cfileText = $_POST['cfileDes'];
        @fopen("$urlItem/$cfile.txt", "w") or die("Unable to create file!");
        @file_put_contents("$urlItem/$cfile.txt", $cfileText);
    }
}


function uploadItem($urlItem)
{
    if ((@$_FILES['myfile']['name'] != "")) {
        // Where the file is going to be stored
        $target_dir = "$urlItem/";
        $file = $_FILES['myfile']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['myfile']['tmp_name'];
        $path_filename_ext = $target_dir . $filename . "." . $ext;

        // Check if file already exists
        if (file_exists($path_filename_ext)) {
            // file already exists
        } else {
            move_uploaded_file($temp_name, $path_filename_ext);
        }
    }
}
