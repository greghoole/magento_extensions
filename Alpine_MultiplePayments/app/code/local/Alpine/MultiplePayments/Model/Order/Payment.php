<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Sales
 * @copyright   Copyright (c) 2011 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Order payment information
 *
 * @method Mage_Sales_Model_Resource_Order_Payment _getResource()
 * @method Mage_Sales_Model_Resource_Order_Payment getResource()
 * @method int getParentId()
 * @method Mage_Sales_Model_Order_Payment setParentId(int $value)
 * @method float getBaseShippingCaptured()
 * @method Mage_Sales_Model_Order_Payment setBaseShippingCaptured(float $value)
 * @method float getShippingCaptured()
 * @method Mage_Sales_Model_Order_Payment setShippingCaptured(float $value)
 * @method float getAmountRefunded()
 * @method Mage_Sales_Model_Order_Payment setAmountRefunded(float $value)
 * @method float getBaseAmountPaid()
 * @method Mage_Sales_Model_Order_Payment setBaseAmountPaid(float $value)
 * @method float getAmountCanceled()
 * @method Mage_Sales_Model_Order_Payment setAmountCanceled(float $value)
 * @method float getBaseAmountAuthorized()
 * @method Mage_Sales_Model_Order_Payment setBaseAmountAuthorized(float $value)
 * @method float getBaseAmountPaidOnline()
 * @method Mage_Sales_Model_Order_Payment setBaseAmountPaidOnline(float $value)
 * @method float getBaseAmountRefundedOnline()
 * @method Mage_Sales_Model_Order_Payment setBaseAmountRefundedOnline(float $value)
 * @method float getBaseShippingAmount()
 * @method Mage_Sales_Model_Order_Payment setBaseShippingAmount(float $value)
 * @method float getShippingAmount()
 * @method Mage_Sales_Model_Order_Payment setShippingAmount(float $value)
 * @method float getAmountPaid()
 * @method Mage_Sales_Model_Order_Payment setAmountPaid(float $value)
 * @method float getAmountAuthorized()
 * @method Mage_Sales_Model_Order_Payment setAmountAuthorized(float $value)
 * @method float getBaseAmountOrdered()
 * @method Mage_Sales_Model_Order_Payment setBaseAmountOrdered(float $value)
 * @method float getBaseShippingRefunded()
 * @method Mage_Sales_Model_Order_Payment setBaseShippingRefunded(float $value)
 * @method float getShippingRefunded()
 * @method Mage_Sales_Model_Order_Payment setShippingRefunded(float $value)
 * @method float getBaseAmountRefunded()
 * @method Mage_Sales_Model_Order_Payment setBaseAmountRefunded(float $value)
 * @method float getAmountOrdered()
 * @method Mage_Sales_Model_Order_Payment setAmountOrdered(float $value)
 * @method float getBaseAmountCanceled()
 * @method Mage_Sales_Model_Order_Payment setBaseAmountCanceled(float $value)
 * @method int getIdealTransactionChecked()
 * @method Mage_Sales_Model_Order_Payment setIdealTransactionChecked(int $value)
 * @method int getQuotePaymentId()
 * @method Mage_Sales_Model_Order_Payment setQuotePaymentId(int $value)
 * @method string getAdditionalData()
 * @method Mage_Sales_Model_Order_Payment setAdditionalData(string $value)
 * @method string getCcExpMonth()
 * @method Mage_Sales_Model_Order_Payment setCcExpMonth(string $value)
 * @method string getCcSsStartYear()
 * @method Mage_Sales_Model_Order_Payment setCcSsStartYear(string $value)
 * @method string getEcheckBankName()
 * @method Mage_Sales_Model_Order_Payment setEcheckBankName(string $value)
 * @method string getMethod()
 * @method Mage_Sales_Model_Order_Payment setMethod(string $value)
 * @method string getCcDebugRequestBody()
 * @method Mage_Sales_Model_Order_Payment setCcDebugRequestBody(string $value)
 * @method string getCcSecureVerify()
 * @method Mage_Sales_Model_Order_Payment setCcSecureVerify(string $value)
 * @method string getCybersourceToken()
 * @method Mage_Sales_Model_Order_Payment setCybersourceToken(string $value)
 * @method string getIdealIssuerTitle()
 * @method Mage_Sales_Model_Order_Payment setIdealIssuerTitle(string $value)
 * @method string getProtectionEligibility()
 * @method Mage_Sales_Model_Order_Payment setProtectionEligibility(string $value)
 * @method string getCcApproval()
 * @method Mage_Sales_Model_Order_Payment setCcApproval(string $value)
 * @method string getCcLast4()
 * @method Mage_Sales_Model_Order_Payment setCcLast4(string $value)
 * @method string getCcStatusDescription()
 * @method Mage_Sales_Model_Order_Payment setCcStatusDescription(string $value)
 * @method string getEcheckType()
 * @method Mage_Sales_Model_Order_Payment setEcheckType(string $value)
 * @method string getPayboxQuestionNumber()
 * @method Mage_Sales_Model_Order_Payment setPayboxQuestionNumber(string $value)
 * @method string getCcDebugResponseSerialized()
 * @method Mage_Sales_Model_Order_Payment setCcDebugResponseSerialized(string $value)
 * @method string getCcSsStartMonth()
 * @method Mage_Sales_Model_Order_Payment setCcSsStartMonth(string $value)
 * @method string getEcheckAccountType()
 * @method Mage_Sales_Model_Order_Payment setEcheckAccountType(string $value)
 * @method string getLastTransId()
 * @method Mage_Sales_Model_Order_Payment setLastTransId(string $value)
 * @method string getCcCidStatus()
 * @method Mage_Sales_Model_Order_Payment setCcCidStatus(string $value)
 * @method string getCcOwner()
 * @method Mage_Sales_Model_Order_Payment setCcOwner(string $value)
 * @method string getCcType()
 * @method Mage_Sales_Model_Order_Payment setCcType(string $value)
 * @method string getIdealIssuerId()
 * @method Mage_Sales_Model_Order_Payment setIdealIssuerId(string $value)
 * @method string getPoNumber()
 * @method Mage_Sales_Model_Order_Payment setPoNumber(string $value)
 * @method string getCcExpYear()
 * @method Mage_Sales_Model_Order_Payment setCcExpYear(string $value)
 * @method string getCcStatus()
 * @method Mage_Sales_Model_Order_Payment setCcStatus(string $value)
 * @method string getEcheckRoutingNumber()
 * @method Mage_Sales_Model_Order_Payment setEcheckRoutingNumber(string $value)
 * @method string getAccountStatus()
 * @method Mage_Sales_Model_Order_Payment setAccountStatus(string $value)
 * @method string getAnetTransMethod()
 * @method Mage_Sales_Model_Order_Payment setAnetTransMethod(string $value)
 * @method string getCcDebugResponseBody()
 * @method Mage_Sales_Model_Order_Payment setCcDebugResponseBody(string $value)
 * @method string getCcSsIssue()
 * @method Mage_Sales_Model_Order_Payment setCcSsIssue(string $value)
 * @method string getEcheckAccountName()
 * @method Mage_Sales_Model_Order_Payment setEcheckAccountName(string $value)
 * @method string getCcAvsStatus()
 * @method Mage_Sales_Model_Order_Payment setCcAvsStatus(string $value)
 * @method string getCcNumberEnc()
 * @method Mage_Sales_Model_Order_Payment setCcNumberEnc(string $value)
 * @method string getCcTransId()
 * @method Mage_Sales_Model_Order_Payment setCcTransId(string $value)
 * @method string getFlo2cashAccountId()
 * @method Mage_Sales_Model_Order_Payment setFlo2cashAccountId(string $value)
 * @method string getPayboxRequestNumber()
 * @method Mage_Sales_Model_Order_Payment setPayboxRequestNumber(string $value)
 * @method string getAddressStatus()
 * @method Mage_Sales_Model_Order_Payment setAddressStatus(string $value)
 *
 * @category    Mage
 * @package     Mage_Sales
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Alpine_MultiplePayments_Model_Order_Payment extends Mage_Sales_Model_Order_Payment
{

    /**
     * Authorize payment either online or offline (process auth notification)
     * Updates transactions hierarchy, if required
     * Prevents transaction double processing
     * Updates payment totals, updates order status and adds proper comments
     *
     * @param bool $isOnline
     * @param float $amount
     * @return Mage_Sales_Model_Order_Payment
     */
    protected function _authorize($isOnline, $amount)
    {	
		$order = $this->getOrder();
		// adjust amount to exclude PO amount
	    if($order->getPayment()->getPoAmount() < $order->getTotalDue()){
	      $amount = $order->getTotalDue() - $order->getPayment()->getPoAmount();
        }
	
        // update totals
        $amount = $this->_formatAmount($amount, true);
        $this->setBaseAmountAuthorized($amount);

        // do authorization
        $order  = $this->getOrder();
        $state  = Mage_Sales_Model_Order::STATE_PROCESSING;
        $status = true;
        if ($isOnline) {
            // invoke authorization on gateway
            $this->getMethodInstance()->setStore($order->getStoreId())->authorize($this, $amount);
        } else {
            $message = Mage::helper('sales')->__(
                'Registered notification about authorized amount of %s.',
                $this->_formatPrice($amount)
            );
        }

        // similar logic of "payment review" order as in capturing
        if ($this->getIsTransactionPending()) {
            $message = Mage::helper('sales')->__('Authorizing amount of %s is pending approval on gateway.', $this->_formatPrice($amount));
            $state = Mage_Sales_Model_Order::STATE_PAYMENT_REVIEW;
            if ($this->getIsFraudDetected()) {
                $status = Mage_Sales_Model_Order::STATUS_FRAUD;
            }
        } else {
            $message = Mage::helper('sales')->__('Authorized amount of %s.', $this->_formatPrice($amount));
        }

        // update transactions, order state and add comments
        $transaction = $this->_addTransaction(Mage_Sales_Model_Order_Payment_Transaction::TYPE_AUTH);
        if ($order->isNominal()) {
            $message = $this->_prependMessage(Mage::helper('sales')->__('Nominal order registered.'));
        } else {
            $message = $this->_prependMessage($message);
            $message = $this->_appendTransactionToMessage($transaction, $message);
        }
        $order->setState($state, $status, $message);

        return $this;
    }

}
