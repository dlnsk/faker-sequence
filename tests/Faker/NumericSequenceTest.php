<?php

namespace Dlnsk\Faker\Tests;

use Dlnsk\Faker\Exceptions\NoMoreException;
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

    public function testInitializingWithoutParams(): void
    {
        $this->faker->initSequence('test');

        $this->assertEquals(0, $this->faker->nextInSequence('test'));
        $this->assertEquals(1, $this->faker->nextInSequence('test'));
        $this->assertEquals(2, $this->faker->nextInSequence('test'));
    }

    public function testUsingWithoutInitialization(): void
    {
        $this->assertEquals(0, $this->faker->nextInSequence('test'));
        $this->assertEquals(1, $this->faker->nextInSequence('test'));
    }

    public function testStartValue(): void
    {
        $this->faker->initSequence('test', 100);

        $this->assertEquals(100, $this->faker->nextInSequence('test'));
    }

    public function testCustomStep(): void
    {
        $this->faker->initSequence('test', 1, 10);

        $this->assertEquals(1, $this->faker->nextInSequence('test'));
        $this->assertEquals(11, $this->faker->nextInSequence('test'));
        $this->assertEquals(21, $this->faker->nextInSequence('test'));
    }

    public function testNegativeStep(): void
    {
        $this->faker->initSequence('test', 10, -2);

        $this->assertEquals(10, $this->faker->nextInSequence('test'));
        $this->assertEquals(8, $this->faker->nextInSequence('test'));
        $this->assertEquals(6, $this->faker->nextInSequence('test'));
    }

    public function testPositiveBound(): void
    {
        $this->faker->initSequence('test', 0, 2, 5);
        $this->expectException(NoMoreException::class);

        $this->assertEquals(0, $this->faker->nextInSequence('test'));
        $this->assertEquals(2, $this->faker->nextInSequence('test'));
        $this->assertEquals(4, $this->faker->nextInSequence('test'));

        $this->faker->nextInSequence('test');
    }

    public function testNegativeBound(): void
    {
        $this->faker->initSequence('test', 0, -2, -5);
        $this->expectException(NoMoreException::class);

        $this->assertEquals(0, $this->faker->nextInSequence('test'));
        $this->assertEquals(-2, $this->faker->nextInSequence('test'));
        $this->assertEquals(-4, $this->faker->nextInSequence('test'));

        $this->faker->nextInSequence('test');
    }

    public function testPositiveBoundWithLoop(): void
    {
        $this->faker->initSequence('test', 0, 2, 5, true);

        $this->assertEquals(0, $this->faker->nextInSequence('test'));
        $this->assertEquals(2, $this->faker->nextInSequence('test'));
        $this->assertEquals(4, $this->faker->nextInSequence('test'));
        $this->assertEquals(0, $this->faker->nextInSequence('test'));
    }

    public function testNegativeBoundWithLoop(): void
    {
        $this->faker->initSequence('test', 0, -2, -5, true);

        $this->assertEquals(0, $this->faker->nextInSequence('test'));
        $this->assertEquals(-2, $this->faker->nextInSequence('test'));
        $this->assertEquals(-4, $this->faker->nextInSequence('test'));
        $this->assertEquals(0, $this->faker->nextInSequence('test'));
    }

    public function testReset(): void
    {
        $this->faker->nextInSequence('test');
        $this->faker->nextInSequence('test');

        $this->faker->resetSequence('test');

        $this->assertEquals(0, $this->faker->nextInSequence('test'));
    }

}
