<?php

namespace AHAbid\AbdValidator\Rules;

use AHAbid\AbdValidator\Exceptions\ValidationRuleFailedException;

class IsEmail implements RuleInterface
{
    protected string $field;

    protected mixed $value;

    public function check(): true
    {
        if ($v = filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        throw new ValidationRuleFailedException(
            field: $this->field,
            rule: 'required',
            stopOnFail: true,
            message: $this->field . ' is not valid',
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
