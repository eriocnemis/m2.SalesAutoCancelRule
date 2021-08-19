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
use Eriocnemis\SalesAutoCancelRule\Api\DetachCustomerGroupFromRuleInterface;
use Eriocnemis\SalesAutoCancelRule\Api\AttachCustomerGroupToRuleInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Save customer groups observer
 */
class SaveCustomerGroupObserver implements ObserverInterface
{
    /**
     * @var DetachCustomerGroupFromRuleInterface
     */
    private $detachCustomerGroupFromRule;

    /**
     * @var AttachCustomerGroupToRuleInterface
     */
    private $attachCustomerGroupToRule;

    /**
     * Initialize observer
     *
     * @param DetachCustomerGroupFromRuleInterface $detachCustomerGroupFromRule
     * @param AttachCustomerGroupToRuleInterface $attachCustomerGroupToRule
     */
    public function __construct(
        DetachCustomerGroupFromRuleInterface $detachCustomerGroupFromRule,
        AttachCustomerGroupToRuleInterface $attachCustomerGroupToRule
    ) {
        $this->detachCustomerGroupFromRule = $detachCustomerGroupFromRule;
        $this->attachCustomerGroupToRule = $attachCustomerGroupToRule;
    }

    /**
     * Save customer groups data
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
            $groupIds = $rule->hasData(RuleInterface::CUSTOMER_GROUP_IDS)
                ? $rule->getData(RuleInterface::CUSTOMER_GROUP_IDS)
                : [];
            $this->detachCustomerGroupFromRule->execute((int)$rule->getId());
            $this->attachCustomerGroupToRule->execute($groupIds, (int)$rule->getId());
        }
    }
}
