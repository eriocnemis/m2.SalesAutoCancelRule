<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model;

use Magento\Framework\Model\AbstractModel;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterfaceFactory;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleExtensionFactory;
use Eriocnemis\SalesAutoCancelRule\Api\ConvertRuleToDataInterface;

/**
 * Convert rule model to data
 */
class ConvertRuleToData implements ConvertRuleToDataInterface
{
    /**
     * @var RuleInterfaceFactory
     */
    private $ruleDataFactory;

    /**
     * @var RuleExtensionFactory
     */
    private $extensionFactory;

    /**
     * Initialize converter
     *
     * @param RuleInterfaceFactory $ruleDataFactory
     * @param RuleExtensionFactory $extensionFactory
     */
    public function __construct(
        RuleInterfaceFactory $ruleDataFactory,
        RuleExtensionFactory $extensionFactory
    ) {
        $this->ruleDataFactory = $ruleDataFactory;
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * Convert rule to data
     *
     * @param AbstractModel $model
     * @return RuleInterface
     */
    public function execute(AbstractModel $model): RuleInterface
    {
        $data = $this->convertExtensionAttributesToObject(
            $model->getData()
        );
        return $this->ruleDataFactory->create(['data' => $data]);
    }

    /**
     * Convert extension attributes of model to object if it is an array
     *
     * @param mixed[] $data
     * @return mixed[]
     */
    private function convertExtensionAttributesToObject(array $data)
    {
        if (!isset($data['extension_attributes'])) {
            $data['extension_attributes'] = [];
        }

        if (is_array($data['extension_attributes'])) {
            $data['extension_attributes'] = $this->extensionFactory->create(
                ['data' => $data['extension_attributes']]
            );
        }
        return $data;
    }
}
