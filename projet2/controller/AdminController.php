<?php
require "../model/connexion.php";
session_start();

class AdminController {
    public static function login($email, $mot_de_passe) {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE email = :email and type_utilisateur = 'admin' ";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["email" => $email]);
        $admin = $stmt->fetch();

        if ($admin && $admin['mot_de_passe'] === $mot_de_passe) { // Comparaison directe
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nom'] = $admin['nom'];
            header("Location: admin_dashboard.php"); // Redirection vers le tableau de bord
            exit();
        } else {
            return "Email ou mot de passe incorrect.";
        }
    }

    public static function logout() {
        session_destroy();
        header("Location: admin_login.php"); // Redirection vers la page de connexion
        exit();
    }
}
?>