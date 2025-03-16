<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Étudiant</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="bg-white p-5 rounded-4 shadow-lg w-50">
        <h2 class="text-center mb-4 fw-bold text-primary">Inscription Étudiant</h2>
        <form action="/projet2/controller/EtudiantController.php" method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nom" class="form-label fw-medium">Nom</label>
                    <input type="text" class="form-control rounded-3" id="nom" name="nom" required>
                </div>
                <div class="col-md-6">
                    <label for="mot_de_passe" class="form-label fw-medium">Mot de passe</label>
                    <input type="password" class="form-control rounded-3" id="mot_de_passe" name="mot_de_passe" required>
                </div>
                <div class="col-md-6">
                    <label for="prenom" class="form-label fw-medium">Prénom</label>
                    <input type="text" class="form-control rounded-3" id="prenom" name="prenom" required>
                </div>
                <div class="col-md-6">
                    <label for="date_naissance" class="form-label fw-medium">Date de naissance</label>
                    <input type="date" class="form-control rounded-3" id="date_naissance" name="date_naissance" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label fw-medium">Email</label>
                    <input type="email" class="form-control rounded-3" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                    <label for="niveau_etude" class="form-label fw-medium">Niveau d'étude</label>
                    <input type="text" class="form-control rounded-3" id="niveau_etude" name="niveau_etude" required>
                </div>
                <div class="col-12">
                    <label for="club_id" class="form-label fw-medium">Club</label>
                    <select class="form-select rounded-3" id="club_id" name="club_id">
                        <option value="">Sélectionner un club</option>
                        <option value="1">Infolab</option>
                        <option value="2">Enactus</option>
                        <option value="3">Radio ESSECT FM</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4 rounded-3 fw-medium">S'inscrire</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include "footer.php"; ?>
