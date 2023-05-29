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
  <!--js Link-->
  <script src="../js/script.js"></script>
  <script src="../js/devis.js"></script>
  <!--DataTables
  -->
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/datatables.min.css" />
  <script src="../js/datatables.min.js">
  </script>
</head>

<body class="container-fluid p-0 m-0">

  <?= $this->renderSection('content') ?>
  <script>
  $(document).ready(function() {
    $('#Table').DataTable();
  });
  </script>
</body>

</html>