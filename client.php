<?php
$msg = "1|2|3|4|5|6|7|8|9|10|11|12|13|14|15|16|17|18|19|20";
$fp = stream_socket_client('udp://127.0.0.1:9094',  $errno, $errstr);
if (!$fp) {
    echo "ERROR: $errno - $errstr<br />\n";
} else {
    for($i=0;$i<10;$i++) {
        fwrite($fp, $msg);
    }
    fclose($fp);
}

//1
//2
//
