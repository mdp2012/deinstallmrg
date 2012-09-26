<?php
class FireGento_DeinstallMRG_Adminhtml_MrgDeinstallController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $formContainer = $this->getLayout()->createBlock(
            'firegento_deinstallmrg/mrgDeinstall_deinstall_form_container'
        );
        $this->getLayout()->getBlock('content')->append($formContainer);
        $this->renderLayout();
    }
}