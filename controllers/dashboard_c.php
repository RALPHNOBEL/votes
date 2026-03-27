<?php
session_start();
if (!isset($_SESSION['id_a'])){
    header("location: " . PATH . "login");
    exit;
}

// Total votes
$queryVotes = $db->prepare("SELECT COUNT(*) AS total FROM vote");
$queryVotes->execute();
$nb_votes = $queryVotes->fetch()['total'];

// Total candidats
$nb_candidates = Candidate::getNumberCandidates();

// Total étudiantes
$nb_etudiantes = Etudiante::getNumberEtudiantes();

// Participation
$participation = $nb_etudiantes > 0 ? round(($nb_votes / $nb_etudiantes) * 100, 1) : 0;

// Répartition des votes par candidat
$queryRepartition = $db->prepare("SELECT c.nom_c, c.description, c.photo, COUNT(v.id_v) AS votes 
                                   FROM candidate c 
                                   LEFT JOIN vote v ON c.id_c = v.id_c 
                                   GROUP BY c.id_c, c.nom_c, c.description, c.photo");
$queryRepartition->execute();
$repartition = $queryRepartition->fetchAll();

// Liste des candidats
$candidate = Candidate::getAllCandidates();
?>