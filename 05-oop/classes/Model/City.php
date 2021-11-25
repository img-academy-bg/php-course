<?php

// 05-oop/classes/Model/City.php

namespace Img\Model;

/**
 * Class City
 *
 * @author ksavc
 */
class City
{
    
    protected int $id;
    
    protected string $name;
    
    protected string $district;
    
    protected string $countryCode;
    
    protected int $population;
    
    protected Country $country;
    
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDistrict(): string {
        return $this->district;
    }

    public function getCountryCode(): string {
        return $this->countryCode;
    }

    public function getPopulation(): int {
        return $this->population;
    }

    public function getCountry(): Country {
        return $this->country;
    }

    public function setId(int $id) {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    public function setDistrict(string $district) {
        $this->district = $district;
        return $this;
    }

    public function setCountryCode(string $countryCode) {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function setPopulation(int $population) {
        $this->population = $population;
        return $this;
    }

    public function setCountry(Country $country) {
        $this->country = $country;
        return $this;
    }
}
