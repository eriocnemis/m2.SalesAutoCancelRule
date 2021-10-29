<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\ResourceModel;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\CouldNotSaveException;
use Eriocnemis\SalesAutoCancelRule\Api\AttachStoreToRuleInterface;

/**
 * Attach stores to rule
 */
class AttachStoreToRule implements AttachStoreToRuleInterface
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
     * Attach stores
     *
     * @param int[] $storeIds
     * @param int $ruleId
     * @return void
     * @throws CouldNotSaveException
     */
    public function execute(array $storeIds, int $ruleId): void
    {
        try {
            $data = [];
            foreach ($storeIds as $storeId) {
                $data[] = [
                    'rule_id' => $ruleId,
                    'store_id' => $storeId
                ];
            }

            if ($data) {
                $this->resource->getConnection()->insertOnDuplicate(
                    $this->resource->getTableName(self::TABLE_NAME),
                    $data
                );
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new CouldNotSaveException(
                __('Could not attach store to rule with id %id', ['id' => $ruleId])
            );
        }
    }
}
