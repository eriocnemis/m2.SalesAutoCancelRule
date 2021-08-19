<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\GetRuleByIdInterface;
use Eriocnemis\SalesAutoCancelRule\Api\ConvertRuleToDataInterface;
use Eriocnemis\SalesAutoCancelRule\Model\ResourceModel\Rule as RuleResource;
use Eriocnemis\SalesAutoCancelRule\Model\RuleFactory;

/**
 * Get rule by id
 *
 * @api
 */
class GetRuleById implements GetRuleByIdInterface
{
    /**
     * @var RuleResource
     */
    private $resource;

    /**
     * @var RuleFactory
     */
    private $factory;

    /**
     * @var ConvertRuleToDataInterface
     */
    private $convertRuleToData;

    /**
     * Initialize provider
     *
     * @param RuleResource $resource
     * @param ConvertRuleToDataInterface $convertRuleToData
     * @param RuleFactory $factory
     */
    public function __construct(
        RuleResource $resource,
        ConvertRuleToDataInterface $convertRuleToData,
        RuleFactory $factory
    ) {
        $this->resource = $resource;
        $this->convertRuleToData = $convertRuleToData;
        $this->factory = $factory;
    }

    /**
     * Retrieve rule by id
     *
     * @param int $ruleId
     * @return RuleInterface
     * @throws NoSuchEntityException
     */
    public function execute($ruleId): RuleInterface
    {
        /** @var \Magento\Framework\Model\AbstractModel $rule */
        $rule = $this->factory->create();
        $this->resource->load($rule, $ruleId, RuleInterface::RULE_ID);

        if (!$rule->getId()) {
            throw new NoSuchEntityException(
                __('Rule with id "%value" does not exist.', ['value' => $ruleId])
            );
        }
        return $this->convertRuleToData->execute($rule);
    }
}
