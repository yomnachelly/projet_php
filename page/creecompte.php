

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Compte - La Badira</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">  <!-- Fichier CSS personnalisé -->
    <style>
        /* Personnalisation de la barre de navigation */
        header.navbar {
            background-color: #343a40; /* Couleur de fond personnalisée */
        }

        .navbar-brand {
            color: #fff; /* Texte du logo en blanc */
        }

        .navbar-light .navbar-nav .nav-link {
            color: #fff; /* Liens de la navbar en blanc */
        }

        /* Personnalisation du formulaire */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container .form-control {
            margin-bottom: 15px;
            
        }
        /* Style de survol (hover) pour le lien 'home' */
.btn-transparent {
    background-color: #CA2110;
    color: white; 
    border-radius: 5px; /* Ajouter un arrondi aux bords du bouton */
    transition: background-color 0.3s, color 0.3s; /* Ajouter une transition fluide */
}

    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <header class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">HotelConnect</a>
            <div class="ml-auto">
                <!-- Formulaire pour le bouton Log In -->
                <form action="home.php" method="get" class="d-flex">
                <form action="home.php" method="get" class="d-flex">
    <button type="submit" class="btn btn-transparent">home</button>
</form>

                </form>
            </div>
        </div>
    </header>

    <!-- Section principale -->
    <main class="main-content">
        <div class="container my-5">
            <h1 class="text-center mb-4">Créer un Compte</h1>
            <div class="form-container">
                <!-- Formulaire d'inscription -->
                <form action="creecomte.php" method="POST">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Âge</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="mb-3">
                        <label for="etat_soc" class="form-label">État Civil</label>
                        <input type="text" class="form-control" id="etat_soc" name="etat_soc" required>
                    </div>
                    
                   
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">Numéro de téléphone</label>
                        <input type="tel" class="form-control" id="tel" name="tel" required>
                    </div>
                    <button   type="submit" class="btn btn-danger w-100">Créer un compte</button>
                </form>
                <!-- Lien pour se connecter si l'utilisateur a déjà un compte -->
                <div class="text-center mt-3">
                    <p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous ici</a>.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Barre en bas -->
    <footer class="navbar navbar-light bg-dark text-white text-center py-3">
        <p>&copy; 2024 La Badira Hammamet. Tous droits réservés.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
