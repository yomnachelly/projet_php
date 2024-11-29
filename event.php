<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="">
    <title>HotelConnect | Liste des évènements</title>
    <style>
        /* Personnalisation de la barre de navigation */
        header.navbar {
            background-color: #343a40; /* Couleur de fond personnalisée */
        }

        .navbar-brand {
            color: #fff; /* Texte du logo en blanc */
        }

        .navbar-light .navbar-nav .nav-link {
            color: #fff; /* Liens de la navbar en blanc */
        }

        /* Personnalisation du bouton transparent */
        .navbar .btn-transparent {
            background-color: transparent;
            color: #fff;
            border: 1px solid #fff;
        }

        .navbar .btn-transparent:hover {
            background-color: #fff;
            color: #343a40;
        }
        /* Style pour la table des events */

        .mb-4, h4{
            color: #efaa36;

        }
        .mb-4{
            font-weight: bold;
        }
        .room-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }
        .room-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .btn {
            margin-top: 10px;
            color: black;
            border: solid 2px #efaa36;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .btn:hover {
            background-color: #efaa36;
        }
    </style>
</head>
<body>

    <!-- Barre de navigation -->
    <header class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="home.php">HotelConnect</a>
            <div class="ml-auto">
                <a href="compte.php?cin=<?php echo $_SESSION['user_id'] ?>" class="ms-3">
                <i class="fa-solid fa-circle-user" style="font-size: 24px; color: white;" title="Page"></i>
                </a>
                
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Liste des évènements</h2>

        <?php
        try {
            // Connexion simple à la base de données avec PDO
            $pdo = new PDO("mysql:host=localhost;dbname=hotelconnect", "root", "");

            // Requête pour récupérer les données des events
            $sql = "SELECT * FROM events";
            $stmt = $pdo->query($sql);

            // Vérification si des données sont disponibles
            if ($stmt->rowCount() > 0) {
                echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col">
                        <div class="room-card">
                            <!-- Image de l'vent -->
                            <?php 
                            echo "<img src='data:image/jpeg;base64," . base64_encode($row['event_img']) . "' alt='Image de l event' />";
                            ?>
                            <!-- Nom de l'event -->
                            <h4><strong><?php echo $row['nom_event']?></strong></h4>
                            <h6><strong>Nombre participants:</strong> <?php echo $row['nbr_part'] ?></h6>
                            <h6><strong>Date d'évènement:</strong> <?php echo $row['date_event'] ?></h6>
                            <h6><strong>Emplacement:</strong> <?php echo $row['emplacement'] ?></h6>
                            <!-- Bouton de participation -->
                            <a href="participation_handler.php?id_event=<?php echo $row['id_event'] ?>" class="btn">Participer</a>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';
            } else {
                echo '<div class="alert alert-warning text-center">Aucun évènement trouvée.</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger text-center">Une erreur est survenue : ' . $e->getMessage() . '</div>';
        }
        ?>

    </div>
    <!-- Barre en bas -->
    <footer class="navbar navbar-light bg-dark text-white text-center py-3">
        <p>&copy; 2024 HotelConnect. Tous droits réservés.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
