<?php

namespace Demo\AffiliateMembers\Controller\Adminhtml\Affiliatemembers;

class Delete extends \Demo\AffiliateMembers\Controller\Adminhtml\Affiliatemembers
{

    /**
     * Delete action.
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('affiliatemember_id');

        if ($id) {
            try {
                $model = $this->_objectManager->create('Demo\AffiliateMembers\Model\Affiliatemembers');
                $model->load($id);
                $model->delete();

                $this->messageManager->addSuccessMessage(__('Affiliate member was successfully deleted.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['affiliatemember_id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a member to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}