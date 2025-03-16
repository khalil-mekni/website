<?php
require '../model/Etudiant.php';

class EtudiantController {
    private $etudiant;

    public function __construct() {
        $this->etudiant = new Etudiant();
    }

    public function ajouterEtudiant() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom = $_POST["nom"] ?? ''; 
            $prenom = $_POST["prenom"] ?? '';
            $email = $_POST["email"] ?? '';
            $mot_de_passe = $_POST["mot_de_passe"] ?? '';
            $date_naissance = $_POST["date_naissance"] ?? '';
            $niveau_etude = $_POST["niveau_etude"] ?? '';
            $club_id = $_POST["club_id"] ?? '';

            // Appeler la méthode d'ajout dans le modèle
            if ($this->etudiant->ajouterEtudiant($nom, $prenom, $email, $mot_de_passe, $date_naissance, $niveau_etude, $club_id)) {
                echo "
                <div style='display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;'>
                    <p style='font-size: 20px; margin-bottom: 20px;'>Etudiant inscrit avec succès.</p>
                   <a href='http://localhost/projet2/view/act.php' style='background-color: blue; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'> Retour</a>
                </div>";
            } else {
                echo "
                <div style='display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;'>
                    <p style='font-size: 20px; margin-bottom: 20px;'>Erreur de l'inscription.</p>
                   <a href='http://localhost/projet2/view/act.php' style='background-color: blue; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'> Retour</a>
                </div>";
            }
        }
    }

   
}



// Création du contrôleur et exécution
$etudiantController = new EtudiantController();
$etudiantController->ajouterEtudiant();
?>