<?php

namespace Img\Repository;

use Img\Model\Country;

/**
 * Description of CountryRepository
 *
 * @author ksavc
 */
class CountryRepository extends AbstractRepository {
    
    public function fetchByCode(string $code): ?Country
    {
        $sql = "SELECT * FROM country WHERE Code = :code";
        $result = $this->db->query($sql, ['code' => $code]);
        // ...
    }
}
