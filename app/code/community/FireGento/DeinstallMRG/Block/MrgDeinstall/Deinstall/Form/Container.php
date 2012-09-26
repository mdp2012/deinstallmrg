<?php
class FireGento_DeinstallMRG_Block_MrgDeinstall_Deinstall_Form_Container
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_controller = 'mrgDeinstall';
        $this->_mode = 'deinstall';
        $this->_blockGroup = 'firegento_deinstallmrg';
        $this->_headerText = Mage::helper('firegento_deinstallmrg')
        ->__('MRG Deinstaller');

        parent::__construct();

        $this->removeButton('back');
        $this->removeButton('reset');
        $this->removeButton('save');

        $this->addButton(
            'deinstallAll', array(
                'label' => Mage::helper('firegento_deinstallmrg')
                ->__('Deinstall All (Recommended!)'),
                'class' => 'deinstallPartly, delete',
                'onclick' => 'deleteConfirm(\'' . Mage::helper('adminhtml')
                ->__('Are you sure you want to uninstall all MRG changes?')
                . '\', \'' . $this->getUrl('*/*/deinstallAll') . '\')',
            )
        );

        $this->_addButton(
            'deinstallPartly', array(
                'label' => Mage::helper('adminhtml')->__(
                    'Deinstall Partly (Experimental)'
                ),
                'class' => 'deinstallPartly, save',
                'onclick' => 'deleteConfirm(\'' . Mage::helper('adminhtml')
                ->__(
                    'Are you sure you want to uninstall only a few MRG changes?'
                )
                . '\', \'' . $this->getUrl('*/*/deinstallPartly') . '\')',
            )
        );
    }
}