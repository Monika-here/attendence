<?php $this->view('includes/header.php'); ?>
<?php $this->view('includes/admin_nav.php'); ?>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $page_title; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Add Product</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">MONTHLY INVOICE</button> -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Employees</div>
                  <div class="h5 mb-0 font-weight-bold"><?= $employees_count ?></div>
                </div>
                <div class="col-auto">
                  <a class="text-dark" href="<?= base_url('list_employees/') ?>"><span data-feather="list"></span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Today's Attendence</div>
                  <div class="h5 mb-0 font-weight-bold"><?= $todays_attendence_count ?></div>
                </div>
                <div class="col-auto">
                  <a class="text-dark" href="<?= base_url('list_attendence/') ?>"><span data-feather="list"></span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </main>
  <?php $this->view('includes/footer.php'); ?>
