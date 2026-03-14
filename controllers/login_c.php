
<?php

if(isset($_POST['signin'])){
    extract($_POST);
    if(!empty($email_a) && !empty($pwd_a)){
        $mdp = md5($pwd_a);
        $administrateur = Administrateur::connectAdministrateur($email_a, $mdp);
        if($administrateur['id_a']){
            $_SESSION['id_a'] = $administrateur['id_a'];
            header('location: '. PATH . 'dashboard');
        } else {
            echo "Email or password incorrect";
        }
    }
}