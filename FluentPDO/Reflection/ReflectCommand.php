<?php

namespace FluentPDO\Reflection;

use PDO;
use RuntimeException;

use Aura\SqlSchema\MysqlSchema;
use Aura\SqlSchema\ColumnFactory;
use Aura\SqlSchema\AbstractSchema;
use Aura\SqlSchema\Column as ColumnSchema;

/**
 * This command generates a schema-reflection for documentation purposes.
 */
class ReflectCommand
{
    /**
     * @var string database host
     */
    public $host = '127.0.0.1';

    /**
     * @var int|null database port number
     */
    public $port = null;

    /**
     * @var string database name
     */
    public $database;

    /**
     * @var string database username
     */
    public $user;

    /**
     * @var string|null database password
     */
    public $password;

    /**
     * @var string|null namespace
     */
    public $namespace;

    /**
     * @return self command instance configured with command-line switches
     */
    public static function create()
    {
        $options = getopt('', array('host:', 'port:', 'database:', 'user:', 'password:', 'namespace:'));

        $command = new self;

        foreach ($options as $name => $value) {
            $command->$name = $value;
        }

        return $command;
    }

    /**
     * @return int command-line status code
     *
     * @throws RuntimeException on error (with status-code for command-line output)
     */
    public function run()
    {
        if (empty($this->host)) {
            throw new RuntimeException('host is required', 1);
        }
        if (empty($this->database)) {
            throw new RuntimeException('database is required', 1);
        }
        if (empty($this->user)) {
            throw new RuntimeException('user is required', 1);
        }

        $schema = $this->createSchema();

        $model = $this->createViewModel($schema);

        echo $this->render($model, 'script.php');
    }

    /**
     * @param object $model view model
     * @param string $tpl template filename (relative to "templates" folder in project root folder)
     *
     * @return string rendered template
     */
    protected function render($model, $tpl)
    {
        ob_start();

        require dirname(dirname(__DIR__)) . '/templates/' . $tpl;

        return ob_get_clean();
    }

    /**
     * @return AbstractSchema
     */
    protected function createSchema()
    {
        $db = new PDO(
            "mysql:host={$this->host};port={$this->port};dbname={$this->database}",
            $this->user,
            $this->password
        );

        $columns = new ColumnFactory();

        return new MysqlSchema($db, $columns);
    }

    /**
     * @param AbstractSchema $schema
     *
     * @return ScriptView
     */
    protected function createViewModel(AbstractSchema $schema)
    {
        /**
         * @var TableView[] $tables
         */
        $tables = array();

        foreach ($schema->fetchTableList() as $table_name) {
            $class_name = $this->database . '_' . $table_name;

            $columns = array();

            foreach ($schema->fetchTableCols($table_name) as $column_schema) {
                $columns[] = new ColumnView($column_schema, $this->getColumnType($column_schema));
            }

            $tables[] = new TableView($table_name, $class_name, $columns);
        }

        return new ScriptView($schema, $this->database, $this->namespace, $tables);
    }

    /**
     * @param ColumnSchema $schema
     * @return string php type
     */
    protected function getColumnType(ColumnSchema $schema)
    {
        return __NAMESPACE__ . '\Types\\' . ucwords($schema->type) . 'Column';
    }
}
