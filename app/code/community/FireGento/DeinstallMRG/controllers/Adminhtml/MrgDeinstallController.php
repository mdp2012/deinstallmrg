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

    public function deinstallPartlyAction()
    {
        $this->_deinstallPartly();
    }

    public function deinstallAllAction()
    {
        $this->_deinstallAllFiles();
        $this->_deinstallAllDatabaseChanges();
        $this->_forward('index');
    }

    protected function _deinstallPartly()
    {
        foreach ($this->getRequest()->getParams() as $param) {
            $files = Mage::helper('firegento_deinstallmrg')
                ->getFilesByName($param);
            $this->delTree($files);
        }

    }

    protected function _deinstallAllFiles()
    {
        $directoriesToDelete
            = Mage::helper('firegento_deinstallmrg')
            ->getFiles();

        foreach ($directoriesToDelete as $dir) {
            $this->delTree(
                Mage::getBaseDir() . DS . str_replace('/', DS, $dir)
            );
        }

        $this->_getSession()->addSuccess('Deleted all MRG files.');
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
        //TODO delete core_resource entries

        /* @var $installer Mage_Eav_Model_Entity_Setup */
        $installer = Mage::getModel(
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

        $this->_getSession()->addSuccess('Reverted database changes.');
    }

}