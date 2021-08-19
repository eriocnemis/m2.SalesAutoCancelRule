<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Find orders by search criteria interface
 *
 * @api
 */
interface GetMatchOrderListInterface
{
    /**
     * Retrieve list of orders
     *
     * @param RuleInterface $rule
     * @return OrderSearchResultInterface
     */
    public function execute(RuleInterface $rule): OrderSearchResultInterface;
}
