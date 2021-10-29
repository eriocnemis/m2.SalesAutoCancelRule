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
use Eriocnemis\SalesAutoCancelRule\Model\System\Config\Source\Status as StatusSource;

/**
 * Check that status is valid
 */
class StatusValidator implements ValidatorInterface
{
    /**
     * @var ValidationResultFactory
     */
    private $validationResultFactory;

    /**
     * @var StatusSource
     */
    private $statusSource;

    /**
     * Initialize validator
     *
     * @param ValidationResultFactory $validationResultFactory
     * @param StatusSource $statusSource
     */
    public function __construct(
        ValidationResultFactory $validationResultFactory,
        StatusSource $statusSource
    ) {
        $this->validationResultFactory = $validationResultFactory;
        $this->statusSource = $statusSource;
    }

    /**
     * Validate status
     *
     * @param RuleInterface $rule
     * @return ValidationResult
     */
    public function validate(RuleInterface $rule): ValidationResult
    {
        $errors = [];
        $units = array_column($this->statusSource->toOptionArray(), 'value');
        $unit = $rule->getStatus();

        if (!in_array($unit, $units)) {
            $errors[] = __('Value for status contains incorrect value.');
        }
        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}
