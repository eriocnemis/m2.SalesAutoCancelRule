<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Duration unit source
 */
class DurationUnit implements OptionSourceInterface
{
    /**
     * Value which equal hours for duration unit dropdown
     */
    const HOUR_VALUE = 1;

    /**
     * Value which equal days for duration unit dropdown
     */
    const DAYS_VALUE = 24;

    /**
     * Retrieve options as array
     *
     * @return mixed[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::DAYS_VALUE, 'label' => __('Days')],
            ['value' => self::HOUR_VALUE, 'label' => __('Hours')],
        ];
    }

    /**
     * Retrieve options in key-value format
     *
     * @return mixed[]
     */
    public function toArray()
    {
        return [
            self::DAYS_VALUE => __('days'),
            self::HOUR_VALUE => __('hours')
        ];
    }
}
