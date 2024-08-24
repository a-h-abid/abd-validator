<?php

namespace AHAbid\AbdValidator\Rules;

use AHAbid\AbdValidator\ValidationRuleFailedException;

interface RuleInterface
{
    /**
     * @throws ValidationRuleFailedException
     */
    public function check(): true;

    public function setField(string $field): static;

    public function setValue(mixed $value): static;
}
