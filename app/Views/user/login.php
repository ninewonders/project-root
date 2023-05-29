<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
  <!--Bootstrap css and js cdn-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  <!--css Link-->
  <link rel="stylesheet" href="../css/login.css" />


  <style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
  </style>

</head>

<body class="text-center">

  <main class="form-signin">

    <img class="mb-4" src="/img/mtds_logo.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 fw-normal">Se connecter</h1>

    <div class="form-floating">
      <input id="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email </label>
    </div>
    <div class="form-floating mb-2">
      <input id="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword ">Mot de pass</label>
    </div>
    <button class="w-100 btn btn-lg btn-secondary mt-5" type="submit" onclick="login()">Login</button>

  </main>
  <script>
  async function login() {
    email = document.getElementById('email');
    password = document.getElementById('password');

    insertData = {
      'email': email.value,
      'password': password.value
    }

    fetch('login', {
        method: 'POST',
        body: JSON.stringify(insertData)
      })
      .then(response => response.json())
      .then(data => {
        if (data.message == 'Authentication successful') {
          window.location.href = '/home';
        }
      })
      .catch(error => {
        console.error(error);
      });
  }
  </script>
</body>

</html>