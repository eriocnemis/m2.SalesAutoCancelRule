<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Api;

/**
 * Cancel orders
 *
 * @api
 */
interface CancelOrdersInterface
{
    /**
     * Cancel orders
     *
     * @return void
     */
    public function execute(): void;
}
