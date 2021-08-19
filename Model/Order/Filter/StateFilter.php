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
use Eriocnemis\SalesAutoCancelRule\Helper\Data as Helper;

/**
 * State order filter
 */
class StateFilter implements FilterInterface
{
    /**
     * @var Helper
     */
    private $helper;

    /**
     * Initialize filter
     *
     * @param Helper $helper
     */
    public function __construct(
        Helper $helper
    ) {
        $this->helper = $helper;
    }

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
        $searchCriteriaBuilder->addFilter(OrderInterface::STATE, $this->helper->getStatuses(), 'in');
    }
}
