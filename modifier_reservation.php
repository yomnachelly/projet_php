<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=hotelconnect;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$reservation = null;

// Vérifier si l'ID de réservation est dans l'URL
if (!isset($_GET['id_res']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("ID de réservation manquant. <a href='afficher_reservations.php'>Retour</a>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mise à jour des données
    if (isset($_POST['id_res'], $_POST['date_check_in'], $_POST['date_check_out'], $_POST['id_chambre'], $_POST['meals'])) {
        $id_res = $_POST['id_res'];
        $date_check_in = $_POST['date_check_in'];
        $date_check_out = $_POST['date_check_out'];
        $id_chambre = $_POST['id_chambre'];
        $meals = implode(',', $_POST['meals']); // Convertir en chaîne pour stockage

        // Récupérer le cin associé à la réservation
        $requete = $bdd->prepare('SELECT id_client FROM reservation WHERE id_res = ?');
        $requete->execute([$id_res]);
        $result = $requete->fetch();

        if ($result) {
            $cin = $result['id_client'];
        } else {
            die("Impossible de récupérer le CIN associé. <a href='afficher_reservations.php'>Retour</a>");
        }

        $requete = $bdd->prepare('UPDATE reservation SET date_check_in = ?, date_check_out = ?, id_chambre = ?, meals = ? WHERE id_res = ?');
        $requete->execute([$date_check_in, $date_check_out, $id_chambre, $meals, $id_res]);

        echo "<script>
        alert('Votre réservation a été modifiée avec succès !');
        window.location.href = 'http://127.0.0.1/projet_php-2/compte.php?cin=' + '" . htmlspecialchars($cin) . "';
        </script>";
    } else {
        echo "Tous les champs doivent être remplis.";
    }
}

 else if (isset($_GET['id_res'])) {
    // Charger les données pour l'édition
    $id_res = $_GET['id_res'];

    $requete = $bdd->prepare('SELECT * FROM reservation WHERE id_res = ?');
    $requete->execute([$id_res]);
    $reservation = $requete->fetch();

    if (!$reservation) {
        die("Réservation non trouvée. <a href='afficher_reservations.php'>Retour</a>");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Modifier Réservation</title>
    <style>
        h2 {
            color: #efaa36;
        }
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container .btn {
            margin-top: 15px;
            color: black;
            border: solid 2px #efaa36;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .form-container .btn:hover {
            background-color: #efaa36;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2 class="text-center mb-4">Modifier Réservation</h2>
            <form action="modifier_reservation.php" method="post">
                <input type="hidden" name="id_res" value="<?php echo isset($reservation['id_res']) ? htmlspecialchars($reservation['id_res']) : ''; ?>">

                <div class="mb-3">
                    <label for="date_check_in" class="form-label">Date de Check-In</label>
                    <input type="date" id="date_check_in" name="date_check_in" class="form-control" value="<?php echo isset($reservation['date_check_in']) ? htmlspecialchars($reservation['date_check_in']) : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="date_check_out" class="form-label">Date de Check-Out</label>
                    <input type="date" id="date_check_out" name="date_check_out" class="form-control" value="<?php echo isset($reservation['date_check_out']) ? htmlspecialchars($reservation['date_check_out']) : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="id_chambre" class="form-label">ID de la Chambre</label>
                    <input type="number" id="id_chambre" name="id_chambre" class="form-control" value="<?php echo isset($reservation['id_chambre']) ? htmlspecialchars($reservation['id_chambre']) : ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Repas</label>
                    <?php
                    $meals = isset($reservation['meals']) ? explode(',', $reservation['meals']) : [];
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="breakfast" name="meals[]" value="breakfast" <?php echo in_array('breakfast', $meals) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="breakfast">Petit-déjeuner</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="lunch" name="meals[]" value="lunch" <?php echo in_array('lunch', $meals) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="lunch">Déjeuner</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dinner" name="meals[]" value="dinner" <?php echo in_array('dinner', $meals) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="dinner">Dîner</label>
                    </div>
                </div>

                <button type="submit" class="btn w-100">Enregistrer les modifications</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
