<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
  <!--Bootstrap css and js cdn-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  .log:hover {
    background: #613db9
  }
  </style>
</head>

<body>
  <!----------------------- Main Container -------------------------->
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->
    <div class="row border rounded p-0 bg-white shadow box-area" style="height:700px">
      <!--------------------------- Left Box ----------------------------->
      <div class="col-md-6 p-3 right-box m-auto p-5">
        <div class="header-text mb-4">
          <h2 class="fw-semibold ">Connexion</h2>
          <p>Veuillez insérer vos informations.</p>
        </div>
        <div class="row align-items-center">

          <div class="input-group mb-3">
            <input id="email" type="text" class="form-control form-control-lg bg-light fs-6"
              placeholder="Adresse e-mail">
          </div>
          <div class="input-group mb-1">
            <input id="password" type="password" class="form-control form-control-lg bg-light fs-6"
              placeholder="Mot de passe">
          </div>
          <div class="input-group mb-5 d-flex justify-content-between">
            <div class="forgot">
              <small><a href="#">Mot de pass oublier?</a></small>
            </div>
          </div>
          <div class="input-group mb-3">
            <button class="log btn btn-lg  w-100 fs-6" onclick="login()"
              style="background:#7e56da;color:white">Login</button>
          </div>
        </div>
      </div>
      <!-------------------- ------ Right Box ---------------------------->
      <div class="col-md-6 d-flex rounded p-0 justify-content-center align-items-center flex-column left-box"
        style="background:#f3f4f8">
        <div class="featured-image mb-3">
          <img src="img/login.png" class="img-fluid" style="width: 500px;">
        </div>
      </div>
    </div>
  </div>
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