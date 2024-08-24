<?php

namespace AHAbid\AbdValidator\Tests\Rules;

use AHAbid\AbdValidator\Exceptions\ValidationRuleFailedException;
use AHAbid\AbdValidator\Rules\InList;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class InListRuleTest extends TestCase
{
    #[Test]
    public function itThrowsExceptionWhenInListRuleFails()
    {
        try {
            $rule = new InList(['a', 'b']);
            $rule->setField('text')->setValue('C');

            $rule->check();
        } catch (ValidationRuleFailedException $e) {
            $this->assertEquals('in-list', $e->rule);
            $this->assertEquals([], $e->ruleParams);
            $this->assertEquals('text does not match value in list', $e->getMessage());

            return;
        }

        $this->fail('Validation rule failed to validated');
    }

    #[Test]
    public function itPassesWhenInListRuleGetsValidValue()
    {
        $rule = new InList(['a', 'b']);
        $rule->setField('text')->setValue('a');

        $this->assertTrue($rule->check(), 'Validation rule passed');
    }
}
