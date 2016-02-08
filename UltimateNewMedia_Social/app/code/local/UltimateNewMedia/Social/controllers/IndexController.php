<?php

class UltimateNewMedia_Social_IndexController extends Mage_Core_Controller_Front_Action
{
    public function likeAction()
    {
        $productId = $this->getRequest()->getParam('id');
        
        $likeData = array(
            'product_id' => $productId,
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        
        $collection = Mage::getModel('ultimatenewmedia_social/likes')
            ->getCollection()
            ->addFieldToFilter('product_id', $productId)
            ->addFieldToFilter('ip_address', $_SERVER['REMOTE_ADDR'])
            ->load();
        if($collection->getSize() > 0) {
            Mage::getSingleton('core/session')->addError(
                $this->__('You have already liked this product.')
            );
        }
        else {
            $likes = Mage::getModel('ultimatenewmedia_social/likes');
            try {
                $likes->addData($likeData);
                $likes->save();
            } catch (Exception $e){
                echo $e->getMessage();
            }
        }

        $refererUrl = $this->_getRefererUrl();
        $this->getResponse()->setRedirect($refererUrl);
    }
    
    public function likeReviewAction()
    {
        $reviewId = $this->getRequest()->getParam('id');
        
        $likeData = array(
            'review_id' => $reviewId,
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        
        $collection = Mage::getModel('ultimatenewmedia_social/review')
            ->getCollection()
            ->addFieldToFilter('review_id', $reviewId)
            ->addFieldToFilter('ip_address', $_SERVER['REMOTE_ADDR'])
            ->load();
        if($collection->getSize() > 0) {
            Mage::getSingleton('core/session')->addError(
                $this->__('You have already liked this review.')
            );
        }
        else {
            $likes = Mage::getModel('ultimatenewmedia_social/review');
            try {
                $likes->addData($likeData);
                $likes->save();
            } catch (Exception $e){
                echo $e->getMessage();
            }
        }

        $refererUrl = $this->_getRefererUrl();
        $this->getResponse()->setRedirect($refererUrl);
    }
}
