<?php 
$user = session()->get('user')?>
<?= $this->extend('/layouts/default') ?>



<?= $this->section('content') ?>
<div class="home container-flex pt-0 pb-0 ">
  <section class="section home-5-bg" id="home">
    <div class="card row my-4 mx-auto  bg-white border border-dark border-1 " style="width:95%">
      <div class="card-header bg-dark text-light">
        <strong class="row ps-2">Profile :</strong>
      </div>
      <div class="card-body m-3 ">
        <div class="mb-3 row">
          <label for="usernom" class="col-sm-2 col-form-label">Nom et prenom :</label>
          <div class="col-sm-9">
            <input type="text" class="form-control ps-1" onblur="" readonly value="<?=$user['name']?>">
          </div>
          <div class="col-sm-1">
            <button class="btn btn-outline-dark" onclick=""><i class="bi bi-pencil-square"></i></button>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="usermail" class="col-sm-2 col-form-label">E-mail :</label>
          <div class="col-sm-9">
            <input id="usermail" type="text" class="form-control ps-1" onblur="saveusermail()" disabled
              value="<?=$user['email']?>">
          </div>
          <div class="col-sm-1">
            <button class="btn btn-outline-dark" onclick="activateusermail()"><i
                class="bi bi-pencil-square"></i></button>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="userpassword" class="col-sm-2 col-form-label">Mot de pass :</label>
          <div class="col-sm-9">
            <input id="userpassword" type="text" class="form-control ps-1" onblur="" readonly
              value="<?=$user['password']?>">
          </div>
          <div class="col-sm-1">
            <button class="btn btn-outline-dark" onclick=""><i class="bi bi-pencil-square"></i></button>
          </div>
        </div>
      </div>
    </div>
    <?php
    $user = session()->get('user');
    if($user['user_id']==1){
      ?>
    <div class="card row my-4 mx-auto  bg-white border border-dark border-1" style="width:95%">
      <div class="card-header bg-dark text-light">
        <strong class="row ps-2">Liste des admins</strong>
      </div>
      <div class="card-body row">
        <div class="col-8 rounded">
          <table id="Table" class="table table-responsive-sm fw text-center ">
            <thead class="text-light text-center bg-dark fs-6">
              <tr scope="row">
                <th scope="col" class="col-lg-2 ps-4 text-start">Nom et prénom</th>
                <th scope="col" class="col-lg-3 ps-4 text-start">E-mail</th>
                <th scope="col" class="col-lg-2 ps-4">Mot de pass</th>
                <th scope="col" class="col-lg-1"></th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <tr scope="row">
                <td scope="col" class="text-start" type="text" value=></td>
                <td scope="col" class="text-start"></td>
                <td scope="col"></td>
                <td scope="col" class="text-center">
                  <div class="btn-group btn-group-md" role="group" aria-label="a group of buttons">
                    <a href="#" class="btn btn-outline-dark">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <button class="btn btn-dark" onclick="">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr scope="row">
                <td scope="col" class="text-start" type="text" value=></td>
                <td scope="col" class="text-start"></td>
                <td scope="col"></td>
                <td scope="col" class="text-center">
                  <div class="btn-group btn-group-md" role="group" aria-label="a group of buttons">
                    <a href="#" class="btn btn-outline-dark">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <button class="btn btn-dark" onclick="">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr scope="row">
                <td scope="col" class="text-start" type="text" value=></td>
                <td scope="col" class="text-start"></td>
                <td scope="col"></td>
                <td scope="col" class="text-center">
                  <div class="btn-group btn-group-md" role="group" aria-label="a group of buttons">
                    <a href="#" class="btn btn-outline-dark">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <button class="btn btn-dark" onclick="">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr scope="row">
                <td scope="col" class="text-start" type="text" value=></td>
                <td scope="col" class="text-start"></td>
                <td scope="col"></td>
                <td scope="col" class="text-center">
                  <div class="btn-group btn-group-md" role="group" aria-label="a group of buttons">
                    <a href="#" class="btn btn-outline-dark">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <button class="btn btn-dark" onclick="">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <div class="col-4 d-flex ">
          <div class="card p-4 m-auto shadow">
            <div class="card-body p-4">
              <div class="mb-3 row">
                <label for="addnom" class="col-sm-12 col-form-label">Nom et prénom :</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control ps-1" id="name" value="">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="addprix" class="col-sm-12 col-form-label ">Mot de pass :</label>
                <div class="col-sm-12 ">
                  <input type="decimal" class="form-control ps-1" id="password" value="">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="usermail" class="col-sm-12 col-form-label ">E-mail :</label>
                <div class="col-sm-12">
                  <input id="mail" type="text" class="form-control ps-1" id="adddesc" value="">
                </div>
              </div>
            </div>
            <div class="container text-end">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
              <button type="button" class="btn btn-primary" onclick="saveadd()">Sauvegarder</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
    ?>
    <!-- ======= App Features Section ======= -->
    <div class="row my-4 mx-auto p-1  bg-white" style="width:95%">
      <div class="row">
        <div class="col-12 mt-3 mb-1">
          <h5 class="">Un aperçu :</h5>
        </div>
      </div>
      <div class="row mx-3">
        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between p-md-1">
                <div class="d-flex flex-row">
                  <div class="align-self-center">
                    <i class="bi bi-database-fill-gear text-info fa-3x me-4"></i>
                  </div>
                  <div>
                    <h4>Total de serveurs</h4>
                    <p class="mb-0">Le nombre de serveurs vendus</p>
                  </div>
                </div>
                <div class="align-self-center">
                  <h2 class="h1 mb-0">10</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between p-md-1">
                <div class="d-flex flex-row">
                  <div class="align-self-center">
                    <i class="bi bi-cloud-fill text-warning fa-3x me-4"></i>
                  </div>
                  <div>
                    <h4>Total des services</h4>
                    <p class="mb-0">Le nombre total de services disponibles</p>
                  </div>
                </div>
                <div class="align-self-center">
                  <h2 class="h1 mb-0">7</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6 offset-xl-3 col-md-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between p-md-1">
                <div class="d-flex flex-row">
                  <div class="align-self-center">
                    <h2 class="h1 mb-0 me-4">5.000MAD</h2>
                  </div>
                  <div>
                    <h4>Ventes totales</h4>
                    <p class="mb-0">Le montant total des ventes</p>
                  </div>
                </div>
                <div class="align-self-center">
                  <i class="bi bi-wallet2 text-danger fa-3x"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- End App Features Section -->
</div>
</section>
<script>
usermailField = document.getElementById('usermail');
usernameField = document.getElementById('usermail');
userpasswordField = documen.getElementById('userpassword');

function activateusermail() {
  usermailField.disabled = false;
  usermailField.focus();
}

function saveusermail() {
  if (usermailField.value.trim() == "") {
    usermailField.value = "<?= $user['email'] ?>"
  } else {
    usermailField.disabled = true
  }
}
</script>
<?= $this->endSection() ?>