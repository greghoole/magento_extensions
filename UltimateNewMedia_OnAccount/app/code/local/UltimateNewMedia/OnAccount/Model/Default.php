<?php
/**
 * Simple model to control visibility of the payment method
 * 
 * We are only setting our payment code and the visibility of 
 * the payment method by overridding some parent class values
 * 
 * @author Gregory Hoole <greg@ultimatenewmedia.com>
 */

class UltimateNewMedia_OnAccount_Model_Default extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'onaccount'; // INTERNAL PAYMENT METHOD CODE
	protected $_isInitializeNeeded      = TRUE;
	protected $_canUseInternal          = TRUE; // CAN BE USED IN ADMIN
	protected $_canUseCheckout          = FALSE; // CAN BE USED BY CUSTOMER CHECKOUT
	protected $_canUseForMultishipping  = FALSE; // CAN BE USED IN MULTIADDRESS CHECKOUT
}