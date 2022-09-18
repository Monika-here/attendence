<?php $this->view('includes/header.php'); ?>

<main role="main" class="col-12 p-4">
  <div class="row">
    <div class="col-12">
      <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <h5 class="alert-heading mb-0"><?php echo $this->session->flashdata('success'); ?></h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <h5 class="alert-heading mb-0"><?php echo $this->session->flashdata('error'); ?></h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
    </div>
  </div>

        <form class="needs-validation" method="post">
          <div class="row">
            <div class="col-6 col-lg-4 mx-auto">
              <div class="form-group">
                <input autocomplete="off" type="number"  class="form-control token" name="token" required="required" placeholder='Sign in Token'>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6 col-lg-4  mx-auto">
              <button type="submit" class="btn btn-dark btn-block disabled">Sign In</button>
            </div>
          </div>
          </div>
        </form>

</main>

<?php $this->view('includes/footer.php'); ?>
