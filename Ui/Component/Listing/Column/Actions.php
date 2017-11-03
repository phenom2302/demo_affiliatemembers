<?php

namespace Demo\AffiliateMembers\Ui\Component\Listing\Column;

class Actions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * Url paths.
     */
    const URL_PATH_EDIT = 'affiliate_members/affiliatemembers/edit';
    const URL_PATH_DETAILS = 'affiliate_members/affiliatemembers/details';
    const URL_PATH_DELETE = 'affiliate_members/affiliatemembers/delete';

    /** @var \Magento\Framework\UrlInterface Url Builder object instance. */
    protected $urlBuilder;

    /**
     * Construct.
     *
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory           $uiComponentFactory
     * @param \Magento\Framework\UrlInterface                              $urlBuilder
     * @param array                                                        $components
     * @param array                                                        $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare data source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['affiliatemember_id'])) {
                    $item[$this->getData('name')] = [
                        'edit'   => [
                            'href'  => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'affiliatemember_id' => $item['affiliatemember_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href'    => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'affiliatemember_id' => $item['affiliatemember_id']
                                ]
                            ),
                            'label'   => __('Delete'),
                            'confirm' => [
                                'title'   => __('Delete "${ $.$data.Name }"'),
                                'message' => __('Are you sure you wan\'t to delete "${ $.$data.Name }" record?')
                            ]
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}