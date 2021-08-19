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
use Eriocnemis\SalesAutoCancelRule\Api\AttachMethodToRuleInterface;

/**
 * Attach payment methods to rule
 */
class AttachMethodToRule implements AttachMethodToRuleInterface
{
    /**
     * Shipping methods relation table name
     */
    private const TABLE_NAME = 'eriocnemis_sales_autocancel_rule_payment';

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
     * Attach payment methods
     *
     * @param string[] $methods
     * @param int $ruleId
     * @return void
     * @throws CouldNotSaveException
     */
    public function execute(array $methods, int $ruleId): void
    {
        try {
            $data = [];
            foreach ($methods as $method) {
                $data[] = [
                    'rule_id' => $ruleId,
                    'payment_method' => $method
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
                __('Could not attach payment methods to rule with id %id', ['id' => $ruleId])
            );
        }
    }
}
