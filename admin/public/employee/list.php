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
        <div class="search-form">
          <form type="GET" class="form-inline">
            <div class="form-group mb-2 mr-1">
              <input type="text" class="form-control" value="<?= (isset($search) && !empty($search)) ? $search : '' ?>" name="search" placeholder="Search by name">
            </div>
            <button type="submit" class="btn btn-dark mb-2">Search</button>
            <?php if($search && !empty($search)): ?>
              <a class="text-dark px-1 my-auto" href="<?= base_url('list_employees/') ?>"><u>clear</u></a>
            <?php endif; ?>
          </form>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="<?= base_url('add_employee/') ?>"><button type="button" class="btn btn-sm btn-dark">Add Employee</button></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <table id="dt_table" class="table table-striped table-bordered dt-responsive" style="width:100%">
            <thead>
                <?php
                $_table_cols = '<tr>
                    <th>Sl.No</th>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Mobile</th>
                    <th>Email</th>
                  </tr>';
                echo $_table_cols;
                ?>
            </thead>
            <tbody>
              <?php if(isset($employees['items']) && !empty($employees['items'])): ?>
              <?php foreach ($employees['items'] as $key => $value): ?>
                <tr>
                    <td class="align-middle"><?= (intval($employees['item_start'])+$key) ?></td>
                    <td class="text-center align-middle action-btn">
                      <a class="pr-2" href="<?= base_url('edit_employee/'.id_encrypt_decrypt($value['id']).'/') ?>"><span data-feather="edit"></span></a>
                      <a class="pl-2" data-toggle="modal" data-link="delete_employee/<?= id_encrypt_decrypt($value['id']) ?>/" data-id="<?= id_encrypt_decrypt($value['id']) ?>" data-name="<?= $value['name'] ?>" href="#" data-target="#deleteModal"><span data-feather="trash-2"></span></a>
                      <a class="pl-2" href="<?= base_url('employee_attendence/'.id_encrypt_decrypt($value['id']).'/') ?>"><span data-feather="info"></span></a>
                  </td>
                    <td class="align-middle"><?= $value['name'] ?></td>
                    <td class="align-middle"><?= $value['status'] ?></td>
                    <td class="align-middle"><?= $value['mobile'] ?></td>
                    <td class="align-middle"><?= $value['email'] ?></td>
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
                  <a class="dropdown-item" href="<?= base_url('list_employees/?items_per_page=50') ?>">50</a>
                  <a class="dropdown-item" href="<?= base_url('list_employees/?items_per_page=100') ?>">100</a>
                  <a class="dropdown-item" href="<?= base_url('list_employees/?items_per_page=300') ?>">300</a>
                  <a class="dropdown-item" href="<?= base_url('list_employees/?items_per_page=500') ?>">500</a>
                  <a class="dropdown-item" href="<?= base_url('list_employees/?items_per_page=700') ?>">700</a>
                  <a class="dropdown-item" href="<?= base_url('list_employees/?items_per_page=900') ?>">900</a>
                  <a class="dropdown-item" href="<?= base_url('list_employees/?items_per_page=1000') ?>">1000</a>
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
                      <a class="page-link" href="<?= base_url('list_employees/1/') ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                    </li>
                  <?php endif; ?>
                  <?php if($employees['page_no'] == 1): ?>
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>
                  <?php else: ?>
                    <li class="page-item"><a class="page-link" href="<?= base_url('list_employees/'.($employees['page_no']-1).'/') ?>">Previous</a></li>
                  <?php endif; ?>
                  <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true"><?= $employees['page_no'] ?></a></li>
                  <?php if($employees['item_end'] == $employees['total_items']): ?>
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a></li>
                  <?php else: ?>
                    <li class="page-item"><a class="page-link" href="<?= base_url('list_employees/'.($employees['page_no']+1).'/') ?>">Next</a></li>
                  <?php endif; ?>

                  <?php if($employees['item_end'] == $employees['total_items']): ?>
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1" aria-disabled="true" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                    </li>
                  <?php else: ?>
                    <li class="page-item"><a class="page-link" href="<?= base_url('list_employees/'.ceil($employees['total_items'] / $employees['items_per_page']).'/') ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                  <?php endif; ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Delete Employee</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you wish to delete <span class="item-title"></span> employee?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
              <a class="delete-btn" href="#"><button type="button" class="btn btn-danger">Delete</button></a>
            </div>
          </div>
        </div>
      </div>

    </main>
<?php $this->view('includes/footer.php'); ?>
