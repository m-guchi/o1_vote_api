<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

include_once('./db.php');

$id = sha1(uniqid(mt_rand(), true));

$sql = "INSERT INTO app_o1_vote.users (id) VALUES (:id)";
$sth = $pdo->prepare($sql);
$sth->bindValue(':id', $id);
$sth->execute();

$result = [
    'id' => $id,
];

echo json_encode($result);