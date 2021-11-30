<?php

// 05-oop/index.php
// Функция, която ще зарежда файлове с класове:
$autoloadCallback = function (string $className) {
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

use Img\Exception\NoTableException;
use Img\Factory\CityRepositoryFactory;

try {
    
    $cityRepository = CityRepositoryFactory::create();
    $city = $cityRepository->fetchById(540);

    echo '<dl>';
    echo '<dt>ID:</dt><dd>' . $city->getId() . '</dd>';
    echo '<dt>Name:</dt><dd>' . $city->getName() . '</dd>';
    echo '<dt>Population:</dt><dd>' . $city->getPopulation() . '</dd>';
    echo '<dt>District:</dt><dd>' . $city->getDistrict() . '</dd>';
    echo '<dt>Country Name:</dt><dd>' . $city->getCountry()->getName() . '</dd>';
    echo '<dt>Continent:</dt><dd>' . $city->getCountry()->getContinent() . '</dd>';
    echo '</dl>';
} catch (NoTableException $ex) {
    echo '<h1>There is a problem with the page, try again later</h1>';
    echo '<pre>';
    echo $ex->getTraceAsString();
    echo '</pre>';
}
