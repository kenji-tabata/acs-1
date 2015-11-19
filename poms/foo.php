<?php

echo "\n" . getcwd();
echo "\n" . basename(dirname(__FILE__));
echo "\n" . dirname(__FILE__);

$filename = dirname(__FILE__) . '/../files-temp/index.php';

if (file_exists($filename)) {
    echo "\n ok";
} else {
    echo "\n neg";
}