<?php
    
class results {
    public $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    static function getResults(){
        global $db;
        $query = $db->prepare("SELECT c.nom, COUNT(v.id_c) AS vote_count 
                               FROM candidate c 
                               LEFT JOIN vote v ON c.id_c = v.id_c 
                               GROUP BY c.id_c");
        $query->execute();
        return $query->fetchAll();
    }
    
}