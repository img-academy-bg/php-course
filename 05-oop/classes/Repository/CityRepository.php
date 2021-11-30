<?php

// 05-oop/classes/Repository/CityRepository.php

namespace Img\Repository;

use Img\Model\ModelInterface;
use Img\Model\City;
use Img\Database\Database;

/**
 * Description of CityRepository
 *
 * @author ksavc
 */
class CityRepository extends AbstractRepository
{
    
    protected string $table = 'city';
    
    protected CountryRepository $countryRepository;
    
    public function __construct(
        Database $db,
        CountryRepository $countryRepository
    ) {
        parent::__construct($db);
        $this->countryRepository = $countryRepository;
    }

    public function fetchById(int $id): ?City
    {
        $result = $this->fetchBy('ID', $id);
        if ($result) {
            return $result[0];
        }
        
        return null;
    }
    
    public function fetchByCountryCode(string $countryCode): array
    {
        return $this->fetchBy('CountryCode', $countryCode);
    }
    
    public function fetchByCountry(Country $country): array
    {
        return $this->fetchByCountryCode($country->code);
    }
    
    public function save(ModelInterface $city): bool
    {
        $result = parent::save($city);
        if ($result && !$city->getId()) {
            $city->setId($this->db->lastInsertId());
        }
        return $result;
    }
    
    public function createObjectFromRow(array $row): City
    {
        $country = $this->countryRepository->fetchByCode($row['CountryCode']);
        
        $cityObject = new City();
        
        return $cityObject->setId($row['ID'])
                ->setName($row['Name'])
                ->setCountryCode($row['CountryCode'])
                ->setPopulation($row['Population'])
                ->setDistrict($row['District'])
                ->setCountry($country);
    }
}
