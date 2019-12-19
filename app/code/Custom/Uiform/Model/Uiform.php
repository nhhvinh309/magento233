<?php
namespace Custom\Uiform\Model;
class Uiform extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Custom\Uiform\Model\ResourceModel\Uiform');
    }
}

