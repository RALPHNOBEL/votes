<?php
// Sauvegarder une élection
if(isset($_POST['save'])){
    extract($_POST);
    if(!empty($title) && !empty($start_date) && !empty($start_time) && !empty($end_date) && !empty($end_time) && !empty($status)){
        $query = $db->prepare("INSERT INTO election (title, description, start_date, start_time, end_date, end_time, status) VALUES (?,?,?,?,?,?,?)");
        $valid = $query->execute([$title, $description, $start_date, $start_time, $end_date, $end_time, $status]);
        if($valid){
            $success = "Élection enregistrée avec succès !";
        } else {
            $error = "Erreur lors de l'enregistrement.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

// Modifier une élection
if(isset($_GET['edit'])){
    $query = $db->prepare("SELECT * FROM election WHERE id_el = ?");
    $query->execute([$_GET['edit']]);
    $election = $query->fetch();
}

if(isset($_POST['update'])){
    extract($_POST);
    $id_el = $_GET['edit'];
    if(!empty($title) && !empty($start_date) && !empty($start_time) && !empty($end_date) && !empty($end_time) && !empty($status)){
        $query = $db->prepare("UPDATE election SET title=?, description=?, start_date=?, start_time=?, end_date=?, end_time=?, status=? WHERE id_el=?");
        $valid = $query->execute([$title, $description, $start_date, $start_time, $end_date, $end_time, $status, $id_el]);
        if($valid){
            header("Location: " . PATH . "vote");
        }
    }
}

// Supprimer une élection
if(isset($_GET['delete'])){
    $query = $db->prepare("DELETE FROM election WHERE id_el = ?");
    $query->execute([$_GET['delete']]);
    header("Location: " . PATH . "vote");
}

// Récupérer toutes les élections
$query = $db->prepare("SELECT * FROM election ORDER BY id_el DESC");
$query->execute();
$elections = $query->fetchAll();
// Récupérer les statistiques
$queryVotes = $db->prepare("SELECT COUNT(*) AS total FROM vote");
$queryVotes->execute();
$total_votes = $queryVotes->fetch()['total'];

$queryCandidats = $db->prepare("SELECT COUNT(*) AS total FROM candidate");
$queryCandidats->execute();
$total_candidats = $queryCandidats->fetch()['total'];

$queryElecteurs = $db->prepare("SELECT COUNT(*) AS total FROM etudiante");
$queryElecteurs->execute();
$total_electeurs = $queryElecteurs->fetch()['total'];

$participation = $total_electeurs > 0 ? round(($total_votes / $total_electeurs) * 100, 1) : 0;