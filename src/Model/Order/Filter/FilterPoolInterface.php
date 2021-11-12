<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\Order\Filter;

/**
 * Cancel order filter pool interface
 */
interface FilterPoolInterface
{
    /**
     * Retrieve filters
     *
     * @return FilterInterface[]
     */
    public function getFilters();
}
