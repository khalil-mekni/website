<?php 
include "header.php"; 
require "../controller/userController.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $result = userController::login($email, $mot_de_passe);

    if (is_array($result)) { 
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["role"] = $result["type_utilisateur"];

        if ($result["type_utilisateur"] == "admin") {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: act.php");
        }
        exit();
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light d-flex flex-column min-vh-100">
    <!-- Formulaire de connexion -->
    <main class="flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card bg-light text-dark shadow-lg border-0 rounded-4">
                        <div class="card-body p-4">
                            <h2 class="text-center text-primary mb-4">Se connecter</h2>
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Adresse Email</label>
                                    <input type="email" name="email" class="form-control rounded-pill" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Mot de passe</label>
                                    <input type="password" name="mot_de_passe" class="form-control rounded-pill" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary rounded-pill">Connexion</button>
                                </div>
                            </form>
                           
                            <p class="text-center mt-2">
                                <small>Vous n'avez pas de compte ? <a href="inscri.php" class="text-primary text-decoration-none">Inscrivez-vous</a></small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php include "footer.php"; ?>
