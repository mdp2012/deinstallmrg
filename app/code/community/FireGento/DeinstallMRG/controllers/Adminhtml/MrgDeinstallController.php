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
        $this->_deinstallAllFiles();
        $this->_deinstallAllDatabaseChanges();
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
            $force
            || $this->getRequest()->getParam('mage_local_wishlist_abstract')
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

    protected function _deinstallAllFiles()
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
            'app/etc/modules/Symmetrics_Config.xml',
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


    /**
     * Delete a directory or file recursive
     *
     * @param $dir
     */
    private function delTree($dir)
    {
        if (!file_exists($dir)) {
            // if the path is already missing we can skip it
            return;
        }

        if (is_file($dir)) {
            // if it is a file, we just delete it
            unlink($dir);
            return;
        }

        // if it is a directory, we loop through it an call this
        // method recursive
        foreach (new DirectoryIterator($dir) as $directory) {
            /* @var $directory DirectoryIterator */
            if (!$directory->isDot()) {
                $this->delTree($directory->getRealPath());
            }
        }

        // when we deleted all directory and files, we can
        // delete the directory itself
        rmdir($dir);
    }

    protected function _deinstallAllDatabaseChanges()
    {
        /* @var $installer Mage_Eav_Model_Entity_Setup */
        $installer = Mage::getResourceModel(
            'eav/entity_setup', 'core_setup'
        );

//app\code\community\Symmetrics\ConfigGerman\sql\config_german_setup\mysql4-install-0.1.0.php
//TODO — remove the wight attribute out of catalog_product?
//
//app\code\community\Symmetrics\ConfigGermanTexts\sql\config_german_texts_setup\mysql4-install-0.1.0.php
//TODO — $this->updateFooterLinksBlock($data); => Keine Ahnung was das ist, Andi fragen
//
//app\code\community\Symmetrics\DeliveryTime\sql\deliverytime_setup\mysql4-install-0.2.1.php
//TODO — remove delivery_time product attribute from catalog_product?
//
//    app\code\community\Symmetrics\Imprint\sql\imprint_setup\mysql4-install-0.2.0.php
// TODO — Changes a lot of configuration data – needs to be reviewed!
//
//    app\code\community\Symmetrics\PdfPrinter\sql\pdfprinter_setup\mysql4-install-0.1.0.php
// TODO — Remove Mage::getBaseDir('media') . DS . 'pdfprinter'
//
//app\code\community\Symmetrics\SecurePassword\sql\securepassword_setup\mysql4-install-0.1.0.php

        $installer->startSetup();
        $installer->removeAttribute('customer', 'failed_logins');
        $installer->removeAttribute('customer', 'last_failed_login');
        $installer->removeAttribute('customer', 'last_unlock_time');
        $installer->removeAttribute('customer', 'unlock_customer');


//app\code\community\Symmetrics\SetMeta\sql\setmeta_setup\mysql4-install-0.2.0.php
        $installer->removeAttribute('catalog_product', 'generate_meta');
        $installer->endSetup();


    }

}