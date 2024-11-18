<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Badira - Hammamet</title>
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

        /* Personnalisation du bouton transparent */
        .navbar .btn-transparent {
            background-color: transparent;
            color: #fff;
            border: 1px solid #fff;
        }

        .navbar .btn-transparent:hover {
            background-color: #fff;
            color: #343a40;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <header class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">HotelConnect</a>
            <div class="ml-auto">
                <!-- Formulaire pour le bouton Log In avec un bouton transparent -->
                <form action="login.php" method="get" class="d-flex">
                    <button type="submit" class="btn btn-transparent">Log In</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Section principale -->
    <main class="main-content">
        <div class="image-container">
            <img src="img.jpg" alt="La Badira Hammamet" class="img-fluid w-100">
        </div>
        <div class="container my-5">
            <div class="article-container">
                <h1 class="text-center">Bienvenue à La Badira</h1>
                <p>
                    Bienvenue à La Badira : Un Voyage vers l’Excellence<br>
                    Bienvenue sur le site de La Badira "HotelConnect", un lieu où l’élégance intemporelle rencontre un confort exceptionnel.<br>
                    Nous sommes ravis de vous accueillir dans notre oasis nichée au cœur de Hammamet, face à l’immensité de la Méditerranée.
                </p>
                <h3>Un Séjour Inoubliable Vous Attend</h3>
                <p>
                    Que vous soyez en voyage d’affaires, en quête de détente ou à la recherche d’un cadre enchanteur pour vos événements, La Badira vous ouvre ses portes. Découvrez :
                </p>
                <ul>
                    <li><b>Des chambres élégantes offrant une vue imprenable sur la mer ou les jardins.</b></li>
                    <li><b>Une cuisine raffinée, célébrant les saveurs locales et internationales.</b></li>
                    <li><b>Un spa d’exception, pour un moment de relaxation absolue.</b></li>
                </ul>
                <h3>Une Expérience Unique à Chaque Instant</h3>
                <p>
                    Plongez dans l’atmosphère sereine de notre hôtel, où chaque détail est pensé pour sublimer votre séjour. Promenez-vous dans notre galerie, explorez nos offres exclusives et laissez-vous inspirer par les témoignages de nos hôtes.
                </p>
                <h3>L’Alliance du Luxe et de la Culture Tunisienne</h3>
                <p>
                    La Badira est bien plus qu’un hôtel, c’est une expérience. À travers une architecture moderne sublimée par des touches de tradition tunisienne, chaque coin de notre établissement raconte une histoire, celle du raffinement et de l’accueil chaleureux.
                </p>
                <p>
                    Nous vous invitons à vivre des moments inoubliables, à savourer chaque instant et à repartir le cœur chargé de souvenirs. Bienvenue chez vous, bienvenue à La Badira.
                </p>
                <p>
                    Venez profiter d'un service exceptionnel, d'une cuisine raffinée et d'un cadre paradisiaque pour des souvenirs inoubliables.
                </p>
            </div>
        </div>

        <!-- Section d'images supplémentaires -->
       
        <!-- Section d'images supplémentaires -->
        <div class="container my-5">
            <h2 class="text-center mb-4">Nos Services en Images</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="image-card">
                        <img src="Chambre.jpg" alt="Chambres élégantes" class="img-fluid">
                        <h5 class="text-center">Chambres Élégantes</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="image-card">
                        <img src="Spa.jpg" alt="Spa de luxe" class="img-fluid">
                        <h5 class="text-center">Spa de Luxe</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="image-card">
                        <img src="event.jpg" alt="Cuisine raffinée" class="img-fluid">
                        <h5 class="text-center">evenement</h5>
                    </div>
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
