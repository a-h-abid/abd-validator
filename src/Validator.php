<?php

namespace AHAbid\AbdValidator;

use AHAbid\AbdValidator\Exceptions\ValidationRuleFailedException;
use AHAbid\AbdValidator\Rules\RuleInterface;

class Validator
{
    protected array $validationErrors = [];

    public function __construct(
        public readonly array $data,

        /**
         * @var array<string, RuleInterface[]>
         */
        public readonly array $fieldRules,
    ) {
    }

    public function validate()
    {
        foreach ($this->fieldRules as $field => $rules) {
            $this->checkFieldRules($field, $rules);
        }

        return $this->validationErrors;
    }

    private function checkFieldRules(string $field, array $rules)
    {
        foreach ($rules as $rule) {
            try {
                $this->checkAndProcessFieldRule($field, $rule);
            } catch (ValidationRuleFailedException $e) {
                $this->validationErrors[$field][] = [
                    'rule' => $e->rule,
                    'ruleParams' => $e->ruleParams,
                    'message' => $e->getMessage(),
                ];

                if ($e->stopOnFail) {
                    break;
                }
            }
        }
    }

    private function checkAndProcessFieldRule(string $field, RuleInterface $rule)
    {
        $rule->setField($field)->setValue($this->data[$field]);

        $rule->check();
    }
}
