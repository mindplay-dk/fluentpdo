--TEST--
insert with literal
--FILE--
<?php
include_once __DIR__ . "/connect.inc.php";
/* @var $fpdo \FluentPDO\FluentPDO */

$query = $fpdo->insertInto('article',
    array(
        'user_id' => 1,
        'updated_at' => new \FluentPDO\FluentLiteral('NOW()'),
        'title' => 'new title',
        'content' => 'new content',
    )
);

echo $query->getQuery() . "\n";

?>
--EXPECTF--
INSERT INTO article (user_id, updated_at, title, content)
VALUES (1, NOW(), 'new title', 'new content')
