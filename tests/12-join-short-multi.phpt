--TEST--
join same two tables
--FILE--
<?php
include_once __DIR__ . "/connect.inc.php";
/* @var $fpdo \FluentPDO\FluentPDO */

$query = $fpdo->from('comment')->leftJoin('article.user');
echo $query->getQuery() . "\n";
?>
--EXPECTF--
SELECT comment.*
FROM comment
    LEFT JOIN article ON article.id = comment.article_id
    LEFT JOIN user ON user.id = article.user_id
