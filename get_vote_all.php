<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

include_once('./db.php');

$sql = "SELECT v.round, g.no, g.name  FROM app_o1_vote.votes as v LEFT JOIN app_o1_vote.groups as g ON v.group_id = g.id";
$sth = $pdo->prepare($sql);
$sth->execute();
$list = $sth->fetchAll(PDO::FETCH_ASSOC);

$result = [
    'ok' => true,
    'data' => $list,
];

echo json_encode($result);