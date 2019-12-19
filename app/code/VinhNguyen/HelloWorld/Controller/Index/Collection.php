<?php
namespace VinhNguyen\HelloWorld\Controller\Index;
class Collection extends
    \Magento\Framework\App\Action\Action {
    public function execute()
    {
        $productCollection = $this->_objectManager
            ->create('Magento\Catalog\Model\ResourceModel\Product\Collection')
            ->addAttributeToSelect([
                'name',
                'price', 'image',
            ])
            ->setPageSize(10, 1);
        $output = '';
        foreach ($productCollection as $product) {
            $output .= var_dump($product->debug(), null,
                false);
        }
        $this->getResponse()->setBody($output);
    }
}