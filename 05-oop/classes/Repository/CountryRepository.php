<?php

namespace Img\Repository;

use Img\Model\Country;

/**
 * Description of CountryRepository
 *
 * @author ksavc
 */
class CountryRepository extends AbstractRepository
{
    
    protected string $table = 'country';

    public function fetchByCode(string $code): ?Country
    {
        $list = $this->fetchBy('Code', $code);
        if ($list) {
            return $list[0];
        }
        
        return null;
    }
    
    public function createObjectFromRow(array $row): Country {
        $country = new Country();
        $country->setCode($row['Code'])
                ->setName($row['Name'])
                ->setPopulation($row['Population'])
                ->setContinent($row['Continent']);
        
        return $country;
    }
}
