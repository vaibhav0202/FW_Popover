<?php

class FW_Popover_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function isBrowserNotificationEnabled($store = null)
    {
        return Mage::getStoreConfig('popover_settings/browser_notification/active', $store);
    }

    public function getBrowserVersionConfig($store = null)
    {
        $browsers = array('internet_explorer', 'firefox', 'chrome', 'safari', 'opera');
        $ret = array();
        foreach ($browsers as $browser) {
            $ret[$browser] = Mage::getStoreConfig('popover_settings/browser_notification/' . $browser, $store);
        }

        return $ret;
    }
}

