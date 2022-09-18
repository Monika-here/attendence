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

      <div class="row">
        <div class="col-12">
          <h2>Today's Attendence</h2>
          <hr>
          <table id="dt_table" class="table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
                <?php
                $_table_cols = '<tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Sign In</th>
                    <th>Status</th>
                  </tr>';
                echo $_table_cols;
                ?>
            </thead>
            <tbody>
            <?php if(isset($employee) && !empty($employee)): ?>
              <?php foreach ($employee as $key => $value): ?>
                <tr>
                    <td class="align-middle"><?= (intval($key)+1) ?></td>
                    <td class="align-middle"><?= $value['name'] ?></td>
                    <td class="align-middle"><?= $value['mobile'] ?></td>
                    <td class="align-middle"><?= $value['email'] ?></td>
                    <td class="align-middle"><?= $value['sign_in'] ?></td>
                    <td class="align-middle"><?= $value['status'] ?></td>
                </tr>
              <?php endforeach; ?>

            </tbody>
            <tfoot>
                <?php echo $_table_cols; ?>
            </tfoot>
          </table>
        </div>
      </div>
      <?php endif; ?>

    </main>
<?php $this->view('includes/footer.php'); ?>
