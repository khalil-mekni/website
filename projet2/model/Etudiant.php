<?php
require "/connexion.php";

class Etudiant {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $mot_de_passe;
    private $date_naissance;
    private $niveau_etude;
    private $club_id;

    public function __construct($data = []) {
        $this->hydrate($data);
    }

    // Hydratation des données
    public function hydrate($data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Setters
    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setEmail($email) { $this->email = $email; }
    public function setMot_de_passe($mot_de_passe) { $this->mot_de_passe = $mot_de_passe; }
    public function setDate_naissance($date_naissance) { $this->date_naissance = $date_naissance; }
    public function setNiveau_etude($niveau_etude) { $this->niveau_etude = $niveau_etude; }
    public function setClub_id($club_id) { $this->club_id = $club_id; }

    // Méthode pour ajouter un étudiant
    public function ajouterEtudiant($nom, $prenom, $email, $mot_de_passe, $date_naissance, $niveau_etude, $club_id) {
        $db = Database::getInstance();

        // Requête SQL pour insérer l'étudiant
        $sql = "INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, date_naissance, niveau_etude, club_id) 
                VALUES (:nom, :prenom, :email, :mot_de_passe, :date_naissance, :niveau_etude, :club_id)";
        
        // Préparation de la requête
        $stmt = $db->prepare($sql);

        // Binding des paramètres avec les valeurs
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':niveau_etude', $niveau_etude);
        $stmt->bindParam(':club_id', $club_id);

        // Exécution de la requête
        return $stmt->execute();
    }
}

?>
