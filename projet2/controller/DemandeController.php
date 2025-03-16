<?php
require '../model/Demande.php';

class DemandeController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();  // Initialize the database connection
    }

    public function envoyerDemande() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                "nom" => $_POST["nom"] ?? '', 
                "prenom" => $_POST["prenom"] ?? '',
                "email" => $_POST["email"] ?? '',
                "annee_universitaire" => $_POST["annee_universitaire"] ?? '',
                "departement" => $_POST["departement"] ?? '',
                "club_id" => $_POST["club_id"] ?? '',
                
            ];
    
            // Vérification que les données ne sont pas vides
            if (empty($data["nom"]) || empty($data["prenom"]) || empty($data["annee_universitaire"]) || empty($data["departement"]) || empty($data["club_id"])) {
                header("Location: supp.php");
                exit();
            }
    
            // Vérification que le club existe dans la base de données
            $clubId = $data["club_id"];
            $clubExists = $this->verifierClubExistant($clubId);
            if (!$clubExists) {
                echo "<p>Le club sélectionné n'existe pas. Veuillez vérifier.</p>";
                exit();
            }
    
            // Création de l'objet Demande avec $data
            $demande = new Demande($data);
    
            if ($demande->ajouterDemande()) {
                echo "
                <div style='display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;'>
                    <p style='font-size: 20px; margin-bottom: 20px;'>Demande envoyée avec succès.</p>
                   <a href='http://localhost/projet2/view/act.php' style='background-color: blue; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'> Retour</a>
                </div>";
                exit();
            } else {
                header("Location: supp.php");
                exit();
            }
        }
    }

    // Méthode pour vérifier si le club existe dans la base de données
    private function verifierClubExistant($clubId) {
        // Utilise $this->db pour préparer la requête
        $query = "SELECT COUNT(*) FROM club WHERE club_id = ?";
        $stmt = $this->db->prepare($query);  // Use $this->db instead of $this->pdo
        $stmt->execute([$clubId]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function supprimer() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
            $email = $_POST["email"] ?? null;
    
            if ($email) {
                $demande = new Demande(); // Instanciation correcte
                if ($demande->suppr($email)) {
                       echo "
                    <div style='display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;' >
                        <p style='font-size: 20px; margin-bottom: 20px;'>Demande supprimée avec succès.</p>
                         <a href='http://localhost/projet2/view/act.php' style='background-color: blue; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'> Retour</a>
                    </div>
                    ";
                    exit();
                } else {
                    echo "
                    <div style='display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;'>
                        <p style='font-size: 20px; margin-bottom: 20px;'>L'email n'existe pas.</p>
                          <a href='http://localhost/projet2/view/act.php' style='background-color: blue; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'> Retour</a>
                    </div>
                    ";
                }
            } else {
                echo "
                <div style='display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;'>
                    <p style='font-size: 20px; margin-bottom: 20px;'>Email invalide.</p>
                      <a href='http://localhost/projet2/view/act.php' style='background-color: blue; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'> Retour</a>
                </div>
                ";
            }
        }
    }
}

// Création du contrôleur et exécution
$demandeController = new DemandeController();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['supprimer'])) {
    $demandeController->supprimer();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $demandeController->envoyerDemande();
}

?>
