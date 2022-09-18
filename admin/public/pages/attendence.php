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
            <?php if(isset($employees['items']) && !empty($employees['items'])): ?>
              <?php foreach ($employees['items'] as $key => $value): ?>
                <tr>
                    <td class="align-middle"><?= (intval($employees['item_start'])+$key) ?></td>
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
        <div class="col-12 py-3">
          <div class="row">
            <div class="col-md-4 text-center text-md-left my-auto">
              <div class="">
                Showing <?= $employees['item_start'] ?> to <?= $employees['item_end'] ?> of <?= $employees['total_items'] ?> entries
              </div>
            </div>

            <div class="col-md-4 text-center my-1">
              <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Items per page (<?= $employees['items_per_page'] ?>)
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="<?= base_url('list_attendence/?items_per_page=50') ?>">50</a>
                  <a class="dropdown-item" href="<?= base_url('list_attendence/?items_per_page=100') ?>">100</a>
                  <a class="dropdown-item" href="<?= base_url('list_attendence/?items_per_page=300') ?>">300</a>
                  <a class="dropdown-item" href="<?= base_url('list_attendence/?items_per_page=500') ?>">500</a>
                  <a class="dropdown-item" href="<?= base_url('list_attendence/?items_per_page=700') ?>">700</a>
                  <a class="dropdown-item" href="<?= base_url('list_attendence/?items_per_page=900') ?>">900</a>
                  <a class="dropdown-item" href="<?= base_url('list_attendence/?items_per_page=1000') ?>">1000</a>
                </div>
              </div>
            </div>

            <div class="col-md-4 my-1">
              <nav>
                <ul class="pagination justify-content-center justify-content-md-end mb-0">
                  <?php if($employees['page_no'] == 1): ?>
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1" aria-disabled="true" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                    </li>
                  <?php else: ?>
                    <li class="page-item">
                      <a class="page-link" href="<?= base_url('list_attendence/1/') ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                    </li>
                  <?php endif; ?>
                  <?php if($employees['page_no'] == 1): ?>
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>
                  <?php else: ?>
                    <li class="page-item"><a class="page-link" href="<?= base_url('list_attendence/'.($employees['page_no']-1).'/') ?>">Previous</a></li>
                  <?php endif; ?>
                  <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true"><?= $employees['page_no'] ?></a></li>
                  <?php if($employees['item_end'] == $employees['total_items']): ?>
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a></li>
                  <?php else: ?>
                    <li class="page-item"><a class="page-link" href="<?= base_url('list_attendence/'.($employees['page_no']+1).'/') ?>">Next</a></li>
                  <?php endif; ?>

                  <?php if($employees['item_end'] == $employees['total_items']): ?>
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1" aria-disabled="true" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                    </li>
                  <?php else: ?>
                    <li class="page-item"><a class="page-link" href="<?= base_url('list_attendence/'.ceil($employees['total_items'] / $employees['items_per_page']).'/') ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                  <?php endif; ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>

    </main>
<?php $this->view('includes/footer.php'); ?>
