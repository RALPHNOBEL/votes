<?php
global $db;

$id_el = $_GET['id_el'] ?? 1;
$candidates = Vot::getResultsByElection($id_el);  // ← supprimer $db en paramètre
$total_votes = Vot::getTotalVotes($id_el);         // ← supprimer $db en paramètre
include __DIR__ . '/../views/resultats_v.php';