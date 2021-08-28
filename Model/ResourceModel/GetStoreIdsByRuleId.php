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
use Eriocnemis\SalesAutoCancelRule\Api\GetStoreIdsByRuleIdInterface;

/**
 * Get store ids
 */
class GetStoreIdsByRuleId implements GetStoreIdsByRuleIdInterface
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
     * @param int $ruleId
     * @return int[]
     * @throws LocalizedException
     */
    public function execute(int $ruleId): array
    {
        $storeIds = [];
        try {
            $connection = $this->resource->getConnection();
            $select = $connection->select()->from(
                $this->resource->getTableName(self::TABLE_NAME),
                ['store_id']
            )->where('rule_id = ?', (string)$ruleId);

            $result = $connection->fetchCol($select);
            if ($result) {
                $storeIds = $result;
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new LocalizedException(
                __('Could not retrieve store ids by rule with id %id', ['id' => $ruleId])
            );
        }
        return $storeIds;
    }
}
