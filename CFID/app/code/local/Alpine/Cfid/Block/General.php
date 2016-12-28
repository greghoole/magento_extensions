<?php

class Alpine_Cfid_Block_General extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{
    protected $_fieldRenderer;
    protected $_values;

    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $html = $this->_getHeaderHtml($element);

        $currentVer = Mage::getConfig()->getModuleConfig('Alpine_Cfid')->version;
		$html .= $element->addField('Alpine_Cfid', 'label', array(
            'name'  => 'module_version',
            'label' => 'Crossfit ID Module',
            'value' => $currentVer,
          ))->setRenderer($this->_getFieldRenderer())->toHtml();

        $html .= $this->_getFooterHtml($element);

        return $html;
    }

    protected function _getFieldRenderer()
    {
        if (empty($this->_fieldRenderer)) {
            $this->_fieldRenderer = Mage::getBlockSingleton('adminhtml/system_config_form_field');
        }
        return $this->_fieldRenderer;
    }
}