<?php

namespace Magestudy\SimpleCrud\Model;

use Magento\Framework\Model\AbstractModel;
use Magestudy\SimpleCrud\Api\Data\ReviewInterface;
use Magestudy\SimpleCrud\Model\ResourceModel\Review as ResourceModel;

class Review extends AbstractModel implements ReviewInterface
{
    protected $_eventPrefix = 'sc_review';
    protected $_eventObject = 'review';
    protected function _construct()
    {
        parent::_construct();
        $this->_init(ResourceModel::class);
    }

    public function getProductId()
    {
        return $this->getData(self::KEY_PRODUCT_ID);
    }
    public function getContent()
    {
        return $this->getData(self::KEY_CONTENT);
    }
    public function getStatus()
    {
        return $this->getData(self::KEY_STATUS);
    }
    public function getUpdatedAt()
    {
        return $this->getData(self::KEY_UPDATED_AT);
    }
    public function getCreatedAt()
    {
        return $this->getData(self::KEY_CREATED_AT);
    }
    public function setProductId($productId)
    {
        $this->setData(self::KEY_PRODUCT_ID, $productId);
    }
    public function setContent($content)
    {
        $this->setData(self::KEY_CONTENT, $content);
    }
    public function setStatus($status)
    {
        $this->setData(self::KEY_STATUS, $status);
    }


    public function getRating()
    {
        return $this->getData(self::KEY_RATING);
    }

    public function getAuthor()
    {
        return $this->getData(self::KEY_AUTHOR);
    }

    public function setRating($rating)
    {
        $this->setData(self::KEY_RATING, $rating);
    }
    function setAuthor($author)
    {
        $this->setData(self::KEY_AUTHOR, $author);
    }

    public function getId()
    {
        return $this->getData(self::KEY_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::KEY_ID, $id);
    }
}