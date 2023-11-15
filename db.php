<?php
require __DIR__ . '/vendor/autoload.php';
// use \Symfony\Component\Yaml\Yaml;

$input = file_get_contents(__DIR__."/../../.env/db_key.yaml");
$env = \Symfony\Component\Yaml\Yaml::parse($input);

$driver_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
$dsn = "mysql:dbname=app_o1_vote;host=".$env["host"].";charset=utf8mb4";
// $dsn = "mysql:dbname=app_o1_vote;host=".$env["host"].";charset=utf8mb4"; 

try {
    $pdo = new PDO($dsn, $env["user"], $env["pass"], $driver_options);
} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
}
