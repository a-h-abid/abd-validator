<?php

namespace AHAbid\AbdValidator\Tests;

use AHAbid\AbdValidator\Rules\Required;
use AHAbid\AbdValidator\Validator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    #[Test]
    public function itCanValidateDataAndProvideErrorDetails()
    {
        $data = [
            'text' => '',
        ];

        $rules = [
            'text' => [new Required],
        ];

        $result = (new Validator($data, $rules))->validate();

        $this->assertArrayHasKey('text', $result);
        $this->assertCount(1, $result);
        $this->assertArrayHasKey('rule', $result['text'][0]);
        $this->assertArrayHasKey('ruleParams', $result['text'][0]);
        $this->assertArrayHasKey('message', $result['text'][0]);
        $this->assertEquals('required', $result['text'][0]['rule']);
        $this->assertEmpty($result['text'][0]['ruleParams']);
        $this->assertEquals('text is required', $result['text'][0]['message']);
    }
}
