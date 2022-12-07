<?php

namespace Dlnsk\Faker\Generators;

interface SequenceInterface
{
    public function resetPointer();
    public function getNext();
}