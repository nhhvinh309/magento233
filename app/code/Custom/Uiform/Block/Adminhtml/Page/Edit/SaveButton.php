<?php
namespace Custom\Uiform\Block\Adminhtml\Page\Edit;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
/**
 * Class SaveButton
 */
class SaveButton extends GenericButton  implements ButtonProviderInterface
{
    /**
     * Save button
     *
     * @return array
     */
    public function getButtonData()
    {
            return [
                'label' => __('Save'),
                'class' => 'save primary',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'save']],
                    'form-role' => 'save',
                ],
                'sort_order' => 30,
            ];
    }

     public function getSaveUrl()
    {
        return $this->getUrl('uiform/index/save');
    }
}
