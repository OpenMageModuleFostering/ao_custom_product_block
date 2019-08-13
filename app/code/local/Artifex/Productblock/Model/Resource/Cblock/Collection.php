<?php
class Artifex_Productblock_Model_Resource_Cblock_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('artifex_productblock/cblock');
    }
}