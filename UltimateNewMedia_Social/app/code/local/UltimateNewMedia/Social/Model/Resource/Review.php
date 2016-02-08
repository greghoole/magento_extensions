<?php
class UltimateNewMedia_Social_Model_Resource_Review extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('ultimatenewmedia_social/review', 'entity_id');
    }
}