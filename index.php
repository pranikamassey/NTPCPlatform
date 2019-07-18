<!DOCTYPE html>
<html lang="en" dir="ltr">
<div class="topnav">
            <a href="images/logo.png">
               <img src="images/logo.png" alt="NTPC logo" class="logopic">
            </a>
            <a class="nav-item nav-link" href="index.php">Home</a>
            <a class="nav-item nav-link " href="addemployee.php">Add Employee</a>
            <a class="nav-item nav-link" href="adddevice.php">Add Device</a>
            <a class="nav-item nav-link" href="issue.php">Issue</a>
            <a class="nav-item nav-link" href="return.php">Return</a>
            <a class="nav-item nav-link" href="report.php">Report</a>
              </div>
<head>
  <meta charset="utf-8">
  <title>Index</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="dashboard.css" rel="stylesheet" type="text/css" >
</head>
<body style = "padding:10px;">
  <!-- <br>
  <nav class="nav nav-pills nav-justified">
    <a class="nav-item nav-link active" href="index.php">Home</a>
    <a class="nav-item nav-link" href="addemployee.php">Add Employee</a>
    <a class="nav-item nav-link" href="adddevice.php">Add Device</a>
    <a class="nav-item nav-link" href="issue.php">Issue</a>
    <a class="nav-item nav-link" href="return.php">Return</a>
  </nav>
  <br> -->
  <br>
  <br>
  <div style='padding:20px'>


<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if($conn){
  //In Stock
  $res = mysqli_query($conn, "SELECT COUNT(Device.DeviceNo), Device.Type, Device.Company
                              FROM Device
                              WHERE Device.Available='Yes'
                              GROUP BY Device.Type, Device.Company");

  //Issued Devices
  $res1 = mysqli_query($conn, "SELECT COUNT(Device.DeviceNo), Device.Type, Device.Company
                              FROM Device
                              WHERE Device.Available='No'
                              GROUP BY Device.Type, Device.Company");
  //Total Devices
  $res2 = mysqli_query($conn, "SELECT COUNT(DeviceNo), Type, Company
                              FROM Device
                              GROUP BY Type, Company;");
  if(mysqli_num_rows($res)){
    if(mysqli_num_rows($res2)){


      $stock = mysqli_fetch_all($res);
      $issued = mysqli_fetch_all($res1);
      $total = mysqli_fetch_all($res2);


      // echo "<h2>In Stock</h2>";
      echo "<div class='card'> <div class='container'>  <h2>In Stock</h2>
         <table class='table table-hover' > <thread> <tr> <th>Count</th>  <th>Type</th>  <th>Company</th> </tr> </thread>";
      for($i = 0; $i < sizeof($stock); $i++){
        print_r('<tr>'.'<td>'.$stock[$i][0].'</td>'.'<td>'.$stock[$i][1].'</td>'.'<td>'.$stock[$i][2].'</td>'.'</tr>');
      }
      echo "</table> </div> </div> <br>";


      // echo "<h2>Issued Devices</h2>";
      echo "<div class='card'> <div class='container'>  <h2>Issued Devices</h2>
         <table class='table table-hover' > <thread> <tr><th>Count</th>  <th>Type</th>  <th>Company</th> </tr> </thread>";
      for($i = 0; $i < sizeof($issued); $i++){
        print_r('<tr>'.'<td>'.$issued[$i][0].'</td>'.'<td>'.$issued[$i][1].'</td>'.'<td>'.$issued[$i][2].'</td>'.'</tr>');
      }
     echo "</table> </div> </div>";


      // echo "<h2>Total Devices</h2>";
      // echo "<div class='card'> <div class='container'>  <h2>Total Devices</h2>
      //    <table class='table table-hover' > <thread> <tr><th>Count</th>  <th>Type</th>  <th>Company</th> </tr> </thread>";
      // for($i = 0; $i < sizeof($total); $i++){
      //   print_r('<tr>'.'<td>'.$total[$i][0].'</td>'.'<td>'.$total[$i][1].'</td>'.'<td>'.$total[$i][2  ].'</td>'.'</tr>');
      // }
      // echo "</table> </div> </div>";


    }
  }
}

echo "</div>";
echo "</body>";
echo "</html>";
 ?>
