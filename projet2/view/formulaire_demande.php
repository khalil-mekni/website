<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande d'adhésion</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card border-primary mx-auto" style="max-width: 800px;"> <!-- Ajustez la largeur ici -->
            <div class="card-header bg-primary text-white text-center">
                <h1 class="card-title">Demande d'adhésion</h1>
            </div>
            <div class="card-body">
                <form action="/projet2/controller/DemandeController.php" method="POST">
                    <!-- Champ caché pour l'ID du club -->
                    <input type="hidden" name="club_id" id="club_id">
                    <input type="hidden" name="id_demande" id="id_demande">

                    <div class="form-group mb-4"> <!-- Ajout de mb-4 pour l'espacement -->
                        <label for="nom" class="font-weight-bold">Nom :</label>
                        <input type="text" class="form-control form-control-lg" id="nom" name="nom" required>
                    </div>

                    <div class="form-group mb-4"> <!-- Ajout de mb-4 pour l'espacement -->
                        <label for="prenom" class="font-weight-bold">Prénom :</label>
                        <input type="text" class="form-control form-control-lg" id="prenom" name="prenom" required>
                    </div>

                    <div class="form-group mb-4"> <!-- Ajout de mb-4 pour l'espacement -->
                        <label for="email" class="font-weight-bold">Email :</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                    </div>

                    <div class="form-group mb-4"> <!-- Ajout de mb-4 pour l'espacement -->
                        <label for="annee_universitaire" class="font-weight-bold">Année universitaire :</label>
                        <input type="text" class="form-control form-control-lg" id="annee_universitaire" name="annee_universitaire" required>
                    </div>

                    <div class="form-group mb-4"> <!-- Ajout de mb-4 pour l'espacement -->
                        <label for="departement" class="font-weight-bold">Département :</label>
                        <input type="text" class="form-control form-control-lg" id="departement" name="departement" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-4" name="envoyer">Envoyer ma demande</button> <!-- Ajout de mt-4 pour l'espacement -->
                </form>
                
                <!-- Bouton Supprimer -->
                <form action="/projet2/controller/DemandeController.php" method="POST" class="mt-4"> <!-- Ajout de mt-4 pour l'espacement -->
                    <input type="hidden" name="id_demande" id="id_demande_suppression">
                    <a href="supp.php" class="btn btn-danger btn-block btn-lg" name="supprimer">supprimer</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Récupérer les paramètres de l'URL
        const params = new URLSearchParams(window.location.search);
        
        // Remplir les champs cachés avec les valeurs des paramètres
        const clubId = params.get("club_id");
        const idDemande = params.get("id_demande");

        // Vérifier si les paramètres existent et les affecter aux champs cachés
        if (clubId) {
            document.getElementById("club_id").value = clubId;
        }
        if (idDemande) {
            document.getElementById("id_demande").value = idDemande;
        }
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include "footer.php"; ?>

