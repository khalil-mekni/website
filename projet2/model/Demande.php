<?php
require "/connexion.php";

class Demande {
    private $db;
    private $nom;
    private $prenom;
    private $email;
    private $annee_universitaire;
    private $departement;
    private $club_id;

    public function __construct(array $data = []) {
        $this->db = Database::getInstance();
        
        // Vérifier que $data n'est pas vide avant d'hydrater
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    private function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $property = strtolower($key);
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    public function ajouterDemande() {
        try {
            $sql = "INSERT INTO demandes (nom, prenom, email, annee_universitaire, departement, club_id) 
                    VALUES (:nom, :prenom, :email,:annee_universitaire, :departement, :club_id)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
                ':email' => $this->email,
                ':annee_universitaire' => $this->annee_universitaire,
                ':departement' => $this->departement,
                ':club_id' => $this->club_id,
            ]);
        } catch (PDOException $e) {
            die("Erreur lors de l'ajout de la demande : " . $e->getMessage());
        }
    }
    public function suppr($email) {
        try {
            // Vérifiez d'abord si l'email existe
            $sqlCheck = "SELECT COUNT(*) FROM demandes WHERE email = :email";
            $stmtCheck = $this->db->prepare($sqlCheck);
            $stmtCheck->bindParam(":email", $email, PDO::PARAM_STR);
            $stmtCheck->execute();
            $count = $stmtCheck->fetchColumn();
    
            if ($count > 0) {
                $sql = "DELETE FROM demandes WHERE email = :email";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                return $stmt->execute();
            } else {
                return false; // L'email n'existe pas
            }
        } catch (PDOException $e) {
            die("Erreur lors de la suppression de la demande : " . $e->getMessage());
        }
    }
}

?>
