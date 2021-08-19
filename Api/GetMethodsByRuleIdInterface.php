<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

use Magento\Framework\Exception\LocalizedException;

/**
 * Get payment methods by rule id interface
 *
 * @api
 */
interface GetMethodsByRuleIdInterface
{
    /**
     * Retrieve payment methods
     *
     * @param int $ruleId
     * @return string[]
     * @throws LocalizedException
     */
    public function execute(int $ruleId): array;
}
