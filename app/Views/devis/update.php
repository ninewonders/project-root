<?= $this->extend('/layouts/default') ?>

<?= $this->section('content') ?>


<div class="devis container-flex position-relative d-flex justify-content-center align-items-center">
  <div class="container mt-4 justify-content-center-md">
    <div class="container mt-4 mx-md-auto mx-sm-0 justify-content-center">
      <div class="card p-4 justify-content-center text-center">
        <div class="row g-3 row-cols-2 mb-3 border-bottom">
          <div class="col-10 offset-md-1">
            <div class="form-outline text-start">
              <div class="mb-3 row">
                <label for="nom" class="col-sm-2 col-form-label ">Nom</label>
                <div class="col-sm-9">
                  <input id="nom" type="text" class="form-control ps-1" required />
                  <span id="nom-warning" class="text-danger mt-0" style=" font-size:12px"></span>
                </div>
              </div>
              <div class="form-outline text-start">
                <div class="mb-3 row">
                  <label for="description" class="col-sm-2 col-form-label ">Description</label>
                  <div class="col-sm-9">
                    <textarea id="description" class="form-control ps-1"></textarea>
                    <span id="description-warning" class="text-danger mt-0" style=" font-size:12px"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="servers" class="container mx-2">
          <div class="container mb-1 px-0">
            <div class="row align-items-center">
              <strong class="col-11 text-start mb-0 ps-0">Serveurs</strong>
              <div class="col-1 ">
                <button id="clone" type="button" onclick="addServer(this)"
                  class="clone btn btn-success btn-sm float-end">
                  <i class="bi bi-plus-lg"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="container  p-3">
            <div id="servers-card" class="row mb-3">
              <!--server cards are added here -->
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col text-end">
            <div class="d-flex justify-content-end align-items-center">
              <div class="fw-bold me-2">Total</div>
              <div class="d-flex align-items-center">
                <input id="total" class="form-control ps-1 me-1 fw-normal" type="decimal" step="0.01" value="0">
                <div class="fw-normal text-center">MAD</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 text-end mt-2">
          <a href="/devis"><button class="btn btn-danger" type="button">Annuler</button></a>
          <button class="btn btn-primary" onclick="save()" type="button">Sauvegarder</button>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal HTML -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <div class="icon-box">
            <i class="bi bi-check-circle "></i>
          </div>
        </div>
        <div class="modal-body text-center">
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
        <div class="modal-body text-center">
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
          msg.innerHTML = data.msg;
        }
      })
      .catch(error => {
        console.log(error)
      });
  } else if (!nomWarning.textContent.trim() == '') {
    document.getElementById('nom').focus();
  } else {
    document.getElementById('description').focus();
  };
}

const nomInput = document.getElementById('nom');
const nomWarning = document.getElementById('nom-warning');
// Regex nom 
const nomRegex = /^[a-zA-Z\s]*$/;
nomInput.addEventListener('input', function() {
  if (this.value.trim() == '') {
    nomWarning.textContent = '! Please enter a value for Nom';
  } else if (!nomRegex.test(this.value)) {
    nomWarning.textContent = '! Nom should only contain letters.';
  } else {
    nomWarning.textContent = '';
  }
});

const descField = document.getElementById('description');
const descWarning = document.getElementById('description-warning');
// Regex description
const descRegex = /^[a-zA-Z0-9\s]*$/;

descField.addEventListener('input', () => {
  if (descField.value.trim() == '') {
    descWarning.textContent = '! Please enter a value for Description';
  } else if (!descRegex.test(descField.value)) {
    descWarning.textContent = '! Desc field must contain only letters, numbers and spaces';
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
let counter = 0;
serveurs.forEach((serveur) => {
  addServer_wthstuff(serveur);
});

nomInput.value = devis.nom;
descField.value = devis.desc;
totalField.value = devis.prix;
</script>

<?= $this->endSection() ?>