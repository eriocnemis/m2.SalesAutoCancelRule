<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\Order\Filter;

use Magento\Framework\Exception\ConfigurationMismatchException;

/**
 * Cancel order filter pool
 */
class FilterPool implements FilterPoolInterface
{
    /**
     * @var FilterInterface[]
     */
    private $filters;

    /**
     * Initialize pool
     *
     * @param FilterInterface[] $filters
     * @throws ConfigurationMismatchException
     */
    public function __construct(
        array $filters = []
    ) {
        foreach ($filters as $filter) {
            if (!$filter instanceof FilterInterface) {
                throw new ConfigurationMismatchException(
                    __('Cancel order filter must implement %1.', FilterInterface::class)
                );
            }
        }
        $this->filters = $filters;
    }

    /**
     * Retrieve filters
     *
     * @return FilterInterface[]
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
