<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

include_once('./db.php');

$post = json_decode(mb_convert_encoding(file_get_contents('php://input'),"UTF8","ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN"),true);
if(!empty($post) && $post->id == 0){
$sql = "UPDATE app_o1_vote.setting SET running=:running,round=:round,vote=:vote,vote_accept=:vote_accept,ticket_accept=:ticket_accept,youtube=:youtube,group_id=:group_id  WHERE id = :id";
$sth = $pdo->prepare($sql);
$sth->bindValue(':id', 0);
$sth->bindValue(':running', ($post["running"])?1:0);
$sth->bindValue(':round', $post["round"]);
$sth->bindValue(':vote', ($post["vote"])?1:0);
$sth->bindValue(':vote_accept', ($post["vote_accept"])?1:0);
$sth->bindValue(':ticket_accept', ($post["ticket_accept"])?1:0);
$sth->bindValue(':youtube', $post["youtube"]);
$sth->bindValue(':group_id', $post["group_id"]);
$sth->execute();

$sql = "SELECT * FROM app_o1_vote.setting";
$sth = $pdo->prepare($sql);
$sth->execute();
$list = $sth->fetch();
}


$result = [
    'ok' => true,
    'data' => $list
];

echo json_encode($result);