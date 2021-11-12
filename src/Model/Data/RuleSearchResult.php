<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\Data;

use Magento\Framework\Api\SearchResults;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleSearchResultInterface;

/**
 * Search result
 *
 * @api
 */
class RuleSearchResult extends SearchResults implements RuleSearchResultInterface
{
}
