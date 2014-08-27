<?php

namespace FluentPDO\Reflection;

class TableView
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $class_name;

    /**
     * @var ColumnView[]
     */
    public $columns;

    /**
     * @param string $name
     * @param string $class_name
     * @param ColumnView[] $columns
     */
    public function __construct($name, $class_name, $columns)
    {
        $this->name = $name;
        $this->class_name = $class_name;
        $this->columns = $columns;
    }
}
