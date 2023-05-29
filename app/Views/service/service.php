<?= $this->extend('/layouts/default') ?>

<?= $this->section('content') ?>
<div class="devis container-flex position-relative" style="min-height: 30vw;">

  <div class="container w-75 mt-5 p-0">
    <!-- table-->
    <table id="Table" class="table table-bordered table-hover " style="width:100%;border-color:#3a527c">
      <thead class="text-light fs-5 " style="background:#3a527c">
        <tr scope="row ">
          <th scope="col " class="col-lg-2 ps-4 ">Nom</th>
          <th scope="col" class="col-lg-3 ps-4">Description</th>
          <th scope="col" class="col-lg-1 ps-4">Prix</th>
          <th scope="col" class="col-lg-2 ps-4">Date Creer</th>
          <th scope="col" class="col-lg-2 ps-4">Date Modifier</th>
          <th scope="col" class="col-lg-1 ">

        </tr>
        <!--Add Element-->
        <button type="button" class="btn btn-success position-relative btn-sm float-end" onclick="add()"
          style="z-index: 500 !important;"><i class="bi bi-plus-lg"></i></button>
        </th>
      </thead>
      <tbody class="" class="bg-white">
        <?php foreach ($services as $service) { ?>
        <tr scope="row">
          <td scope="col"><?=$service['nom']?></td>
          <td scope="col"><?=$service['desc']?></td>
          <td scope="col"><?=$service['prix_unitaire']?></td>
          <td scope="col"><?=$service['created_at']?></td>
          <td scope="col"><?=$service['updated_at']?></td>
          <td scope="col " class="text-center">
            <div class=" btn-group btn-group-md " role="group" aria-label="a group of buttons">
              <button class="btn btn-warning" onclick='up(<?=json_encode($service)?>)'>
                <i class=" bi bi-pencil-square"></i></button>
              <button class="btn btn-danger" onclick="del(<?= $service['id'] ?>)">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>


  <!--Add Modal -->
  <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background:#fd4444; color:white">
          <h5 class="modal-title" id="staticBackdropLabel">Ajouter Service</h5>
          <button type="button" class="btn-close btn-close-white " data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3 row">
            <label for="addnom" class="col-sm-3 col-form-label ">Nom </label>
            <div class="col-sm-9">
              <input type="text" class="form-control ps-1" id="addnom" value="">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="adddesc" class="col-sm-3 col-form-label ">Description </label>
            <div class="col-sm-9">
              <input type="text" class="form-control ps-1" id="adddesc" value="">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addprix" class="col-sm-3 col-form-label ">Prix</label>
            <div class="col-sm-9">
              <input type="text" class="form-control ps-1" id="addprix" value="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-success" onclick="saveadd()">Sauvegarder</button>
        </div>
      </div>
    </div>
  </div>

  <!--Update Modal -->
  <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header " style="background:#fd4444; color:white">
          <h5 class="modal-title" id="staticBackdropLabel">Modifier Service</h5>
          <button type="button" class="btn-close btn-close-white " data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 row">
            <label for="editid" class="col-sm-3 col-form-label  ">Id</label>
            <div class="col-sm-9">
              <input type="text" class="form-control ps-1" id="editid" value="" disabled>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editnom" class="col-sm-3 col-form-label ">Nom </label>
            <div class="col-sm-9">
              <input type="text" class="form-control ps-1" id="editnom" value="">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editdesc" class="col-sm-3 col-form-label ">Description </label>
            <div class="col-sm-9">
              <input type="text" class="form-control ps-1" id="editdesc" value="">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editdesc" class="col-sm-3 col-form-label ">Prix</label>
            <div class="col-sm-9">
              <input type="text" class="form-control ps-1" id="editprix" value="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-success" onclick="saveedit()">Sauvegarder</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function del(id) {
  fetch(`service/${id}`, {
      method: 'delete',
    })
    .then(response => response)
    .then(data => {
      window.location.href = '<?= base_url('/service') ?>';
    })
    .catch(error => {
      console.error(error);
    });
}

function add() {
  let addModal = document.getElementById('addModal');
  let modal = new bootstrap.Modal(addModal);
  modal.show();

  //clearing out the inputs
  let nom = document.getElementById('addnom');
  let desc = document.getElementById('adddesc');
  let prix = document.getElementById('addprix');
  nom.value = "";
  desc.value = "";
  prix.value = "";

}

function up(service) {
  let editModal = document.getElementById('editModal');
  let modal = new bootstrap.Modal(editModal);
  modal.show();
  //clearing out the inputs
  let nom = document.getElementById('editnom');
  let desc = document.getElementById('editdesc');
  let prix = document.getElementById('editprix');
  let editid = document.getElementById('editid');

  editid.value = service.id;
  nom.value = service.nom;
  desc.value = service.desc;
  prix.value = service.prix_unitaire;

}

function saveadd() {
  let nom = document.getElementById('addnom');
  let desc = document.getElementById('adddesc');
  let prix = document.getElementById('addprix');
  const service = {
    "nom": nom.value,
    "desc": desc.value,
    "prix_unitaire": parseFloat(prix.value),
  }
  fetch('service/insert', {
      method: 'POST',
      body: JSON.stringify(service)
    })
    .then(response => response)
    .then(data => {
      window.location.href = '<?= base_url('/service') ?>';
    })
    .catch(error => {
      console.log(error);
    });
}

function saveedit() {
  let nom = document.getElementById('editnom');
  let desc = document.getElementById('editdesc');
  let prix = document.getElementById('editprix');
  let editid = document.getElementById('editid');

  const service = {
    "id": editid.value,
    "nom": nom.value,
    "desc": desc.value,
    "prix_unitaire": parseFloat(prix.value),
  }
  fetch('service', {
      method: 'put',
      body: JSON.stringify(service)
    })
    .then(response => response)
    .then(data => {
      console.log(data)
      window.location.href = '<?= base_url('/service') ?>';
    })
    .catch(error => {
      console.log(error);
    });
}

let serviceid = 0;
services = <?=json_encode($services)?>
</script>
<?= $this->endSection() ?>