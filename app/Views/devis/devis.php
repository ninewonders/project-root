<?= $this->extend('/layouts/default') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
// Remove warning message after 2.5 seconds
setTimeout(function() {
  let warningMessage = document.querySelector('.warning-message');
  if (warningMessage) {
    warningMessage.style.display = 'none';
  }
}, 2500);
</script>
<div class="devis container-flex position-relative mb-5" style="min-height: 35vw;">

  <div class="container-flex mt-5 mb-3  p-0 mx-3 px-5">
    <?php if (session()->getFlashdata('warning')): ?>
    <div class="warning-message text-danger fw-bold">
      <?= session()->getFlashdata('warning') ?>
      <?php session()->removeTempdata('warning'); ?>
    </div>
    <?php endif; ?>
    <!-- table-->
    <table id="Table" class="table table table-responsive-sm fw  text-center">
      <thead class="text-light text-center bg-dark fs-6">
        <tr scope="row">
          <th scope="col" class="col-lg-3 ps-4 text-start">Nom</th>
          <th scope="col" class="col-lg-2 ps-4 text-start">Description</th>
          <th scope="col" class="col-lg-1 ps-4">Prix</th>
          <th scope="col" class="col-lg-1 ps-4">Date Creer</th>
          <th scope="col" class="col-lg-1 ps-4">Date Modifier</th>
          <th scope="col" class="col-lg-1"></th>
        </tr>
        <!--Add Element-->
        <a href="devis/add" type="button" class="btn btn-success position-relative btn-sm float-end"
          style="z-index: 500 !important;"><i class="bi bi-plus-lg"></i></a>
        </th>
      </thead>
      <tbody class="bg-light">
        <?php foreach ($devis as $devi) { ?>
        <tr scope="row">
          <td scope="col" class="text-start" type="text" value=><?= $devi['nom'] ?></td>
          <td scope="col" class="text-start"><?= $devi['desc'] ?></td>
          <td scope="col"><?= $devi['prix'] ?></td>
          <td scope="col"><?=date("d-m-Y", strtotime($devi['created_at']))?></td>
          <td scope="col"><?=date("d-m-Y", strtotime($devi['updated_at'] ))?></td>
          <td scope="col" class="text-center">
            <div class="btn-group btn-group-md" role="group" aria-label="a group of buttons">
              <a href="/devis/<?= $devi['id'] ?>" class="btn btn-dark">
                <i class="bi bi-database"></i>
              </a>
              <button class="btn btn-dark" onclick="del(<?= $devi['id'] ?>)">
                <i class="bi bi-trash"></i>
              </button>
              <button class="btn btn-dark" onclick="pdf(<?= $devi['id'] ?>)">
                <i class="bi bi-filetype-pdf"></i>
              </button>
            </div>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<script>
window.jsPDF = window.jspdf.jsPDF;

function del(id) {
  fetch(`devis/${id}`, {
      method: 'delete',
    })
    .then(response => response)
    .then(data => {
      window.location.href = '<?= base_url('/devis') ?>';
    })
    .catch(error => {
      console.error(error);
    });
}

function pdf(id) {
  Promise.all([
      fetch(`devis/select/${id}`, {
        method: 'GET',
      }).then(response => response.json()),
      fetch('/service_all', {
        method: 'GET',
      }).then(response => response.json()),
    ])
    .then(([devisData, servicesData]) => {
      // Create a new jsPDF instance
      var doc = new jsPDF();
      const findById = (array, id) => array.find(item => item.id === id);
      const currentDate = new Date();
      const year = currentDate.getFullYear();
      const month = currentDate.getMonth() + 1; // Months are zero-based, so adding 1
      const day = currentDate.getDate();

      // Format the date as desired
      const formattedDate = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

      // Template HTML
      var templateHTML = `
        <style>
          
        </style>
        <body>
          <section class="header py-3 text-center"></section>
          <div class="container page" style="">
            <div class="row">
              <div class="col">
                <img class="m-0 p-0" src="/img/mtds_logo.png" alt="Logo" width="50" height="50" />
                <strong class="mb-2 fs-2" style="">Mtds</strong>
              </div>
              <div class="col mt-2">
                <h3>Nom Devis : ${devisData.devis.nom}</h3>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <h4>Date : ${(new Date(devisData.devis.created_at)).toLocaleDateString('fr-MA')}</h4>
              </div>
              <div class="col">
                <h4>Total : ${devisData.devis.prix} MAD</h4>
              </div>
            </div>
          </div>

          <section class="header py-1 text-center"></section>
          <div class="container-flex mt-2">
      `;

      // Loop through the servers
      let i = 1;
      devisData.serveurs.forEach(server => {


        templateHTML += `
          <table class="table table-sm table-responsive-sm fw mt-2 text-center ">
            <thead class="text-light text-start bg-dark fs-7">
              <tr>
                <th>Service</th>
                <th>Quantite</th>
                <th>Prix Unitaire</th>
                <th class="text-end">Prix Total</th>
              </tr>
            </thead>
            <tbody>
        `;

        // Loop through the specifications of the current server
        server.specifications.forEach(spec => {
          // Accessing the object with ID "1"
          const service = findById(servicesData[0], spec.id_service);
          templateHTML += `
            <tr>
              <td class="text-start">${service.nom}</td>
              <td>${spec.quantite}</td>
              <td>${spec.prix_unitaire}</td>
              <td class="text-end">${spec.prix}</td>
            </tr>
          `;
        });

        templateHTML += `
            <tr class="text-start total">
              <td>Total</td>
              <td></td>
              <td></td>
              <td class="text-end">${server.serveur.prix}</td>
            </tr>
          </tbody>
        </table>
        </div>
        `;
        i++
      });

      templateHTML += `  
          </div>
        </div>

        </body>
        </html>
      `;
      const contentHeight = templateHTML.offsetHeight;
      var opt = {
        margin: [0, 0, 0.2, 0],
        filename: `${devisData.devis.id}-${devisData.devis.nom}-${formattedDate}.pdf`,
        image: {
          type: "jpeg",
          quality: 1
        },
        pagebreak: {
          avoid: 'tr',

        },
        html2canvas: {
          scale: 4,
          useCORS: true,
          dpi: 192,
          letterRendering: true
        },
        // Added putTotalPages option to add page number
        jsPDF: {
          unit: "in",
          format: "a4",
          orientation: "portrait",
          putTotalPages: true
        },
      };

      html2pdf().set(opt).from(templateHTML).save();
    })
    .catch(error => {
      console.error(error);
    });
}
</script>
<?= $this->endSection() ?>