<?php

namespace Demo\AffiliateMembers\Controller\Adminhtml;

abstract class Affiliatemembers extends \Magento\Backend\App\Action
{
    protected $_coreRegistry;

    const ADMIN_RESOURCE = 'Demo_AffiliateMembers::top_level';

    /**
     * Construct.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry         $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page.
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Demo'), __('Demo'))
            ->addBreadcrumb(__('Affiliate Members'), __('Affiliate Members'));

        return $resultPage;
    }
}