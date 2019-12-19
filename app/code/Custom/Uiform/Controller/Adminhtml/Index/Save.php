<?php
namespace Custom\Uiform\Controller\Adminhtml\Index;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;
use Magento\Framework\Filesystem;

class Save extends \Magento\Backend\App\Action
{
    protected $cacheTypeList;
    protected $jsHelper;

    const ADMIN_RESOURCE = 'Custom_Uiform::save';
    protected $adapterFactory;
    protected $uploader;
    protected $filesystem;


    protected $_filesystem;
    protected $_storeManager;
    protected $_directory;
    protected $_imageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Backend\Helper\Js $jsHelper,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploader,        
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Image\AdapterFactory $imageFactory
    )
    {        
        $this->_storeManager = $storeManager;
        $this->_directory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_imageFactory = $imageFactory;
        $this->adapterFactory = $adapterFactory;
        $this->uploader = $uploader;
        $this->filesystem = $filesystem;
        $this->cacheTypeList = $cacheTypeList;
        parent::__construct($context);
        $this->jsHelper = $jsHelper;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            
            $model = $this->_objectManager->create('Custom\Uiform\Model\Uiform');

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
            $model->setTitle($data["title"]);
            $model->setStore(implode(',', $data["store"]));
            $model->setFile($data['file'][0]['name']);
            $model->setCategoryIds(implode(',', $data["category_ids"]));
            try {
                $model->save();
                $this->cacheTypeList->invalidate('full_page');
                $this->messageManager->addSuccess(__('You saved this Employee.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Attachment.'));
            }

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

}
