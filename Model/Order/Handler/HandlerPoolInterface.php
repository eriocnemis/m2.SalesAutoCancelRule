<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\Order\Handler;

/**
 * Cancel order handler pool interface
 */
interface HandlerPoolInterface
{
    /**
     * Retrieve handlers
     *
     * @return HandlerInterface[]
     */
    public function getHandlers();
}
