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




function tableInsert($folder)
{
    $e = scandir($folder);
    foreach ($e as $file) {
        if (!is_dir("root/$file")) {
            $files = get_headers("http://localhost/filesystem-explorer/root/$file", 1); //file => files
            $bytes = $files["Content-Length"];
            $statFile = stat('root/' . $file);
            $path_parts = pathinfo($file);

            $output =
                "<tr>
                        <td><a href='http://localhost/filesystem-explorer/root/$file'>$file</a></td>
                        <td>" . gmdate("d-m-Y H:i", $statFile["ctime"]) . "</td>
                        <td>" . gmdate("d-m-Y H:i", $statFile['mtime']) . "</td>
                        <td class='text-uppercase'>" . $path_parts['extension'] . "</td>
                        <td>" . format_folder_size($bytes) . "</td>
                    </tr>";

            echo $output;
        } else if ('.' == $file or '..' == $file) {
            // echo 'dot<br>';
        } else {
            $direct = './root/' . $file;
            $fstatFile = stat('root/' . $file);
            $directFiles = array_diff(scandir($direct), array('..', '.'));

            $total = 0;
            foreach ($directFiles as $folderFiles) {
                if (!is_dir("root/$file/$folderFiles")) {
                    $files = get_headers("http://localhost/filesystem-explorer/root/$file/$folderFiles", 1); //file => files
                    $bytes = $files["Content-Length"];
                    $kb = round($bytes / 1024, 2);

                    $total += $kb;
                }
            }


            $output =
                "<tr>
                    <td><a href='http://localhost/filesystem-explorer/root/$file'>$file</a></td>
                    <td>" . gmdate("d-m-Y H:i", $fstatFile['ctime']) . "</td>
                    <td>" . gmdate("d-m-Y H:i", $fstatFile['mtime']) . "</td>
                    <td></td>
                    <td><span>$total KB</span></td>
                </tr>";
            echo $output;
        }
    }
}
