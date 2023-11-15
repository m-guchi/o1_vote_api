<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

include_once('./db.php');

$post = json_decode(mb_convert_encoding(file_get_contents('php://input'),"UTF8","ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN"),true);

$sql = "SELECT * FROM app_o1_vote.users WHERE id = :id";
$sth = $pdo->prepare($sql);
$sth->bindValue(':id', $post["user_id"]);
$sth->execute();
$count = count($sth->fetchAll());

if($count>0){

    $sql = "SELECT * FROM setting";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $list = $sth->fetch();

    $sql = "SELECT * FROM app_o1_vote.users as u INNER JOIN app_o1_vote.tickets as t ON u.id = t.user_id WHERE (id = :id AND round = :round AND group_id = :group_id)";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':id', $post["user_id"]);
    $sth->bindValue(':round', $list["round"]);
    $sth->bindValue(':group_id', $list["group_id"]);
    $sth->execute();
    $already = count($sth->fetchAll()) > 0;

    $sql = "SELECT * FROM app_o1_vote.users as u INNER JOIN app_o1_vote.tickets as t ON u.id = t.user_id WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':id', $post["user_id"]);
    $sth->execute();
    $count = count($sth->fetchAll());

    $result = [
        'ok' => true,
        'already' => $already,
        'count' => $count,
    ];
}else{
    $result = [
        'ok' => false,
        'error' => 'not_user_id',
    ];
}



echo json_encode($result);