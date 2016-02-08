<?php
class UltimateNewMedia_Social_Model_Resource_Likes extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('ultimatenewmedia_social/likes', 'entity_id');
    }
}