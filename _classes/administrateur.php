<?php
class Administrateur
{
    public $id_a;
    public $nom_a;
    public $email_a;
    public $pwd_a;

    public function __construct($id_a, $nom_a, $email_a, $pwd_a)
    {
        $this->id_a = $id_a;
        $this->nom_a = $nom_a;
        $this->email_a = $email_a;
        $this->pwd_a = $pwd_a;
    }
    static function addAdministrateur($nom_a, $email_a, $pwd_a)
    {
        global $db;
        // Lets check if the Administrateur already exists
        $query = $db->prepare("SELECT * FROM administrateur WHERE nom_a = ? OR email_a = ?");
        $query->execute([$nom_a, $email_a]);

        if ($query->rowCount() > 0) {
            // If Administrateur already exists
            return false;
        } else {
            $query2 = $db->prepare("INSERT INTO administrateur(nom_a, email_a, pwd_a) VALUES (?, ?, ?)");
            $valid = $query2->execute([$nom_a, $email_a, $pwd_a]);
            if ($valid) {
                // Administrateur added successfully
                return true;
            } else {
                return false;
            }
        }
    }
    static function getAdministrateurById($id_a)
    {
        global $db;
        $query = $db->prepare("SELECT * FROM administrateur WHERE id_a = ?");
        $query->execute([$id_a]);
        return $query->fetch();
    }
    static function getAllAdministrateurs()
    {
        global $db;
        $query = $db->prepare("SELECT * FROM administrateur");
        $query->execute();
        return $query->fetchAll();
    }
    static function update($id_a, $nom_a, $email_a, $pwd_a)
    {
        global $db;
        $query = $db->prepare("UPDATE administrateur SET nom_a = ?, email_a = ?, pwd_a = ? WHERE id_a = ?");
        $valid = $query->execute([$nom_a, $email_a, $pwd_a, $id_a]);
        if ($valid) {
            // Administrateur updated successfully
            return true;
        } else {
            return false;
        }
    }
    static function connectAdministrateur($email_a, $pwd_a)
    {
        global $db;
        $query = $db->prepare("SELECT * FROM administrateur WHERE email_a = ? AND pwd_a = ?");
        $query->execute([$email_a, $pwd_a]);
        if($query->rowCount() > 0) {
            // Administrateur found
            return $query->fetch();
        } else {
            // Administrateur not found
            return false;
        }
    }
}
