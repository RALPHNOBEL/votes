<?php
    
class Election {
    private $conn;
    private $table = 'election';

    public $id_el;
    public $title;
    public $description;
    public $start_date;
    public $end_date;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtenir une élection par id_el
    public function getElectionById($id_el) {
        $query = "SELECT * FROM " . 'election' . " WHERE id_el = :id_el LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_el', $id_el);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id_el = $row['id_el'];
            $this->title = $row['title'];
            $this->description = $row['description'];
            $this->start_date = $row['start_date'];
            $this->end_date = $row['end_date'];
            $this->status = $row['status'];
            return true;
        }
        return false;
    }
                                                                                                                                        
    // Vérifier si l'élection est active
    public function isActive() {
        $now = date('Y-m-d H:i:s');
        return ($this->status === 'active' && 
                $now >= $this->start_date && 
                $now <= $this->end_date);
    }

    // Obtenir toutes les élections actives
    public function getActiveElections() {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE status = 'active' 
                  AND start_date <= NOW() 
                  AND end_date >= NOW()
                  ORDER BY start_date ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
