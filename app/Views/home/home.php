<?= $this->extend('/layouts/default') ?>



<?= $this->section('content') ?>
<div class="home container-flex pt-0 pb-0 ">
  <section class="section home-5-bg" id="home">

    <!-- ======= Hero Section ======= -->
    <div class="jumbotron p-3 p-md-5 text-white rounded bg-light">
      </br>
      <div class="col-md-6 px-0">

        <h1 class="display-4 font-italic text-danger">Title of a longer featured blog post</h1>
        <p class="lead my-3 text-dark">Multiple lines of text that form the lede, informing new readers quickly and
          efficiently
          about what's most interesting in this post's contents.
        </p>
        </br>
      </div>
    </div>
    <!-- End Hero -->
    <!-- ======= App Features Section ======= -->
    <div class="row my-4 mx-auto" style="width:95%">
      <div class="row">
        <div class="col-12 mt-3 mb-1">
          <h5 class="text-uppercase">Statistiques pertinentes</h5>
          <p>Un aperçu des activités des utilisateurs</p>
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
  </section>
</div>
<!-- End App Features Section -->
</div>
</section>

<?= $this->endSection() ?>