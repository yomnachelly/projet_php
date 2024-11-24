<?php
session_start();

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

// Vérification si les données ont été envoyées via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour vérifier si l'utilisateur existe
    $query = "SELECT * FROM client WHERE email_client = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Vérifier le mot de passe
        if (password_verify($password, $user['pwd_client'])) {
            // Enregistrer des informations dans la session
            $_SESSION['user_id'] = $user['cin'];
            $_SESSION['user_name'] = $user['nom'] . ' ' . $user['prenom'];

            // Rediriger vers la page compte.php avec le CIN
            header("Location: compte.php?cin=" . urlencode($user['cin']));
            exit;
        } else {
            $_SESSION['error'] = "Mot de passe incorrect.";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Aucun compte trouvé avec cet email.";
        header("Location: login.php");
        exit;
    }
}
?>
