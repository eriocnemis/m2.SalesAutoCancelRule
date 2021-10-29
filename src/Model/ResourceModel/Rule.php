<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Rule resource
 */
class Rule extends AbstractDb
{
    /**
     * Constructor adds unique fields
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('eriocnemis_sales_autocancel_rule', 'rule_id');
    }
}
