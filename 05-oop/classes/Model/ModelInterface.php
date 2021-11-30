<?php

namespace Img\Model;

/**
 *
 * @author ksavc
 */
interface ModelInterface {
    
    /**
     * Returns the value of the PK column
     * 
     * @return mixed
     */
    public function getPrimaryKeyValue();
    
    /**
     * Returns the name of the PK column
     * 
     * @return string
     */
    public function getPrimaryKeyName(): string;
    
    /**
     * Values to be saved into DB
     * 
     * @return array
     */
    public function getValues(): array;
}
