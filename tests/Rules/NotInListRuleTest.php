<?php

namespace AHAbid\AbdValidator\Tests\Rules;

use AHAbid\AbdValidator\Exceptions\ValidationRuleFailedException;
use AHAbid\AbdValidator\Rules\NotInList;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class NotInListRuleTest extends TestCase
{
    #[Test]
    public function itThrowsExceptionWhenNotInListRuleFails()
    {
        try {
            $rule = new NotInList(['a', 'b']);
            $rule->setField('text')->setValue('a');

            $rule->check();
        } catch (ValidationRuleFailedException $e) {
            $this->assertEquals('in-list', $e->rule);
            $this->assertEquals([], $e->ruleParams);
            $this->assertEquals('text has value matching in list', $e->getMessage());

            return;
        }

        $this->fail('Validation rule failed to validated');
    }

    #[Test]
    public function itPassesWhenNotInListRuleGetsValidValue()
    {
        $rule = new NotInList(['a', 'b']);
        $rule->setField('text')->setValue('c');

        $this->assertTrue($rule->check(), 'Validation rule passed');
    }
}
