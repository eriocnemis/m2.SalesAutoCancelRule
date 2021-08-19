<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Cancel orders by rule interface
 *
 * @api
 */
interface CancelOrdersByRuleInterface
{
    /**
     * Cancel orders
     *
     * @param RuleInterface $rule
     * @return void
     */
    public function execute(RuleInterface $rule): void;
}
