<?php

namespace Img\Factory;

use Img\Repository\CountryRepository;
use Img\Database\Database;

/**
 * Description of CountryRepositoryFactory
 *
 * @author ksavc
 */
class CountryRepositoryFactory {
    
    public static function create(): CountryRepository
    {
        return new CountryRepository(Database::getInstance());
    }
}
