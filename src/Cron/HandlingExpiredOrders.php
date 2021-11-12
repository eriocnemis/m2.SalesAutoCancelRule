<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Cron;

use Psr\Log\LoggerInterface;
use Eriocnemis\SalesAutoCancelRule\Helper\Data as Helper;
use Eriocnemis\SalesAutoCancelRule\Api\CancelOrdersInterface;

/**
 * Handling expired orders job
 */
class HandlingExpiredOrders
{
    /**
     * @var CancelOrdersInterface
     */
    private $cancelOrders;

    /**
     * @var Helper
     */
    private $helper;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Initialize job
     *
     * @param CancelOrdersInterface $cancelOrders
     * @param LoggerInterface $logger
     * @param Helper $helper
     */
    public function __construct(
        CancelOrdersInterface $cancelOrders,
        LoggerInterface $logger,
        Helper $helper
    ) {
        $this->cancelOrders = $cancelOrders;
        $this->logger = $logger;
        $this->helper = $helper;
    }

    /**
     * Canceling expired orders
     *
     * @return void
     */
    public function execute()
    {
        if ($this->helper->isEnabled()) {
            try {
                $this->cancelOrders->execute();
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
            }
        }
    }
}
