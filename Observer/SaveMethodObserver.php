<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Eriocnemis\SalesAutoCancelRule\Api\DetachMethodFromRuleInterface;
use Eriocnemis\SalesAutoCancelRule\Api\AttachMethodToRuleInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Save shipping methods observer
 */
class SaveMethodObserver implements ObserverInterface
{
    /**
     * @var DetachMethodFromRuleInterface
     */
    private $detachMethodFromRule;

    /**
     * @var AttachMethodToRuleInterface
     */
    private $attachMethodToRule;

    /**
     * Initialize observer
     *
     * @param DetachMethodFromRuleInterface $detachMethodFromRule
     * @param AttachMethodToRuleInterface $attachMethodToRule
     */
    public function __construct(
        DetachMethodFromRuleInterface $detachMethodFromRule,
        AttachMethodToRuleInterface $attachMethodToRule
    ) {
        $this->detachMethodFromRule = $detachMethodFromRule;
        $this->attachMethodToRule = $attachMethodToRule;
    }

    /**
     * Save shipping methods data
     *
     * @param Observer $observer
     * @return void
     * @throws CouldNotSaveException
     * @throws CouldNotDeleteException
     */
    public function execute(Observer $observer): void
    {
        $rule = $observer->getEvent()->getData('rule');
        if ($rule->getId()) {
            $methods = $rule->hasData(RuleInterface::PAYMENT_METHOD)
                ? $rule->getData(RuleInterface::PAYMENT_METHOD)
                : [];
            $this->detachMethodFromRule->execute((int)$rule->getId());
            $this->attachMethodToRule->execute($methods, (int)$rule->getId());
        }
    }
}
