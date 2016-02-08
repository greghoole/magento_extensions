<?php

class UltimateNewMedia_Social_Model_Likes extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('ultimatenewmedia_social/likes');
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();

        $this->_updateTimestamps();

        return $this;
    }

    protected function _updateTimestamps()
    {
        $timestamp = now();

        if ($this->isObjectNew()) {
            $this->setCreatedAt($timestamp);
        }

        return $this;
    }
}