<?php
/**
 * Copyright © Eriocnemis, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eriocnemis\SalesAutoCancelRule\Model\Rule\Validator;

use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;
use Eriocnemis\SalesAutoCancelRuleApi\Api\Data\RuleInterface;
use Eriocnemis\SalesAutoCancelRule\Model\Rule\ValidatorInterface;
use Eriocnemis\SalesAutoCancelRule\Model\System\Config\Source\DurationUnit as DurationUnitSource;

/**
 * Check that duration unit is valid
 */
class DurationUnitValidator implements ValidatorInterface
{
    /**
     * @var ValidationResultFactory
     */
    private $validationResultFactory;

    /**
     * @var DurationUnitSource
     */
    private $durationUnitSource;

    /**
     * Initialize validator
     *
     * @param ValidationResultFactory $validationResultFactory
     * @param DurationUnitSource $durationUnitSource
     */
    public function __construct(
        ValidationResultFactory $validationResultFactory,
        DurationUnitSource $durationUnitSource
    ) {
        $this->validationResultFactory = $validationResultFactory;
        $this->durationUnitSource = $durationUnitSource;
    }

    /**
     * Validate duration unit
     *
     * @param RuleInterface $rule
     * @return ValidationResult
     */
    public function validate(RuleInterface $rule): ValidationResult
    {
        $errors = [];
        $units = array_column($this->durationUnitSource->toOptionArray(), 'value');
        $unit = $rule->getDurationUnit();

        if (!in_array($unit, $units)) {
            $errors[] = __('Value for duration unit contains incorrect value.');
        }
        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}
