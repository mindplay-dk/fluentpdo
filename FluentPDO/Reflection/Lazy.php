<?php

namespace FluentPDO\Reflection;

/**
 * Abstract base class for types that construct their properties
 * as late as possible, the first time they are accessed.
 */
abstract class Lazy extends Singleton
{
    /**
     * @var object[] list of properties
     */
    public $_props = array();

    /**
     * @ignore
     */
    public function __get($name)
    {
        if (! isset($this->_props[$name])) {
            $fn = "create_{$name}";

            $this->_props[$name] = $this->$fn();
        }

        return $this->_props[$name];
    }
}
