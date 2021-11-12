<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\Order\Handler;

use Magento\Framework\Exception\ConfigurationMismatchException;

/**
 * Cancel order handler pool
 */
class HandlerPool implements HandlerPoolInterface
{
    /**
     * @var HandlerInterface[]
     */
    private $handlers;

    /**
     * Initialize pool
     *
     * @param HandlerInterface[] $handlers
     * @throws ConfigurationMismatchException
     */
    public function __construct(
        array $handlers = []
    ) {
        foreach ($handlers as $handler) {
            if (!$handler instanceof HandlerInterface) {
                throw new ConfigurationMismatchException(
                    __('Cancel order handler must implement %1.', HandlerInterface::class)
                );
            }
        }
        $this->handlers = $handlers;
    }

    /**
     * Retrieve handlers
     *
     * @return HandlerInterface[]
     */
    public function getHandlers()
    {
        return $this->handlers;
    }
}
