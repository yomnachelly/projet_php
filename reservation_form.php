<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['user_id']; // Use this to associate bookings with the logged-in user
?>

<?php
if (isset($_GET['id_chambre'])) {
    $id_chambre = $_GET['id_chambre'];

    try {
        // Connect to the database
        $pdo = new PDO("mysql:host=localhost;dbname=hotelconnect", "root", "");

        // Fetch room details
        $sql = "SELECT * FROM chambre WHERE num_ch = :id_chambre";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_chambre' => $id_chambre]);

        $room = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$room) {
            die("Chambre non trouvée.");
        }
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
} else {
    die("ID de chambre manquant.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Réservation de Chambre</title>
    <style>
        h2{
            color: #efaa36;
        }
        header.navbar {
            background-color: #343a40;
        }
        .navbar-brand, .navbar-light .navbar-nav .nav-link {
            color: #fff;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container .form-control {
            margin-bottom: 15px;
        }
        .navbar .btn-transparent {
            background-color: transparent;
            color: #fff;
            border: 1px solid #fff;
        }

        .navbar .btn-transparent:hover {
            color: #343a40;
            border: 1px solid #fff;
            background-color: #fff;
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
    <!-- Navigation Bar -->
    <header class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">HotelConnect</a>
            <div class="ml-auto">
                <!-- Formulaire pour le bouton Log In avec un bouton transparent -->
                <a href="reservation.php" class="ms-3">
                    <i class="fa-solid fa-share" 
                       style="font-size: 24px; color: white;"></i>
                </a>
            </div>
        </div>
       
    </header>

    <!-- Reservation Form Section -->
    <div class="container mt-5">
        <div class="form-container">
            <h2 class="text-center mb-4">Réservation de la Chambre <?php echo htmlspecialchars($room['num_ch']); ?></h2>

            <form action="process_reservation.php" method="post">
                <input type="hidden" name="id_chambre" value="<?php echo htmlspecialchars($room['num_ch']); ?>">

                <div class="mb-3">
                    <label for="date_check_in" class="form-label">Date d'arrivée</label>
                    <input type="date" id="date_check_in" name="date_check_in" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="date_check_out" class="form-label">Date de départ</label>
                    <input type="date" id="date_check_out" name="date_check_out" class="form-control" required>
                </div>

                <div class="mb-3">
    <label for="id_client" class="form-label">ID du Client</label>
    <input type="number" id="id_client" name="id_client" class="form-control" value="<?php echo htmlspecialchars($user_id); ?>" readonly>
</div>


                <div class="mb-3">
                    <label class="form-label">Repas (sélectionnez vos préférences):</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="breakfast" name="meals[]" value="breakfast">
                        <label class="form-check-label" for="breakfast">Petit déjeuner</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="lunch" name="meals[]" value="lunch">
                        <label class="form-check-label" for="lunch">Déjeuner</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dinner" name="meals[]" value="dinner">
                        <label class="form-check-label" for="dinner">Dîner</label>
                    </div>
                </div>

                <button type="submit" class="btn w-100">Réserver</button>
            </form>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="text-center">
        <p>&copy; 2024 HotelConnect. Tous droits réservés.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
