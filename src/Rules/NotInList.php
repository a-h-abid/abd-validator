<?php

namespace AHAbid\AbdValidator\Rules;

use AHAbid\AbdValidator\Exceptions\ValidationRuleFailedException;

class NotInList implements RuleInterface
{
    protected string $field;

    protected mixed $value;

    public function __construct(
        /** @param array<int, string> $haystack */
        public readonly array $haystack,
    ) {
    }

    public function check(): true
    {
        if (!in_array($this->value, $this->haystack)) {
            return true;
        }

        throw new ValidationRuleFailedException(
            field: $this->field,
            rule: 'in-list',
            stopOnFail: true,
            message: $this->field . ' has value matching in list',
        );
    }

    public function setField(string $field): static
    {
        $this->field = $field;

        return $this;
    }

    public function setValue(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }
}
