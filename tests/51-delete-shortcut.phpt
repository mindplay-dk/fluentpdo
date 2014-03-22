--TEST--
Shortcuts for delete
--FILE--
<?php
include_once __DIR__ . "/connect.inc.php";
/* @var $fpdo \FluentPDO\FluentPDO */

$query = $fpdo->deleteFrom('user', 1);
echo $query->getQuery() . "\n";
print_r($query->getParameters());

?>
--EXPECTF--
DELETE
FROM user
WHERE id = ?
Array
(
    [0] => 1
)
