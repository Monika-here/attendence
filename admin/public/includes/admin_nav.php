<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link <?= ($slug == 'dashboard') ? 'active' : '' ?>" href="<?= base_url('dashboard/') ?>">
          <span data-feather="home"></span>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($slug == 'add_employee') ? 'active' : '' ?>" href="<?= base_url('add_employee/') ?>">
          <span data-feather="user-plus"></span>
          Add Employee
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($slug == 'list_employees') ? 'active' : '' ?>" href="<?= base_url('list_employees/') ?>">
          <span data-feather="list"></span>
          List Employees
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= ($slug == 'list_attendence') ? 'active' : '' ?>" href="<?= base_url('list_attendence/') ?>">
          <span data-feather="list"></span>
          List Employee Attendence
        </a>
      </li>
    </ul>
  </div>
</nav>
