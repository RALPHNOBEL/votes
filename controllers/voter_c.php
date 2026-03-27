<?php
session_start();
require_once '_classes/Candidate.php';
include_once '_config/db.php';

$id_el = $_SESSION['user_id'] ?? null;
$candidateModel = new Candidate($db);

// Récupérer l'élection active
$queryEl = $db->prepare("SELECT * FROM election WHERE status = 'ouvert' LIMIT 1");
$queryEl->execute();
$election = $queryEl->fetch();

// Si le formulaire de vote a été soumis
if(isset($_POST['id_c'])){
    // Vérifier si l'élection est encore ouverte
    if($election){
        $now = new DateTime();
        $start = new DateTime($election['start_date'] . ' ' . $election['start_time']);
        $end = new DateTime($election['end_date'] . ' ' . $election['end_time']);
        
        if($now >= $start && $now <= $end){
            if(!$candidateModel->hasVoted($id_el)){
                $candidateModel->vote($id_el, $_POST['id_c']);
                $message = "✅ Vote enregistré avec succès !";
            } else {
                $message = "⚠️ Vous avez déjà voté !";
            }
        } else {
            $message = "⛔ Les votes sont fermés.";
        }
    }
}

// Récupérer les candidats
$candidats = $candidateModel->getCandidates();