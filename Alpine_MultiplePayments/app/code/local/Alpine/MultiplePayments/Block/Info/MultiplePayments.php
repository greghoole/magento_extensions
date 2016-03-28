<?php
class Alpine_MultiplePayments_Block_Info_MultiplePayments extends Mage_Payment_Block_Info
{	
	/**
     * Retrieve credit card type name
     *
     * @return string
     */
    public function getCcTypeName()
    {
        $types = Mage::getSingleton('payment/config')->getCcTypes();
        $ccType = $this->getInfo()->getCcType();
        if (isset($types[$ccType])) {
            return $types[$ccType];
        }
        return (empty($ccType)) ? Mage::helper('payment')->__('N/A') : $ccType;
    }

    /**
     * Retrieve CC expiration month
     *
     * @return string
     */
    public function getCcExpMonth()
    {
        $month = $this->getInfo()->getCcExpMonth();
        if ($month<10) {
            $month = '0'.$month;
        }
        return $month;
    }

    /**
     * Retrieve CC expiration date
     *
     * @return Zend_Date
     */
    public function getCcExpDate()
    {
        $date = Mage::app()->getLocale()->date(0);
        $date->setYear($this->getInfo()->getCcExpYear());
        $date->setMonth($this->getInfo()->getCcExpMonth());
        return $date;
    }

    /**
     * Prepare po and credit card related payment info
     *
     * @param Varien_Object|array $transport
     * @return Varien_Object
     */
	protected function _prepareSpecificInformation($transport = null)
	{
		if (null !== $this->_paymentSpecificInformation) {
			return $this->_paymentSpecificInformation;
		}
		$transport = new Varien_Object();
		$transport = parent::_prepareSpecificInformation($transport);
		$transport->addData(array(
			Mage::helper('payment')->__('Purchase Order Number') => $this->getInfo()->getPoNumber(),
			Mage::helper('payment')->__('Purchase Order Amount') => '$' . number_format($this->getInfo()->getPoAmount(),2)
		));

        $data = array();

    	$orderTotal = Mage::getSingleton('checkout/cart')->getQuote()->collectTotals()->getGrandTotal();
	
	    if($this->getInfo()->getPoAmount() < $orderTotal){
          if ($ccType = $this->getCcTypeName()) {
              $data[Mage::helper('payment')->__('Credit Card Type')] = $ccType;
          }
          if ($this->getInfo()->getCcLast4()) {
              $data[Mage::helper('payment')->__('Credit Card Number')] = sprintf('xxxx-%s', $this->getInfo()->getCcLast4());
          }
          if (!$this->getIsSecureMode()) {
              if ($ccSsIssue = $this->getInfo()->getCcSsIssue()) {
                  $data[Mage::helper('payment')->__('Switch/Solo/Maestro Issue Number')] = $ccSsIssue;
              }
              $year = $this->getInfo()->getCcSsStartYear();
              $month = $this->getInfo()->getCcSsStartMonth();
              if ($year && $month) {
                  $data[Mage::helper('payment')->__('Switch/Solo/Maestro Start Date')] =  $this->_formatCardDate($year, $month);
              }
          }
          $data[Mage::helper('payment')->__('Credit Card Amount')] = '$' . number_format($orderTotal - $this->getInfo()->getPoAmount(),2);
        }
        $transport->setData(array_merge($transport->getData(), $data));

        return $transport;
	}
	
	/**
     * Format year/month on the credit card
     *
     * @param string $year
     * @param string $month
     * @return string
     */
    protected function _formatCardDate($year, $month)
    {
        return sprintf('%s/%s', sprintf('%02d', $month), $year);
    }
}