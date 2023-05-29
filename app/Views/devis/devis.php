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
<div class="devis container-flex position-relative" style="min-height: 30vw;">

  <div class="container w-75 mt-5 p-0">
    <?php if (session()->getFlashdata('warning')): ?>
    <div class="warning-message text-danger fw-bold">
      <?= session()->getFlashdata('warning') ?>
      <?php session()->removeTempdata('warning'); ?>
    </div>
    <?php endif; ?>
    <!-- table-->
    <table id="Table" class="table table-bordered table-hover" style="width:100%;border-color:#3a527c">
      <thead class="text-light fs-5" style="background:#3a527c">
        <tr scope="row">
          <th scope="col" class="col-lg-2 ps-4">Nom</th>
          <th scope="col" class="col-lg-3 ps-4">Description</th>
          <th scope="col" class="col-lg-1 ps-4">Prix</th>
          <th scope="col" class="col-lg-2 ps-4">Date Creer</th>
          <th scope="col" class="col-lg-2 ps-4">Date Modifier</th>
          <th scope="col" class="col-lg-1"></th>
        </tr>
        <!--Add Element-->
        <a href="devis/add" type="button" class="btn btn-success position-relative btn-sm float-end"
          style="z-index: 500 !important;"><i class="bi bi-plus-lg"></i></a>
        </th>
      </thead>
      <tbody class="bg-white">
        <?php foreach ($devis as $devi) { ?>
        <tr scope="row">
          <td scope="col" type="text" value=><?= $devi['nom'] ?></td>
          <td scope="col"><?= $devi['desc'] ?></td>
          <td scope="col"><?= $devi['prix'] ?></td>
          <td scope="col"><?= $devi['created_at'] ?></td>
          <td scope="col"><?= $devi['updated_at'] ?></td>
          <td scope="col" class="text-center">
            <div class="btn-group btn-group-md" role="group" aria-label="a group of buttons">
              <a href="/devis/<?= $devi['id'] ?>" class="btn btn-success">
                <i class="bi bi-database"></i>
              </a>
              <button class="btn btn-danger" onclick="del(<?= $devi['id'] ?>)">
                <i class="bi bi-trash"></i>
              </button>
              <button class="btn btn-primary" onclick="pdf(<?= $devi['id'] ?>)">
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
          * {
            font-family: "Montserrat";
          }
          body {
            font-family: Arial, sans-serif;
            font-size: 14px;
          }
          h1 {
            text-align: center;
          }
          table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
          }
          table th,
          table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: top;
          }
          table th {
            background-color: #f5f5f5;
            font-weight: bold;
          }
          .total {
            font-weight: bold;
            text-align: right;
          }
          .header {
            background-color: #333333;
          }
          .blue {
            background-color: #CCCCCC;
          }
        </style>
        <body>
          <section class="header py-3 text-center"></section>
          <div class="container">
            <div class="row">
              <div class="col">
                <img class="m-0 p-0" src="/img/mtds_logo.png" alt="Logo" width="50" height="50" />
                <strong class="mb-2 fs-2">Mtds</strong>
              </div>
              <div class="col mt-2">
                <h3>N° Devis : ${devisData.devis.id}</h3>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <h4>Date : ${devisData.devis.created_at}</h4>
              </div>
              <div class="col">
                <h4>Total : ${devisData.devis.prix} MAD</h4>
              </div>
            </div>
          </div>

          <section class="header py-1 text-center"></section>
          <div class="container mt-2">
      `;

      // Loop through the servers
      let i = 1;
      devisData.serveurs.forEach(server => {
        templateHTML += `
          <h5>Serveur ${i}</h5>
          <table>
            <thead>
              <tr>
                <th>Service</th>
                <th>Description</th>
                <th>Quantite</th>
                <th>Prix Unitaire</th>
                <th>Prix Total</th>
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
              <td>${service.nom}</td>
              <td>${service.desc}</td>
              <td>${spec.quantite}</td>
              <td>${spec.prix_unitaire}</td>
              <td>${spec.prix}</td>
            </tr>
          `;
        });

        templateHTML += `
            <tr class="total">
              <td>Total</td>
              <td></td>
              <td></td>
              <td></td>
              <td>${server.serveur.prix}</td>
            </tr>
          </tbody>
        </table>
        `;
        i++
      });

      templateHTML += `  
          </div>
        </div>
        <div class="">
            <section class="header py-2 text-center"></section>
            <section class="blue py-1 text-center"></section>
        </body>
        </html>
      `;

      html2pdf()
        .set({
          margin: [0, 0, 0, 0], // Set all margins to 0
          filename: `${devisData.devis.id}-${devisData.devis.nom}-${formattedDate}`,
          image: {
            type: 'jpeg',
            quality: 1,
          },
          html2canvas: {
            scale: 2,
          },
          jsPDF: {
            unit: 'mm',
            format: 'a4',
            orientation: 'portrait',
          },
        })
        .from(templateHTML)
        .save();
    })
    .catch(error => {
      console.error(error);
    });
}
</script>
<?= $this->endSection() ?>