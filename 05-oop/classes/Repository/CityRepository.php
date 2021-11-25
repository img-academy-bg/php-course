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
class CityRepository extends AbstractRepository
{

    public function fetchById(int $id): ?City
    {
        $sql = "SELECT * FROM city WHERE ID = :id";
        $result = (array) $this->db->query($sql, ['id' => $id]);
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
    
    public function save(City $city): bool
    {
        $values = [
            'name' => $city->getName(),
            'countryCode' => $city->getCountryCode(),
            'district' => $city->getDistrict(),
            'population' => $city->getPopulation()
        ];
        if ($city->getId()) {
            return $this->update($values, $city->getId());
        } else {
            $return = $this->insert($values);
            if ($return) {
                $city->setId($this->db->lastInsertId());
            }
            return $return;
        }
    }
    
    protected function insert(array $values): bool
    {
        $sql = "INSERT INTO city VALUES(NULL, :name, :countryCode, :district, :population)";
        return (bool) $this->db->exec($sql, $values);
    }
    
    protected function update(array $values, int $id): bool
    {
        $sql = "UPDATE city SET "
                . "Name = :name, "
                . "CountryCode = :countryCode, "
                . "District = :district, "
                . "Population = :population "
                . "WHERE ID = :id";
        
        $values['id'] = $id;
        
        return (bool) $this->db->exec($sql, $values);
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
