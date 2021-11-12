<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model;

use Psr\Log\LoggerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\DeleteRuleByIdInterface;
use Eriocnemis\SalesAutoCancelRule\Model\ResourceModel\Rule as RuleResource;
use Eriocnemis\SalesAutoCancelRule\Model\RuleFactory;

/**
 * Delete rule by rule id
 *
 * @api
 */
class DeleteRuleById implements DeleteRuleByIdInterface
{
    /**
     * @var RuleFactory
     */
    private $factory;

    /**
     * @var RuleResource
     */
    private $resource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Initialize provider
     *
     * @param RuleResource $resource
     * @param RuleFactory $factory
     * @param LoggerInterface $logger
     */
    public function __construct(
        RuleResource $resource,
        RuleFactory $factory,
        LoggerInterface $logger
    ) {
        $this->resource = $resource;
        $this->factory = $factory;
        $this->logger = $logger;
    }

    /**
     * Delete by id
     *
     * @param int $ruleId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function execute($ruleId): bool
    {
        /** @var \Magento\Framework\Model\AbstractModel $rule */
        $rule = $this->factory->create();
        $this->resource->load($rule, $ruleId, RuleInterface::RULE_ID);

        if (!$rule->getId()) {
            throw new NoSuchEntityException(
                __('Rule with id "%1" does not exist.', $ruleId)
            );
        }

        try {
            $this->resource->delete($rule);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new CouldNotDeleteException(
                __('Could not delete the rule with id: %1', $ruleId)
            );
        }
        return true;
    }
}
