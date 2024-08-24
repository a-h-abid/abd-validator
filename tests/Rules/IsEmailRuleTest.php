<?php

namespace AHAbid\AbdValidator\Tests\Rules;

use AHAbid\AbdValidator\Exceptions\ValidationRuleFailedException;
use AHAbid\AbdValidator\Rules\IsEmail;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class IsEmailRuleTest extends TestCase
{
    #[Test]
    #[DataProvider('invalidEmailData')]
    public function itThrowsExceptionWhenIsEmailRuleFails($value)
    {
        try {
            $rule = new IsEmail();
            $rule->setField('email')->setValue($value);

            $rule->check();
        } catch (ValidationRuleFailedException $e) {
            $this->assertEquals('required', $e->rule);
            $this->assertEquals([], $e->ruleParams);
            $this->assertEquals('email is not valid', $e->getMessage());

            return;
        }

        $this->fail('Validation rule failed to validated for: ' . $value);
    }

    #[Test]
    public function itPassesWhenIsEmailRuleGetsValidValue()
    {
        $rule = new IsEmail();
        $rule->setField('email')->setValue('test@example.com');

        $this->assertTrue($rule->check(), 'Validation rule passed');
    }

    public static function invalidEmailData(): array
    {
        return [
            ['Invalid'],
            ['in-valid'],
            ['@'],
            ['x@y'],
            ['123'],
        ];
    }
}
