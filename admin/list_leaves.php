<?php 
include '../include/db-connection.php';
include '../include/session.php';

// Check if user is logged in
checkLogin();

// Check if user is admin
if (!isAdmin()) {
    header('Location: ../login.php');
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['add_leave']) && !empty($_POST['user_id']) && !empty($_POST['leave_type_id']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
      // Insert new leave
      $user_id = $conn->real_escape_string($_POST['user_id']);
      $leave_type_id = $conn->real_escape_string($_POST['leave_type_id']);
      $start_date = $conn->real_escape_string($_POST['start_date']);
      $end_date = $conn->real_escape_string($_POST['end_date']);
      $reason = $conn->real_escape_string($_POST['reason']);
      $status = $conn->real_escape_string($_POST['status']);
      $sql = "INSERT INTO leaves (user_id , leave_type_id, start_date, end_date, reason, status ) VALUES ('$user_id', '$leave_type_id', '$start_date', '$end_date', '$reason', '$status')";
      if ($conn->query($sql) === TRUE) {
          $_SESSION['message'] = 'New leave request created successfully';
      } else {
          $_SESSION['error'] = 'Error: ' . $conn->error;
      }
      // Redirect to avoid form resubmission
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
  } elseif (isset($_POST['update_leave']) && !empty($_POST['leave_id']) && !empty($_POST['user_id']) && !empty($_POST['leave_type_id']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
      // Update existing leave
      $leave_id = intval($_POST['leave_id']);
      $user_id = $conn->real_escape_string($_POST['user_id']);
      $leave_type_id = $conn->real_escape_string($_POST['leave_type_id']);
      $start_date = $conn->real_escape_string($_POST['start_date']);
      $end_date = $conn->real_escape_string($_POST['end_date']);
      $reason = $conn->real_escape_string($_POST['reason']);
      $status = $conn->real_escape_string($_POST['status']);
      $sql = "UPDATE leaves SET user_id='$user_id', leave_type_id='$leave_type_id', start_date='$start_date', end_date='$end_date', reason='$reason', status='$status' WHERE id=$leave_id";
      if ($conn->query($sql) === TRUE) {
          $_SESSION['message'] = 'Leave request updated successfully';
      } else {
          $_SESSION['error'] = 'Error: ' . $conn->error;
      }
      // Redirect to avoid form resubmission
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
  } elseif (isset($_POST['delete_leave']) && !empty($_POST['leave_id'])) {
      // Delete leave
      $leave_id = intval($_POST['leave_id']);
      $sql = "DELETE FROM leaves WHERE id=$leave_id";
      if ($conn->query($sql) === TRUE) {
          $_SESSION['message'] = 'Leave request deleted successfully';
      } else {
          $_SESSION['error'] = 'Error: ' . $conn->error;
      }
      // Redirect to avoid form resubmission
      header("Location: ".$_SERVER['PHP_SELF']);
      exit();
  }
}

// Fetch leaves
$sql = "SELECT * FROM leaves";
$result = $conn->query($sql);
$leaveArray = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      $leaveArray[] = $row;
  }
}

include '../templates/admin-header.php'; 
?>

<style>
  table.dataTable.no-footer {
    border-bottom: 1px #403d3d1c;
  }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Leave Report</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Alert Messages -->
                        <?php if (isset($_SESSION['message']) || isset($_SESSION['error'])): ?>
                            <div id="alert-container" style="position: fixed; top: 10px; right: 10px; z-index: 1050;">
                                <?php if (isset($_SESSION['message'])): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?php echo $_SESSION['message']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION['message']); ?>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['error'])): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $_SESSION['error']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION['error']); ?>
                                <?php endif; ?>
                            </div>
                            <script>
                                setTimeout(function() {
                                    let alertContainer = document.getElementById('alert-container');
                                    if (alertContainer) {
                                        alertContainer.style.display = 'none';
                                    }
                                }, 5000);
                            </script>
                        <?php endif; ?>
                        <button type="button" class="btn btn-primary mt-3 mb-3"data-bs-toggle="modal" data-bs-target="#addModal">
                            Add Leave Request
                        </button>
                        <!-- Table with stripped rows -->
                        <table id="leavesTable" class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Leave Type ID</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($leaveArray as $leave): ?>
                                <tr>
                                    <td><?php echo $leave["id"]; ?></td>
                                    <td><?php echo $leave["user_id"]; ?></td>
                                    <td><?php echo $leave["leave_type_id"]; ?></td>
                                    <td><?php echo $leave["start_date"]; ?></td>
                                    <td><?php echo $leave["end_date"]; ?></td>
                                    <td><?php echo $leave["reason"]; ?></td>
                                    <td><?php echo $leave["status"]; ?></td>
                                    <td><?php echo $leave["created_at"]; ?></td>
                                    <td>
                                        <button type="button" class="btn"style="background-color: #ffb84d" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="setUpdateData(<?php echo $leave['id']; ?>, '<?php echo $leave['user_id']; ?>', '<?php echo $leave['leave_type_id']; ?>', '<?php echo $leave['start_date']; ?>', '<?php echo $leave['end_date']; ?>', '<?php echo $leave['reason']; ?>', '<?php echo $leave['status']; ?>')">Update</button>
                                        <button type="button" class="btn " style="background-color: #ff5050" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteData(<?php echo $leave['id']; ?>)">Delete</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- Add Leave Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addUserId" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="addUserId" name="user_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="addLeaveTypeId" class="form-label">Leave Type ID</label>
                        <input type="text" class="form-control" id="addLeaveTypeId" name="leave_type_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="addStartDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="addStartDate" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="addEndDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="addEndDate" name="end_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="addReason" class="form-label">Reason</label>
                        <textarea class="form-control" id="addReason" name="reason" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="addStatus" class="form-label">Status</label>
                        <select class="form-select" id="addStatus" name="status">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add_leave" style="background-color:#a24a8e;" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Leave Modal -->
<div class="modal fade" id="updateModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Update Leave Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="updateLeaveId" name="leave_id">
                    <div class="mb-3">
                        <label for="updateUserId" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="updateUserId" name="user_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateLeaveTypeId" class="form-label">Leave Type ID</label>
                        <input type="text" class="form-control" id="updateLeaveTypeId" name="leave_type_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateStartDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="updateStartDate" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateEndDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="updateEndDate" name="end_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateReason" class="form-label">Reason</label>
                        <textarea class="form-control" id="updateReason" name="reason" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="updateStatus" class="form-label">Status</label>
                        <select class="form-select" id="updateStatus" name="status">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_leave"  class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Leave Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Leave Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteLeaveId" name="leave_id">
                    <p>Are you sure you want to delete this leave request?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="delete_leave"  class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#leavesTable').DataTable({
            "scrollX": false, // Enable horizontal scrolling
            "columns": [
                { "width": "0%" }, // Adjust width as needed for each column
                { "width": "10%" },
                { "width": "15%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "20%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "20%", "orderable": false } // Disable sorting for action column
            ]
        });
    });

    function setUpdateData(id, user_id, leave_type_id, start_date, end_date, reason, status) {
        document.getElementById('updateLeaveId').value = id;
        document.getElementById('updateUserId').value = user_id;
        document.getElementById('updateLeaveTypeId').value = leave_type_id;
        document.getElementById('updateStartDate').value = start_date;
        document.getElementById('updateEndDate').value = end_date;
        document.getElementById('updateReason').value = reason;
        document.getElementById('updateStatus').value = status;
    }

    function setDeleteData(id) {
        document.getElementById('deleteLeaveId').value = id;
    }
</script>

<?php include '../templates/footer.php'; ?>