<?php
class FireGento_DeinstallMRG_Adminhtml_MrgDeinstallController
    extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        if ($this->getRequest()->getMethod() == 'post') {
            $methods = get_class_methods(get_class($this));
            foreach ($methods as $method) {
                if (strpos($method, 'uninstall') === 0) {
                    $this->$method();
                }
            }
        }


        $this->loadLayout();
        $formContainer = $this->getLayout()->createBlock(
            'firegento_deinstallmrg/mrgDeinstall_deinstall_form_container'
        );
        $this->getLayout()->getBlock('content')->append($formContainer);
        $this->renderLayout();
    }


    /**
     * check wether option is set and remove file
     */
    private function uninstallMageLocalWishlist()
    {
        if ($this->getRequest()->getParam('mage_local_wishlist_abstract')) {
            // TODO check path
            unlink(
                Mage::getBaseDir('code_dir') .
                'local/Mage/Wishlist/Block/Abstract.php'
            );
        }
    }

}