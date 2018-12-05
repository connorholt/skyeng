<?php declare(strict_types = 1);

namespace Summator;

/**
 * Class ArrayAccessTrait
 *
 * @package Summator
 */
trait ArrayAccessTrait
{
    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[ $offset ] = $value;
        }
    }

    /**
     * @param $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->container[ $offset ]);
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->container[ $offset ]);
    }

    /**
     * @param $offset
     *
     * @return null
     */
    public function offsetGet($offset)
    {
        return isset($this->container[ $offset ])
            ? $this->container[ $offset ]
            : null;
    }
}