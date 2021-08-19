<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model;

use Eriocnemis\SalesAutoCancelRule\Api\CancelOrdersInterface;
use Eriocnemis\SalesAutoCancelRule\Api\CancelOrdersByRuleInterface;
use Eriocnemis\SalesAutoCancelRule\Api\GetActiveRuleListInterface;

/**
 * Cancel orders
 *
 * @api
 */
class CancelOrders implements CancelOrdersInterface
{
    /**
     * @var GetActiveRuleListInterface
     */
    private $getActiveRuleList;

    /**
     * @var CancelOrdersByRuleInterface
     */
    private $cancelOrdersByRule;

    /**
     * Initialize provider
     *
     * @param GetActiveRuleListInterface $getActiveRuleList
     * @param CancelOrdersByRuleInterface $cancelOrdersByRule
     */
    public function __construct(
        GetActiveRuleListInterface $getActiveRuleList,
        CancelOrdersByRuleInterface $cancelOrdersByRule
    ) {
        $this->getActiveRuleList = $getActiveRuleList;
        $this->cancelOrdersByRule = $cancelOrdersByRule;
    }

    /**
     * Cancel orders
     *
     * @return void
     */
    public function execute(): void
    {
        $searchResult = $this->getActiveRuleList->execute();
        if ($searchResult->getTotalCount()) {
            foreach ($searchResult->getItems() as $rule) {
                $this->cancelOrdersByRule->execute($rule);
            }
        }
    }
}
