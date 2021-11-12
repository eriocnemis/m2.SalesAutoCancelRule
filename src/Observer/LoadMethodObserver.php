<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Eriocnemis\SalesAutoCancelRule\Api\GetMethodsByRuleIdInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Load shipping methods observer
 */
class LoadMethodObserver implements ObserverInterface
{
    /**
     * @var GetMethodsByRuleIdInterface
     */
    private $getMethodsByRuleId;

    /**
     * Initialize observer
     *
     * @param GetMethodsByRuleIdInterface $getMethodsByRuleId
     */
    public function __construct(
        GetMethodsByRuleIdInterface $getMethodsByRuleId
    ) {
        $this->getMethodsByRuleId = $getMethodsByRuleId;
    }

    /**
     * Load shipping methods
     *
     * @param Observer $observer
     * @return void
     * @throws LocalizedException
     */
    public function execute(Observer $observer): void
    {
        $rule = $observer->getEvent()->getData('rule');
        if ($rule->getId()) {
            if (!$rule->hasData(RuleInterface::PAYMENT_METHOD)) {
                $methods = $this->getMethodsByRuleId->execute((int)$rule->getId());
                $rule->setData(RuleInterface::PAYMENT_METHOD, $methods);
            }
        }
    }
}
