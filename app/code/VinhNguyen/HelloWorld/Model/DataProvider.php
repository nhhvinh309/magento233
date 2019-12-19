<?php
namespace VinhNguyen\HelloWorld\Model;

use VinhNguyen\HelloWorld\Model\ResourceModel\Subscription\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $employeeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $employee) {
            $this->_loadedData[$employee->getId("customer_details")] = $employee->getData();
        }
//        $this->_loadedData[''];
        return $this->_loadedData;
    }
}