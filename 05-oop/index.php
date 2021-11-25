<?php

// 05-oop/index.php
// Функция, която ще зарежда файлове с класове:
$autoloadCallback = function(string $className) {
    $parts = explode('\\', $className);
    $vendorNs = array_shift($parts);
    if ($vendorNs === 'Img') {
        $dirStructure = implode(DIRECTORY_SEPARATOR, $parts);
        $path = 'classes/' . $dirStructure . '.php';
        if (file_exists($path)) {
            require_once $path;
        }
    }
};
// регистриране на функцията за зареждане:
spl_autoload_register($autoloadCallback);

use Img\Database\Database;
use Img\Repository\CityRepository;

$db = new Database('localhost', 'root', '', 'world');
$cityRepository = new CityRepository($db);

$city = $cityRepository->fetchById(539);

var_dump($city);