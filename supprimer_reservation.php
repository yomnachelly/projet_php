<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=hotelconnect;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérification que l'ID de la réservation est passé en paramètre
if (isset($_GET['id_res'])) {
    $id_res = intval($_GET['id_res']); // Sécurisation de l'ID

    // Récupérer le cin associé à la réservation
    $requete_cin = $bdd->prepare('SELECT id_client FROM reservation WHERE id_res = ?');
    $requete_cin->execute([$id_res]);
    $resultat = $requete_cin->fetch();

    if ($resultat) {
        $cin = $resultat['id_client'];

        // Suppression de la réservation
        $requete_delete = $bdd->prepare('DELETE FROM reservation WHERE id_res = ?');
        if ($requete_delete->execute([$id_res])) {
            echo "<script>
                    alert('Votre réservation a été supprimée avec succès 😞!');
                    window.location.href = 'http://127.0.0.1/projet_php-2/compte.php?cin=' + $cin;
                  </script>";
        } else {
            echo "<script>alert('Erreur lors de la suppression de la réservation.');</script>";
        }
    } else {
        echo "<script>alert('Réservation introuvable.');</script>";
    }
} else {
    echo "Aucun ID de réservation spécifié.";
}
?>
