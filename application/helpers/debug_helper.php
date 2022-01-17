<?php
function debug($data, $ext = "txt") {
    date_default_timezone_set('Indian/Antananarivo');
    $file = fopen("./debug/debug.".$ext, "a+");
    fwrite($file, "\n--------------------------------------------------------".date('Y-m-d H:i:s')."----------------------------------------------------------------\n");
    fwrite($file, $data);
    fclose($file);
}