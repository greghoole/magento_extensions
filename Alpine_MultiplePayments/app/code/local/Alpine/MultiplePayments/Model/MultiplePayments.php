<?php
class Alpine_MultiplePayments_Model_MultiplePayments extends Mage_Paygate_Model_Authorizenet
{
	protected $_code = 'multiplepayments';
	protected $_formBlockType = 'multiplepayments/form_multiplepayments';
	protected $_infoBlockType = 'multiplepayments/info_multiplepayments';

    /**
     * this should probably be true if you're using this
     * method to take payments
     */
    protected $_isGateway               = true;

    /**
     * can this method authorize?
     */
    protected $_canAuthorize            = true;

    /**
     * can this method capture funds?
     */
    protected $_canCapture              = true;

    /**
     * can we capture only partial amounts?
     */
    protected $_canCapturePartial       = false;

    /**
     * can this method refund?
     */
    protected $_canRefund               = false;

    /**
     * can this method void transactions?
     */
    protected $_canVoid                 = true;

    /**
     * can admins use this payment method?
     */
    protected $_canUseInternal          = true;

    /**
     * show this method on the checkout page
     */
    protected $_canUseCheckout          = true;

    /**
     * available for multi shipping checkouts?
     */
    protected $_canUseForMultishipping  = true;

    /**
     * can this method save cc info for later use?
     */
    protected $_canSaveCc = false;

    /**
     * Set block template
     */
    protected function _construct()
    {
        parent::_construct();
    }
	
	public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }
        $info = $this->getInfoInstance();
        $info->setPoNumber($data->getPoNumber())
		     ->setPoAmount($data->getPoAmount())
		     ->setCcType($data->getCcType())
             ->setCcOwner($data->getCcOwner())
             ->setCcLast4(substr($data->getCcNumber(), -4))
             ->setCcNumber($data->getCcNumber())
             ->setCcCid($data->getCcCid())
             ->setCcExpMonth($data->getCcExpMonth())
             ->setCcExpYear($data->getCcExpYear())
             ->setCcSsIssue($data->getCcSsIssue())
             ->setCcSsStartMonth($data->getCcSsStartMonth())
             ->setCcSsStartYear($data->getCcSsStartYear())
            ;
        return $this;
    }

	public function validate()
	{
		$info = $this->getInfoInstance();
		
		$orderTotal = Mage::getSingleton('checkout/cart')->getQuote()->collectTotals()->getGrandTotal();
		
		if($info->getPoAmount() < $orderTotal){
		  parent::validate();  // trigger CC validation
        }

		$no = $info->getPoNumber();
		$amount = $info->getPoAmount();
		if(empty($no) || empty($amount)){
			$errorCode = 'invalid_data';
			$errorMsg = $this->_getHelper()->__('Purchase Order Number and Purchase Order Amount are required fields');
		}

		if($errorMsg){
			Mage::throwException($errorMsg);
		}

		return $this;
	}
	
    /**
     * this method is called if we are just authorizing
     * a transaction
     */
    public function authorize (Varien_Object $payment, $amount)
    {
	    $info = $this->getInfoInstance();
	    $orderTotal = Mage::getSingleton('checkout/cart')->getQuote()->collectTotals()->getGrandTotal();
	    if($info->getPoAmount() < $orderTotal){
	      $amount = $orderTotal - $info->getPoAmount();
          parent::authorize($payment, $amount);
        }
    }

    /**
     * this method is called if we are authorizing AND
     * capturing a transaction
     */
    public function capture (Varien_Object $payment, $amount)
    {
	    $info = $this->getInfoInstance();
	    $orderTotal = Mage::getSingleton('checkout/cart')->getQuote()->collectTotals()->getGrandTotal();
	    if($info->getPoAmount() < $orderTotal){
	      $amount = $orderTotal - $info->getPoAmount();
          parent::capture($payment, $amount);
        }
    }

    /**
     * called if refunding
     */
    public function refund (Varien_Object $payment, $amount)
    {
      
    }

    /**
     * called if voiding a payment
     */
    public function void (Varien_Object $payment)
    {

    }
}
?>
