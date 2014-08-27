<?php

namespace FluentPDO\Reflection;

/**
 * Abstract base class for types of columns.
 *
 * @property-read string $name column name
 */
abstract class Column
{
    /**
     * @var Table parent table
     */
    protected $table;

    /**
     * @param Table $table parent table
     */
    public function __construct(Table $table)
    {
        $this->table = $table;

        $this->init();
    }

    /**
     * Initialize the object upon construction
     *
     * @return void
     */
    abstract public function init();

    /**
     * @ignore
     */
    public function __get($name)
    {
        return $this->$name;
    }
}
