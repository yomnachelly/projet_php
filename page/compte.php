<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">  <!-- Fichier CSS personnalisé -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<style>
    h1{
        
    }
    
        .navbar .btn-transparent {
                    background-color: transparent;
                    color: #fff;
                    border: 1px solid #fff;
                }
        .navbar .btn-transparent:hover {
                    background-color: #fff;
                    color: #343a40;
        }
        header.navbar {
            background-color: #343a40; /* Couleur de fond personnalisée */
        }

        .navbar-brand {
            color: #fff; /* Texte du logo en blanc */
        }

        .navbar-light .navbar-nav .nav-link {
            color: #fff; /* Liens de la navbar en blanc */
        }
       
        table {
    margin-top: 20px;
    text-align: left;
    width: 100%;
}
.btn-info {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    font-size: 16px;
    text-align: center;
}

        
        
.form-container {
        display: flex;
        gap: 20px; /* ajustez l'espace ici */
    }    
      
    
    .btn1 {
    background: none;
    border: none;
    cursor: pointer;
}

.btn1 i {
    font-size: 1.2em; /* Ajustez la taille selon vos besoins */
    color: #333; /* Couleur des icônes */
}

.btn1:hover i {
    color: red; /* Couleur au survol */
}

        
        </style>

<script>
function addImage() {
    
    // Simuler un clic sur l'input de fichier
    document.getElementById('imageInput').click();
}
</script>





<body>
   <!-- Barre de navigation -->
   <header class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="home.php">HotelConnect</a>
        <div class="ml-auto">
            <!-- Conteneur des boutons et de l'icône -->
            <div class="form-container d-flex align-items-center">
                <!-- Boutons -->
                
                <form action="event.php" method="get" class="d-flex">
                    <button type="submit" class="btn btn-transparent">Events</button>
                </form>
                <form action="reservation.php" method="get" class="d-flex">
                    <button type="submit" class="btn btn-transparent">Reservation</button>
                </form>

                <!-- Icône cliquable -->
                <a href="login.php" style="margin-left: 10px; text-decoration: none;">
                    <i class="fa-sharp fa-solid fa-arrow-right-from-bracket fa-flip-vertical" 
                       style="font-size: 24px; color: white;"></i>
                </a>
            </div>
        </div>
    </div>
</header>

    <main class="container mt-5">
    <div class="row">
        <!-- Colonne gauche pour le bouton d'ajout d'image -->
        <div class="col-md-3 d-flex align-items-center justify-content-center">
        <form action="upload_image.php" method="POST" enctype="multipart/form-data">
        <!-- Champ de fichier caché -->
        <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;" >
        
        <!-- Bouton déclencheur -->  
        <button type="button" class="btn-info" onclick="addImage()"><i class="fa-sharp-duotone fa-solid fa-download"style="font-size: 24px; color:#EFAA36;"></i></button>
    </form>
</div>
       

        <!-- Colonne droite pour le tableau -->
        <div class="col-md-9">
        <?php
session_start();

// Vérification de la connexion utilisateur
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'hotelconnect';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupération du CIN depuis l'URL
if (isset($_GET['cin'])) {
    $cin = $_GET['cin'];

    // Requête pour récupérer les informations client
    $query = "
            SELECT c.nom, c.prenom, r.id_res, r.date_check_in, r.date_check_out
    FROM client c
    LEFT JOIN reservation r ON c.cin = r.id_client
    WHERE c.cin = :cin

    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':cin' => $cin]);
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Compter le nombre total de réservations
    $countQuery = "SELECT COUNT(*) AS total_reservations FROM reservation WHERE id_client = :cin";
    $countStmt = $pdo->prepare($countQuery);
    $countStmt->execute([':cin' => $cin]);
    $countResult = $countStmt->fetch(PDO::FETCH_ASSOC);
    $totalReservations = $countResult['total_reservations'];

    // Affichage des informations du client
    if ($reservations) {
        echo "<h1 class='text-center mb-4'>Informations du Client</h1>";
        echo "<p><strong >Nom :</strong> " . htmlspecialchars($reservations[0]['nom']) . "</p>";
        echo "<p><strong>Prénom :</strong> " . htmlspecialchars($reservations[0]['prenom']) . "</p>";

        // Tableau des réservations
        echo '<i class="fa-regular fa-bell fa-shake fa-2x"></i> <h2 class="mt-4 d-inline">Réservations</h2>';

        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>
                <tr>
                    <th>Date de Check-In</th>
                    <th>Date de Check-Out</th>
                </tr>
              </thead>";
        echo "<tbody>";
        foreach ($reservations as $reservation) {
          /*  echo "<tr>";
            echo "<td>" . htmlspecialchars($reservation['date_check_in']) . "</td>";
            echo "<td>" . htmlspecialchars($reservation['date_check_out']) . <i class="fa-solid fa-trash"></i><i class="fa-solid fa-pen"></i>"</td>";
            echo "</tr>";*/
            echo "<tr>";
            echo "<td>" . htmlspecialchars($reservation['date_check_in']) . "</td>";
            echo "<td>" . htmlspecialchars($reservation['date_check_out']) . "</td>";
            if (isset($reservation['id_res'])) {
                echo "<td>
                    <button class='btn1'onclick=\"actionSupprimer('" . htmlspecialchars($reservation['id_res']) . "')\">
                        <i class=\"fa-solid fa-trash\"></i>
                    </button>
                    <button class='btn1' onclick=\"actionModifier('" . htmlspecialchars($reservation['id_res']) . "')\">
                        <i class=\"fa-solid fa-pen\"></i>
                    </button>
                </td>";
            } else {
                echo "<td>Aucune action disponible</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        // Affichage du nombre total de réservations
        echo "<p class='mt-3'><strong>Nombre total de réservations :</strong> " . htmlspecialchars($totalReservations) . "</p>";
    } else {
        echo "<h1 class='text-center mb-4'>Informations du Client</h1>";
        echo "<p><strong>Nom :</strong> " . htmlspecialchars($reservations[0]['nom']) . "</p>";
        echo "<p><strong>Prénom :</strong> " . htmlspecialchars($reservations[0]['prenom']) . "</p>";

        // Affichage du tableau vide
        echo "<h2 class='mt-4'>Réservations</h2>";
        echo "<table class='table table-bordered table-striped'>
                <thead>
                    <tr>
                        <th>Date de Check-In</th>
                        <th>Date de Check-Out</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan='2' class='text-center'>Aucune réservation trouvée.</td>
                    </tr>
                </tbody>
              </table>";

        // Affichage du nombre total de réservations
        echo "<p class='mt-3'><strong>Nombre total de réservations :</strong> 0</p>";
        echo "<div class='alert alert-info text-center' role='alert'>
                <strong>Info :</strong> Aucune réservation trouvée pour ce client.
              </div>";
    }
} else {
    echo "<p>Aucun CIN fourni dans l'URL.</p>";
}
?>

        </div>
    </div>
</main>
<script>
    function actionSupprimer(id) {
   
    alert("Suppression de la réservation avec l'id : " + id);
   
}

function actionModifier(id) {
   
    alert("Modification de la réservation avec l'id : " + id);
    
}


</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>