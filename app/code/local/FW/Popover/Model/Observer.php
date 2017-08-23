<?php

class FW_Popover_Model_Observer
{
	/**
	 * Checks (on each page load) if Popover is enabled for store
	 * Will eventually check other user properties such as logged in/logged out
	 * @param $observer
	 */
	public function checkUser($observer)
	{
		$storeId = Mage::app()->getStore()->getId();
		$isEnabled = Mage::helper('popover')->isBrowserNotificationEnabled($storeId);

		if ($isEnabled) {
			$this->generatePopoverJs($observer);

			//TODO: Later stage logged in check (!Mage::getSingleton('customer/session')->isLoggedIn())
		}
	}

	/**
	 * Creates a block with dynamic popover JS and HTML
	 * Appends block to end of page (before_body_end)
	 * @param $observer
	 */
	public function generatePopoverJs($observer)
	{
		$controller = $observer->getAction();
		$layout = $controller->getLayout();
		if ($layout) {
			$block = $layout->createBlock('core/template');
			if ($block) {
				$block->setTemplate('fw/popover/browsernotification.phtml');
				$bblock = $layout->getBlock('before_body_end');
				if ($bblock) {
					$bblock->append($block);
				}
			}
		}
	}
}