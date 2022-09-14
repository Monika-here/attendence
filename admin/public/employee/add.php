<?php $this->view('includes/header.php'); ?>
<?php $this->view('includes/admin_nav.php'); ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="row">
    <div class="col-12 pt-4">
      <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5 class="alert-heading mb-0"><?php echo $this->session->flashdata('success'); ?></h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading mb-0"><?php echo $this->session->flashdata('error'); ?></h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
    </div>
  </div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $page_title; ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="<?= base_url('list_employees/') ?>"><button type="button" class="btn btn-sm btn-dark">All Employees</button></a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 pt-3 pb-5">
      <form class="needs-validation" method="post" enctype="multipart/form-data">
        <div class="row">

          <div class="col-6">
            <div class="form-group">
              <label for="name" class="col-form-label">Employee Name</label>
              <input autocomplete="off" type="text" value="" class="form-control" name="name" required="required">
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="status" class="col-form-label">Status</label>
              <?php echo form_dropdown('status', array('active' => 'Active','in_active' => 'In-Active'), '1', 'id="employee_status" class="wc_dd form-control" data-placeholder="Select Status" required="required"'); ?>
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="email" class="col-form-label">Email</label>
              <input autocomplete="off" type="email" class="form-control" name="email">
            </div>
          </div>

          <div class="col-6">
            <div class="form-group">
              <label for="mobile" class="col-form-label">Mobile</label>
              <input autocomplete="off" type="number" value="" class="form-control" name="mobile">
            </div>
          </div>

          <div class="col-6 mt-4">
            <button type="submit" class="btn btn-dark btn-block">Add Employee</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<?php $this->view('includes/footer.php'); ?>
