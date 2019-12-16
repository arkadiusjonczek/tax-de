<?php

namespace Jonczek\Tax\Repository;

use Traversable;

/**
 * SimpleRepository
 */
class SimpleRepository implements \IteratorAggregate
{
    /**
     * @var array
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
     * @param $entry
     */
    public function add($entry)
    {
        $this->container[] = $entry;
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
        yield from $this->container;
    }
}