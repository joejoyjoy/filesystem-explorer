<?php

function format_folder_size($size)
{
    if ($size >= 1048576) {
        $size = number_format($size / 1048576, 2) . ' MB';
    } elseif ($size >= 1) {
        $size = number_format($size / 1024, 2) . ' KB';
    } else {
        $size = '0 KB';
    }
    return $size;
}




function tableInsert($urlItem)
{
    $e = scandir($urlItem);
    foreach ($e as $file) {
        if (!is_dir("$urlItem/$file")) {
            $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
            $path .= $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]);

            $files = get_headers("$path/$urlItem/$file", 1); //file => files
            $bytes = $files["Content-Length"];
            $statFile = stat("$urlItem/" . $file);
            $path_parts = pathinfo($file);

            $output =
                "<tr>
                        <td><a href='$path/$urlItem/$file' class='btn' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-url='$path/$urlItem/$file' 
                        data-bs-ctime='" . gmdate("d-m-Y H:i", $statFile["ctime"]) . "' data-bs-mtime='" . gmdate("d-m-Y H:i", $statFile['mtime']) . "' 
                        data-bs-extension='" . $path_parts['extension'] . "' data-bs-size='" . format_folder_size($bytes) . "' data-bs-name='$file'>$file</a></td>

                        <td>" . gmdate("d-m-Y H:i", $statFile["ctime"]) . "</td>
                        <td>" . gmdate("d-m-Y H:i", $statFile['mtime']) . "</td>
                        <td class='text-uppercase'>" . $path_parts['extension'] . "</td>
                        <td>" . format_folder_size($bytes) . "</td>
                </tr>";

            echo $output;
        } else if ('.' == $file or '..' == $file) {
            // echo 'dot<br>';
        } else {
            $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
            $path .= $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]);

            $direct = "./$urlItem/$file";
            $fstatFile = stat("$urlItem/$file");
            $directFiles = array_diff(scandir($direct), array('..', '.'));

            $total = 0;
            foreach ($directFiles as $folderFiles) {
                if (!is_dir("$urlItem/$file/$folderFiles")) {
                    $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
                    $path .= $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]);

                    $files = get_headers("$path/$urlItem/$file/$folderFiles", 1); //file => files
                    $bytes = $files["Content-Length"];
                    $kb = round($bytes / 1024, 2);

                    $total += $kb;
                }
            }


            $output =
                "<tr><form action='' method='post' id='getUrlPath'>
                        <input type='hidden' id='customUrlPath' name='customUrlPath' value='$file'>
                    </form>

                    <td><input type='submit' form='getUrlPath' class='btn btn-link' name='getPath' value='$file'></td>
                    <td>" . gmdate("d-m-Y H:i", $fstatFile['ctime']) . "</td>
                    <td>" . gmdate("d-m-Y H:i", $fstatFile['mtime']) . "</td>
                    <td></td>
                    <td><span>$total KB</span></td>
                </tr>";
            echo $output;
        }
    }
}


function dirToArray($dir)
{
    $result = array();
    $cdir = scandir($dir);

    foreach ($cdir as $key => $value) {
        if (!in_array($value, array(".", ".."))) {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                $result[] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
                $path .= $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]);

                echo "<li style='color:#ccc; list-style:none;'>$value</li>";
            } else {
                $result[] = $value;
                $path = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
                $path .= $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]);

                echo "<li style='list-style:none;'><a href='$path/$dir/$value' style='color:white;'>$value</a></li>";
            }
        }
    }

    return $result;
}

$a = 0;
