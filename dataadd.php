<?php


$fp = fopen('newkey.txt', 'w');

for($i=1; $i <= 10000; $i++) {
    $key = 'ключ';
    $value = '\tзначение';
    $prefix = '\x0A';
    $content = $key.$i.$value.$i.$prefix;
    $text = fwrite($fp, $content);

    $newtext = wordwrap($text, 200, "\n", true);

}


fclose($fp);

?>