<?php

namespace Demo\AffiliateMembers\Model\Affiliatemembers;

use Demo\AffiliateMembers\Model\ResourceModel\Affiliatemembers\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $loadedData;
    protected $dataPersistor;

    /**
     * Constructor.
     *
     * @param string                 $name
     * @param string                 $primaryFieldName
     * @param string                 $requestFieldName
     * @param CollectionFactory      $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data.
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $itemData = $model->getData();
            $imageName = $itemData['profile_image'];
            if ($imageName != '') {
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $media = $objectManager->get('Magento\Store\Model\StoreManagerInterface')
                        ->getStore()
                        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'profile_images' . $imageName;

                unset($itemData['image']);
                $itemData['image'] = [
                    [
                        'name' => $imageName,
                        'url'  => $media,
                        'file' => $imageName
                    ]
                ];
            }

            $this->loadedData[$model->getId()] = $itemData;
        }

        $data = $this->dataPersistor->get('affiliate_members');

        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('affiliate_members');
        }

        return $this->loadedData;
    }
}
