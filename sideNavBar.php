<?php

function sideNav($nav)
{
    $scan = array_diff(scandir($nav), array('..', '.'));
    foreach ($scan as $file) {
        if (is_dir("$nav/$file")) {

            $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
            $path .= $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]);

            $sideNavOutput =
                "<form action='' method='post' id='getUrlPath'>
                    <input type='hidden' id='customUrlPath' name='customUrlPath' value='$file'>
                </form>
                <button type='submit' form='getUrlPath' class='btn btn-link text-primary' name='getPath' value='$file'>$file</button>";
            echo $sideNavOutput;



            $scanFolder = array_diff(scandir("$nav/$file"), array('..', '.'));
            foreach ($scanFolder as $folder) {
                if (is_dir("$nav/$file/$folder")) {
                    $sideNavFolderOutput =
                        "<form action='' method='post' id='getUrlPath'>
                            <input type='hidden' id='customUrlPath' name='customUrlPath' value='$folder'>
                        </form>
                        <button type='submit' form='getUrlPath' class='btn btn-link text-success ps-3 ms-3' name='getPath' value='$file/$folder'>$folder</button>";
                    echo $sideNavFolderOutput;



                    $scanFolderFolder = array_diff(scandir("$nav/$file/$folder"), array('..', '.'));
                    foreach ($scanFolderFolder as $folderFolder) {
                        if (is_dir("$nav/$file/$folder/$folderFolder")) {
                            $sideNavFolderFolderOutput =
                                "<form action='' method='post' id='getUrlPath'>
                                    <input type='hidden' id='customUrlPath' name='customUrlPath' value='$folderFolder'>
                                </form>
                                <button type='submit' form='getUrlPath' class='btn btn-link text-danger ps-4 ms-4' name='getPath' value='$file/$folder/$folderFolder'>$folderFolder</button>";
                            echo $sideNavFolderFolderOutput;
                        }
                    }
                }
            }
        }
    }
}
