<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

use Magento\Sales\Api\Data\OrderInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Cancel order interface
 *
 * @api
 */
interface CancelOrderInterface
{
    /**
     * Cancel order
     *
     * @param OrderInterface $order
     * @param RuleInterface $rule
     * @return void
     */
    public function execute(OrderInterface $order, RuleInterface $rule): void;
}
