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
      <a class="nav-item nav-link" href="index.php">Home</a>
      <a class="nav-item nav-link active" href="addemployee.php">Add Employee</a>
      <a class="nav-item nav-link" href="adddevice.php">Add Device</a>
      <a class="nav-item nav-link" href="issue.php">Issue</a>
      <a class="nav-item nav-link" href="return.php">Return</a>
    </nav>
    <br> -->
    

    <div >

     
          <div class="container">

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-0"></div>
            <div class="col-lg-6 col-md-6 col-sm-10">
                <br><br>
                 <div class="card">
                     <div class="container">
<form action="addemployee.php" method="post">
     <h1 align="center">Update Employee</h1>
        <h6 class="card-subtitle mb-2 text-muted" align="center">Device Issue and Return System</h6><br>
    <div>
        <label style="width: 40%">Employee's Name</label>
        <input style="width: 50%"type="text" name="name" placeholder="Enter Employee's Name">
    </div>
    <br>
    <div>
        <label style="width: 40%">Designation</label>
        <input style="width: 50%" type="text" name="designation" placeholder="Enter Designation">
    </div>
    <br>
    
    <div>
        <label style="width: 40%">RAX Number</label>
        <input style="width: 50%"type="text" name="raxno" placeholder="Enter RAX Number">
    </div>
    <br>
     <div>
        <label style="width: 40%">Department</label>
        <input style="width: 50%" type="text" name="department" placeholder="Enter Department">
    </div>
    <br>
    
    <div>
    
                    <br>
                        <button class="btn btn-primary" type="submit" name="submit" value="Add Row">ADD EMPLOYEE</button>
                      
    </div>
    </form>
    </div>
    </div>
    <br><br>
    </div>
     <div class="col-lg-3 col-md-3 col-sm-0"></div>
    </div>
    </div> 
      

   <!--  <h2>Add Employee</h2>
    <form action="addemployee.php" method="post">
      <input type="text" name="name" value="" placeholder="name">
      <input type="text" name="designation" value="" placeholder="designation">
      <input type="number" name="raxno" value="" placeholder="raxno">
      <input type="text" name="department" value="" placeholder="department">
      <input type="submit" name="submit" value="Add Row">
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

    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $raxno = $_POST['raxno'];
    $department = $_POST['department'];

    $res2 = mysqli_query($conn, "INSERT INTO Employee(name, designation, raxno, department) VALUES('$name', '$designation', $raxno, '$department' )");

    if($res2){
      echo "Data entered in database successfully";
    }
    else{
      echo "Some error occured while entering the data in database";
    }
  }

  // echo "<br>";

  //TO FETCH DATA
  $res = mysqli_query($conn, "SELECT * FROM Employee ORDER BY EmployeeNo");
  if(mysqli_num_rows($res)){
    $x = mysqli_fetch_all($res);
    // echo "<h2>Database</h2>";
    echo "<div class='card'> <div class='container'>  <h2>Database</h2>
         <table class='table table-hover' > <thread> <tr> <th>Employee No</th>  <th>Name</th>   <th>Designation</th>    <th>Rax No</th>   <th>Department</th> </tr> </thread>";
    for($i = 0; $i < sizeof($x); $i++){

      print_r('<tr>'.'<td>'.$x[$i][0].'</td>'.'<td>'.$x[$i][1].'</td>'.'<td>'.$x[$i][2].'</td>'.'<td>'.$x[$i][3].'</td>'.'<td>'.$x[$i][4].'</td>'.'</tr>');
    }
    echo "</table></div></div>";
  }
}
echo "</div>";
echo "</body>";
echo "</html>";

 ?>
