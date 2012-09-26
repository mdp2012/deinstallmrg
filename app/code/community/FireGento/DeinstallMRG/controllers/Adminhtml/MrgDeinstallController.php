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
        $this->_deinstallAll();
        $this->_forward('index');
    }

    public function deinstallPartlyAction()
    {
        $this->_removeModules();
        $this->_forward('index');
    }

    protected function _removeModules($force = false)
    {
        if ($this->getRequest()->getMethod() == 'post') {
            $methods = get_class_methods(get_class($this));
            foreach ($methods as $method) {
                if (strpos($method, '_uninstall') === 0) {
                    $this->$method($force);
                }
            }
        }
    }

    /**
     * check wether option is set and remove file
     */
    protected function _uninstallMageLocalWishlist($force)
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

    protected function _uninstallMageLocalProductView($force)
    {
        // TODO check wether this should be done
        if (true) {
            unlink(
                Mage::getBaseDir('code') .
                '/local/Mage/Catalog/Block/Product/Abstract.php'
            );
        }
    }

    protected function _deinstallAll()
    {
        $directoriesToDelete = array(
            'app/code/community/Symmetrics/Agreement',
            'app/code/community/Symmetrics/ConfigGerman',
            'app/code/community/Symmetrics/ConfigGermanTexts',
            'app/code/community/Symmetrics/DeliveryTime',
            'app/code/community/Symmetrics/Imprint',
            'app/code/community/Symmetrics/Invoice',
            'app/code/community/Symmetrics/InvoicePdf',
            'app/code/community/Symmetrics/PdfPrinter',
            'app/code/community/Symmetrics/SecurePassword',
            'app/code/community/Symmetrics/SetMeta',
            'app/code/community/Symmetrics/StockIndicator',
            'app/code/community/Symmetrics/TweaksGerman',
            'app/code/local/Mage/Catalog/Block/Product/Abstract.php',
            'app/code/local/Mage/Wishlist/Block/Abstract.php',
            'app/code/local/Symmetrics/DomPdf',
            'app/design/adminhtml/default/default/template/symmetrics/imprint',
            'app/design/adminhtml/default/default/template/symmetrics/invoice',
            'app/design/adminhtml/default/default/template/tweaksgerman',
            'app/design/frontend/default/default/layout/securepassword.xml',
            'app/design/frontend/default/default/layout/stockindicator.xml',
            'app/design/frontend/default/default/layout/tweaksgerman.xml',
            'app/design/frontend/default/default/template/mrg',
            'app/design/frontend/default/default/template/pdfprinter',
            'app/design/frontend/default/default/template/stockindicator',
            'app/design/frontend/default/default/template/symmetrics/imprint',
            'app/design/frontend/default/default/template/symmetrics/invoice',
            'app/design/frontend/default/default/template/tweaksgerman',
            'app/etc/modules/Symmetrics_Agreement.xml',
            'app/etc/modules/Symmetrics_ConfigGerman.xml',
            'app/etc/modules/Symmetrics_ConfigGermanTexts.xml',
            'app/etc/modules/Symmetrics_DeliveryTime.xml',
            'app/etc/modules/Symmetrics_Imprint.xml',
            'app/etc/modules/Symmetrics_Invoice.xml',
            'app/etc/modules/Symmetrics_InvoicePdf.xml',
            'app/etc/modules/Symmetrics_PdfPrinter.xml',
            'app/etc/modules/Symmetrics_SecurePassword.xml',
            'app/etc/modules/Symmetrics_SetMeta.xml',
            'app/etc/modules/Symmetrics_StockIndicator.xml',
            'app/etc/modules/Symmetrics_TweaksGerman.xml',
            'app/locale/de_de/template/config_german_texts',
            'js/symmetrics/stockindicator',
            'js/symmetrics/tweaksgerman',
            'lib/Symmetrics/dompdf/',
            'skin/adminhtml/default/default/images/symmetrics/aws',
            'skin/adminhtml/default/default/images/symmetrics/awsprovider.png',
            'skin/adminhtml/default/default/images/symmetrics/bottomhr.png',
            'skin/adminhtml/default/default/images/symmetrics/boxbg.png',
            'skin/adminhtml/default/default/images/symmetrics/cashticketlogo.png',
            'skin/adminhtml/default/default/images/symmetrics/econdalogo.png',
            'skin/adminhtml/default/default/images/symmetrics/enterprisepartner.png',
            'skin/adminhtml/default/default/images/symmetrics/factfinderlogo.png',
            'skin/adminhtml/default/default/images/symmetrics/founders-award.png',
            'skin/adminhtml/default/default/images/symmetrics/mrg_logo.png',
            'skin/adminhtml/default/default/images/symmetrics/payonelogo.png',
            'skin/adminhtml/default/default/images/symmetrics/symmetrics_logo.png',
            'skin/adminhtml/default/default/images/symmetrics/tophr.png',
            'skin/adminhtml/default/default/images/symmetrics/trustedshops_logo.png',
            'skin/adminhtml/default/default/images/symmetrics/ts_logo.png',
            'skin/frontend/default/default/css/stock_indicator.css',
            'skin/frontend/default/default/images/stockindicator',
        );

        foreach ($directoriesToDelete as $dir) {
            $this->delTree(
                Mage::getBaseDir() . DS . str_replace('/', DS, $dir)
            );
        }
    }


    private function delTree($dir)
    {
        if (is_file($dir)) {
            unlink($dir);
            return;
        }

        foreach (new DirectoryIterator($dir) as $directory) {
            /* @var $directory DirectoryIterator */
            if (!$directory->isDot()) {
                $this->delTree($directory->getRealPath());
            }
        }

        rmdir($dir);
    }

}