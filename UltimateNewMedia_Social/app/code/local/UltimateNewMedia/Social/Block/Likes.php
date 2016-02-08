<?php

class UltimateNewMedia_Social_Block_Likes extends Mage_Core_Block_Template
{
    public function getLikeCount($productId) {

        $collection = Mage::getModel('ultimatenewmedia_social/likes')
            ->getCollection()
            ->addFieldToFilter('product_id', $productId)
            ->load();
        return $collection->getSize();
    }

}