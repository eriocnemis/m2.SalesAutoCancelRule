<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Plugin\Sales\Model\CronJob;

use Magento\Sales\Model\CronJob\CleanExpiredOrders;
use Eriocnemis\SalesAutoCancelRule\Helper\Data as Helper;

/**
 * Clean expired orders
 */
class CleanExpiredOrdersPlugin
{
    /**
     * @var Helper
     */
    private $helper;

    /**
     * Initialize plugin
     *
     * @param Helper $helper
     * @return void
     */
    public function __construct(
        Helper $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Clean expired quotes (cron process)
     *
     * @param CleanExpiredOrders $subject
     * @param callable $proceed
     * @return void
     */
    public function aroundExecute(
        CleanExpiredOrders $subject,
        callable $proceed
    ) {
        if (!$this->helper->isEnabled() ||
            !$this->helper->isDisableNative()
        ) {
            $proceed();
        }
    }
}
