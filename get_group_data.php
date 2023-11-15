<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

include_once('./db.php');

$sql = "SELECT * FROM app_o1_vote.groups ORDER BY no ASC";
$sth = $pdo->prepare($sql);
$sth->execute();
$list = $sth->fetchAll();

$result = [
    'ok' => true,
    'data' => $list,
];

echo json_encode($result);