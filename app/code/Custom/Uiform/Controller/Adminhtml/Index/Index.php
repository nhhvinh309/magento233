<?php
namespace Custom\Uiform\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
	private $resultPageFactory;
	public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Custom_Uiform::manage');
    }

    public function execute(){
    	$resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Custom_Uiform::uiform_manage'
        )->addBreadcrumb(
            __('Uiform'),
            __('Uiform')
        )->addBreadcrumb(
            __('Uiform'),
            __('Uiform')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Uiform'));
        return $resultPage;
    }
}