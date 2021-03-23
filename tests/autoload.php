<?php
require_once "./vendor/autoload.php";
$scannedDirectory = array_diff(scandir("./src/CustomTypes"), array('..', '.'));
require_once "./src/CustomTypes/_Type.php";
require_once "./src/CustomTypes/_Iterable.php";
require_once "./src/CustomTypes/_ArrayObject.php";
require_once "./src/CustomTypes/_Array.php";


