<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model;

use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;
use Eriocnemis\SalesAutoCancelRule\Api\GetMatchOrderListInterface;
use Eriocnemis\SalesAutoCancelRule\Api\CancelOrdersByRuleInterface;
use Eriocnemis\SalesAutoCancelRule\Api\CancelOrderInterface;

/**
 * Cancel orders by rule
 *
 * @api
 */
class CancelOrdersByRule implements CancelOrdersByRuleInterface
{
    /**
     * @var GetMatchOrderListInterface
     */
    private $getMatchOrderList;

    /**
     * @var CancelOrderInterface
     */
    private $cancelOrder;

    /**
     * Initialize provider
     *
     * @param GetMatchOrderListInterface $getMatchOrderList
     * @param CancelOrderInterface $cancelOrder
     */
    public function __construct(
        GetMatchOrderListInterface $getMatchOrderList,
        CancelOrderInterface $cancelOrder
    ) {
        $this->getMatchOrderList = $getMatchOrderList;
        $this->cancelOrder = $cancelOrder;
    }

    /**
     * Cancel orders
     *
     * @param RuleInterface $rule
     * @return void
     */
    public function execute(RuleInterface $rule): void
    {
        $searchResult = $this->getMatchOrderList->execute($rule);
        if ($searchResult->getTotalCount()) {
            foreach ($searchResult->getItems() as $order) {
                $this->cancelOrder->execute($order, $rule);
            }
        }
    }
}
