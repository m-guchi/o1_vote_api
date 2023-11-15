<?php

// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

include_once('./db.php');

$post = json_decode(mb_convert_encoding(file_get_contents('php://input'),"UTF8","ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN"),true);

$sql = "UPDATE app_o1_vote.groups SET final=:final WHERE id = :id";
$sth = $pdo->prepare($sql);
$sth->bindValue(':id', $post["id"]);
$sth->bindValue(':final', ($post["final"])?1:0);
$sth->execute();


$result = [
    'ok' => true,
    'data' => $post
];

echo json_encode($result);
