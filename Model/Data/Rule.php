<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eriocnemis\SalesAutoCancelRule\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleExtensionInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Rule data
 */
class Rule extends AbstractExtensibleObject implements RuleInterface
{
    /**
     * Retrieve rule id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->_get(self::RULE_ID);
    }

    /**
     * Set rule id
     *
     * @param int $ruleId
     * @return $this
     */
    public function setId(int $ruleId): RuleInterface
    {
        return $this->setData(self::RULE_ID, $ruleId);
    }

    /**
     * Retrieve rule name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set rule name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name): RuleInterface
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve a visible on storefront flag
     *
     * @return int
     */
    public function getVisibleOnFront(): int
    {
        return $this->_get(self::VISIBLE_ON_FRONT);
    }

    /**
     * Set the visible on storefront flag
     *
     * @param int $flag
     * @return $this
     */
    public function setVisibleOnFront(int $flag): RuleInterface
    {
        return $this->setData(self::VISIBLE_ON_FRONT, $flag);
    }

    /**
     * Retrieve a customer notified flag
     *
     * @return int
     */
    public function getCustomerNotified(): int
    {
        return $this->_get(self::CUSTOMER_NOTIFIED);
    }

    /**
     * Set the customer notified flag
     *
     * @param int $flag
     * @return $this
     */
    public function setCustomerNotified(int $flag): RuleInterface
    {
        return $this->setData(self::CUSTOMER_NOTIFIED, $flag);
    }

    /**
     * Retrieve a duration unit
     *
     * @return int
     */
    public function getDurationUnit(): int
    {
        return $this->_get(self::DURATION_UNIT);
    }

    /**
     * Set the duration unit
     *
     * @param int $durationUnit
     * @return $this
     */
    public function setDurationUnit(int $durationUnit): RuleInterface
    {
        return $this->setData(self::DURATION_UNIT, $durationUnit);
    }

    /**
     * Retrieve a duration
     *
     * @return int
     */
    public function getDuration(): int
    {
        return $this->_get(self::DURATION);
    }

    /**
     * Set the duration
     *
     * @param int $duration
     * @return $this
     */
    public function setDuration(int $duration): RuleInterface
    {
        return $this->setData(self::DURATION, $duration);
    }

    /**
     * Whether the rule is active
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set whether the rule is active
     *
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status): RuleInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Retrieve a list of stores the rule applies to
     *
     * @return int[]
     */
    public function getStoreIds(): array
    {
        return $this->_get(self::STORE_IDS);
    }

    /**
     * Set the stores the rule applies to
     *
     * @param int[] $storeIds
     * @return $this
     */
    public function setStoreIds(array $storeIds): RuleInterface
    {
        return $this->setData(self::STORE_IDS, $storeIds);
    }

    /**
     * Retrieve a list of customer group ids the rule applies to
     *
     * @return int[]
     */
    public function getCustomerGroupIds(): array
    {
        return $this->_get(self::CUSTOMER_GROUP_IDS);
    }

    /**
     * Set the customer group ids the rule applies to
     *
     * @param int[] $customerGroupIds
     * @return $this
     */
    public function setCustomerGroupIds(array $customerGroupIds): RuleInterface
    {
        return $this->setData(self::CUSTOMER_GROUP_IDS, $customerGroupIds);
    }

    /**
     * Whether the methods access
     *
     * @return int
     */
    public function getMethodsAccess(): int
    {
        return $this->_get(self::METHODS_ACCESS);
    }

    /**
     * Set whether the methods access
     *
     * @param int $access
     * @return $this
     */
    public function setMethodsAccess($access): RuleInterface
    {
        return $this->setData(self::METHODS_ACCESS, $access);
    }

    /**
     * Retrieve a list of payment methods the rule applies to
     *
     * @return string[]
     */
    public function getPaymentMethod(): array
    {
        return $this->_get(self::PAYMENT_METHOD);
    }

    /**
     * Set the payment methods the rule applies to
     *
     * @param string[] $paymentMethods
     * @return $this
     */
    public function setPaymentMethod(array $paymentMethods): RuleInterface
    {
        return $this->setData(self::PAYMENT_METHOD, $paymentMethods);
    }

    /**
     * Retrieve existing extension attributes object or create a new one
     *
     * @return \Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object
     *
     * @param \Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(RuleExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
