<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

use Magento\Framework\Exception\LocalizedException;

/**
 * Get customer group ids by rule ids
 *
 * @api
 */
interface GetCustomerGroupIdsByRuleIdsInterface
{
    /**
     * Retrieve customer group ids
     *
     * @param int[] $ruleIds
     * @return mixed[]
     * @throws LocalizedException
     */
    public function execute(array $ruleIds): array;
}
