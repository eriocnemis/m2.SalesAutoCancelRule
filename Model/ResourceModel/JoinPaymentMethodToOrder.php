<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\ResourceModel;

use Magento\Framework\Api\SearchCriteria\CollectionProcessor\JoinProcessor\CustomJoinInterface;
use Magento\Framework\Data\Collection\AbstractDb;

/**
 * Join payment method
 */
class JoinPaymentMethodToOrder implements CustomJoinInterface
{
    /**
     * Store relation table name
     */
    private const TABLE_NAME = 'sales_order_payment';

    /**
     * Make custom joins to collection
     *
     * @param AbstractDb $collection
     * @return bool
     */
    public function apply(AbstractDb $collection)
    {
        $collection->getSelect()->joinLeft(
            [self::TABLE_NAME => $collection->getResource()->getTable(self::TABLE_NAME)],
            'main_table.entity_id = ' . self::TABLE_NAME . '.parent_id',
            []
        );
        return true;
    }
}
