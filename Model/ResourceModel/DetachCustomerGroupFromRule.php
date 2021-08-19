<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\ResourceModel;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\CouldNotDeleteException;
use Eriocnemis\SalesAutoCancelRule\Api\DetachCustomerGroupFromRuleInterface;

/**
 * Detach customer groups from rule
 */
class DetachCustomerGroupFromRule implements DetachCustomerGroupFromRuleInterface
{
    /**
     * Customer group relation table name
     */
    private const TABLE_NAME = 'eriocnemis_sales_autocancel_rule_customer_group';

    /**
     * @var ResourceConnection
     */
    private $resource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Initialize resource
     *
     * @param ResourceConnection $resource
     * @param LoggerInterface $logger
     */
    public function __construct(
        ResourceConnection $resource,
        LoggerInterface $logger
    ) {
        $this->resource = $resource;
        $this->logger = $logger;
    }

    /**
     * Detach customer groups
     *
     * @param int $ruleId
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $ruleId): void
    {
        try {
            $this->resource->getConnection()->delete(
                $this->resource->getTableName(self::TABLE_NAME),
                ['rule_id = ?' => $ruleId]
            );
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new CouldNotDeleteException(
                __('Could not detach customer group from rule with id %id', ['id' => $ruleId])
            );
        }
    }
}
