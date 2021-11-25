<?php

// 05-oop/classes/Model/Country.php

namespace Img\Model;

/**
 * Description of Country
 *
 * @author ksavc
 */
class Country
{

    protected string $code;
    
    protected string $name;
    
    protected int $population;
    
    protected string $continent;
    
    public function getCode(): string {
        return $this->code;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPopulation(): int {
        return $this->population;
    }

    public function getContinent(): string {
        return $this->continent;
    }

    public function setCode(string $code) {
        $this->code = $code;
        return $this;
    }

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    public function setPopulation(int $population) {
        $this->population = $population;
        return $this;
    }

    public function setContinent(string $continent) {
        $this->continent = $continent;
        return $this;
    }
}
