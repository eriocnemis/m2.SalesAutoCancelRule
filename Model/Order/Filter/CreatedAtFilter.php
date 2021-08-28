<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\Order\Filter;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\Stdlib\DateTime\DateTime as Date;
use Magento\Sales\Api\Data\OrderInterface;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;

/**
 * Created at field filter
 */
class CreatedAtFilter implements FilterInterface
{
    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @var Date
     */
    private $date;

    /**
     * Initialize filter
     *
     * @param DateTime $dateTime
     * @param Date $date
     */
    public function __construct(
        DateTime $dateTime,
        Date $date
    ) {
        $this->dateTime = $dateTime;
        $this->date = $date;
    }

    /**
     * Apply filter
     *
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RuleInterface $rule
     * @return void
     */
    public function apply(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RuleInterface $rule
    ): void {
        $unit = (int)$rule->getDurationUnit();
        $duration = (int)$rule->getDuration();

        if ($unit && $duration) {
            $searchCriteriaBuilder->addFilter(
                OrderInterface::CREATED_AT,
                $this->dateTime->formatDate(
                    (string)($this->date->gmtTimestamp() - 3600 * $unit * $duration)
                ),
                'lteq'
            );
        }
    }
}
