<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style="background-color:#66b2b2 ">

<ul class="sidebar-nav" id="sidebar-nav"style="background-color:#ffdd99">

  <?php if (isAdmin()) : ?>
  <li class="nav-item">
    <a class="nav-link " href="../admin/dashboard.php"style="background-color:#fff7e6">
      <i class="bi bi-clipboard2-fill"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link " href="../admin/manage_departments.php"style="background-color:#fff7e6">
      <i class="bi bi-building-fill"></i>
      <span>Department</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link " href="../admin/manage_leave_types.php"style="background-color:#fff7e6">
      <i class="bi bi-calendar2-check-fill"></i>
      <span>Leave Type</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link " href="../admin/role_management.php"style="background-color:#fff7e6">
      <i class="bi bi-person-fill"></i>
      <span>Role Management</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link " href="../admin/manage_staff.php"style="background-color:#fff7e6">
      <i class="bi bi-person-badge-fill"></i>
      <span>Staff Management</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link " href="../admin/list_leaves.php"style="background-color:#fff7e6">
      <i class="bi bi-clipboard-check-fill"></i>
      <span>Leave List</span>
    </a>
  </li><!-- End Dashboard Nav -->
  
  <?php elseif (isStaff() || isManager()) : ?>
    <li class="nav-item">
      <a class="nav-link " href="../staff/dashboard.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="../staff/leaves.php">
        <i class="bi bi-grid"></i>
        <span>Leaves</span>
      </a>
    </li> 
  <?php elseif (isManager()) : ?>
    <li class="nav-item">
      <a class="nav-link " href="../staff/list_leaves.php">
        <i class="bi bi-list-task"></i>
        <span>Leave List</span>
      </a>
    </li>
  <?php endif ?>
</ul>

</aside><!-- End Sidebar-->