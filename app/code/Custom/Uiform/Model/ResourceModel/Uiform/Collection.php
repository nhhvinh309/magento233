<?php
namespace Custom\Uiform\Model\ResourceModel\Uiform;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
    protected function _construct()
    {
        $this->_init('Custom\Uiform\Model\Uiform','Custom\Uiform\Model\ResourceModel\Uiform');
    }
}