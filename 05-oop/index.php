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
use Img\Model\City;

$db = new Database('localhost', 'root', '', 'world');
$cityRepository = new CityRepository($db);

$city = new City();
$city->setName('Veliko Tyrnovo')
        ->setCountryCode('BGR')
        ->setDistrict('Veliko Tyrnovo')
        ->setPopulation(65000);

// Изваждане на обект с данни от БД
//$city = $cityRepository->fetchById(539);
// Промяна на данните:
//$city->setName('София');
//// Запазване на променените данни:
$cityRepository->save($city);

echo '<dl>';
echo '<dt>ID:</dt><dd>' . $city->getId().'</dd>';
echo '<dt>Name:</dt><dd>' . $city->getName().'</dd>';
echo '<dt>Population:</dt><dd>' . $city->getPopulation().'</dd>';
echo '<dt>District:</dt><dd>' . $city->getDistrict().'</dd>';
echo '<dt>Country:</dt><dd>' . $city->getCountryCode().'</dd>';
echo '</dl>';