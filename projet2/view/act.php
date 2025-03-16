<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clubs ESSECT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body class="bg-dark text-white">

    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4">
                <div class="card bg-secondary text-white border-0 shadow-lg">
                    <div id="carouselClub1" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="infolab.jpg" class="d-block w-100" alt="Club 1">
                            </div>
                            <div class="carousel-item">
                                <img src="ii2.jpg" class="d-block w-100" alt="Club 1">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Club INFOLAB</h5>
                        <p class="card-text">Un club dédié aux passionnés de la programmation et des nouvelles technologies.</p>
                        <a href="formulaire_demande.php?club_id=1" class="btn btn-primary">Adhérer à INFOLAB</a>
                        <a href="infolab.php" class="btn btn-primary">voir plus</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card bg-secondary text-white border-0 shadow-lg">
                    <div id="carouselClub2" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="enactus.jpg" class="d-block w-100" alt="Club 2">
                            </div>
                            <div class="carousel-item">
                                <img src="enactus3.jpg" class="d-block w-100" alt="Club 2">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Club Enactus</h5>
                        <p class="card-text">Explorez la conception et la programmation de robots intelligents.</p>
                        <a href="formulaire_demande.php?club_id=2" class="btn btn-primary">Adhérer à ENACTUS</a>
                        <a href="enactus.php" class="btn btn-primary">voir plus</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card bg-secondary text-white border-0 shadow-lg">
                    <div id="carouselClub3" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="fhmologia.jpg" class="d-block w-100" alt="Club 3">
                            </div>
                            <div class="carousel-item">
                                <img src="fah3.jpg" class="d-block w-100" alt="Club 3">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Club fahmologia</h5>
                        <p class="card-text">Apprenez les fondamentaux du business et de l'entrepreneuriat.</p>
                        <a href="formulaire_demande.php?club_id=3" class="btn btn-primary">Adhérer à FAHMOLOGIA</a>
                        <a href="fahmologia.php" class="btn btn-primary">voir plus</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card bg-secondary text-white border-0 shadow-lg">
                    <div id="carouselClub4" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="radio.jpg" class="d-block w-100" alt="Club 4">
                            </div>
                            <div class="carousel-item">
                                <img src="ra1.jpg" class="d-block w-100" alt="Club 4">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Club radio_essect_fm</h5>
                        <p class="card-text">Un club dédié à l'innovation et aux nouvelles idées.</p>
                        <a href="formulaire_demande.php?club_id=4" class="btn btn-primary">Adhérer à RADIO_ESSECT_FM</a>
                        <a href="radio.php" class="btn btn-primary">voir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include "footer.php"; ?>

