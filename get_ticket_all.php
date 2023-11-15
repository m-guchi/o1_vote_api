<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

include_once('./db.php');

$sql = "SELECT * FROM app_o1_vote.tickets";
$sth = $pdo->prepare($sql);
$sth->execute();
$list = $sth->fetchAll(PDO::FETCH_ASSOC);

$result = [
    'ok' => true,
    'data' => $list,
];

echo json_encode($result);