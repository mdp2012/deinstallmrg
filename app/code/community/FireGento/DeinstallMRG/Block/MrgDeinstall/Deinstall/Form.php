<?php
class FireGento_DeinstallMRG_Block_MrgDeinstall_Deinstall_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        parent::_prepareForm();
        $form = new Varien_Data_Form(
            array(
                'id' => 'deinstall_form',
                'action' => $this->getUrl(
                    '*/*/deinstall',
                    array('id' => $this->getRequest()->getParam('id'))
                ),
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_mage_local',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Mage app/local changes')
            )
        );

        $fieldset->addField(
            'mage_local_note', 'note', array(
                'label' => 'Information',
                'text' => Mage::helper('firegento_deinstallmrg')
                ->__(
                    'Added Taxes, ' .
                    'we don\'t remove the CMS blocks!
                    <br />
                    Enabled Agreements'
                )
            )
        );

        $fieldset->addField(
            'mage_local_product_abstract', 'checkbox', array(
                'label' => Mage::helper('firegento_deinstallmrg')
                ->__('Delete local/Mage/Catalog/Block/Product/Abstract.php')
            )
        );

        $fieldset->addField(
            'mage_local_wishlist_abstract', 'checkbox', array(
                'label' => Mage::helper('firegento_deinstallmrg')
                ->__('Delete local/Mage/Wishlist/Block/Abstract.php')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_agreement',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics Agreement')
            )
        );

        $fieldset->addField(
            'symmetrics_agreement_note', 'note', array(
                'label' => 'Information',
                'text' => Mage::helper('firegento_deinstallmrg')
                ->__(
                    'Added general terms and right of revocation, ' .
                    'we don\'t remove the CMS blocks!
                    <br />
                    Enabled Agreements'
                )
            )
        );

        $fieldset->addField(
            'symmetrics_agreement_remove', 'checkbox', array(
                'label' => Mage::helper('firegento_deinstallmrg')
                ->__('Remove module files')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_configGerman',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics ConfigGerman')
            )
        );

        $fieldset->addField(
            'symmetrics_configGerman_note', 'note', array(
                'label' => 'Information',
                'text' => Mage::helper('firegento_deinstallmrg')
                ->__(
                    'Removed all taxes and added german taxes, ' .
                    '<br />' .
                    'changed locale, timezone, currency, time format, ... ' .
                    '<br />' .
                    'Changed the tax calculation, tax applyiance' .
                    '<br />' .
                    'disabled a lot of shipping methods'
                )
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_configGermanTexts',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics ConfigGermanTexts')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_deliveryTime',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics DeliveryTime')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_imprint',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics Imprint')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_invoice',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics Invoice')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_invoicePdf',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics InvoicePdf')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_pdfPrinter',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics PdfPrinter')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_securePassword',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics SecurePassword')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_setMeta',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics SetMeta')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_stockIndicator',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics StockIndicator')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_tweaksGerman',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics TweaksGerman')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_symmetrics_dompdf',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('Symmetrics DomPDF')
            )
        );

        $fieldset = $form->addFieldset(
            'deinstallmrg_firegento',
            array(
                'legend' => Mage::helper('firegento_deinstallmrg')
                ->__('FireGento DeinstallMRG')
            )
        );

        $fieldset->addField(
            'remove_firegento_deinstallmrg', 'checkbox', array(
                'label' => Mage::helper('firegento_deinstallmrg')
                ->__('Remove FireGento DeinstallMRG afterwards')
            )
        );

        $this->setForm($form);

        return $this;
    }


}