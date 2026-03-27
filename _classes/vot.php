<?php
class Vot {

    public static function countVotesForCandidate($id_c) {
        global $db; // <-- récupère la connexion PDO
        $stmt = $db->prepare("SELECT COUNT(*) AS votes FROM vote WHERE id_c = ?");
        $stmt->execute([$id_c]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['votes'] ?? 0;
    }
public static function getResultsByElection($id_el) {
    global $db;
   
    $query = "SELECT c.id_c, c.id_e, c.nom_c, c.description, c.photo, COUNT(v.id_v) AS votes
              FROM candidate c
              LEFT JOIN vote v ON c.id_c = v.id_c
              GROUP BY c.id_c, c.id_e, c.nom_c, c.description, c.photo";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public static function getTotalVotes($id_el) {
        global $db; // <-- indispensable
        $stmt = $db->prepare("SELECT COUNT(*) AS total FROM vote WHERE id_el = ?");
        $stmt->execute([$id_el]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }
}
