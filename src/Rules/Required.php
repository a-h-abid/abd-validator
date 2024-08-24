<?php

namespace AHAbid\AbdValidator\Rules;

use AHAbid\AbdValidator\Exceptions\ValidationRuleFailedException;

class Required implements RuleInterface
{
    protected string $field;

    protected mixed $value;

    public function check(): true
    {
        if (!empty($this->value)) {
            return true;
        }

        throw new ValidationRuleFailedException(
            field: $this->field,
            rule: 'required',
            stopOnFail: true,
            message: $this->field . ' is required',
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
