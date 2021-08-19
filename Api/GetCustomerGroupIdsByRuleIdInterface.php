<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

use Magento\Framework\Exception\LocalizedException;

/**
 * Get customer group ids by rule id interface
 *
 * @api
 */
interface GetCustomerGroupIdsByRuleIdInterface
{
    /**
     * Retrieve customer group ids
     *
     * @param int $ruleId
     * @return int[]
     * @throws LocalizedException
     */
    public function execute(int $ruleId): array;
}
