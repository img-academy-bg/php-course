<?php

// 05-oop/classes/Repository/CityRepository.php

namespace Img\Repository;

use Img\Database\Database;
use Img\Model\City;

/**
 * Description of CityRepository
 *
 * @author ksavc
 */
class CityRepository
{
    
    private Database $db;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function fetchById(int $id): ?City
    {
        $sql = "SELECT * FROM city WHERE ID = {$id}";
        $result = (array) $this->db->query($sql);
        if ($result) {
            return $this->createObjectFromArray($result[0]);
        }
        
        return null;
    }
    
    public function fetchByCountryCode(string $countryCode): array
    {
        $sql = "SELECT * FROM city WHERE CountryCode = '{$countryCode}'";
        $result = (array) $this->db->query($sql);
        $cities = [];
        foreach ($result as $row) {
            $cities[] = $this->createObjectFromArray($row);
        }
        return $cities;
    }
    
    public function fetchByCountry(Country $country): array
    {
        return $this->fetchByCountryCode($country->code);
    }
    
    private function createObjectFromArray(array $row): City
    {
        $cityObject = new City();
        
        return $cityObject->setId($row['ID'])
                ->setName($row['Name'])
                ->setCountryCode($row['CountryCode'])
                ->setPopulation($row['Population'])
                ->setDistrict($row['District']);
    }
}
