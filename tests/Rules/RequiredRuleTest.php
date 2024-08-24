<?php

namespace AHAbid\AbdValidator\Tests\Rules;

use AHAbid\AbdValidator\Exceptions\ValidationRuleFailedException;
use AHAbid\AbdValidator\Rules\Required;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RequiredRuleTest extends TestCase
{
    #[Test]
    public function itThrowsExceptionWhenRequiredRuleFails()
    {
        try {
            $rule = new Required();
            $rule->setField('text')->setValue('');

            $rule->check();
        } catch (ValidationRuleFailedException $e) {
            $this->assertEquals('required', $e->rule);
            $this->assertEquals([], $e->ruleParams);
            $this->assertEquals('text is required', $e->getMessage());

            return;
        }

        $this->fail('Validation rule failed to validated');
    }

    #[Test]
    public function itStopsProcessingFurtherWhenRequiredRuleFails()
    {
        try {
            $rule = new Required();
            $rule->setField('text')->setValue('');

            $rule->check();
        } catch (ValidationRuleFailedException $e) {
            $this->assertTrue($e->stopOnFail);

            return;
        }

        $this->fail('Validation rule failed to validated');
    }

    #[Test]
    public function itPassesWhenRequiredRuleGetsValidValue()
    {
        $rule = new Required();
        $rule->setField('text')->setValue('filled');

        $this->assertTrue($rule->check(), 'Validation rule passed');
    }
}
