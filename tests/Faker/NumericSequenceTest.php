<?php

namespace Dlnsk\Faker\Tests;

use Dlnsk\Faker\SequenceProvider;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class NumericSequenceTest extends TestCase
{

    /**
     * @var Generator
     */
    private $faker;

    protected function setUp(): void
    {
        $faker = Factory::create();
        $faker->addProvider(new SequenceProvider($faker));
        $this->faker = $faker;
    }

    public function testIncrementing(): void
    {
    }

}
