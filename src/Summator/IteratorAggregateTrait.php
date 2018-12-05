<?php

namespace Summator;

/**
 * Class IteratorAggregateTrait
 *
 * @package Summator
 */
trait IteratorAggregateTrait
{
    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->container);
    }
}