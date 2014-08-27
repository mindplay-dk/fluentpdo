<?php

namespace FluentPDO\Reflection;

use Aura\SqlSchema\AbstractSchema;

class ScriptView
{
    /**
     * @var AbstractSchema
     */
    public $schema;

    /**
     * @var string database name
     */
    public $database;

    /**
     * @var string
     */
    public $namespace;

    /**
     * @var TableView[]
     */
    public $tables;

    /**
     * @param AbstractSchema $schema
     * @param string $database
     * @param string $namespace
     * @param TableView[] $tables
     */
    public function __construct(AbstractSchema $schema, $database, $namespace, $tables)
    {
        $this->schema = $schema;
        $this->database = $database;
        $this->namespace = $namespace;
        $this->tables = $tables;
    }
}
