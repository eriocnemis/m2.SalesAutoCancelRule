<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\ResourceModel\Rule;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Eriocnemis\SalesAutoCancelRule\Model\ResourceModel\Rule as RuleResource;
use Eriocnemis\SalesAutoCancelRule\Model\Rule;

/**
 * Rule collection
 */
class Collection extends AbstractCollection
{
    /**
     * Identifier field name for collection items
     *
     * @var string
     */
    protected $_idFieldName = 'rule_id';

    /**
     * Name prefix of events that are dispatched by model
     *
     * @var string
     */
    protected $_eventPrefix = 'eriocnemis_sales_autocancel_rule_collection';

    /**
     * Name of event parameter
     *
     * @var string
     */
    protected $_eventObject = 'collection';

    /**
     * initialize entity and resource
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Rule::class, RuleResource::class);
    }
}
