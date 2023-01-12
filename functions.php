<?php

function tableInsert($folder)
{
    $e = scandir($folder);
    foreach ($e as $file) {
        if (!is_dir("root/$file")) {
            $files = get_headers("http://localhost/filesystem-explorer/root/$file", 1); //file => files
            $bytes = $files["Content-Length"];
            $kb = round($bytes / 1024, 2);
            $statFile = stat('root/' . $file);
            $path_parts = pathinfo($file);

            $output =
                "<tr>
                        <td><a href='http://localhost/filesystem-explorer/root/$file'>$file</a></td>
                        <td>" . gmdate('d-m-Y h:m:i A', $statFile["ctime"]) . "</td>
                        <td>" . gmdate("Y-m-d H:i:s", $statFile['mtime']) . "</td>
                        <td class='text-uppercase'>" . $path_parts['extension'] . "</td>
                        <td>$kb KB</td>
                    </tr>";

            echo $output;
        } else if ('.' == $file or '..' == $file) {
            // echo 'dot<br>';
        } else {
            $output =
                "<tr>
                <td><a href='http://localhost/filesystem-explorer/root/$file'>$file</a></td>
                <td>" . gmdate("Y-m-d H:i:s", $statFile['ctime']) . "</td>
                <td>" . gmdate("Y-m-d H:i:s", $statFile['mtime']) . "</td>
                <td></td>
                <td>$kb KB</td>
                </tr>";
            echo $output;

            echo $file . ' <span style="color:blue;">is a folder</span><br><br><br>';
        }
    }
}
