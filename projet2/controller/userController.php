<?php
require "../model/connexion.php";

class userController {
    public static function login($email, $mot_de_passe) {
        try {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("SELECT id, type_utilisateur, mot_de_passe FROM utilisateur WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $mot_de_passe == $user["mot_de_passe"]) { 
                return $user; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            die("Erreur: " . $e->getMessage());
        }
    }

}
?>