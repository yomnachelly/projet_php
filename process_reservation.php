<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=hotelconnect", "root", "");

        $id_chambre = $_POST['id_chambre'];
        $date_check_in = $_POST['date_check_in'];
        $date_check_out = $_POST['date_check_out'];
        $id_client = $_SESSION['user_id']; // Use session ID for client
        $meals = isset($_POST['meals']) ? implode(',', $_POST['meals']) : '';

        // Insert reservation into the database
        $sql = "INSERT INTO reservation (id_chambre, date_check_in, date_check_out, id_client, meals)
                VALUES (:id_chambre, :date_check_in, :date_check_out, :id_client, :meals)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id_chambre' => $id_chambre,
            'date_check_in' => $date_check_in,
            'date_check_out' => $date_check_out,
            'id_client' => $id_client,
            'meals' => $meals,
        ]);

        // Retrieve the CIN of the client for redirection
        $cinQuery = "SELECT cin FROM client WHERE  cin = :id_client";
        $cinStmt = $pdo->prepare($cinQuery);
        $cinStmt->execute(['id_client' => $id_client]);
        $cinResult = $cinStmt->fetch(PDO::FETCH_ASSOC);

        if ($cinResult && isset($cinResult['cin'])) {
            $cin = $cinResult['cin'];
            // Redirect to compte.php with the CIN as a parameter
            header("Location: compte.php?cin=" . urlencode($cin));
            exit();
        } else {
            throw new Exception("CIN introuvable pour cet utilisateur.");
        }
    } catch (PDOException $e) {
        die("Erreur lors de la réservation : " . $e->getMessage());
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
}
?>
