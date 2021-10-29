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
use Eriocnemis\SalesAutoCancelRule\Api\GetStoreIdsByRuleIdsInterface;
use Eriocnemis\SalesAutoCancelRule\Api\GetCustomerGroupIdsByRuleIdsInterface;
use Eriocnemis\SalesAutoCancelRule\Api\GetMethodsByRuleIdsInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Load rule additional data observer
 */
class LoadRulesObserver implements ObserverInterface
{
    /**
     * @var GetStoreIdsByRuleIdsInterface
     */
    private $getStoreIdsByRuleIds;

    /**
     * @var GetCustomerGroupIdsByRuleIdsInterface
     */
    private $getCustomerGroupIdsByRuleIds;

    /**
     * @var GetMethodsByRuleIdsInterface
     */
    private $getMethodsByRuleIds;

    /**
     * Initialize observer
     *
     * @param GetStoreIdsByRuleIdsInterface $getStoreIdsByRuleIds
     * @param GetCustomerGroupIdsByRuleIdsInterface $getCustomerGroupIdsByRuleIds
     * @param GetMethodsByRuleIdsInterface $getMethodsByRuleIds
     */
    public function __construct(
        GetStoreIdsByRuleIdsInterface $getStoreIdsByRuleIds,
        GetCustomerGroupIdsByRuleIdsInterface $getCustomerGroupIdsByRuleIds,
        GetMethodsByRuleIdsInterface $getMethodsByRuleIds
    ) {
        $this->getStoreIdsByRuleIds = $getStoreIdsByRuleIds;
        $this->getCustomerGroupIdsByRuleIds = $getCustomerGroupIdsByRuleIds;
        $this->getMethodsByRuleIds = $getMethodsByRuleIds;
    }

    /**
     * Load rules
     *
     * @param Observer $observer
     * @return void
     * @throws LocalizedException
     */
    public function execute(Observer $observer): void
    {
        $collection = $observer->getEvent()->getData('collection');
        $ruleIds = $collection->getColumnValues(RuleInterface::RULE_ID);
        if (0 < count($ruleIds)) {
            /* preload related data */
            $methods = $this->getMethodsByRuleIds->execute($ruleIds);
            $storeIds = $this->getStoreIdsByRuleIds->execute($ruleIds);
            $customerGroupIds = $this->getCustomerGroupIdsByRuleIds->execute($ruleIds);
            /* add related data to rules */
            foreach ($collection as $rule) {
                $rule->setData(RuleInterface::STORE_IDS, $storeIds[$rule->getId()] ?? []);
                $rule->setData(RuleInterface::PAYMENT_METHOD, $methods[$rule->getId()] ?? []);
                $rule->setData(RuleInterface::CUSTOMER_GROUP_IDS, $customerGroupIds[$rule->getId()] ?? []);
            }
        }
    }
}
