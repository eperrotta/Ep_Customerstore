<?php

class Ep_Customerstore_Block_Adminhtml_Sales_Order_Create_Customer_Grid extends Mage_Adminhtml_Block_Sales_Order_Create_Customer_Grid {

	public function getAdditionalJavaScript() {
		$js = '
        AdminOrder.prototype.setCustomerAfter = function () {
        this.customerSelectorHide();

        if (this.storeId) {
            $(this.getAreaId(\'data\')).callback = \'dataLoaded\';
            this.loadArea([\'data\'], true);
        }
        else {
            this.storeSelectorShow();

            /* Here starts our custom code.
             The selected customer id stored in the variable this.customerId
             So, starting from the customer Id you can perform an Ajax call which resolve its 
             registration store. Let\'s assume is "2"
            */
            
           new Ajax.Request(\''. Mage::helper("adminhtml")->getUrl("adminhtml/customerstore_ajax/get") .'\',{
			method:\'POST\',
			parameters: {id: this.customerId},
			requestHeaders: {Accept: \'application/json\'},
			onSuccess:function(transport){
				var response = transport.responseText.evalJSON(true);
				
				console.log(response);
				/* 
            	Now via prototype we can modify the look of the store label by adding our custom content
            	*/
            	$$(\'label[for="store_\'+ response["store_id"] + \'"]\').each(function(el) {
            	    el.insert(\' <strong>Customer registered here</strong>\');
            	});
			}.bind(this)
			});
        }

    };';
		return $js;
	}
}