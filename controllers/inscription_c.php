<?php



// lets check if the Administrateur submit the information
if (isset($_POST['signup'])){

    extract($_POST);
    // Verify if the information is not empty
    if (!empty($nom_a) && !empty($email_a) && !empty($pwd_a)){
        $mdp = md5($pwd_a);
        $connect = Administrateur::addAdministrateur($nom_a, $email_a, $mdp);
        if ($connect) {
            // Redirect to the login page after successful registration
            header("location: " . PATH . "login");
        } else {
            echo "Error in registration, please try again";
        }
    } else {
        echo "All fields are required";
    }
}