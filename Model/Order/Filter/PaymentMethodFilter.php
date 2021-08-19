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
 * Payment method filter
 */
class PaymentMethodFilter implements FilterInterface
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
        $methods = $rule->getPaymentMethod();
        if ($methods && !$rule->getMethodsAccess()) {
            $searchCriteriaBuilder->addFilter(RuleInterface::PAYMENT_METHOD, $methods, 'in');
        }
    }
}
