<?php
     session_start();
    if (!isset($_SESSION['id_a'])){
        header("location: "  .PATH. "login");
    }
    $nb_candidates = Candidate::getNumberCandidates();
    
    $nb_etudiantes = Etudiante::getNumberEtudiantes();
    
$candidate = Candidate::getAllCandidates();

?>
