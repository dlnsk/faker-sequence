<?php

namespace Dlnsk\Faker\Generators;

use ArrayObject;
use Dlnsk\Faker\Exceptions\NoMoreException;

class IterableSequence implements SequenceInterface
{
    private $collection;
    private $iterator;
    private $loop;


    public function __construct($collection, $loop = false)
    {
        if (is_array($collection)) {
            $this->collection = new ArrayObject($collection);
            $this->iterator = $this->collection->getIterator();
        } else {
            $this->collection = $collection;
        }
        $this->loop = $loop;
    }

    public function resetPointer()
    {
        $this->iterator->rewind();
    }

    /**
     * @throws NoMoreException
     */
    public function getNext()
    {
        if (!$this->iterator->valid()) {
            if ($this->loop) {
                $this->resetPointer();
            } else {
                throw new NoMoreException();
            }
        }
        $result = $this->iterator->current();
        $this->iterator->next();

        return $result;
    }
}