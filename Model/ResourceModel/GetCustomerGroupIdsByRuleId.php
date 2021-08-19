<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\ResourceModel;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\LocalizedException;
use Eriocnemis\SalesAutoCancelRule\Api\GetCustomerGroupIdsByRuleIdInterface;

/**
 * Get customer group ids by rule id
 */
class GetCustomerGroupIdsByRuleId implements GetCustomerGroupIdsByRuleIdInterface
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
     * Retrieve customer group ids
     *
     * @param int $ruleId
     * @return int[]
     * @throws LocalizedException
     */
    public function execute(int $ruleId): array
    {
        $groupIds = [];
        try {
            $connection = $this->resource->getConnection();
            $select = $connection->select()->from(
                $this->resource->getTableName(self::TABLE_NAME),
                ['customer_group_id']
            )->where('rule_id = ?', (string)$ruleId);

            $result = $connection->fetchCol($select);
            if ($result) {
                $groupIds = $result;
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new LocalizedException(
                __('Could not retrieve customer group ids by rule with id %id', ['id' => $ruleId])
            );
        }
        return $groupIds;
    }
}
