<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Eriocnemis\SalesAutoCancelRule\Model\DeleteRuleById;
use Eriocnemis\SalesAutoCancelRule\Model\ResourceModel\Rule as RuleResource;
use Eriocnemis\SalesAutoCancelRule\Model\RuleFactory;
use Eriocnemis\SalesAutoCancelRule\Model\Rule;

/**
 * Delete rule by id
 */
class DeleteRuleByIdTest extends TestCase
{
    /**
     * @var DeleteRuleById
     */
    private $deleteRuleById;

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
    protected function setUp(): void
    {
        $resource = $this->createMock(RuleResource::class);
        $ruleFactory = $this->createMock(RuleFactory::class);

        $objectManager = new ObjectManager($this);
        /** @var DeleteRuleById $deleteRuleById */
        $deleteRuleById = $objectManager->getObject(
            DeleteRuleById::class,
            [
                'resource' => $resource,
                'factory' => $ruleFactory
            ]
        );

        $this->resource = $resource;
        $this->ruleFactory = $ruleFactory;
        $this->deleteRuleById = $deleteRuleById;
    }

    /**
     * Test get rule by id
     *
     * @return void
     * @test
     */
    public function execute()
    {
        $rule = $this->createMock(Rule::class);

        $this->ruleFactory->expects($this->once())
            ->method('create')
            ->willReturn($rule);

        $this->resource->expects($this->once())
            ->method('load')
            ->willReturnSelf();

        $rule->expects($this->once())
            ->method('getId')
            ->willReturn(10);

        $this->resource->expects($this->once())
            ->method('delete');

        $this->assertTrue($this->deleteRuleById->execute(10));
    }
}
