<?php

namespace Jonczek\Tax\Repository;

use ArrayIterator;
use Traversable;

/**
 * GenericRepository
 */
class GenericRepository implements \IteratorAggregate
{
    /**
     * @var array<object>|object[]
     */
    protected $container;

    /**
     * TaxRepository constructor.
     */
    public function __construct()
    {
        $this->container = [];
    }

    /**
     * @param object $entry
     */
    public function add(object $entry)
    {
        $this->container[] = $entry;
    }

    /**
     * @param object $entry
     */
    public function update(object $entry)
    {
        if (($key = array_search($entry, $this->container)) !== false) {
            $this->container[$key] = $entry;
        }
    }

    /**
     * @param object $entry
     */
    public function delete(object $entry)
    {
        if (($key = array_search($entry, $this->container)) !== false) {
            unset($this->container[$key]);
        }
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new ArrayIterator($this->container);
    }
}