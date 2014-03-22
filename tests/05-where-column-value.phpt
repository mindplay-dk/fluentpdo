--TEST--
where('column', 'value')
--FILE--
<?php
include_once __DIR__ . "/connect.inc.php";
/* @var $fpdo \FluentPDO\FluentPDO */

$query = $fpdo->from('user')->where('type', 'author');

echo $query->getQuery() . "\n";
print_r($query->getParameters());
?>
--EXPECTF--
SELECT user.*
FROM user
WHERE type = ?
Array
(
    [0] => author
)
