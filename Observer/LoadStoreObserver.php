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
use Eriocnemis\SalesAutoCancelRule\Api\GetStoreIdsByRuleIdInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Load store ids observer
 */
class LoadStoreObserver implements ObserverInterface
{
    /**
     * @var GetStoreIdsByRuleIdInterface
     */
    private $getStoreIdsByRuleId;

    /**
     * Initialize observer
     *
     * @param GetStoreIdsByRuleIdInterface $getStoreIdsByRuleId
     */
    public function __construct(
        GetStoreIdsByRuleIdInterface $getStoreIdsByRuleId
    ) {
        $this->getStoreIdsByRuleId = $getStoreIdsByRuleId;
    }

    /**
     * Load store ids
     *
     * @param Observer $observer
     * @return void
     * @throws LocalizedException
     */
    public function execute(Observer $observer): void
    {
        $rule = $observer->getEvent()->getData('rule');
        if ($rule->getId()) {
            if (!$rule->hasData(RuleInterface::STORE_IDS)) {
                $storeIds = $this->getStoreIdsByRuleId->execute((int)$rule->getId());
                $rule->setData(RuleInterface::STORE_IDS, $storeIds);
            }
        }
    }
}
