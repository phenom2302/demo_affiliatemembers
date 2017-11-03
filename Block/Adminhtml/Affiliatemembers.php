<?php

namespace Demo\AffiliateMembers\Block\Adminhtml;

class Affiliatemembers extends \Magento\Backend\Block\Widget\Container
{
    /**
     * Template path.
     *
     * @var string
     */
    protected $_template = 'affiliatemembers/affiliatemembers.phtml';

    /**
     * Construct.
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array                                 $data
     */
    public function __construct(\Magento\Backend\Block\Widget\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Prepare button and grid.
     *
     * @return \Magento\Catalog\Block\Adminhtml\Product
     */
    protected function _prepareLayout()
    {
        $addButtonProps = [
            'id'           => 'add_new',
            'label'        => __('Add New'),
            'class'        => 'add',
            'button_class' => '',
            'class_name'   => 'Magento\Backend\Block\Widget\Button\SplitButton',
            'options'      => $this->_getAddButtonOptions(),
        ];
        $this->buttonList->add('add_new', $addButtonProps);

        $this->setChild(
            'grid',
            $this->getLayout()->createBlock(
                'Demo\AffiliateMembers\Block\Adminhtml\Affiliatemembers\Grid', 'affiliate.affiliatemembers.grid'
            )
        );

        return parent::_prepareLayout();
    }

    /**
     * Return add-button options.
     *
     * @return array
     */
    protected function _getAddButtonOptions()
    {
        $splitButtonOptions[] = [
            'label'   => __('Add New'),
            'onclick' => "setLocation('" . $this->_getCreateUrl() . "')"
        ];
        return $splitButtonOptions;
    }

    /**
     * Return create-action url.
     *
     * @return string
     */
    protected function _getCreateUrl()
    {
        return $this->getUrl('members/*/new');
    }

    /**
     * Render grid.
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}