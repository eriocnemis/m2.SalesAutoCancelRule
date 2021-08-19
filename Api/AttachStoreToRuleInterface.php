<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Attach stores to rule
 *
 * @api
 */
interface AttachStoreToRuleInterface
{
    /**
     * Attach stores
     *
     * @param int[] $storeIds
     * @param int $ruleId
     * @return void
     * @throws CouldNotSaveException
     */
    public function execute(array $storeIds, int $ruleId): void;
}
