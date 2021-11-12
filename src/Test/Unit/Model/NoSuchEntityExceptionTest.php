<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Eriocnemis\SalesAutoCancelRule\Model\GetRuleById;
use Eriocnemis\SalesAutoCancelRule\Model\ConvertRuleToData;
use Eriocnemis\SalesAutoCancelRule\Model\ResourceModel\Rule as RuleResource;
use Eriocnemis\SalesAutoCancelRule\Model\RuleFactory;
use Eriocnemis\SalesAutoCancelRule\Model\Rule;

/**
 * Get rule by id with exception test
 */
class NoSuchEntityExceptionTest extends TestCase
{
    /**
     * @var GetRuleById
     */
    private $getRuleById;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $ruleFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $resource;

    /**
     * This method is called before a test is executed
     *
     * @return void
     */
    protected function setUp()
    {
        $resource = $this->createMock(RuleResource::class);
        $ruleFactory = $this->createMock(RuleFactory::class);
        $convertRuleToData = $this->createMock(ConvertRuleToData::class);

        $objectManager = new ObjectManager($this);
        /** @var GetRuleById $getRuleById */
        $getRuleById = $objectManager->getObject(
            GetRuleById::class,
            [
                'resource' => $resource,
                'convertRuleToData' => $convertRuleToData,
                'factory' => $ruleFactory
            ]
        );

        $this->resource = $resource;
        $this->ruleFactory = $ruleFactory;
        $this->getRuleById = $getRuleById;
    }

    /**
     * Test get rule by id
     *
     * @return void
     * @test
     */
    public function execute()
    {
        $this->expectException(NoSuchEntityException::class);

        $rule = $this->createMock(Rule::class);
        $this->ruleFactory->expects($this->once())
            ->method('create')
            ->willReturn($rule);

        $this->resource->expects($this->once())
            ->method('load')
            ->willReturnSelf();

        $rule->expects($this->once())
            ->method('getId')
            ->willReturn(null);

        $this->getRuleById->execute(10);
    }
}
