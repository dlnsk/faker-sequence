<?php

namespace Dlnsk\Faker\Tests;

use Dlnsk\Faker\Exceptions\NoMoreException;
use Dlnsk\Faker\Exceptions\NonIterableException;
use Dlnsk\Faker\SequenceProvider;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class IterableSequenceTest extends TestCase
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

    public function testArray(): void
    {
        $this->faker->initSequence('test', ['one', 'two', 'three']);

        $this->assertEquals('one', $this->faker->nextInSequence('test'));
        $this->assertEquals('two', $this->faker->nextInSequence('test'));
        $this->assertEquals('three', $this->faker->nextInSequence('test'));
    }

    public function testArrayNotLooped(): void
    {
        $this->faker->initSequence('test', ['one', 'two', 'three']);
        $this->expectException(NoMoreException::class);

        $this->assertEquals('one', $this->faker->nextInSequence('test'));
        $this->assertEquals('two', $this->faker->nextInSequence('test'));
        $this->assertEquals('three', $this->faker->nextInSequence('test'));

        $this->faker->nextInSequence('test');
    }

    public function testArrayLooped(): void
    {
        $this->faker->initSequence('test', ['one', 'two', 'three'], true);

        $this->assertEquals('one', $this->faker->nextInSequence('test'));
        $this->assertEquals('two', $this->faker->nextInSequence('test'));
        $this->assertEquals('three', $this->faker->nextInSequence('test'));

        $this->assertEquals('one', $this->faker->nextInSequence('test'));
    }

    public function testReset(): void
    {
        $this->faker->initSequence('test', ['one', 'two', 'three']);
        $this->faker->nextInSequence('test');
        $this->faker->nextInSequence('test');

        $this->faker->resetSequence('test');

        $this->assertEquals('one', $this->faker->nextInSequence('test'));
    }

    public function testNonIterable(): void
    {
        $this->expectException(NonIterableException::class);

        $this->faker->initSequence('test', new \DateTime());
    }
}
