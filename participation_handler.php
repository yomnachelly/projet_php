<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

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

// Retrieve the event ID from the URL and client CIN from the session
if (isset($_GET['id_event']) && isset($_SESSION['user_id'])) {
    $id_event = $_GET['id_event'];
    $cin = $_SESSION['user_id']; // Assuming CIN is stored as 'user_id' in session

    // Prepare the SQL to insert into the 'participation' table
    $query = "INSERT INTO participation (cin, id_event) VALUES (:cin, :id_event)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['cin' => $cin, 'id_event' => $id_event]);

    // Redirect to the user's account page (compte.php) with CIN parameter
    header("Location: compte.php?cin=" . $cin);
    exit();
} else {
    // Handle missing parameters or session
    echo "Error: Missing event ID or user not logged in.";
}
?>
