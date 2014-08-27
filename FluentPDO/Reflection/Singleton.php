<?php

namespace FluentPDO\Reflection;

/**
 * Abstract base class for singleton types
 */
abstract class Singleton
{
    /**
     * @return static singleton instance
     */
    static public function instance()
    {
        /**
         * @var self $instance
         * @var self[] $instances
         */

        static $instances = array();

        $type = get_called_class();

        if (! isset($instances[$type])) {
            $instance = new $type();
            $instance->init();

            $instances[$type] = $instance;
        }

        return $instances[$type];
    }
}
