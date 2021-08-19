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
use Eriocnemis\SalesAutoCancelRule\Api\GetStoreIdsByRuleIdsInterface;

/**
 * Get store ids by rule ids
 */
class GetStoreIdsByRuleIds implements GetStoreIdsByRuleIdsInterface
{
    /**
     * Store relation table name
     */
    private const TABLE_NAME = 'eriocnemis_sales_autocancel_rule_store';

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
     * Retrieve store ids
     *
     * @param int[] $ruleIds
     * @return mixed[]
     * @throws LocalizedException
     */
    public function execute(array $ruleIds): array
    {
        $storeIds = [];
        try {
            $connection = $this->resource->getConnection();
            $select = $connection->select()->from(
                $this->resource->getTableName(self::TABLE_NAME),
                ['rule_id', 'store_id']
            )->where(
                $connection->quoteInto('rule_id IN (?)', $ruleIds)
            );

            $result = $connection->fetchAll($select);
            if ($result) {
                foreach ($result as $data) {
                    $storeIds[$data['rule_id']][] = $data['store_id'];
                }
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new LocalizedException(
                __('Could not retrieve store ids by rule ids')
            );
        }
        return $storeIds;
    }
}
