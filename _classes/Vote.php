<?php                           

class Vote
{
    private $id_v;
    private $id_e;
    private $id_c;
    private $date_vote;
    private $id_el;
    private $election;
    private $candidate;
    private $vote;


    

    public function __construct($id_e, $id_c,$date_vote,$id_el)
    {
        $this->id_e = $id_e;
        $this->id_c = $id_c;
        $this->id_el = $id_el;
        $this->election = new Election($id_el);
        $this->candidate = new Candidate( $id_c);
        $this->vote = new Vote($id_e, $id_c,$date_vote,$id_el);


        $this->date_vote = date('Y-m-d H:i:s');
    }
     static function getAllVotes(){
            global $db;
            $query = $db->prepare("SELECT * FROM vote");
            $query->execute();
            return $query->fetchAll();
        }
         static function addVote($id_e,$id_c,$id_el,$date_vote ){
            global $db;
            // Lets check if the electeur already exists
            $query = $db->prepare("SELECT * FROM vote WHERE id_e = ?  AND id_c = ? AND id_el = ? AND  date_vote = ? ");
            $query->execute([$id_e,$id_c,$id_el, $date_vote]);

            if($query->rowCount() > 0){
                // If electeur already exists
                return false;
            } else {
               
                //pour regarder le null
                $query2 = $db->prepare("INSERT INTO vote ( id_e,date_vote) VALUES ( ?,?)");
                $valid = $query2->execute([$id_e, $date_vote]);
                if($valid){
                    // Electeur added successfully

                    return true;
                } else {
                    return false;
                }
            }
        
       }

    // E{nregistre le vote dans la base de données
    public function save()
    {
global $db;
        // Vérifier si l'étudiant a déjà voté
        $query = "SELECT COUNT(*) FROM vote WHERE id_e = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$this->id_e]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return false; // L'étudiant a déjà voté
        }

        // Insérer le vote
        $query = "INSERT INTO vote (id_e, id_c, id_el,date_vote) VALUES (?,  ?, ?,?)";
        $stmt = $db->prepare($query);
        
        return $stmt->execute([$this->id_e, $this->id_c, $this->id_el , $this->date_vote]);   
    }
     // Vérifier si l'utilisateur a déjà voté
    public function hasUserVoted($id_e, $id_el) {
        global $db;
        $query = "SELECT COUNT(*) as count FROM " . 'vote' . " 
                  WHERE id_e = :id_e AND id_el = :id_el";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_e', $id_e);
        $stmt->bindParam(':id_el', $id_el);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'] > 0;
    }

    // Enregistrer un vote
    public function castVote() {
        global $db;
        $query = "INSERT INTO " .'vote' . " 
                  SET id_e = :id_e, 
                      id_c = :id_c, 
                      id_el = :id_el,
                      vote_date = NOW(),
                      ";

        $stmt = $db->prepare($query);

        // Nettoyage des données
        $this->id_e = htmlspecialchars(strip_tags($this->id_e));
        $this->id_c = htmlspecialchars(strip_tags($this->id_c));
        $this->id_el = htmlspecialchars(strip_tags($this->id_el));

        // Liaison des paramètres
        $stmt->bindParam(':id_e', $this->id_e);
        $stmt->bindParam(':id_c', $this->id_c);
        $stmt->bindParam(':id_el', $this->id_el);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
        // Obtenir les résultats d'une élection
   public static function getResultsByElection($id_el) {
    global $db;
    $query = "SELECT c.id_c, c.date_vote, COUNT(v.id_v) AS votes
              FROM candidate c
              LEFT JOIN vote v ON c.id_c = v.id_c AND v.id_el = ?
              WHERE c.id_el = ?
              GROUP BY c.id_c, c.date_vote";
    $stmt = $db->prepare($query);
    $stmt->execute([':id_el', $id_el]);
    return $stmt->fetchAll();
}
// ...existing code...

    // Obtenir le nombre total de votes pour une élection
    public function getTotalVotes($id_el) {
        global $db;
        $query = "SELECT COUNT(*) as total FROM " . 'vote' . " 
                  WHERE id_el = :id_el";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_el', $id_el);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
    public static function countVotesForCandidate($id_c) {
        global $db;
        $stmt = $db->prepare("SELECT COUNT(*) AS votes FROM vote WHERE id_c = ?");
        $stmt->execute([$id_c]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['votes'] ?? 0;
    

}
    
    // Afficher la page de vote
    public function showVotingPage($id_el) {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['id_e'])) {
            $this->redirectToLogin();
            return;
        }

        $id_e = $_SESSION['id_e'];

        // Vérifier si l'élection existe et est active
        if (!$this->election->getElectionById($id_el)) {
            $this->showError("Élection introuvable");
            return;
        }

        if (!$this->election->isActive()) {
            $this->showError("Cette élection n'est plus active");
            return;
        }

        // Vérifier si l'utilisateur a déjà voté
        if ($this->vote->hasUserVoted($id_e, $id_el)) {
            $this->showError("Vous avez déjà voté pour cette élection");
            return;
        }

        // Obtenir les candidats
        $candidates = $this->candidate->getCandidatesByElection($id_el);

        // Charger la vue
        include 'views/vote/voting_form.php';
    }

    // Traiter le vote
    public function processVote() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->showError("Méthode non autorisée");
            return;
        }

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['id_e'])) {
            $this->redirectToLogin();
            return;
        }

        $id_e = $_SESSION['id_e'];
        $id_c = $_POST['id_c'] ?? null;
        $id_el = $_POST['id_el'] ?? null;

        // Validation des données
        if (!$id_c || !$id_el) {
            $this->showError("Données manquantes");
            return;
        }

        // Vérifier si l'élection est active
        if (!$this->election->getElectionById($id_el) || !$this->election->isActive()) {
            $this->showError("Élection non disponible");
            return;
        }

        // Vérifier si l'utilisateur a déjà voté
        if ($this->vote->hasUserVoted($id_e, $id_el)) {
            $this->showError("Vous avez déjà voté");
            return;
        }

        // Vérifier que le candidat existe et appartient à cette élection
        if (!$this->candidate->getCandidateById($id_c) || 
            $this->id_el != $id_el) {
            $this->showError("Candidat invalide");
            return;
        }

        // Enregistrer le vote
        $this->id_e = $id_e;
        $this->id_c = $id_c;
        $this->id_el = $id_el;

        if ($this->castVote()) {
            $this->showSuccess("Votre vote a été enregistré avec succès!");
        } else {
            $this->showError("Erreur lors de l'enregistrement du vote");
        }
    }

    // Afficher les résultats
    public function showResults($id_el) {
        // Vérifier si l'élection existe
        if (!$this->election->getElectionById($id_el)) {
            $this->showError("Élection introuvable");
            return;
        }

        // Obtenir les résultats
        $results = !$this->vote->getResultsByElection($id_el);
        $total_votes =!$this->vote->getTotalVotes($id_el);

        // Charger la vue des résultats
        include 'views/vote/results.php';
    }

    // Méthodes utilitaires
    private function redirectToLogin() {
        header('Location: /login');
        exit();
    }

    private function showError($message) {
        $_SESSION['error'] = $message;
        header('Location: /elections');
        exit();
    }

    private function showSuccess($message) {
        $_SESSION['success'] = $message;
        header('Location: /elections');
        exit();
    }



   }








?>


