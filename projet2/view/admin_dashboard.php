<?php 
session_start();
include "header.php"; 
require "../model/connexion.php";

$conn = Database::getInstance();
$admin_nom = isset($_SESSION['admin_nom']) ? $_SESSION['admin_nom'] : "Administrateur";

try {
    // Récupération des statistiques générales
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM utilisateur WHERE type_utilisateur = 'etudiant'");
    $stmt->execute();
    $totalEtudiants = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM club");
    $stmt->execute();
    $totalClubs = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM demandes");
    $stmt->execute();
    $totalAdhesions = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

    // Récupération des membres par club
    $stmt = $conn->prepare("SELECT nom_club, membres FROM club");
    $stmt->execute();
    $membresParClub = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $labels = json_encode(array_column($membresParClub, 'nom_club')) ?: '[]';
    $data = json_encode(array_column($membresParClub, 'membres')) ?: '[]';
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Ajustement des tailles des cartes pour éviter les graphiques trop grands */
        .chart-container {
            width: 100%;
            max-width: 500px;
            height: 300px;
            margin: auto;
        }
        .card {
            min-height: 400px;
        }
    </style>
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <h2 class="text-center text-info">Bienvenue, <?php echo htmlspecialchars($admin_nom); ?> !</h2>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card bg-secondary text-white shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title">Statistiques générales</h5>
                        <div class="chart-container">
                            <canvas id="statChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-secondary text-white shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title">Membres par club</h5>
                        <div class="chart-container">
                            <canvas id="membresParClubChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="gestion.php" class="btn btn-primary">Gérer les étudiants, clubs et adhésions</a>
            <a href="admin_logout.php" class="btn btn-danger">Se déconnecter</a>
        </div>
    </div>

    <script>
        // Graphique des statistiques générales
        const ctx = document.getElementById('statChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Étudiants', 'Clubs', 'Adhésions'],
                datasets: [{
                    label: 'Nombre total',
                    data: [<?php echo $totalEtudiants; ?>, <?php echo $totalClubs; ?>, <?php echo $totalAdhesions; ?>],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                    borderColor: ['#0056b3', '#1e7e34', '#d39e00'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Graphique des membres par club
        const membresCtx = document.getElementById('membresParClubChart').getContext('2d');
        new Chart(membresCtx, {
            type: 'bar',
            data: {
                labels: <?php echo $labels; ?>,
                datasets: [{
                    label: 'Nombre de membres',
                    data: <?php echo $data; ?>,
                    backgroundColor: '#17a2b8',
                    borderColor: '#117a8b',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include "footer.php"; ?>
