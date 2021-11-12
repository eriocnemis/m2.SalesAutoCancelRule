<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;
use Eriocnemis\SalesAutoCancelRule\Api\CancelOrderInterface;
use Eriocnemis\SalesAutoCancelRule\Model\Order\Handler\HandlerPoolInterface;

/**
 * Cancel order use rule
 *
 * @api
 */
class CancelOrder implements CancelOrderInterface
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var HandlerPoolInterface
     */
    private $handlerPool;

    /**
     * Initialize provider
     *
     * @param OrderRepositoryInterface $orderRepository
     * @param HandlerPoolInterface $handlerPool
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        HandlerPoolInterface $handlerPool
    ) {
        $this->orderRepository = $orderRepository;
        $this->handlerPool = $handlerPool;
    }

    /**
     * Cancel order
     *
     * @param OrderInterface $order
     * @param RuleInterface $rule
     * @return void
     */
    public function execute(OrderInterface $order, RuleInterface $rule): void
    {
        if ($order->canCancel()) {
            foreach ($this->handlerPool->getHandlers() as $handler) {
                $handler->execute($order, $rule);
            }
            $this->orderRepository->save($order);
        }
    }
}
