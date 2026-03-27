<?php

if (isset($_POST['add'])){ 

    extract($_POST);
    

    if ( !empty($description) && !empty($id_e) ) {

        $valid = Candidate::addCandidate($id_e,$description);
           
        if ($valid) {
            echo "<script>alert('Candidate ajouter avec succes');</script>";

        } else {
            echo "<script>alert('Votre description existe deja');</script>";
        }
    }
    if (isset($_POST['add'])){ 
    extract($_POST);
    
    $photo = '';
    if(!empty($_FILES['photo']['name'])){
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photo = uniqid() . '.' . $extension;
        move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/img/' . $photo);
    }
    
    if (!empty($description) && !empty($id_e)) {
        $valid = Candidate::addCandidate($id_e, $description, $photo);
        if ($valid) {
            echo "<script>alert('Candidate ajouté avec succès');</script>";
        } else {
            echo "<script>alert('Ce candidat existe déjà');</script>";
        }
    }
}
}

$candidates = Candidate::getAllCandidates();
$etudiantes = Etudiante::getAllEtudiantes();
 $nb_candidates = Candidate::getNumberCandidates();
    
    $nb_etudiantes = Etudiante::getNumberEtudiantes();
    


    if(isset($_GET['edit'])){
        $candidate= Candidate::getCandidateById($_GET['edit']);
    }

    if(isset($_POST['update'])){
        extract($_POST);
        $id_c = $_GET['edit'];
        if( !empty($id_e)  && !empty($id_c)  && !empty($description)  ){
            $e  = Candidate::update($id_e,$id_c,$description);
            if($e){
                header("Location: " .PATH.  "Candidate");
            }else{
                echo "<script>alert('Erreur lors de la modification')</script>";
            }
        }else{
            echo "<script>alert('modifications effectuées avec succès')</script>";
        }
        // Dans le bloc update
if(isset($_POST['update'])){
    extract($_POST);
    $id_c = $_GET['edit'];
    
    $photo = $candidate['photo'] ?? ''; // garder l'ancienne photo par défaut
    if(!empty($_FILES['photo']['name'])){
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photo = uniqid() . '.' . $extension;
        move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/img/' . $photo);
    }
    
    if(!empty($id_e) && !empty($id_c) && !empty($description)){
        $e = Candidate::update($id_e, $id_c, $description, $photo);
        if($e){
            header("Location: " . PATH . "candidate");
        } else {
            echo "<script>alert('Erreur lors de la modification')</script>";
        }
    }
}
    }
    if(isset($_GET['delete'])){
        $del = Candidate::delete($_GET['delete']);
        if($del){
            header("Location: " .PATH. "candidate");
        }else{
            echo "<script>alert('error deleting category');</script>";

        }
    }
        
         $etudiantes_niveau1 = Etudiante::getEtudiantesByNiveau("niveau 1");
         
    
 ?>