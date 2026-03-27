<?php

if (isset($_POST['add'])){
    extract($_POST);
    
    if (!empty($email) && !empty($birthdate) && !empty($nom_e) && !empty($tel_e) && !empty($matricule) && !empty($filiere) && !empty($niveau) && !empty($prenom_e) ) {
        $valid = Etudiante::addEtudiante($email, $birthdate , $nom_e, $tel_e, $matricule, $filiere, $niveau, $prenom_e);
        if ($valid) {
            echo "<script>alert('Etudiante ajouter avec succes');</script>";
        } else {
            echo "<script>alert('Votre email existe deja');</script>";
        }
    }
    // Validation filière
    if(!preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $filiere)){
        $error = "La filière ne doit contenir que des lettres.";
    } else {
        $valid = Etudiante::addEtudiante($email, $birthdate, $nom_e, $tel_e, $matricule, $filiere, $niveau, $prenom_e);
        if($valid){
            echo "<script>alert('Etudiant ajouté avec succès');</script>";
        } else {
            echo "<script>alert('Cet étudiant existe déjà');</script>";
        }
    }
}
    

$etudiantes = Etudiante::getAllEtudiantes();
    if(isset($_GET['edit'])){
        $etudiante = Etudiante::getEtudianteById($_GET['edit']);
    }

    if(isset($_POST['update'])){ 

        extract($_POST);
        $id_e = $_GET['edit'];
        $niveau = isset($_POST['niveau']) ? $_POST['niveau'] : null;
        if(  !empty($email) && !empty($birthdate) && !empty($nom_e) && !empty($tel_e) && !empty($matricule) && !empty($filiere) && !empty($niveau) && !empty($prenom_e)){
            $e  = Etudiante::update($id_e,$email,$birthdate,$nom_e,$tel_e, $matricule, $filiere, $niveau, $prenom_e);
            if($e){
echo "<script>alert('9999')</script>";
                header("Location: " .PATH.  "Etudiante");
            }else{
                echo "<script>alert('Erreur lors de la modification')</script>";
            }
        }else{
            echo "<script>alert('Entrer tutes les informations')</script>";
        }
    }
    if(isset($_GET['delete'])){
        $del = Etudiante::delete($_GET['delete']);
        if($del){
            header("Location: " .PATH. "Etudiante");
        }else{
            echo "<script>alert('error deleting category');</script>";

        }
    }
        $nb_etudiantes = Etudiante::getNumberEtudiantes();
     $nb_candidates = Candidate::getNumberCandidates();
    
    ?>