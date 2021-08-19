<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\Order\Handler;

use Magento\Sales\Model\Order;
use Magento\Sales\Api\Data\OrderInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;
use Eriocnemis\SalesAutoCancelRule\Model\System\Config\Source\DurationUnit as DurationUnitSource;

/**
 * Comment order handler
 */
class CommentHandler implements HandlerInterface
{
    /**
     * @var DurationUnitSource
     */
    private $durationUnitSource;

    /**
     * Initialize handler
     *
     * @param DurationUnitSource $durationUnitSource
     */
    public function __construct(
        DurationUnitSource $durationUnitSource
    ) {
        $this->durationUnitSource = $durationUnitSource;
    }

    /**
     * Execute handler
     *
     * @param OrderInterface $order
     * @param RuleInterface $rule
     * @return void
     */
    public function execute(OrderInterface $order, RuleInterface $rule): void
    {
        $options = $this->durationUnitSource->toArray();
        $durationUnit = $options[$rule->getDurationUnit()] ?? $rule->getDurationUnit();

        $order->addCommentToStatusHistory(
            __(
                'The order is canceled automatically due to the lack of information ' .
                'about payment for the order within %1 %2.',
                $rule->getDuration(),
                $durationUnit
            ),
            Order::STATE_CANCELED,
            (bool)$rule->getVisibleOnFront()
        )->setIsCustomerNotified((bool)$rule->getCustomerNotified());
    }
}
