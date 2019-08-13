<?php
class Artifex_Productblock_Model_Observer
{
	static protected $_singletonFlag = false;	
	public function saveProductTabData(Varien_Event_Observer $observer)
	{
		if (!self::$_singletonFlag) {
			self::$_singletonFlag = true;
			$product = $observer->getEvent()->getProduct();
			try {
				$customFieldValue = $this->_getRequest()->getPost('custom_list');
				if($customFieldValue == null)
				return;
				$block = Mage::getModel('cms/block')->load($customFieldValue);
				$blockname = $block->getTitle();
				
				$product1 = Mage::registry('product')->getId();
				
				$read = Mage::getSingleton('core/resource')->getConnection('core_read'); 
				$write = Mage::getSingleton('core/resource')->getConnection('core_write');
				
				$results = $read->fetchAll("select product_id from artifex_productblock_cblock where product_id = '$product1'");
				
				if($results[0]['product_id'] == $product1)
				{
					$write->update(
							"artifex_productblock_cblock",
							array("product_id" => $product1, "custom_block_id" => $customFieldValue,"custom_block_name" => $blockname),
							"product_id=$product1"
					);
				}else
				{
					$write->insert(
						"artifex_productblock_cblock", 
						array("product_id" => $product1, "custom_block_id" => $customFieldValue,"custom_block_name" => $blockname)
					);
					
				}
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
	}
	/**
	 * Retrieve the product model
	 *
	 * @return Mage_Catalog_Model_Product $product
	 */
	public function getProduct()
	{
		return Mage::registry('product');
	}
    /**
     * Shortcut to getRequest
     *
     */
    protected function _getRequest()
    {
        return Mage::app()->getRequest();
    }
}