<?php

namespace Demo\AffiliateMembers\Model\Status;

class Options implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * Get option items.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = self::getOptionArray();
        $options = [];

        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }

        return $options;
    }

    public static function getOptionArray()
    {
        return [1 => __('Enabled'), 0 => __('Disabled')];
    }
}