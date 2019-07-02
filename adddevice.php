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
            <a href="report.html">Report</a>
              </div>
  <head>
    <meta charset="utf-8">
    <title>Devices</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="dashboard.css" rel="stylesheet" type="text/css" >
  </head>
  <body style = "padding:10px;">
   <!--  <br>
    <nav class="nav nav-pills nav-justified">
      <a class="nav-item nav-link" href="index.php">Home</a>
      <a class="nav-item nav-link" href="addemployee.php">Employees</a>
      <a class="nav-item nav-link active" href="adddevice.php">Devices</a>
      <a class="nav-item nav-link" href="issue.php">Issue</a>
      <a class="nav-item nav-link" href="return.php">Return</a>
    </nav>
    <br> -->
    <br>
    <br>
    <div class="container">

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-0"></div>
            <div class="col-lg-6 col-md-6 col-sm-10">
                
                 <div class="card">
                     <div class="container">
<form action="adddevice.php" method="post">
     <h1 align="center">Update Devices</h1>
        <h6 class="card-subtitle mb-2 text-muted" align="center">Device Issue and Return System</h6><br>
    
    <br>
    <div>
       <div>
        <label style="width: 40%">Company</label>
        <input style="width: 50%" type="text" name="company" placeholder="Enter Company">
      </div>
       <!--  <label style="width: 40%">Company </label>
            <select style="width: 50%" name="company" type="text">
                    
                    
                      <option >Company</option>
                      <option value="HP">HP</option>
                      <option value="Lenevo">Lenevo</option>
                      <option value="Dell">Dell</option>
                      <option value="Dell">Apple</option>
                   
                  </select> -->
                  <br>
                <!--   <br>
                  <label style="width: 40%">Type of device </label>
                      <select style="width: 50%" name="type" type="text">
                    <option >Item type</option>
                    <option value="Laptop">Laptop</option>
                      <option value="Printer">Printer</option>
                      <option value="Keyboard">Keyboard</option>
                      <option value="Hard Disk">Hard Disk</option>
                  </select> -->
                  <div>
                   <label style="width: 40%">Type</label>
                   <input style="width: 50%" type="text" name="type" placeholder="Enter type">
                 </div>

                  <div>
                    <br>
                      <input type="checkbox" name="returnable" value=1> Is it returnable<br>
                  </div>
                  <div>
                    <br>
                        <button class="btn btn-primary" type="submit" name="submit" value="Add Row">Submit</button>
                  </div>
    </div>
    </form>
    </div>
    </div>
    </div>
     <div class="col-lg-3 col-md-3 col-sm-0"></div>
    </div>
    </div> 
   <!--  <div style='padding:20px'> -->

   <!--  <h2>Add Device</h2>
    <form action="adddevice.php" method="post">
      <input type="text" name="company" value="" placeholder="company">
      <input type="text" name="type" value="" placeholder="type">
      <label>Is it returnable</label>
      <input type="checkbox" name="returnable" value=1>
      <input type="submit" name="submit" value="Add Device">
    </form> -->


<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if($conn){

  //TO INSERT DATA
  if(isset($_POST['submit'])){

    $company = $_POST['company'];
    $type = $_POST['type'];
    $returnable = isset($_POST['returnable']) ? "Yes" : "No";

    $res2 = mysqli_query($conn, "INSERT INTO `Device`(`Company`, `Type`, `Available`, `Returnable`) VALUES ('$company', '$type', 'Yes', '$returnable') ");

    if($res2){
      echo "Data entered in database successfully";
    }
    else{
      echo "Some error occured while entering the data in database";
    }
  }

  echo "<br>";

  //TO FETCH DATA
  $res = mysqli_query($conn, "SELECT * FROM Device ORDER BY Type");
  if(mysqli_num_rows($res)){
    $x = mysqli_fetch_all($res);
    // echo "<h2>Database</h2>";
    echo "<div class='card'> <div class='container'>  <h2>Database</h2> <table class='table table-hover' > <thread> <tr> <th>Device No</th>  <th>Type</th>   <th>Company</th>   <th>Available?</th>   <th>Returnable?</th> </tr> </thread>";
    for($i = 0; $i < sizeof($x); $i++){

      print_r('<tr>'.'<td>'.substr($x[$i][2], 0, 1).substr($x[$i][1], 0, 1).$x[$i][0].'</td>'
              .'<td>'.$x[$i][2].'</td>'
              .'<td>'.$x[$i][1].'</td>'
              .'<td>'.$x[$i][3].'</td>'
              .'<td>'.$x[$i][4].'</td>'.'</tr>');
    }
    echo "</table></div></div>";
  }
}
echo "</div>";
echo "</body>";
echo "</html>";

 ?>
