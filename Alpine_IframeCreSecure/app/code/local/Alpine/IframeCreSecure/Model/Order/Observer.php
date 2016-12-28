<?php
class Alpine_IframeCreSecure_Model_Order_Observer
{
    public function __contruct()
    {
    }

    public function update_order_payment($observer)
    {
      $debug = Mage::getStoreConfig('payment/iframecresecure/debug');

      // get order
      $invoice  = $observer->getEvent()->getInvoice();
      $order    = $observer->getEvent()->getOrder();
      $payment  = $order->getPayment();
      $customer = $order->getCustomer();
      $billing  = $order->getBillingAddress();
      $shipping = $order->getShippingAddress();

      if($payment->getMethod() == 'iframecresecure') {

        try {
      	
          $quoteId = ($_SESSION['creSessionId']) ? $_SESSION['creSessionId'] : null;
        
          // retrieve cresecure data
          $transaction = Mage::getModel('iframecresecure/iframe')->getTransaction($quoteId);

      	  if($debug){
      	    Mage::log(__METHOD__ . ' Execution Time: ' . time() . ' : '. date('m/d/Y h:i a'));
      	    Mage::log(__METHOD__ . ' Quote ID: ' . $quoteId);
      	    Mage::log(__METHOD__ . ' Cresecure ID: ' . $transaction->getCresecureId());
      	    Mage::log(__METHOD__ . ' Order ID: ' . $order->getIncrementId());
      	    Mage::log(__METHOD__ . ' Browser Used: ' . $_SERVER['HTTP_USER_AGENT']);
      	  }
      	
      	  // get order payment
          $payment = $order->getPayment(); 
        
          $payment->setCcLast4($transaction->getCardNumber());
          $payment->setCcType($transaction->getCardType());
          $payment->setCcExpMonth($transaction->getExpMonth());
          $payment->setCcExpYear($transaction->getExpYear());
          $payment->setCcTransId($transaction->getTransactionId());
          $payment->setCcApproval($transaction->getApprovalCode());
          $payment->save();
        
          // mark processed
          $transaction->setOrderId($order->getIncrementId());
          $transaction->setProcessed('1');
          $transaction->save();
        
          unset($_SESSION['creSessionId']);
        }
        catch (Exception $e){
          if($debug == 1){ Mage::log('Exception: ' . $e->getMessage()); }
        }
      }
      else {

        try {
          $request     = Mage::app()->getRequest();
          $transaction = Mage::getModel('iframecresecure/iframe');

          $additionalInformation = $payment->getAdditionalInformation('authorize_cards');
          $additionalInformation = array_pop($additionalInformation);
          // $params = Mage::getModel('sales/order_api')->info($order->getIncrementId());  // causing exception

          $transaction->setTransactionStart(time());
          $transaction->setTransactionEnd(time());
          $transaction->setSessionId(($order->getStoreId()+1) . sprintf('%08d', $order->getQuoteId()));
          $transaction->setName($billing->getFirstname() . ' ' . $billing->getLastname());
          $transaction->setCustomerId($customer->getId());
          $transaction->setCustomerEmail($customer->getEmailAddress());
          $transaction->setAddress(implode("\n", $billing->getStreet()));

          $transaction->setCreStatus('');  // dont have data
          $transaction->setAmount($order->getData('grand_total'));
          $transaction->setCardNumber($additionalInformation['cc_last4']);
          $transaction->setCardType($additionalInformation['cc_type']);

          $transaction->setExpMonth($additionalInformation['cc_exp_month']);
          $transaction->setExpYear($additionalInformation['cc_exp_year']);

          $transaction->setTransactionId('');  // dont have data
          $transaction->setApprovalCode('');  // dont have data
          $transaction->setProcessed('1');
          $transaction->setOrderId($order->getIncrementId());
          $transaction->save();
        }
        catch(Exception $e) {
          if($debug == 1){ Mage::log('Exception: ' . $e->getMessage()); }
        }
      }

      $this->_reassignOrderCustomer($order);
    }

    protected function _reassignOrderCustomer($order)
    {
	  $retailerId = $order->getCustomer()->getId();
	  $items = $order->getAllItems();
	  foreach($items as $itemId => $item){
	    if($item->getProductType() == 'jerseykitteam'){
	      $optionsArr = $item->getProductOptions();
	      foreach($optionsArr['options'] as $option){
	        if($option['label'] == 'Retailer'){
	          $retailerId = $option['value'];
	        }
	      }
	    }
	  }
	  
	  $customer = Mage::getModel('customer/customer')->load($retailerId);
	  $order->setCustomer($customer);
	  $order->save();
    }
}
?>
