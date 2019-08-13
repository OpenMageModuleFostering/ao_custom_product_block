<?php 
class Artifex_Productblock_Model_Resource_Cblock extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('artifex_productblock/cblock', 'cblock_id');
    }
}