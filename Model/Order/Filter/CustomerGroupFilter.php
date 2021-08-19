<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\Order\Filter;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Sales\Api\Data\OrderInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Customer group filter
 */
class CustomerGroupFilter implements FilterInterface
{
    /**
     * Apply filter
     *
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RuleInterface $rule
     * @return void
     */
    public function apply(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RuleInterface $rule
    ): void {
        $groupIds = $rule->getCustomerGroupIds();
        if ($groupIds) {
            $searchCriteriaBuilder->addFilter(OrderInterface::CUSTOMER_GROUP_ID, $groupIds, 'in');
        }
    }
}
