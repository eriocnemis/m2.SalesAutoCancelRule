<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

use Magento\Framework\Exception\CouldNotDeleteException;

/**
 * Detach shipping methods from rule
 *
 * @api
 */
interface DetachMethodFromRuleInterface
{
    /**
     * Detach shipping methods
     *
     * @param int $ruleId
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $ruleId): void;
}
