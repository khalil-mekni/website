<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une demande</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white text-center">
                <h1 class="card-title">Supprimer ma demande</h1>
            </div>
            <div class="card-body text-center">
                <p>Êtes-vous sûr de vouloir supprimer votre demande d'adhésion ?</p>
                <form action="/projet2/controller/DemandeController.php" method="POST">
                    <label for="email" class="font-weight-bold">Email :</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                    <input type="hidden" name="supprimer" value="1">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                    <a href="act.php" class="btn btn-secondary btn-lg">Annuler</a>
                </form>
            </div>
        </div>
    </div>
 

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include "footer.php"; ?>
