<?php
class UltimateNewMedia_Social_Model_Resource_Likes_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        parent::_construct();

        $this->_init(
            'ultimatenewmedia_social/likes',
            'ultimatenewmedia_social/likes'
        );
    }
}