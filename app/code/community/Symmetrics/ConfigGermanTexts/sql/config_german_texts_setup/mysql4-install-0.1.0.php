<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category  Symmetrics
 * @package   Symmetrics_ConfigGermanTexts
 * @author    symmetrics gmbh <info@symmetrics.de>
 * @author    Eric Reiche <er@symmetrics.de>
 * @author    Eugen Gitin <eg@symmetrics.de>
 * @author    Sergej Braznikov <sb@symmetrics.de>
 * @copyright 2010 symmetrics gmbh
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */

$installer = $this;
$installer->startSetup();

// execute pages
foreach ($this->getConfigPages() as $name => $data) {
    if ($data['execute'] == 1) {
        if ($name == 'symmetrics_mrgbeispiel') {
            // create inactive CMS page
            $this->createCmsPage($data, '0');
        } else {
            $this->createCmsPage($data);
        }
    }
}

// execute blocks
foreach ($this->getConfigBlocks() as $name => $data) {
    if ($data['execute'] == 1) {
        if ($name == 'mrg_footerlinks') {
            $this->updateFooterLinksBlock($data);
        } else {
            $this->createCmsBlock($data, true);
        }
    }
}

// execute emails
foreach ($this->getConfigEmails() as $name => $data) {
    if ($data['execute'] == 1) {
        $this->createEmail($data);
    }
}

// set some misc data
$installer->setConfigData('sales_pdf/invoice/put_order_id', '1');
$installer->setConfigData('sales_pdf/shipment/put_order_id', '1');
$installer->setConfigData('sales_pdf/creditmemo/put_order_id', '1');
$installer->setConfigData('sales/identity/logo', 'default/logo.jpg');
$installer->setConfigData('tax/display/shippingurl', 'lieferung');