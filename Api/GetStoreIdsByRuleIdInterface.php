<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

use Magento\Framework\Exception\LocalizedException;

/**
 * Get store ids by rule id
 *
 * @api
 */
interface GetStoreIdsByRuleIdInterface
{
    /**
     * Retrieve store ids
     *
     * @param int $ruleId
     * @return int[]
     * @throws LocalizedException
     */
    public function execute(int $ruleId): array;
}
