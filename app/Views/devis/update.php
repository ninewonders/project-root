<?= $this->extend('/layouts/default') ?>

<?= $this->section('content') ?>


<div class="devis container-flex position-relative justify-content-center align-items-center">
  <div class="container-flex mx-5 my-4 mb-5 justify-content-center-md">
    <div class="container-flex mt-4 pt-2 justify-content-center">
      <div class="card px-4 pt-4 m-0 pt-5 justify-content-center text-center border-1 border-secondary">
        <div class="row row-cols-12 mb-3 ">
          <div class="form-outline text-start ps-3 pe-5">
            <div class="mb-3 row d-flex ps-3 pe-5">
              <label for="nom" class="col-lg-2 col-sm-2 col-form-label ">Nom</label>
              <div class="col-lg-5 col-sm-10 mb-1">
                <input id="nom" type="text" class="form-control " />
                <span id="nom-warning" class="text-danger mt-0" style=" font-size:12px"></span>
              </div>
              <label for="total" class="col-lg-1 col-sm-2 col-form-label ">Total</label>
              <div class="col-lg-4 col-sm-10 mb-1">
                <input id="total" class="form-control ps-1 me-1 fw-normal" type="decimal" step="0.01" value="0">
              </div>
            </div>
            <div class="mb-3 row ps-3 pe-5">
              <label for="description" class="col-lg-2 col-sm-2 col-form-label ">Description</label>
              <div class="col-lg-10 col-sm-10">
                <textarea id="description" class="form-control "> </textarea>
                <span id="description-warning" class="text-danger mt-0" style=" font-size:12px"></span>
              </div>
            </div>
          </div>
          <div class="col-12 text-end mt-2 mb-0">
            <a href="/devis"><button class="btn btn-danger" type="button">Annuler</button></a>
            <button class="btn btn-success" onclick="save()" type="button">Sauvegarder</button>
          </div>
        </div>
      </div>
      <div class="card  m-0 mt-3 justify-content-center text-center border-1 border-dark">
        <div class="card-header bg-dark text-light">
          <div class="row align-items-center">
            <strong class="col-11 text-start mb-0 ps-0 fs-4 ps-2">Serveurs</strong>
            <div class="col-1 ">
              <button type="button" onclick="addServer(this)" data-toggle="tooltip" data-placement="left"
                title="Ajouter Serveur" class="btn btn-outline-light btn-sm px-3 py-1 float-end">
                <i class="bi bi-cloud-plus-fill fa-2x "></i>
              </button>
            </div>
          </div>
        </div>

        <div id="servers" class="card-body ">
          <div class="card-body py-3 px-1 mx-0">
            <div id="servers-card" class="row mb-3">
              <!--server cards are added here -->
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <!-- Modal HTML -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm  modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <div class="modal-header justify-content-center ">
          <div class="icon-box">
            <i class="bi bi-check-circle "></i>
          </div>
        </div>
        <div class="modal-body text-center pb-4">
          <h4>Succès!</h4>
          <p>Le devis a été modifier</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal HTML -->
  <div id="no" class="modal fade">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center" style="background:red !important">
          <div class="icon-box">
            <i class="bi bi-x-circle "></i>
          </div>
        </div>
        <div class="modal-body text-center pb-4">
          <h4>Echec</h4>
          <p id="error">Pas de modification</p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function save() {
  const nomWarning = document.getElementById('nom-warning');
  const descWarning = document.getElementById('description-warning');
  const nom = document.getElementById('nom');
  if (nom.value != "") {
    if (nomWarning.textContent.trim() == '' && descWarning.textContent.trim() == '') {
      const data = extractDevis();
      const servers = extractServer();
      data.prix = parseFloat(data.prix);

      // Restructure the server and spec data
      let serverData = [];
      servers.forEach((s) => {
        const server = s.server;
        let serverObj = {
          "prix": null,
          "specs": []
        };
        serverObj.id_devis = data.id;
        serverObj.prix = parseFloat(server[server.length - 1].prix);
        for (i = 0; i < server.length - 1; i++) {
          let specObj = {
            'id_service': server[i].Id_service,
            'quantite': server[i].quantite,
            'prix_unitaire': server[i].prix_unitaire,
            'prix': server[i].prix
          };
          serverObj.specs.push(specObj);
        }
        serverData.push(serverObj);
      })


      // Combine the data to be inserted into a single object
      let insertData = {
        "devisData": data,
        "serverData": serverData
      };
      // Send a single fetch request to insert all the data

      fetch(`${devis.id}`, {
          method: 'PUT',
          body: JSON.stringify(insertData)
        })
        .then(response => response.json())
        .then(data => {
          if (data.msg = 'Devis Updated') {
            $('#myModal').modal('show');
            setTimeout(2000);
            window.location.href = '<?= base_url('/devis') ?>';
          } else {
            $('#no').modal('show');
            let msg = document.getElementById('error');
            if (data.msg != undefined) {
              msg.innerHTML = data.msg;
            } else {
              msg.innerHTML = "Type de données non valide"
            }
            window.location.href = '<?= base_url('/devis') ?>';
          }
        })
        .catch(error => {
          console.log(error)
        });
    } else if (!nomWarning.textContent.trim() == '') {
      document.getElementById('nom').focus();
      window.scrollTo(0, 0);
    } else {
      document.getElementById('description').focus();
      window.scrollTo(0, 0);
    }
  } else {
    document.getElementById('nom').focus();
    window.scrollTo(0, 0);
    nomWarning.textContent = 'Veuillez entrer une valeur pour Nom.'
  };
}

const nomInput = document.getElementById('nom');
const nomWarning = document.getElementById('nom-warning');
// Regex nom 
const nomRegex = /^[a-zA-Z0-9\s'()]*$/;
nomInput.addEventListener('input', function() {
  if (this.value.trim() == '') {
    nomWarning.textContent = 'Veuillez entrer une valeur pour Nom.';
  } else if (!nomRegex.test(this.value)) {
    nomWarning.textContent = 'Nom ne doit contenir que des lettres.';
  } else {
    nomWarning.textContent = '';
  }
});

const descField = document.getElementById('description');
const descWarning = document.getElementById('description-warning');

// Regular expression to validate the desc field
const descRegex = /^[a-zA-Z0-9\s'()]*$/;

descField.addEventListener('input', () => {
  if (!descRegex.test(descField.value)) {
    descWarning.textContent = 'Le champ description ne doit contenir que des lettres, des chiffres et des espaces ';
  } else {
    descWarning.textContent = '';
  }
});
const totalField = document.getElementById('total')
</script>

<script>
const services = <?= json_encode($services); ?>;
const services_del = <?= json_encode($services_deleted); ?>;
const devis = <?= json_encode($devis); ?>;
const serveurs = <?= json_encode($serveurs); ?>;
let counter = 1;
let cnter = 1;
serveurs.forEach((serveur) => {
  addServer_wthstuff(serveur);
});

nomInput.value = devis.nom;
descField.value = devis.desc;
totalField.value = devis.prix;
</script>

<?= $this->endSection() ?>