<?php
$user = session()->get('user')?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calculateur</title>
  <link rel="icon" type="image/x-icon" href="/img/logo.png">
  <!--Google Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

  <!--Montserrat-->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Playfair+Display&display=swap"
    rel="stylesheet" />
  <!--Lato-->
  <link href="https://fonts.googleapis.com/css2?family=Lato&family=Playfair+Display&display=swap" rel="stylesheet" />

  <!--fontawesome icons-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--Bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />

  <!--Bootstrap css and js cdn-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  <!--css Link-->
  <link rel="stylesheet" href="../css/style.css" />
  <!--Js Link-->
  <script src="../js/script.js"></script>
  <script src="../js/devis.js"></script>

  <!--DataTables-->
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/datatables.min.css" />
  <script src="../js/datatables.min.js">
  </script>
  <!--JS libraries' links-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.1/purify.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


</head>

<body class="container-fluid p-0 m-0 bg-light">

  <!-- Sticky navbar-->
  <header class="py-0 sticky-top" style="background:#fbfbff">
    <section class="header py-4 text-center"></section>
    <nav class="navbar navbar-expand-lg py-2 px-2 navbar-light shadow-sm">
      <div class="container-fluid mx-5">
        <a class="navbar-brand fs-4" href="/profile">
          <strong class="mb-2 font-weight-bold">Calculateur prix</strong>
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto ms-2">
            <li class="nav-item">
              <a class="nav-link" href="/devis"> Devis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/service"> Service</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto me-5 ">
            <li class="nav-item d-flex">
              <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                  aria-haspopup="false" aria-expanded="true">
                  <i class="me-2 fas fa-user"></i>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="/profile"><i class="me-2 fas fa-user"></i><?= $user['name'] ?></a>
                  <div class="dropdown-divider mt-0"></div>
                  <a class="dropdown-item" href="/"><i class="bi bi-box-arrow-left me-2"></i>Deconnexion</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <?= $this->renderSection('content') ?>

  <div class="">
    <footer class="text-center text-lg-start bg-light text-light ">
      <!-- Section: Links  -->
      <section class="py-1" style="background:#040f16">
        <div class="container text-center text-md-start mt-5">
          <!-- Grid row -->
          <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-6 mx-auto mb-4">
              <!-- Content -->
              <h6 class="text-uppercase fw-bold mb-4">
                <img src="/img/mtds-logo-white.png" width="150px"></img>
              </h6>
              <p>
                MTDS est une société de conseil en technologies de l'information et en développement basée à Rabat, au
                Maroc. Notre entreprise est un Fournisseur d'Accès Internet (FAI) et est reconnue pour son expertise de
                pointe en matière de sécurité des réseaux.
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="sol-sm-12 col-md-4 col-lg-4 col-xl-3 mx-auto mb-4 ">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold mb-4">
                Liens utiles
              </h6>
              <p>
                <a href="/devis" class="ms-3 text-reset">Devis</a>
              </p>
              <p>
                <a href="/service" class="ms-3 text-reset">Service</a>
              </p>
            </div>

            <!-- Grid column -->
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-3 mx-auto mb-4 ">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
              <p><i class="fas fa-home me-3"></i> Rabat, Maroc</p>
              <p>
                <i class="fas fa-envelope me-3"></i>
                info@mtds.com
              </p>
              <p><i class="fas fa-phone me-3"></i> +212 537 674861 </p>
              <p><i class="bi bi-printer-fill fx-2 me-3"></i> +212 537 674 863 </p>
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row -->
        </div>
      </section>
      <!-- Section: Links  -->
      <hr class=" border-1 m-0" style="background:#fbfbff">
      <!-- Copyright -->
      <div class="text-center p-4" style="color:#fbfbff; background-color:#040f16;">
        © <?=date("Y")?> Copyright:
        <a class="text-reset fw-bold" href="https://mtds.com/">MTDS.com</a>
      </div>
      <!-- Copyright -->
    </footer>
  </div>
  <script>
  $(document).ready(function() {
    $('#Table').DataTable();
  });
  </script>
</body>

</html>