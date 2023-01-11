<?php

if ($handle = opendir('./root')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {
            echo "<p>$entry <button class='fileBtn' data-path='$entry'>Info</button></p>";
        }
    }

    closedir($handle);
}
