<?php



// lets check if the Administrateur submit the information
if (isset($_POST['send'])){

    extract($_POST);
    // Verify if the information is not empty
    if ( !empty($email) ){
        $connect =Etudiante::addEtudiante( $email_a);
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