<?php

namespace AHAbid\AbdValidator\Exceptions;

class ValidationRuleFailedException extends \Exception
{
    public function __construct(
        public readonly string $field,
        public readonly string $rule,
        public readonly array $ruleParams = [],
        public readonly bool $stopOnFail = false,
        string $message = "",
        int $code = 422,
        \Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
