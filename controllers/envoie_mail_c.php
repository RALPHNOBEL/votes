<?php
//inclusion du model
require_once 'classes/envoie_mail_m.php';
class Envoie_mail_c 
{
   private $model;

    public function __construct()
    {
        // $this->model = new Envoie_mail_m();
    }
    public function verifyemail(){
        $this->model->verifyemail();
        

    }

   
    

}
?>