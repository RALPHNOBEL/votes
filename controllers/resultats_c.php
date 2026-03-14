<?php
require_once '_config/db.php';
// récupère le PDO
global $db;
// var_dump($db);
$id_el = $_GET['id_el'] ?? 1;

$candidates = Vot::getResultsByElection($id_el, $pdo);
$total_votes = Vot::getTotalVotes($id_el, $pdo);

include __DIR__ . '/../views/resultats_v.php';
