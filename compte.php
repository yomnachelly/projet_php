<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css"> <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        header.navbar {
            background-color: #343a40;
        }
        .navbar-brand, .navbar-light .navbar-nav .nav-link {
            color: #fff;
        }
        .btn-transparent {
            background: transparent;
            color: #fff;
            border: 1px solid #fff;
        }
        .btn-transparent:hover {
            background: #fff;
            color: #343a40;
        }
        table {
            margin-top: 20px;
            width: 100%;
        }
        .btn1 {
            background: none;
            border: none;
            cursor: pointer;
        }
        .btn1 i {
            font-size: 1.2em;
            color: #333;
        }
        .btn1:hover i {
            color: red;
        }
        .btn-info {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            font-size: 16px;
            text-align: center;
        }
    </style>
    <script>
        function addImage() {
            document.getElementById('imageInput').click();
        }
        function actionSupprimer(id_res) {
        if (confirm("Voulez-vous vraiment supprimer cette réservation ?")) {
            
            window.location.href = "supprimer_reservation.php?id_res=" + id_res;
        }
    }

    function actionModifier(id_res) {
        // Redirection vers une page ou formulaire pour modifier la réservation
        window.location.href = "modifier_reservation.php?id_res=" + id_res;
    }
    function actionSupprimerevent(id_event) {
    if (confirm("Voulez-vous vraiment supprimer cet événement ?")) {
        window.location.href = "supprimer_event.php?id_event=" + id_event;
    }
}
   

    </script>
</head>
<body>
    <!-- Navbar -->
    <header class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="home.php">HotelConnect</a>
            <div class="ml-auto d-flex align-items-center">
            <form action="event.php" method="get" class="d-flex">
    <button type="submit" class="btn btn-transparent">Events</button>
</form>
<div style="width: 10px;"></div>
<form action="reservation.php" method="get" class="d-flex">
    <button type="submit" class="btn btn-transparent">Reservation</button>
