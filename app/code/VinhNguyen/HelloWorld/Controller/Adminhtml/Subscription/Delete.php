<?php
namespace VinhNguyen\HelloWorld\Controller\Adminhtml\Subscription;

class Delete extends \Magento\Framework\App\Action\Action
{
    protected $connection;
    protected $resource;
    protected $resultRedirect;
    protected $messageManager;
    public function __construct(
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager
    )
    {
        $this->connection = $resource->getConnection();
        $this->resource = $resource;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }
    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest()->getParams();
        $delete_id= $request['id'];
        $table = $this->resource->getTableName('VinhNguyen_helloworld_subscription');
        $sql = "DELETE FROM $table WHERE subscription_id=$delete_id";
        $this->connection->query($sql);
        $this->messageManager->addSuccessMessage( __('Record deleted Successfully !'));
        return $resultRedirect->setPath('helloworld/subscription/index');
    }
}
