<?php

namespace Dlnsk\Faker;


use Dlnsk\Faker\Exceptions\NonIterableException;
use Dlnsk\Faker\Generators\IterableSequence;
use Dlnsk\Faker\Generators\NumericSequence;
use Faker\Provider\Base;

class SequenceProvider extends Base
{
    private $sequences = [];

    /**
     * @throws NonIterableException
     */
    public function initSequence(string $name, ...$args)
    {
        if (!isset($args[0]) || is_int($args[0])) {
            $this->sequences[$name] = new NumericSequence(...$args);
            return;
        }

        if (is_array($args[0]) || method_exists($args[0], 'getIterator')) {
            $this->sequences[$name] = new IterableSequence(...$args);
        } else {
            throw new NonIterableException();
        }
    }

    public function nextInSequence(string $name) {
        if (!isset($this->sequences[$name])) {
            $this->initSequence($name);
        }

        return $this->sequences[$name]->getNext();
    }

    public function resetSequence(string $name) {
        if (isset($this->sequences[$name])) {
            $this->sequences[$name]->resetPointer();
        }
    }

}
