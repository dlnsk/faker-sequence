<?php

namespace Dlnsk\Faker\Generators;

use Dlnsk\Faker\Exceptions\NoMoreException;

class NumericSequence implements SequenceInterface
{
    private $start;
    private $step;
    private $bound;
    private $current;
    private $loop;


    public function __construct($start = 0, $step = 1, $bound = null, $loop = false)
    {
        $this->start = $start;
        $this->step = $step;
        $this->bound = $bound;
        $this->current = $start;
        $this->loop = $loop;
    }

    public function resetPointer()
    {
        $this->current = $this->start;
    }

    /**
     * @throws NoMoreException
     */
    public function getNext()
    {
        $result = $this->current;
        $this->current += $this->step;
        if (is_int($this->bound)) {
            if ($this->loop) {
                $this->current = ($this->bound > 0 && $this->current > $this->bound) ? $this->start : $this->current;
                $this->current = ($this->bound < 0 && $this->current < $this->bound) ? $this->start : $this->current;
            } else {
                throw new NoMoreException();
            }
        }

        return $result;
    }
}