<?php

class UltimateNewMedia_Social_Model_Review extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('ultimatenewmedia_social/review');
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