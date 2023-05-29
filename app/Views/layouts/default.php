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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
    integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous" />

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

<body class="container-fluid p-0 m-0">

  <!-- Sticky navbar-->
  <header class="bg-white py-0 sticky-top">
    <section class="header py-4 text-center"></section>
    <nav class="navbar navbar-expand-lg py-2 px-2 navbar-light shadow-sm">
      <div class="container-fluid mx-5">
        <a class="navbar-brand fs-4" href="#">
          <img class="m-0 p-0" src="/img/mtds_logo.png" alt="Logo" width="50" height="50" />
          <strong class="mb-2 font-weight-bold">MTDS</strong>
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto me-5">
            <li class="nav-item active">
              <a class="nav-link" href="/home">Accueil <span class="sr-only"></span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="/devis">Devis</a></li>
            <li class="nav-item">
              <a class="nav-link" href="/service">Service</a>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                  aria-haspopup="false" aria-expanded="true">
                  <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Profile</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/">Logout</a>
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
    <footer class="footer d-flex justify-content-between align-items-center py-3 my-4 border-top  mx-2">
      <p class="col-md-4 mb-0 text-muted">© 2023 Company, Inc</p>

      <a
        class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
          <use xlink:href="#bootstrap"></use>
        </svg>
      </a>

      <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item">
          <a href="/home" class="nav-link px-2 text-muted">Accueil</a>
        </li>
        <li class="nav-item">
          <a href="/devis" class="nav-link px-2 text-muted">Devis</a>
        </li>
        <li class="nav-item">
          <a href="/service" class="nav-link px-2 text-muted">Service</a>
        </li>
      </ul>
    </footer>
  </div>
  <script>
  $(document).ready(function() {
    $('#Table').DataTable();
  });
  </script>
</body>

</html>