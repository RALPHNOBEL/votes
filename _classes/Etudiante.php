<?php
class Etudiante
{
    private $conn;

    public $id_e;
    public $email;
    public $birthdate;
    public $nom_e;
    public $tel_e;
    public $matricule;
    public $filiere;
    public $niveau;
    public $prenom_e;




    public function __construct($db)
    {
        $this->conn = $db;
    }
    static function getAllEtudiantes()
    {
        global $db;
        $query = $db->prepare("SELECT * FROM etudiante");
        $query->execute();
        return $query->fetchAll();
    }
    static function getEtudiantes()
    {
        global $db;
        $query = $db->prepare("SELECT * FROM etudiante");
        $query->execute();
        return $query->fetchAll();
    }
    static function etudian($email)
    {
        global $db;
        $query = $db->prepare("SELECT * FROM etudiante WHERE email=? LIMIT 1");
        $query->execute([$email]);
        return $query->fetch();
    }
 public static function savecode($id, $code)
{
    global $db;
$query = $db->prepare("INSERT INTO code_anonyme (user, code_c) VALUES (?,?)
                       ON DUPLICATE KEY UPDATE code_c = ?, used = 0");
    $query->execute([$id, $code, $code]);
}

    // Récupérer le dernier code pour un utilisateur
    public function getCode($userId)
    {
        $query = $this->conn->prepare("SELECT * FROM code_anonyme WHERE user = ? ORDER BY id_c DESC LIMIT 1");
        $query->execute([$userId]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Marquer un code comme utilisé
    public function markCodeUsed($id_c)
    {
        $query = $this->conn->prepare("UPDATE code_anonyme SET used = 1 WHERE id_c = ?");
        return $query->execute([$id_c]);
    }


    static function addEtudiante($email, $birthdate, $nom_e, $tel_e, $matricule, $filiere, $niveau, $prenom_e)
    {
        global $db;
        // Lets check if the electeur already exists
        $query = $db->prepare("SELECT * FROM etudiante WHERE email = ? OR matricule = ?");
        $query->execute([$email, $matricule]);

        if ($query->rowCount() > 0) {
            // If electeur already exists
            return false;
        } else {
            //pour regarder le null
            $query2 = $db->prepare("INSERT INTO etudiante (email, birthdate,nom_e, tel_e,matricule,filiere,niveau,prenom_e) VALUES (?,?, ?,?, ?, ?,?, ?)");
            $valid = $query2->execute([$email, $birthdate, $nom_e, $tel_e, $matricule, $filiere, $niveau, $prenom_e]);
            if ($valid) {
                // Electeur added successfully
                return true;
            } else {
                return false;
            }
        }
    }


    static function getEtudianteById($id_e)
    {
        global $db;
        $query = $db->prepare("SELECT * FROM Etudiante WHERE id_e = ?");
        $query->execute([$id_e]);
        return $query->fetch();
    }

    static function delete($id_e)
    {
        global $db;
        $query = $db->prepare("DELETE FROM Etudiante WHERE id_e = ?");
        $valid = $query->execute([$id_e]);
        if ($valid) {
            // etudiante deleted successfully
            return true;
        } else {
            return false;
        }
    }
    static function update($id_e, $email, $birthdate, $nom_e, $tel_e, $matricule, $filiere, $niveau, $prenom_e)
    {
        global $db;
        $query = $db->prepare("UPDATE Etudiante SET email = ?, birthdate = ?, nom_e = ? ,tel_e = ?, matricule = ?,filiere = ?,niveau = ?,prenom_e = ? WHERE id_e = ?");
        $valid = $query->execute([$email, $birthdate, $nom_e, $tel_e, $matricule, $filiere, $niveau, $prenom_e, $id_e]);
        if ($valid) {
            // etudiante updated successfully
            echo "<script>alert('9999')</script>";
            return true;
        } else {
            echo "<script>alert('8888')</script>";
            return false;
        }
    }

    static function getNumberEtudiantes()
    { //permet d entrer le nom_ebre
        global $db;
        $query = $db->prepare("SELECT * FROM Etudiante ");
        $query->execute();
        $query->rowCount();
    }

    public static function getEtudiantesByNiveau($niveau)
    {
        global $db;
        $query = $db->prepare("SELECT * FROM etudiante WHERE niveau = ?");
        $query->execute([$niveau]);
        return $query->fetchAll();
    }

    // fonction de verification d'email
    public static function verifyEmail($email)
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM etudiante WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}?>