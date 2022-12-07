<?php

namespace Dlnsk\Faker;


use Dlnsk\Faker\Generators\NumericSequence;
use Faker\Provider\Base;

class SequenceProvider extends Base
{
    private $sequences = [];

    public function initSequence(string $name, ...$args)
    {
        if (!isset($args[0]) || is_int($args[0])) {
            $this->sequences[$name] = new NumericSequence(...$args);
        }
    }

    public function nextInSequence(string $name) {
        return $this->sequences[$name]->getNext();
    }

}
