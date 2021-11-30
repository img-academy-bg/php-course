<?php

namespace Img\Factory;

use Img\Repository\CityRepository;

/**
 * Description of CityRepositoryFactory
 *
 * @author ksavc
 */
class CityRepositoryFactory {
    
    public static function create(): CityRepository
    {
        $countryRepositoty = CountryRepositoryFactory::create();
        $db = \Img\Database\Database::getInstance();
        
        return new CityRepository($db, $countryRepositoty);
    }
}
