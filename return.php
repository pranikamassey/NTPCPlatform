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
  <br>
 <!--  <nav class="nav nav-pills nav-justified">
    <a class="nav-item nav-link" href="index.php">Home</a>
    <a class="nav-item nav-link" href="addemployee.php">Add Employee</a>
    <a class="nav-item nav-link" href="adddevice.php">Add Device</a>
    <a class="nav-item nav-link" href="issue.php">Issue</a>
    <a class="nav-item nav-link active" href="return.php">Return</a>
  </nav> -->
  <br>
  <br>
  <br>

  <div style='padding:20px'>

       <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-0"></div>
        <div class="col-lg-6 col-md-6 col-sm-10">
            
              <div class="card">
               <div class="container">
                <form>
                   <h1 align="center">Issue Devices</h1>
                   <h6 class="card-subtitle mb-2 text-muted" align="center">Device Issue and Return System</h6><br>
              <div>
                       <label style="width: 40%">Date Of Issue</label>
                       <input style="width: 50%" type="date" name="date1">
                   </div>
                    <br>
                    <div>
                       <label style="width: 40%">Employee Number</label>
                        <input style="width: 50%" type="Number" name="employeeno" placeholder="Enter Employee Number">
                   </div>
                   <br>
                    <div>
                       <label style="width: 40%">Device Number</label>
                        <input style="width: 50%" type="Number" name="deviceno" placeholder="Enter Employee Number">
                   </div>
                   <br>
                    <div>
                    
                        <button class="btn btn-primary" type="submit" name="submit" value="Retrun">Return</button>
                  </div>
                
                
            </form>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-0"></div>
</div>
</div> 
    <!-- <h2>Return Device</h2> -->
<!--     <form action="return.php" method="post">

      <label>Date of return</label>
      <input type="date" name="date1" value="">
      <input type="number" name="employeeno" value="" placeholder="employeeno">
      <input type="number" name="deviceno" value="" placeholder="deviceno">

      <input type="submit" name="submit" value="Return">

    </form> -->


<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if($conn){

  #IF SUBMIT
  if(isset($_POST['submit'])){

    $date1 = strtotime($_POST["date1"]);
    $date1 = date('Y-m-d', $date1);
    $employeeno = $_POST['employeeno'];
    $deviceno = $_POST['deviceno'];

    #CHECKING IF THE DEVICE IS RETURNABLE
    $res0 = mysqli_query($conn, "SELECT DeviceNo FROM Device WHERE DeviceNo=$deviceno AND Returnable='Yes'");
    if(mysqli_num_rows($res0)){

      #CHECKING IF THE DEVICE ENTERED IS IN ISSUE TABLE AND IS NOT RETURNED
      $res1 = mysqli_query($conn, "SELECT DeviceNo FROM Device WHERE DeviceNo=$deviceno AND Available='No'");
      if(mysqli_num_rows($res1)){

        #UPDATE DEVICE DATABASE TO REFLECT RETURN OF THE ISSUE DEVICE IF THE DEVICE HAS BEEN ISSUE
        $res2 = mysqli_query($conn, "UPDATE `Device` SET `Available`='Yes' WHERE `DeviceNo`=$deviceno");
        if($res2){

          $res3 = mysqli_query($conn, "INSERT INTO `Return1`(`Date`, `EmployeeNo`, `DeviceNo`) VALUES ('$date1', $employeeno, $deviceno)");
          #IF ENTERED IN THE RECORD IN RETURN DATABASE
          if($res3){
            echo "Data inserted in database successfully";}
          else{
            echo "Couln't insert given data into the database";}

        }
        else{
          echo "Couln't update returned flag";}

      }
      else{
        echo "No such device has been issued";}
    }
    else {
      echo "No such device is returnable";
    }



  }

  echo "<br>";

  //TO FETCH DATA

  $res = mysqli_query($conn, 'select Return1.ReturnNo, Return1.Date, Return1.EmployeeNo, Employee.Name, Return1.DeviceNo, Device.Company, Device.Type
                              from Return1, Employee, Device
                              where Return1.EmployeeNo=Employee.EmployeeNo and Return1.DeviceNo=Device.DeviceNo
                              ORDER BY Return1.ReturnNo');
  if(mysqli_num_rows($res)){
    $x = mysqli_fetch_all($res);
    // echo "<h2>Database</h2>";
    echo "<div class='card'> <div class='container'>  <h2>Database</h2>
         <table class='table table-hover' > <thread> <tr> <th>Return No</th>  <th>Date of Return</th>   <th>Employee No</th>    <th>Employee Name</th>     <th>Device No</th>   <th>Device Company</th>   <th>Device Type</th> </tr> </thread>";
    for($i = 0; $i < sizeof($x); $i++){

      print_r('<tr>'.'<td>'.$x[$i][0].'</td>'.'<td>'.$x[$i][1].'</td>'.'<td>'.$x[$i][2].'</td>'.'<td>'.$x[$i][3].'</td>'.'</td>'.'<td>'.$x[$i][4].'</td>'.'</td>'.'<td>'.$x[$i][5].'</td>'.'</td>'.'<td>'.$x[$i][6].'</td>'.'</tr>');
    }
    echo "</table></div></div>";
  }
}
echo "</div>";
echo "</body>";
echo "</html>";

 ?>
