
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
$max_votes = 0;
$winner = null;

foreach ($candidates as $c) {
    $total_votes += $c['votes'];
    if ($c['votes'] > $max_votes) {
        $max_votes = $c['votes'];
        $winner = $c;
    }
}

include __DIR__ . '/../views/resultats_v.php';
?>