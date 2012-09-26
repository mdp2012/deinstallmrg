<?php
class FireGento_DeinstallMRG_Adminhtml_MrgDeinstallController
    extends Mage_Adminhtml_Controller_Action
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


    public function deinstallAllAction()
    {
        $this->removeModules(true);
    }

    public function deinstallPartlyAction()
    {
        $this->removeModules();
    }

    protected function removeModules($force = false)
    {
        if ($this->getRequest()->getMethod() == 'post') {
            $methods = get_class_methods(get_class($this));
            foreach ($methods as $method) {
                if (strpos($method, 'uninstall') === 0) {
                    $this->$method($force);
                }
            }
        }
    }

    /**
     * check wether option is set and remove file
     */
    private function uninstallMageLocalWishlist($force)
    {
        if (
            $this->getRequest()->getParam('mage_local_wishlist_abstract')
            || $force
        ) {
            // TODO check path
            unlink(
                Mage::getBaseDir('code') .
                '/local/Mage/Wishlist/Block/Abstract.php'
            );
        }
    }

}