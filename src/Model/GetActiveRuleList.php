<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleSearchResultInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\GetRuleListInterface;
use Eriocnemis\SalesAutoCancelRule\Api\GetActiveRuleListInterface;

/**
 * Find active rules by search criteria
 *
 * @api
 */
class GetActiveRuleList implements GetActiveRuleListInterface
{
    /**
     * @var GetRuleListInterface
     */
    private $getRuleList;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * Initialize provider
     *
     * @param GetRuleListInterface $getRuleList
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        GetRuleListInterface $getRuleList,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->getRuleList = $getRuleList;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Retrieve list of rules
     *
     * @return RuleSearchResultInterface
     */
    public function execute(): RuleSearchResultInterface
    {
        $this->searchCriteriaBuilder->addFilter(RuleInterface::STATUS, 1);
        return $this->getRuleList->execute(
            $this->searchCriteriaBuilder->create()
        );
    }
}
