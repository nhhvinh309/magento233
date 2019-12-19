<?php
namespace Custom\Uiform\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Uiform extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('form_block','id');
    }
}

