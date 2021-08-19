<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Reflection\DataObjectProcessor;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;
use Eriocnemis\SalesAutoCancelRule\Api\ConvertDataToRuleInterface;
use Eriocnemis\SalesAutoCancelRule\Model\ResourceModel\Rule as RuleResource;
use Eriocnemis\SalesAutoCancelRule\Model\RuleFactory;

/**
 * Convert data to rule model
 */
class ConvertDataToRule implements ConvertDataToRuleInterface
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
     * @var DataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * Initialize converter
     *
     * @param RuleResource $resource
     * @param DataObjectProcessor $dataObjectProcessor
     * @param RuleFactory $factory
     */
    public function __construct(
        RuleResource $resource,
        DataObjectProcessor $dataObjectProcessor,
        RuleFactory $factory
    ) {
        $this->resource = $resource;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->factory = $factory;
    }

    /**
     * Convert to model
     *
     * @param RuleInterface $rule
     * @return AbstractModel
     */
    public function execute(RuleInterface $rule): AbstractModel
    {
        /** @var \Eriocnemis\SalesAutoCancelRule\Model\Rule $model */
        $model = $this->factory->create();
        if ($rule->getId()) {
            $this->resource->load($model, $rule->getId(), RuleInterface::RULE_ID);
        }

        $data = $this->dataObjectProcessor->buildOutputDataArray($rule, RuleInterface::class);
        $model->addData($data);

        return $model;
    }
}
