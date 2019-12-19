<?php
namespace VinhNguyen\HelloWorld\Controller\Adminhtml\Subscription;
class Save extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $subscriptionFactory;
    protected $subscription;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \VinhNguyen\HelloWorld\Model\SubscriptionFactory $subscriptionFactory,
        \VinhNguyen\HelloWorld\Model\Subscription $subscription
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->subscriptionFactory = $subscriptionFactory;
        $this->subscription = $subscription;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest()->getParams();
        $subscription = $this->subscriptionFactory->create();
        if (!empty($request['subscription_id'])) {
            $subscription->setid($request['subscription_id']);
        }
        try{
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $email = $request['email'];
            $status = $request['status'];
            $subscription->setfirstname($firstname);
            $subscription->setlastname($lastname);
            $subscription->setemail($email);
            $subscription->setstatus($status);
            $subscription->save();  
            $this->messageManager->addSuccessMessage(__('Record saved successfully'));
            $this->resultPageFactory->create();
            return $resultRedirect->setPath('helloworld/subscription/index');

        }catch (\Exception $e){
            $this->messageManager->addException($e, __('We can\'t submit your request, Please try again.'));
            $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
            return $resultRedirect->setPath('helloworld/subscription/error');
        }
    }
}
