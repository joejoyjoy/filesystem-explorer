<?php

function tableInsert($e)
{
    $e = scandir('root');
    foreach ($e as $eFile) {
        if (!is_dir("root/$eFile")) {
            $eFiles = get_headers("http://localhost/filesystem-explorer/root/$eFile", 1); //file => files
            $eFileByts = $eFiles["Content-Length"];
            $eFileKB = round($eFileByts / 1024, 2);
            $eFileStatFile = stat('root/' . $eFile);
            $eFilePathParts = pathinfo($eFile);

            $eFileOutput =
                "<tr>
                <td><a href='http://localhost/filesystem-explorer/root/$eFile'>$eFile</a></td>
                <td>" . gmdate("Y-m-d H:i:s", $eFileStatFile['mtime']) . "</td>
                <td>" . gmdate("Y-m-d H:i:s", $eFileStatFile['atime']) . "</td>
                <td class='text-uppercase'>" . $eFilePathParts['extension'] . "</td>
                <td>$eFileKB KB</td>
            </tr>";

            echo $eFileOutput;
        } else if ('.' == $eFile or '..' == $eFile) {
            // echo 'dot<br>';
        } else {
            echo $eFile . ' <span style="color:blue;">is a folder</span><br><br><br>';
        }
    }
}
