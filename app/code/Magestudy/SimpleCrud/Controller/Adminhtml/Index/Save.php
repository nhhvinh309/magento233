<?php

namespace Magestudy\SimpleCrud\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magestudy\SimpleCrud\Api\Data\ReviewInterface;
use Magestudy\SimpleCrud\Api\ReviewRepositoryInterface;
use Magestudy\SimpleCrud\Model\Review;
use Magestudy\SimpleCrud\Model\ReviewFactory;
use Throwable;

class Save extends Action
{
    const ADMIN_RESOURCE = 'VinhNguyen_helloworld_subscription::save';

    private $reviewRepository;

    private $reviewFactory;

    public function __construct(
        Action\Context $context,
        ReviewRepositoryInterface $reviewRepository,
        ReviewFactory $reviewFactory
    ) {
        parent::__construct($context);
        $this->reviewRepository = $reviewRepository;
        $this->reviewFactory = $reviewFactory;
    }

    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('subscription_id');
        $data = $this->getRequest()->getParams();

        if ($id) {
            $review = $this->reviewRepository->getById($id);
        } else {
            unset($data[ReviewInterface::KEY_ID]);
            $review = $this->reviewFactory->create();
        }

        unset($data[ReviewInterface::KEY_UPDATED_AT]);
        $review->setData($data);

        try {
            $this->reviewRepository->save($review);
            $this->messageManager->addSuccessMessage(__('Record saved successfully'));

            if (key_exists('back', $data) && $data['back'] == 'edit') {

                return $resultRedirect->setPath('*/*/edit', ['subscription_id' => $id, '_current' => true]);
            }

            return $resultRedirect->setPath('*/*/');
        } catch (Throwable $throwable) {
            $this->messageManager->addErrorMessage(__("Record not saved"));

            return $resultRedirect->setPath('*/*/edit', ['subscription_id' => $id]);
        }
    }
}