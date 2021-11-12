<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\Order\Handler;

use Magento\Sales\Model\Order;
use Magento\Sales\Api\Data\OrderInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * State order handler
 */
class StateHandler implements HandlerInterface
{
    /**
     * Execute handler
     *
     * @param OrderInterface $order
     * @param RuleInterface $rule
     * @return void
     */
    public function execute(
        OrderInterface $order,
        RuleInterface $rule
    ): void {
        $order->setState(Order::STATE_CANCELED);
    }
}
