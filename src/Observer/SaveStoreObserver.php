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
use Eriocnemis\SalesAutoCancelRule\Api\DetachStoreFromRuleInterface;
use Eriocnemis\SalesAutoCancelRule\Api\AttachStoreToRuleInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Save stores observer
 */
class SaveStoreObserver implements ObserverInterface
{
    /**
     * @var DetachStoreFromRuleInterface
     */
    private $detachStoreFromRule;

    /**
     * @var AttachStoreToRuleInterface
     */
    private $attachStoreToRule;

    /**
     * Initialize observer
     *
     * @param DetachStoreFromRuleInterface $detachStoreFromRule
     * @param AttachStoreToRuleInterface $attachStoreToRule
     */
    public function __construct(
        DetachStoreFromRuleInterface $detachStoreFromRule,
        AttachStoreToRuleInterface $attachStoreToRule
    ) {
        $this->detachStoreFromRule = $detachStoreFromRule;
        $this->attachStoreToRule = $attachStoreToRule;
    }

    /**
     * Save stores data
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
            $storeIds = $rule->hasData(RuleInterface::STORE_IDS)
                ? $rule->getData(RuleInterface::STORE_IDS)
                : [];
            $this->detachStoreFromRule->execute((int)$rule->getId());
            $this->attachStoreToRule->execute($storeIds, (int)$rule->getId());
        }
    }
}
