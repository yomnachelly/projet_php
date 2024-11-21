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
        #carouselExampleDark .carousel-inner img {
  height: 400px; /* Modifiez la hauteur selon vos besoins */
  object-fit: cover; /* Assurez-vous que l'image couvre bien la zone sans se déformer */
}
/* Modifier le titre */
#carouselExampleDark .carousel-caption h5 {
  font-family: 'Arial', sans-serif; /* Remplacez par la police de votre choix */
  font-size: 2rem; /* Taille du texte */
  color: #fff; /* Couleur du texte */
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Ombre portée pour améliorer la lisibilité */
}

/* Modifier le texte de description */
#carouselExampleDark .carousel-caption p {
  font-family: 'Verdana', sans-serif; /* Remplacez par la police de votre choix */
  font-size: 1rem; /* Taille du texte */
  color: #fff; /* Couleur du texte */
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7); /* Ombre portée */
}
/* Réduire la taille de l'image */
.image-container img {
  width: 50%; /* Modifiez la taille de l'image à la largeur souhaitée (par exemple, 50%) */
  height: 800px; /* Conserver les proportions de l'image */
  margin-top: 0; /* Appliquer un margin-top de 0 */
}
/* Classe pour l'agrandissement avec transition */
/* Classe pour l'agrandissement au survol */
.zoomable {
    transition: transform 0.3s ease; /* Transition douce pour l'agrandissement */
}

/* Agrandir l'image au survol */
.zoomable:hover {
    transform: scale(1.1); /* Agrandissement de 10% */
}

.carousel-img {
  height: 650px; /* Adjust this value to control the height */
  object-fit: cover; /* Ensures images cover the area without stretching */
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

 <!--carlouse1-->
<div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img.jpg" class="d-block w-100 carousel-img" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img2.jpg" class="d-block w-100 carousel-img" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img3.jpg" class="d-block w-100 carousel-img" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    <!-- Section principale -->
    <main class="main-content">
       <!-- <div class="image-container">
            <img src="img.jpg" alt="La Badira Hammamet" class="img-fluid w-100">
        </div>-->
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
                 <!-- Section d'images supplémentaires -->
       <!--carousel-->
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="Rest.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Gastronomie</h5>
        <p>Revisitant les classiques de la cuisine tunisienne et méditerranéenne, on vous propose plusieurs cartes inventives et généreuses .</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="suite.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Suite</h5>
        <p> ,/Spacieuses, avec vue sur la Méditerranée, nos suites incarnent avec subtilité un mélange d’authenticité,.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="decouverte.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Découverte</h5>
        <p>Notre équipe œuvre avec passion à faire de votre séjour une aventure inoubliable.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
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
        <div class="container my-5">
    <h2 class="text-center mb-4">Nos Services en Images</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="image-card">
                <img src="Chambre.jpg" alt="Chambres élégantes" class="img-fluid zoomable">
                <h5 class="text-center">Chambres Élégantes</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="image-card">
                <img src="Spa.jpg" alt="Spa de luxe" class="img-fluid zoomable">
                <h5 class="text-center">Spa de Luxe</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="image-card">
                <img src="event.jpg" alt="Cuisine raffinée" class="img-fluid zoomable">
                <h5 class="text-center">Événement</h5>
            </div>
        </div>
    </div>
</div>


    </main>
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="decouverte.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>La Badira Hotel Information:</h5>
        <p>
Address:
<br>
-BP437 / HAMMAMET<br>
-8050 / TUNISIE.<br>Telephone: +(216)70018180<br>gmail:contact@labadira.com<br>Travellife: Gold Certified for Accommodation Sustainability</p>
      </div>
    </div>
  
  </div>
  
</div>
    
    <!-- Barre en bas -->
    <footer class="text-center navbar navbar-light bg-dark text-white py-2">
    <p>&copy; 2024 La Badira Hammamet. Tous droits réservés.</p>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
