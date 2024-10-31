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
$sql = "SELECT * from leaves where status='pending';";
$result = $conn->query($sql);
$leaves = [];
while($row = $result->fetch_assoc())
{
    $leaves[] = $row;
}
$sql2 = "SELECT * from leave_types ";
$result2 = $conn->query($sql2);
$leavetype = [];
while($row = $result2->fetch_assoc())
{
    $leavetype[] = $row;
}
$sql3 = "SELECT * from departments ";
$result3 = $conn->query($sql3);
$totaldept = [];
while($row = $result3->fetch_assoc())
{
    $totaldept[] = $row;
}
$sql4 = "SELECT * from users ";
$result4 = $conn->query($sql4);
$totalemp = [];
while($row = $result4->fetch_assoc())
{
    $totalemp[] = $row;
}
$sql5 = "SELECT * from leaves where status='approved';";
$result5 = $conn->query($sql5);
$leaves1 = [];
while($row = $result5->fetch_assoc())
{
  $leaves1[] = $row;
}
$sql6 = "SELECT * from leaves where status='rejected';";
$result6 = $conn->query($sql6);
$rejectes = [];
while($row = $result6->fetch_assoc())
{
  $rejectes[] = $row;
}

include '../templates/admin-header.php'; 
?>
<main id="main" class="main">

</main>
<body >
  <h1 style="text-align:center;">Leave Management System</h1>
  <br>

<div class="container">
  <div class="row">
    <div class="col-md-5">
      <div class="card text-center"style="background-color: #ccf2ff;">
      <img src="../assets/images/leaves.png" style="width:50px; height:50px;">
        <div class="card-body" style="height:150px; background-color:#fedf94;">
          <h3 class="card-title">Total Type of Leave</h3>
          <h4><?php echo count($leavetype)?></h4>
          
          <p class="card-text"><i class="fas fa-file-alt fa-2x"></i></p>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card text-center"style="background-color: #ccf2ff;">
        <img src="../assets/images/emp.jpg" style="width:50px; height:50px;">
        <div class="card-body" style="height:150px; background-color:#fedf94;">
          <h3 class="card-title">Total Employees</h3>
          <h4><?php echo count($totalemp)?></h4>
          
          <p class="card-text"><i class="fas fa-building fa-2x"></i></p>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card text-center" style="background-color: #ccf2ff;">
      <img src="../assets/images/dept.png" style="width:50px; height:50px;">
        <div class="card-body"style="height:150px; background-color:#fedf94;">
          <h3 class="card-title">Total Departments</h3>
          <h4><?php echo count($totaldept)?></h4>
          
          <p class="card-text"><i class="fas fa-users fa-2x"></i></p>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card text-center" style="background-color: #ccf2ff;">
      <img src="../assets/images/pending.png" style="width:50px; height:50px;">
        <div class="card-body"  style="height:150px; background-color:#fedf94;">
          <h3 class="card-title">Pending Applications</h3>
          <h4><?php echo count($leaves)?></h4>
          
          <p class="card-text"><i class="fas fa-list-alt fa-2x"></i></p>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card text-center" style="background-color: #ccf2ff;">
      <img src="../assets/images/declined.png" style="width:50px; height:50px;">
        <div class="card-body"  style="height:150px; background-color:#fedf94;">
          <h3 class="card-title">Declined Applications</h3>
          <h4><?php echo count($rejectes)?></h4>
          <p class="card-text"><i class="fas fa-list-alt fa-2x"></i></p>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card text-center" style="background-color: #ccf2ff;">
      <img src="../assets/images/approved.png" style="width:50px; height:50px;">
        <div class="card-body"  style="height:150px; background-color:#fedf94;">
          <h3 class="card-title">Approved Applications</h3>
          <h4><?php echo count($leaves1)?></h4>
          
          <p class="card-text"><i class="fas fa-list-alt fa-2x"></i></p>
   
      </div>
    </div>
    </div>
  </div>
</div>

<?php include '../templates/footer.php'; ?>