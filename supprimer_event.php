<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=hotelconnect;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérification que l'ID de l'événement est passé en paramètre
if (isset($_GET['id_event'])) {
    $id_event = intval($_GET['id_event']); // Sécurisation de l'ID

    // Récupérer l'cin correspondant à cet événement
    $requete_participant = $bdd->prepare('SELECT cin FROM participation WHERE id_event = ?');
    $requete_participant->execute([$id_event]);
    $participant = $requete_participant->fetch(PDO::FETCH_ASSOC);

    if ($participant) {
        $cin = $participant['cin'];

        // Suppression de l'événement
        $requete_delete = $bdd->prepare('DELETE FROM events WHERE id_event = ?');
        if ($requete_delete->execute([$id_event])) {
            echo "<script>
                    alert('L\'événement a été supprimé avec succès.');
                    window.location.href = 'compte.php?cin=' + $cin;
                  </script>";
        } else {
            echo "<script>
                    alert('Erreur lors de la suppression de l\'événement.');
                  </script>";
        }
    } else {
        echo "<script>
                alert('Aucun participant trouvé pour cet événement.');
              </script>";
    }
} else {
    echo "<script>
            alert('Aucun ID d\'événement spécifié.');
          </script>";
}
?>
