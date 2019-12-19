<?php
namespace VinhNguyen\HelloWorld\Observer;
use Magento\Framework\Event\ObserverInterface;
class Observer implements ObserverInterface
{
    /** @var \Psr\Log\LoggerInterface $logger */
    protected $logger;
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getProduct();
        $category = $observer->getCategory();
//        $this->logger->debug(var_dump($product->debug()));
//        $this->logger->debug(var_dump($category->debug()));
        $this->logger->debug('Registered');
    }
}