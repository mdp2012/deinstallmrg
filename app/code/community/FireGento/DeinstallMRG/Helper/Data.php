<?php
class FireGento_DeinstallMRG_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $_directories
        = array(
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
            'mage_local_product_abstract'  => 'app/code/local/Mage/Catalog/Block/Product/Abstract.php',
            'mage_local_wishlist_abstract' => 'app/code/local/Mage/Wishlist/Block/Abstract.php',
            'app/code/local/Symmetrics/DomPdf',
            'app/design/adminhtml/default/default/template/symmetrics/imprint',
            'app/design/adminhtml/default/default/template/symmetrics/invoice',
            'app/design/adminhtml/default/default/template/tweaksgerman',
            'app/design/frontend/default/default/lay    out/securepassword.xml',
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


    public function getFiles()
    {
        $filesAndDirectories = array();
        foreach ($this->_directories as $entry) {
            if (is_array($entry)) {
                $filesAndDirectories = array_merge(
                    $filesAndDirectories, $entry
                );
            } else {
                $filesAndDirectories[] = $entry;
            }
        }

        return $filesAndDirectories;
    }

    public function getFilesByName($name)
    {
        if (array_key_exists($name, $this->_directories)) {
            if (is_array($this->_directories[$name])) {
                return $this->_directories[$name];
            } else {
                return ($this->_directories[$name]);
            }
        }
    }
}