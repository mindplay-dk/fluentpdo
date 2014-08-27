<?php

namespace FluentPDO\Reflection;

/**
 * Abstract base class for a static reflection of columns in a table.
 */
abstract class Table extends Lazy
{
    /**
     * @var Table parent database
     */
    protected $database;

    /**
     * @param Table $database parent database
     */
    public function __construct(Table $database)
    {
        $this->database = $database;

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
