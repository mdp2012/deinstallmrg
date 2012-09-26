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
 * @package   Symmetrics_TweaksGerman
 * @author    symmetrics gmbh <info@symmetrics.de>
 * @author    Eric Reiche <er@symmetrics.de>
 * @copyright 2011 symmetrics gmbh
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */

/**
 * Observer model.
 *
 * @category  Symmetrics
 * @package   Symmetrics_TweaksGerman
 * @author    symmetrics gmbh <info@symmetrics.de>
 * @author    Eric Reiche <er@symmetrics.de>
 * @copyright 2011 symmetrics gmbh
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.symmetrics.de/
 */
class Symmetrics_TweaksGerman_Model_Observer
{
    /**
     * @const CONFIGURATION_ORDER_IP
     */
    const CONFIGURATION_ORDER_IP = 'customer/privacy/order_ip';
    
    /**
     * Remove IP on checkout submit.
     *
     * @param Varien_Event_Observer $observer Observer object to get the order from.
     *
     * @return void
     */
    public function checkoutSubmit($observer)
    {
        if (!Mage::getStoreConfigFlag(self::CONFIGURATION_ORDER_IP)) {
            $observer->getOrder()->setRemoteIp('0');
        }
    }
}
