<?php
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
    $cin = $_POST['cin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $etat_soc = $_POST['etat_soc'];
    $email_client = $_POST['email_client'];
    $pwd_client = password_hash($_POST['pwd_client'], PASSWORD_BCRYPT); // Hachage du mot de passe
    $tel_client = $_POST['tel_client'];

    // Vérification si la CIN ou l'email existe déjà
    $checkQuery = "SELECT COUNT(*) FROM client WHERE cin = :cin OR email_client = :email_client";
    $stmt = $pdo->prepare($checkQuery);
    $stmt->execute([
        ':cin' => $cin,
        ':email_client' => $email_client
    ]);
    $exists = $stmt->fetchColumn();

    if ($exists > 0) {
        // Affichage d'une alerte si un compte existe déjà
        echo "<script>alert('Un compte avec cet email ou cette CIN existe déjà.'); window.history.back();</script>";
        exit;
    }

    // Initialisation des champs non inclus dans le formulaire
    $prix = 0;
   

    // Insertion dans la table `client`
    $sql = "INSERT INTO client (cin, nom, prenom, age, etat_soc, prix,  email_client, pwd_client, tel_client) 
            VALUES (:cin, :nom, :prenom, :age, :etat_soc, :prix,  :email_client, :pwd_client, :tel_client)";
    $stmt = $pdo->prepare($sql);

    try {
        // Exécution de la requête
        $stmt->execute([
            ':cin' => $cin,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':age' => $age,
            ':etat_soc' => $etat_soc,
            ':prix' => $prix,
            
            ':email_client' => $email_client,
            ':pwd_client' => $pwd_client,
            ':tel_client' => $tel_client,
        ]);

        // Redirection ou message de succès
        header("Location: compte.php?cin=" . urlencode($cin));
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de l'ajout du compte : " . $e->getMessage());
    }
} else {
    die("Méthode non autorisée.");
}
?>
