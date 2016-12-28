<?php
class Alpine_IframeCreSecure_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    }
    
    public function returnAction()
    {
      if(!$this->getRequest()) {
        $this->_redirect('checkout/cart');
        return;
      }        

      $debug = Mage::getStoreConfig('payment/iframecresecure/debug');
      
      $postXML = file_get_contents('php://input'); 
      if($debug == 1){ 
      	Mage::log(__METHOD__ . ' Execution Time: ' . time() . ' : '. date('m/d/Y h:i a'));
      	Mage::log(__METHOD__ . ' Cresecure XML: ' . $postXML); 
      }
      $xml = simplexml_load_string($postXML);
      
      try {
      
      	// get model
        $transaction = Mage::getModel('iframecresecure/iframe');
        
        // set values
        $transaction->setTransactionStart($xml->transactionStart);
        $transaction->setTransactionEnd($xml->transactionEnd);
        $transaction->setSessionId($xml->sessionId);
        $transaction->setCreStatus($xml->status);
        $transaction->setName($xml->name);
        $transaction->setCustomerId($xml->customer_id);
        $transaction->setCustomerEmail($xml->customer_email);
        $transaction->setAddress($xml->address);
        $transaction->setAmount($xml->amount);
        $transaction->setCardNumber($xml->cardNumber);
        $transaction->setCardType($xml->cardType);
        $transaction->setExpMonth($xml->expMonth);
        $transaction->setExpYear($xml->expYear);
        $transaction->setTransactionId($xml->transId);
        $transaction->setApprovalCode($xml->approvalCode);
        $transaction->setProcessed('0');
        $transaction->setOrderId(0);
        
        // save
        $transaction->save();
        
      }
      catch (Exception $e){
      	if($debug == 1){ Mage::log('CRE Exception: ' . $e->getMessage()); }
      }
    }

    /**
     *  This function is here but not used 
     */
    public function cancelAction()
    {
        $this->_redirect('checkout/cart');
    }

    /**
     *  This function is here but not used 
     */
    public function successAction()
    {
        $this->_redirect('checkout/onepage/success', array('_secure'=>true));
    }
    
    /**
     *  This function is here but not used
     */
    public function editAction()
    {
    	$this->_redirect('checkout/cart');
    }
}
