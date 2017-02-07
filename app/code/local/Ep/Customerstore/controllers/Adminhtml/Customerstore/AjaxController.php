<?php

class Ep_Customerstore_Adminhtml_Customerstore_AjaxController extends Mage_Adminhtml_Controller_action {
	public function getAction() {
		$id     = $this->getRequest()->getParam('id');
		$customer  = Mage::getModel('customer/customer')->load($id);
		if($customer) {
			$storeId = $customer->getData('store_id');
		} else {
			$storeId = 0;
		}

		$responseArray = array('store_id' => $storeId);

		$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($responseArray));
	}
}