</form>

                <a href="login.php" class="ms-3">
                    <i class="fa-sharp fa-solid fa-arrow-right-from-bracket fa-flip-vertical" 
                       style="font-size: 24px; color: white;"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mt-5">
        <div class="row">
            <!-- Image Upload Section -->
            <div class="col-md-3 d-flex align-items-center justify-content-center">
                <form action="upload_image.php" method="POST" enctype="multipart/form-data">
                    <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;">
                    <button type="button" class="btn-info" onclick="addImage()">
                        <i class="fa-solid fa-upload" style="font-size: 24px; color: #EFAA36;"></i>
                    </button>
                </form>
            </div>

            <!-- Client Information and Reservations -->
            <div class="col-md-9">
                <?php
                session_start();

                // Check user login status
                if (!isset($_SESSION['user_id'])) {
                    header("Location: login.php");
                    exit;
                }

                // Database Connection
                $host = 'localhost';
                $dbname = 'hotelconnect';
                $username = 'root';
                $password = '';
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Database connection error: " . $e->getMessage());
                }

                // Get CIN from URL
                if (isset($_GET['cin'])) {
                    $cin = $_GET['cin'];

                    // Query for client and reservation data
                    $query = "
                        SELECT c.nom, c.prenom, r.id_res, r.date_check_in, r.date_check_out,r.meals
                        FROM client c
                        LEFT JOIN reservation r ON c.cin = r.id_client
                        WHERE c.cin = :cin
                    ";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute([':cin' => $cin]);
                    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Query for events and participation data
                    $eventsQuery = "
                        SELECT e.id_event, e.nom_event, e.date_event, e.emplacement
                        FROM events e
                        JOIN participation p ON e.id_event = p.id_event
                        WHERE p.cin = :cin

                    ";
                    $eventsStmt = $pdo->prepare($eventsQuery);
                    $eventsStmt->execute([':cin' => $cin]);
                    $events = $eventsStmt->fetchAll(PDO::FETCH_ASSOC);

                    // Count total reservations
                    $countQuery = "SELECT COUNT(*) AS total_reservations FROM reservation WHERE id_client = :cin";
                    $countStmt = $pdo->prepare($countQuery);
                    $countStmt->execute([':cin' => $cin]);
                    $totalReservations = $countStmt->fetch(PDO::FETCH_ASSOC)['total_reservations'];
                    //somme des prix
                    $sumQuery = "
                        SELECT SUM(c.prix) AS total_prix
                        FROM reservation r
                        JOIN chambre c ON r.id_chambre = c.num_ch
                        WHERE r.id_client = :cin
                    ";
                    $sumStmt = $pdo->prepare($sumQuery);
                    $sumStmt->execute([':cin' => $cin]);
                    $totalprix = $sumStmt->fetch(PDO::FETCH_ASSOC)['total_prix'];



                    // Display Client Info
                    if ($reservations) {
                        echo "<h1 class='text-center mb-4'>Informations du Client</h1>";
                        echo "<p><strong>Nom:</strong> " . htmlspecialchars($reservations[0]['nom']) . "</p>";
                        echo "<p><strong>Prénom:</strong> " . htmlspecialchars($reservations[0]['prenom']) . "</p>";
                        echo '<i class="fa-regular fa-bell fa-shake fa-2x"></i> <h2 class="mt-4 d-inline">Réservations</h2>';
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead><tr><th>Date Check-In</th><th>Date Check-Out</th><th>repats</th><th>Actions</th></tr></thead><tbody>";
                        foreach ($reservations as $reservation) {
                            echo "<tr>";
                            echo "<td>" .$reservation['date_check_in'] . "</td>";
                            echo "<td>" .$reservation['date_check_out'] . "</td>";
                            echo "<td>" .$reservation['meals'] . "</td>";
                            echo "<td>";
                            if (isset($reservation['id_res'])) {
                                echo "<button class='btn1' onclick=\"actionSupprimer('" . htmlspecialchars($reservation['id_res']) . "')\">
                                        <i class=\"fa-solid fa-trash\"></i>
                                      </button>";
                                echo "<button class='btn1' onclick=\"actionModifier('" . htmlspecialchars($reservation['id_res']) . "')\">
                                        <i class=\"fa-solid fa-pen\"></i>
                                      </button>";
                            } else {
                                echo "N/A";
                            }
                            echo "</td></tr>";
                        }
                        echo "</tbody></table>";
                        echo "<p class='mt-3'><strong>Total Réservations:</strong> " . $totalReservations . "</p>";
                        
                        echo "<p class='mt-3'><strong>Prix total:</strong> " . $totalprix . "</p>";
                    } else {
                        echo "<h1 class='text-center mb-4'>Aucune Information Client</h1>";
                        echo "<div class='alert alert-info text-center'>Aucune reservation trouvé pour ce client.</div>";
                    }

                    // Display Events Participation
                    if ($events) {
                        echo '<i class="fa-regular fa-bell fa-shake fa-2x"></i> <h2 class="mt-4 d-inline">événement</h2>';
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead><tr><th>Nom de l'Événement</th><th>Date</th><th>Emplacement</th><th>Actions</th></tr></thead><tbody>";
                        foreach ($events as $event) {
                            echo "<tr>";
                            echo "<td>" . $event['nom_event'] . "</td>";
                            echo "<td>" . $event['date_event'] . "</td>";
                            echo "<td>" . $event['emplacement'] . "</td>";
                            echo "<td>";
                            if (isset($event['id_event'])) {
                                echo "<button class='btn1' onclick=\"actionSupprimerevent('" . $event['id_event'] . "')\">
                                <i class=\"fa-solid fa-trash\"></i>
                              </button>";
                        
                                
                            } else {
                                echo "N/A";
                            }
                            echo "</td></tr>";
                            
                        }
                        echo "</tbody></table>";
                    } 
                    else {
                        echo "<div class='alert alert-info text-center'>Aucun événement trouvé pour ce client.</div>";
                    }
                } else {
                    echo "<p>Aucun CIN fourni dans l'URL.</p>";
                }
                ?>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
