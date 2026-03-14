<?php
class VoteAPI {
    private $db;
    private $vote;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->vote = new Vote($this->db);
    }

    public function handleRequest() {
        header('Content-Type: application/json');
        
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        try {
            switch ($method) {
                case 'GET':
                    if (preg_match('/^\/api\/results\/(\d+)$/', $path, $matches)) {
                        $this->getResults($matches[1]);
                    } else {
                        throw new Exception("Endpoint non trouvé");
                    }
                    break;
                
                case 'POST':
                    if ($path === '/api/vote') {
                        $this->processAPIVote();
                    } else {
                        throw new Exception("Endpoint non trouvé");
                    }
                    break;
                
                default:
                    throw new Exception("Méthode non autorisée");
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    private function getResults($id_v) {
        if (!$this->election->getElectionById($id_v)) {
            throw new Exception("Élection introuvable");
        }

        $results = $this->vote->getElectionResults($id_v);
        $total_votes = $this->vote->getTotalVotes($id_v);
        
        $data = [
            
            'total_votes' => $total_votes,
            'candidates' => []
        ];

        while ($result = $results->fetch(PDO::FETCH_ASSOC)) {
            $percentage = $total_votes > 0 ? round(($result['vote_count'] / $total_votes) * 100, 2) : 0;
            
            $data['candidates'][] = [
                'id' => $result['id'],
                'name' => $result['name'],
                'party' => $result['party'],
                'votes' => (int)$result['vote_count'],
                'percentage' => $percentage
            ];
        }

        echo json_encode($data);
    }

    private function processAPIVote() {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($input['id_c']) || !isset($input['id_v'])) {
            throw new Exception("Données manquantes");
        }

        // Ici, vous devriez implémenter l'authentification API
        // Pour l'exemple, on suppose que l'id_e est fourni
        if (!isset($input['id_e'])) {
            throw new Exception("Authentification requise");
        }

        $this->vote->id_e = $input['id_e'];
        $this->vote->id_c = $input['id_c'];
        $this->vote->id_v = $input['id_v'];

        // Vérifications similaires à la version web
        if ($this->vote->hasUserVoted($this->vote->id_e, $this->vote->id_v)) {
            throw new Exception("Vote déjà enregistré");
        }

        if ($this->vote->castVote()) {
            echo json_encode(['success' => true, 'message' => 'Vote enregistré']);
        } else {
            throw new Exception("Erreur lors de l'enregistrement");
        }
    }
}
?>