<?php 
$user = session()->get('user')?>
<?= $this->extend('/layouts/default') ?>

<?= $this->section('content') ?>
<div class="home container-flex pt-0 pb-0 " style="min-height:60vh">
  <section class="section home-5-bg" id="home">
    <div class="card row my-4 mx-auto  bg-white border border-dark border-1 " style="width:95%">
      <div class="card-header bg-dark text-light d-flex">
        <strong class="ps-2 col-11 ">Profile :</strong>
        <div class="col-1 text-end">
          <button class="btn btn-outline-light" onclick='up(<?= json_encode($user) ?>)'><i
              class="bi bi-pencil-square"></i></button>
        </div>
      </div>
      <div class="card-body m-3 ">
        <div class="mb-3 row">
          <label for="usernom" class="col-sm-2 col-form-label">Nom et prénom :</label>
          <div class="col-sm-9">
            <input type="text" class="form-control ps-1" onblur="" readonly value="<?=$user['name']?>">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="usermail" class="col-sm-2 col-form-label">E-mail :</label>
          <div class="col-sm-9">
            <input id="usermail" type="text" class="form-control ps-1" onblur="saveusermail()" disabled
              value="<?=$user['email']?>">
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
                <th scope="col" class="col-lg-1"></th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <?php foreach($utilisateurs as $utilisateur){?>
              <tr scope="row">
                <td scope="col" class="text-start" type="text" value=><?=$utilisateur['nom']?></td>
                <td scope="col" class="text-start"><?=$utilisateur['email']?></td>
                <td scope="col" class="text-center">
                  <div class="btn-group btn-group-md" role="group" aria-label="a group of buttons">
                    <button class="btn btn-outline-dark" onclick='edit(<?=json_encode($utilisateur)?>)'>
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-dark" onclick="del(<?=$utilisateur['id']?>)">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <?php
            }
            ?>
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
                <label for="usermail" class="col-sm-12 col-form-label ">E-mail :</label>
                <div class="col-sm-12">
                  <input id="email" type="text" class="form-control ps-1" value="">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="addprix" class="col-sm-12 col-form-label ">Mot de pass :</label>
                <div class="col-sm-12 ">
                  <input type="decimal" class="form-control ps-1" id="password" value="">
                </div>
              </div>
              <input type="text" class="form-control ps-1 m-0 p-0 invisible" id="id" value="">
            </div>
            <div class="container text-end">
              <button type="button" class="btn btn-secondary" onclick="cancel()">Annuler</button>
              <button type="button" class="btn btn-primary" onclick="add()">Sauvegarder</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
    ?>
    <!-- ======= App Features Section ======= -->

  </section>

  <!--Update Modal -->
  <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-dark text-light">
          <h5 class="modal-title" id="staticBackdropLabel">Modifier</h5>
          <button type="button" class="btn-close btn-close-white " data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-1 row">
            <label for="editid" class="col-sm-12 col-form-label  ">Nom et prénom :</label>
            <div class="col-sm-12">
              <input type="text" class="form-control ps-1" id="editnom" value="" readonly>
            </div>
          </div>
          <div class="mb-1 row">
            <label for="editmail" class="col-sm-12 col-form-label ">E-Mail :</label>
            <div class="col-sm-12">
              <input type="text" class="form-control ps-1" id="editmail" value="">
            </div>
          </div>
          <div class="mb-1 row">
            <label for="editdesc" class="col-sm-12 col-form-label ">Mot de pass ancient :</label>
            <div class="col-sm-12">
              <input type="text" class="form-control ps-1" id="editopass" value="">
            </div>
          </div>
          <div class="mb-1 row">
            <label for="editdesc" class="col-sm-12 col-form-label ">Nouveau mot de pass :</label>
            <div class="col-sm-12">
              <input type="text" class="form-control ps-1" id="editnpass" value="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-success" onclick="saveup()">Sauvegarder</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>
<script>
let editBool = false;

function up(user) {
  let editModal = document.getElementById('editModal');
  let modal = new bootstrap.Modal(editModal);
  modal.show();


  let nom = document.getElementById('editnom');
  let mail = document.getElementById('editmail');
  let opass = document.getElementById('editopass');
  let npass = document.getElementById('editnpass');

  nom.value = user.name;
  mail.value = user.email;
  opass.value = "";
  npass.value = "";
}

function saveup() {
  let nom = document.getElementById('editnom');
  let mail = document.getElementById('editmail');
  let opass = document.getElementById('editopass');
  let npass = document.getElementById('editnpass');

  let insertData = {
    'user_id': <?=$user['user_id']?>,
    'nom': nom.value,
    'mail': mail.value,
    'opass': opass.value,
    'npass': npass.value
  }
  console.log(insertData)
  console.log('stuff')
  fetch('/util', {
      method: 'PUT',
      mode: 'no-cors',
      body: JSON.stringify(insertData)
    })
    .then(response => response.json())
    .then(data => {
      if (data.msg = 'Utilisateur Updated Successfully') {
        window.location.href = '<?= base_url('/profile') ?>';
      }
    })
    .catch(error => {
      console.log(error)
    });
}

function add() {
  idField = document.getElementById('id');
  mailField = document.getElementById('email');
  nameField = document.getElementById('name');
  passwordField = document.getElementById('password');
  if (editBool) {
    let insertData = {
      "id": idField.value,
      "name": nameField.value,
      "email": mailField.value,
      "password": passwordField.value
    }
    fetch('util/update', {
        method: 'POST',
        mode: 'no-cors',
        body: JSON.stringify(insertData)
      })
      .then(response => response.json())
      .then(data => {
        console.log(data)
        if (data.msg == 'Utilisateur Updated Successfully') {
          cancel()
          window.location.href = '<?= base_url('/profile') ?>';
        }
      })
      .catch(error => {
        console.log(error)
      });
  } else {
    let insertData = {
      "name": nameField.value,
      "email": mailField.value,
      "password": passwordField.value
    }

    fetch('util/insert', {
        method: 'POST',
        mode: 'no-cors',
        body: JSON.stringify(insertData)
      })
      .then(response => response.json())
      .then(data => {
        console.log(data)
        if (data.message == 'Utilisateur Created Successfully') {
          window.location.href = '<?= base_url('/profile') ?>';
        }
      })
      .catch(error => {
        console.log(error)
      });
  }
}

function del(id) {
  fetch(`util/${id}`, {
      method: 'DELETE',
      mode: 'no-cors',
    })
    .then(response => response)
    .then(data => {
      window.location.href = '<?= base_url('/profile') ?>';
    })
    .catch(error => {
      console.error(error);
    });
}

function edit(util) {
  idField = document.getElementById('id');
  mailField = document.getElementById('email');
  nameField = document.getElementById('name');
  passwordField = document.getElementById('password');

  editBool = true
  idField.value = util.id
  mailField.value = util.email
  nameField.value = util.nom

}

function cancel() {
  editBool = false
  mailField = document.getElementById('email');
  nameField = document.getElementById('name');
  passwordField = document.getElementById('password');

  mailField.value = ""
  nameField.value = ""
  passwordField.value = ""
}
</script>
<?= $this->endSection() ?>