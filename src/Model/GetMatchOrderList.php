<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Api\OrderRepositoryInterfaceFactory;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;
use Eriocnemis\SalesAutoCancelRule\Api\GetMatchOrderListInterface;
use Eriocnemis\SalesAutoCancelRule\Model\Order\Filter\FilterPoolInterface;

/**
 * Find orders by search criteria
 *
 * @api
 */
class GetMatchOrderList implements GetMatchOrderListInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var OrderRepositoryInterfaceFactory
     */
    private $orderRepositoryFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var FilterPoolInterface
     */
    private $filterPool;

    /**
     * Initialize provider
     *
     * @param CollectionProcessorInterface $collectionProcessor
     * @param OrderRepositoryInterfaceFactory $orderRepositoryFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterPoolInterface $filterPool
     */
    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        OrderRepositoryInterfaceFactory $orderRepositoryFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterPoolInterface $filterPool
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->orderRepositoryFactory = $orderRepositoryFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterPool = $filterPool;
    }

    /**
     * Retrieve list of orders
     *
     * @param RuleInterface $rule
     * @return OrderSearchResultInterface
     */
    public function execute(RuleInterface $rule): OrderSearchResultInterface
    {
        foreach ($this->filterPool->getFilters() as $filter) {
            $filter->apply($this->searchCriteriaBuilder, $rule);
        }

        $orderRepository = $this->orderRepositoryFactory->create(
            ['collectionProcessor' => $this->collectionProcessor]
        );

        return $orderRepository->getList(
            $this->searchCriteriaBuilder->create()
        );
    }
}
