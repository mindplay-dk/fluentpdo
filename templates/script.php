<?php

namespace FluentPDO\Reflection;

/**
 * @var $model ScriptView
 */

echo "<?php\n\n";

?>
/**
 * Static reflection of database `<?= $model->database ?>`
 * Generated at: <?= date('Y-m-d H:i:s') . "\n" ?>
 */

<?php if ($model->namespace): ?>
namespace <?= $model->namespace ?>;
<?php endif ?>

/**
 * Static reflection of database `<?= $model->database ?>`
 *
<?php foreach ($model->tables as $table): ?>
 * @property-read <?= $table->class_name ?> $<?= $table->name . "\n" ?>
<?php endforeach # $table ?>
 */
class <?= $model->database ?> extends \FluentPDO\Reflection\Database
{
<?php foreach ($model->tables as $table): ?>
    protected function create_<?= $table->name ?>()
    {
        return new <?= $table->class_name ?>($this);
    }
<?php endforeach # $table ?>
}

/** @return <?= $model->database ?> static reflection of database `<?= $model->database ?>` */
function <?= $model->database ?>() { return <?= $model->database ?>; }

<?php foreach ($model->tables as $table): ?>
/** @return <?= $table->class_name ?> static reflection of table `<?= $table->name ?>` */
function <?= $table->name ?>() { return <?= $model->database ?>()-><?= $table->name ?>; }

<?php endforeach # $table ?>

<?php foreach ($model->tables as $table): ?>
/**
 * Static reflection of table `<?= $model->database ?>`.`<?= $table->name ?>`
 *
<?php foreach ($table->columns as $column): ?>
 * @property-read \<?= $column->type ?> $<?= $column->schema->name . "\n" ?>
<?php endforeach ?>
 */
class <?= $table->class_name ?> extends \FluentPDO\Reflection\Table
{
<?php foreach ($table->columns as $column): ?>
    protected function create_<?= $column->schema->name ?>()
    {
        return new \<?= $column->type ?>($this);
    }
<?php endforeach # $column ?>
}

<?php endforeach # $table ?>
