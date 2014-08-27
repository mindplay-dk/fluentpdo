<?php

namespace FluentPDO\Reflection;

/**
 * Abstract base class for a static reflection of tables in a database.
 */
abstract class Database extends Lazy
{
    /**
     * @ignore
     */
    public function __get($name)
    {
        return $this->$name;
    }
}
