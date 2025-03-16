<?php
require "../model/connexion.php";

class Admin {
    public static function getAdminByEmail($email) {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE email = :email where type_utilisateur = 'admin'";
        $stmt = $conn->prepare($sql);
        $stmt->execute(["email" => $email]);
        return $stmt->fetch();
    }
}
?>