<?php

namespace FluentPDO\Reflection;

use Aura\SqlSchema\Column;

class ColumnView
{
    /**
     * @var Column
     */
    public $schema;

    /**
     * @var string php type-name
     */
    public $type;

    /**
     * @param Column $schema column schema
     * @param string $type
     */
    public function __construct(Column $schema, $type)
    {
        $this->schema = $schema;
        $this->type = $type;
    }
}
