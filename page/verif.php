<?php
// Démarrage de la session pour stocker des messages d'erreur ou des informations de session
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
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour vérifier si l'utilisateur existe
    $query = "SELECT * FROM client WHERE email_client = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Vérifier si le mot de passe correspond à celui enregistré
        if (password_verify($password, $user['pwd_client'])) {
            // Authentification réussie, enregistrer l'ID de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['cin'];
            $_SESSION['user_name'] = $user['nom'] . ' ' . $user['prenom'];

            // Rediriger vers une page sécurisée (par exemple, le tableau de bord)
            header("Location: compte.php");
            exit;
        } else {
            // Mot de passe incorrect
            $_SESSION['error'] = "Mot de passe incorrect. Vérifiez vos données.";
            
            header("Location: login.php");
            exit;
        }
    } else {
        // L'utilisateur n'existe pas
        $_SESSION['error'] = "Aucun compte trouvé avec cet email. Vérifiez vos données.";
         
        header("Location: login.php");
        exit;
    }
}
?>
