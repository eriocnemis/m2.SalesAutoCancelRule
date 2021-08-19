<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleSearchResultInterface;

/**
 * Find active rules by search criteria interface
 *
 * @api
 */
interface GetActiveRuleListInterface
{
    /**
     * Retrieve list of rules
     *
     * @return RuleSearchResultInterface
     */
    public function execute(): RuleSearchResultInterface;
}
