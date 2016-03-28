<?php 
class Alpine_IframeCreSecure_Model_Iframe extends Mage_Core_Model_Abstract 
{
    protected function _construct()
    {
        $this->_init('iframecresecure/iframe');
    }

    public function getTransaction($quoteId)
    {
    	$transaction = null;
    	$collection = Mage::getModel('iframecresecure/iframe')->getCollection()
                    ->addFieldToFilter('session_id',$quoteId)
                    ->addFieldToFilter('processed','0');
        foreach($collection->load() as $trans){
          $transaction = $trans;
        }
        return $transaction;
    }
    
    public function getSessionIdFromOrderId($orderId)
    {
    	$transaction = null;
    	$collection = Mage::getModel('iframecresecure/iframe')->getCollection()
                    ->addFieldToFilter('order_id',$orderId);
        foreach($collection->load() as $trans){
          $transaction = $trans;
        }
        return ($transaction) ? $transaction->getSessionId() : $this;
    }
    
    public function getOrderIdFromSessionId($sessionId)
    {
    	$transaction = null;
    	$collection = Mage::getModel('iframecresecure/iframe')->getCollection()
                    ->addFieldToFilter('session_id',$sessionId)
                    ->addFieldToFilter('processed','1');
        foreach($collection->load() as $trans){
          $transaction = $trans;
        }
        return ($transaction ? $transaction->getOrderId() : $sessionId);
    }
} 
