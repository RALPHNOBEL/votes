<?php

if (isset($_POST['add'])){ 

    extract($_POST);
    

    if ( !empty($description) && !empty($nom_e)  ) {

        $valid = Candidate::addCandidate($id_e,$description );
           
        if ($valid) {
            echo "<script>alert('Candidate ajouter avec succes');</script>";

        } else {
            echo "<script>alert('Votre description existe deja');</script>";
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
            echo "<script>alert('Entrer tutes les informations')</script>";
        }
    }//
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
    <?php



