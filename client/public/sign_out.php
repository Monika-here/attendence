<?php $this->view('includes/header.php'); ?>

<main role="main" class="col-12 px-md-4">
  <div class="row">
    <div class="col-12 pt-4">
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

    <div class="row">
      <div class="col-6 col-lg-4 mx-auto">
        <a href="<?= base_url('sign_out/1/')?>" type="submit" class="btn btn-dark btn-block">Sign Out</a>
      </div>
    </div>
  </div>


</main>

<?php $this->view('includes/footer.php'); ?>
