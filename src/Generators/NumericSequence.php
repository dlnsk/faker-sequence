<?php

namespace Dlnsk\Faker\Generators;

class NumericSequence implements SequenceInterface
{
    private $start;
    private $step;
    private $bound;
    private $current;


    public function __construct($start = 0, $step = 1, $bound = null)
    {
        $this->start = $start;
        $this->step = $step;
        $this->bound = $bound;
        $this->current = $start;
    }

    public function resetPointer()
    {
        $this->current = $this->start;
    }

    public function getNext()
    {
        $result = $this->current;
        $this->current += $this->step;
        if (!is_null($this->bound)) {
            $this->current = ($this->bound > 0 && $this->current > $this->bound) ? $this->start : $this->current;
            $this->current = ($this->bound < 0 && $this->current < $this->bound) ? $this->start : $this->current;
        }

        return $result;
    }
}