<?php
session_start();
require_once '_classes/Candidate.php';
require_once '_config/db.php'; // Connexion PDO

$id_el = $_SESSION['user_id']??null;
$user_id= $_SESSION['user_id']??4; // électeur connecté

$candidateModel = new Candidate($pdo);

// Si le formulaire de vote a été soumis
if(isset($_POST['id_c'])){
 

    if(!$candidateModel->hasVoted($id_el)){
        $candidateModel->vote($id_el, $_POST['id_c']);
        $message = "✅ Vote enregistré avec succès !";
    } else {
        $message = "⚠️ Vous avez déjà voté !";
    }
}

// Récupérer les candidats pour la vue
$candidats = $candidateModel->getCandidates();

// Inclure la vue
include_once '../views/vote_v.php';
