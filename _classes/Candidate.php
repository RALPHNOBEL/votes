<?php
class Candidate
{
    public $conn;
    public $id_c;
    public $description;
    public $id_e;
    public $photo; // Champ ajouté pour la photo du candidat

    public function __construct($db)
    {
        $this->conn = $db;
    }
    static function getCandidates()
    {
        global $db;
        $query = $db->prepare("SELECT * FROM Candidate");
        $query->execute();
        return $query->fetchAll();
    }
    public function getCandidatesByElection($id_el)
    {
        $query = "SELECT * FROM " . 'election ' . " 
                  WHERE id_el = :id_el 
                  ORDER BY name ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_el', $id_el);
        $stmt->execute();
        return $stmt;
    }
    static function addCandidate($id_e, $description, $photo = '')
{
    global $db;
    $etudiant = Etudiante::getEtudianteById($id_e);
    $nom_c = $etudiant['nom_e'] . ' ' . $etudiant['prenom_e'];
    
    $query = $db->prepare("SELECT * FROM candidate WHERE id_e = ? AND description = ?");
    $query->execute([$id_e, $description]);
    
    if ($query->rowCount() > 0) {
        return false;
    }
    
    $query2 = $db->prepare("INSERT INTO candidate (id_e, description, nom_c, photo) VALUES (?, ?, ?, ?)");
    return $query2->execute([$id_e, $description, $nom_c, $photo]);
}



    static function getCandidateById($id_c)
{
    global $db;
    $query = $db->prepare("SELECT * FROM candidate WHERE id_c = ?");
    $query->execute([$id_c]);
    return $query->fetch(PDO::FETCH_ASSOC); // ← ajouter FETCH_ASSOC
}

    static function getAllCandidates()
{
    global $db;
    $query = $db->prepare("SELECT * FROM candidate");
    $query->execute([]);
    return $query->fetchAll();
}
    static function delete($id_c)
    {
        global $db;
        $query = $db->prepare("DELETE FROM Candidate WHERE id_c = ?");
        $valid = $query->execute([$id_c]);
        if ($valid) {
            // Candidate deleted successfully
            return true;
        } else {
            return false;
        }
    }
    static function update($id_e, $id_c, $description, $photo = '')
{
    global $db;
    $etudiant = Etudiante::getEtudianteById($id_e);
    $nom_c = $etudiant['nom_e'] . ' ' . $etudiant['prenom_e'];
    
    $query = $db->prepare("UPDATE candidate SET id_e=?, description=?, nom_c=?, photo=? WHERE id_c=?");
    return $query->execute([$id_e, $description, $nom_c, $photo, $id_c]);
}
    static function getNumberCandidates()
    { //permet d entrer le id_cbre
        global $db;
        $query = $db->prepare("SELECT * FROM Candidate  ");
        $query->execute();
        return $query->rowCount();
    }


    public static function getEtudiantesByid()
    {
        global $db;
        $query = $db->prepare("SELECT * FROM candidate ");
        $query->execute([]);
        return $query->fetchAll();
    }
    static function getAllCandidate()
    {
        global $db;
        $query = $db->prepare("SELECT c.*, e.* FROM candidate c INNER JOIN etudiante e ON c.nom_e = e.nom_e ");
        $query->execute([]);
        return $query->fetchAll();
    }



    // Vérifier si un électeur a déjà voté
    public  function hasVoted($id_el)
    {
        global $db;
        $stmt = $db->prepare("SELECT COUNT(*) FROM vote WHERE id_el = ?");
        $stmt->execute([$id_el]);
        return $stmt->fetchColumn() > 0;
    }

    // Enregistrer un vote
    public function vote($id_el, $id_c)
    {
        global $db;
        $stmt = $db->prepare("INSERT INTO vote (id_el, id_c) VALUES (?, ?)");
        return $stmt->execute([$id_el, $id_c]);
    }

}
