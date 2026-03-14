
<?php
require_once __DIR__ . '/../_classes/Vote.php';
require_once __DIR__ . '/../_classes/Candidate.php';
require_once __DIR__ . '/../_config/db.php';

// Récupérer l'id de l'élection (à adapter selon ta logique)
$id_el = $_GET['id_el'] ?? 1;

// Récupérer les résultats
$candidates = Vote::getResultsByElection($id_el);

// Calculer le total des votes
$total_votes = 0;
foreach($candidates as $c) $total_votes += $c['votes'];

include __DIR__ . '/../views/resultats_v.php';
?>