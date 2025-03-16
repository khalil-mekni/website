<?php include "header.php"; ?>
<?php
require "../model/connexion.php";
session_start();

// Connexion à la base de données
$conn = Database::getInstance();

// Ajouter un club
if (isset($_POST['ajouter_club'])) {
    $nom_club = $_POST['nom_club']; // Utilisation du bon nom pour le champ
    $nom_pres = $_POST['nom_pres']; // Nouveau champ pour le nom du président
    $nbmembres = $_POST['nbmembres'];

    // Vérifier si les champs ne sont pas vides
    if (!empty($nom_club) && !empty($nom_pres) && isset($nbmembres)) {
        $sql = "INSERT INTO club (nom_club, nom_pres, membres) VALUES (:nom_club, :nom_pres, :membres)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'nom_club' => $nom_club,
            'nom_pres' => $nom_pres,
            'membres' => $nbmembres,
        ]);

        header("Location: gestion.php");
        exit();
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}

// Ajouter une adhésion
if (isset($_POST['ajouter_adhesion'])) {
    $club_id = $_POST['idclub'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $departement = $_POST['departement'];
   

    if (!empty($club_id) && !empty($nom) && !empty($prenom) && !empty($email) && !empty($departement) ) {
        $sql = "INSERT INTO demandes (nom, prenom, email, departement, club_id) 
                VALUES (:nom, :prenom, :email, :departement, :club_id)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            
            'departement' => $departement,
            'club_id' => $club_id
        ]);

        header("Location: gestion.php");
        exit();
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
// Supprimer un étudiant
if (isset($_GET['supprimer_etudiant'])) {
    $etudiant_id = $_GET['supprimer_etudiant'];

    // Supprimer l'étudiant
    $sql = "DELETE FROM utilisateur WHERE id = :id and type_utilisateur = 'etudiant'";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $etudiant_id]);

    header("Location: gestion.php");
    exit();
}

// Supprimer un club
if (isset($_GET['supprimer_club'])) {
    $club_id = $_GET['supprimer_club'];

    // Supprimer un club et ses demandes
    $sql = "DELETE FROM club WHERE club_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $club_id]);

    header("Location: gestion.php");
    exit();
}

// Supprimer une adhésion
if (isset($_GET['supprimer_adhesion'])) {
    $adhesion_id = $_GET['supprimer_adhesion'];

    // Supprimer une demande d'adhésion
    $sql = "DELETE FROM demandes WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $adhesion_id]);

    header("Location: gestion.php");
    exit();
}

// Afficher les étudiants
$etudiants = $conn->query("SELECT * FROM utilisateur WHERE type_utilisateur = 'etudiant'")->fetchAll(PDO::FETCH_ASSOC);

// Afficher les clubs
$clubs = $conn->query("SELECT * FROM club")->fetchAll(PDO::FETCH_ASSOC);

// Afficher les adhésions
$adhesions = $conn->query("SELECT * FROM demandes")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des étudiants, clubs et adhésions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center">Gestion des étudiants, clubs et adhésions</h2>

    <!-- Affichage des étudiants -->
    <h3>Liste des étudiants</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Club</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <td><?php echo $etudiant['id']; ?></td>
                    <td><?php echo $etudiant['nom']; ?></td>
                    <td><?php echo $etudiant['email']; ?></td>
                    <td><?php echo $etudiant['club_id']; ?></td>
                    <td>
                        <a href="?supprimer_etudiant=<?php echo $etudiant['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Affichage des clubs -->
    <h3>Liste des clubs</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Président</th>
                <th>Nombre de membres</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clubs as $club): ?>
                <tr>
                    <td><?php echo $club['club_id']; ?></td>
                    <td><?php echo $club['nom_club']; ?></td>
                    <td><?php echo $club['nom_pres']; ?></td>
                    <td><?php echo $club['membres']; ?></td>
                    <td>
                        <a href="?supprimer_club=<?php echo $club['club_id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulaire d'ajout d'un club -->
    <h3>Ajouter un club</h3>
    <form method="POST" class="mb-4">
        <div class="mb-3">
            <label for="nom_club" class="form-label">Nom du club</label>
            <input type="text" class="form-control" id="nom_club" name="nom_club" required>
        </div>
        <div class="mb-3">
            <label for="nom_pres" class="form-label">Nom du président</label>
            <input type="text" class="form-control" id="nom_pres" name="nom_pres" required>
        </div>
        <div class="mb-3">
            <label for="nbmembres" class="form-label">Nombre de membres</label>
            <input type="number" class="form-control" id="nbmembres" name="nbmembres" required>
        </div>
        <button type="submit" name="ajouter_club" class="btn btn-success">Ajouter club</button>
    </form>

    <!-- Affichage des adhésions -->
    <h3>Liste des adhésions</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Club</th>
                <th>Nom</th>
                <th>prenom</th>
                <th>Email</th>
                <th>Departement</th>
                <th>Date</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adhesions as $adhesion): ?>
                <tr>
                    <td><?php echo $adhesion['id']; ?></td>
                    <td><?php echo $adhesion['club_id']; ?></td>
                    <td><?php echo $adhesion['nom']; ?></td>
                    <td><?php echo $adhesion['prenom']; ?></td>
                    <td><?php echo $adhesion['email']; ?></td>
                    <td><?php echo $adhesion['departement']; ?></td>
                    <td><?php echo $adhesion['date']; ?></td>


                    <td>
                        <a href="?supprimer_adhesion=<?php echo $adhesion['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

     <!-- Formulaire d'ajout d'une adhésion -->
     <h3>Ajouter une adhésion</h3>
    <form method="POST">
        <div class="mb-3">
            <label for="idclub" class="form-label">ID du club</label>
            <input type="number" class="form-control" name="idclub" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="departement" class="form-label">Département</label>
            <input type="text" class="form-control" name="departement" required>
        </div>
       
        <button type="submit" name="ajouter_adhesion" class="btn btn-success">Ajouter adhésion</button>
    </form>

    <a href="admin_dashboard.php" class="btn btn-secondary">Retour au tableau de bord</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include "footer.php"; ?>

