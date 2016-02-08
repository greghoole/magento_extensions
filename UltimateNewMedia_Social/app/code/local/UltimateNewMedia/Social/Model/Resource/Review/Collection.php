<?php
class UltimateNewMedia_Social_Model_Resource_Review_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();

        $this->_init(
            'ultimatenewmedia_social/review',
            'ultimatenewmedia_social/review'
        );
    }
}