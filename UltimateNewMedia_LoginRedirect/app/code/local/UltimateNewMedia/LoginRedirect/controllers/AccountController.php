<?php
/**
 * Customer account controller
 */
require_once 'Mage/Customer/controllers/AccountController.php';

class UltimateNewMedia_LoginRedirect_AccountController extends Mage_Customer_AccountController {

    /**
     * Default customer account page
     */
    public function preDispatch() 
    {
        parent::preDispatch();

        $_loginRedirect = Mage::getStoreConfig('unm/unm_group_2/active', Mage::app()->getStore());
        $_loginRedirectUrl = Mage::getStoreConfig('unm/unm_group_2/redirect_url', Mage::app()->getStore());
        if ($_loginRedirect) {
        	if ($this->_getSession()->isLoggedIn()) {
                $customer = Mage::getModel('customer/customer')->load(Mage::getSingleton('customer/session')->getCustomer()->getId());
                if (!$customer->getCompleteSfForm() && !empty($_loginRedirectUrl) && $_SERVER['REQUEST_URI'] != $_loginRedirectUrl) {
            		$this->_redirectUrl($_loginRedirectUrl);
                }
        	}
        }
    }

    public function captureAction()
    {
        if ($this->_getSession()->isLoggedIn()) {
            $this->loadLayout();
            $this->_initLayoutMessages('customer/session');
            $this->_initLayoutMessages('catalog/session');
            $this->getLayout()->getBlock('head')->setTitle($this->__('My Account'));
            $this->renderLayout();
        } else {
            $this->_redirectUrl('/');
        }
    }

    public function finalizeAction()
    {
        if ($this->_getSession()->isLoggedIn()) {
            $customer = Mage::getModel('customer/customer')->load(Mage::getSingleton('customer/session')->getCustomer()->getId());
            $customer->setCompleteSfForm(1);
            $customer->save();
            $this->_redirectUrl('/customer/account');
        } else {
            $this->_redirectUrl('/');
        }
    }
}