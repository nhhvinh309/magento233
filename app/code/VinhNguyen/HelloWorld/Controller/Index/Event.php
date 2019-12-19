<?php

namespace VinhNguyen\HelloWorld\Controller\Index;

class Event extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    public function execute() {
        $resultPage = $this->resultPageFactory->create();

        $parameters = [
                'product' => $this->_objectManager->create('Magento\Catalog\Model\Product')->load(11),
                'category' => $this->_objectManager->create('Magento\Catalog\Model\Product')->load(11),
        ];

        $this->_eventManager->dispatch('helloworld_register_visit',$parameters);

        return $resultPage;
    }
}