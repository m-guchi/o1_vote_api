<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

include_once('./db.php');

$sql = "SELECT * FROM app_o1_vote.setting";
$sth = $pdo->prepare($sql);
$sth->execute();
$list = $sth->fetch();

$result = [
    'setting' => $list,
];

echo json_encode($result);