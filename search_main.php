
<?php
include('connectionData.txt');
$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>A Aircraft Database</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="main.php">Warbird Database</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="main.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="search_main.php">Database Lookup</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add_link.php">Add Item to Aircraft</a>
          </li>
          <li class='nav-item'>
            <a class="nav-link" href="add_item.php">Add an Aircraft</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="trevor.php">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="col-lg-12 text-center">
    <h1 class="mt-5">Search The Database</h1>
    <p class="lead">Select your search terms from the drop downs below</p>
  </div>
  
  <!-- SEARCHING BY MANUFACT --!>
  <form action="search_man.php" method="POST">
  <div class="form-group" style="width:98%">
    <h2> Search By Manufacturer:</h2>
    <table class="table">
      <tbody>
        <tr>
          <td>Select a Manufacturer:</td>
          <td>
            <select name="man">
            <option value="" selected disabled>Please Select A Manufacturer:</option>
            <option value="all">Show A/C from all Manufacturers</option>
              <?php
                $sql= mysqli_query($conn, "SELECT DISTINCT(name), m_id FROM Manufact JOIN Aircraft USING(m_id)") or die (mysqli_error($conn));
                while($row=mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['m_id'].'">';
                    echo $row['name'];
                    echo '</option>';
                }
              ?>
            </select>
          </td>
          <td> 
            <button type="submit" class="btn btn-info btn-block">Search!</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
 </form>

 <br/>
 <br/>


  <!-- SEARCHING BY ENGINE TYPE --!>
  <form action="search_e_typ.php" method="POST">
  <div class="form-group" style="width:98%">
    <h2> Search By Engine Type:</h2>
    <table class="table">
      <tbody>
        <tr>
          <td>Select a Engine Type:</td>
          <td>
            <select name="e_typ">
            <option value="" selected disabled>Please Select An Engine Type:</option>
            <option value="all">Show A/C from all Engine Types</option>
              <?php
                $sql= mysqli_query($conn, "SELECT DISTINCT type FROM Engine") or die (mysqli_error($conn));
                while($row=mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['type'].'">';
                    echo $row['type'];
                    echo '</option>';
                }
              ?>
            </select>
          </td>
          <td> 
            <button type="submit" class="btn btn-info btn-block">Search!</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
 </form>

 <br/>
 <br/>

  <!-- SEARCHING BY Mission TYPE --!>
  <form action="search_miss.php" method="POST">
  <div class="form-group" style="width:98%">
    <h2> Search By Mission Designation:</h2>
    <table class="table">
      <tbody>
        <tr>
          <td>Select a Mission Designation:</td>
          <td>
            <select name="miss_d">
            <option value="" selected disabled>Please Select A Mission:</option>
            <option value="all">Show A/C from all</option>
              <?php
                $sql= mysqli_query($conn, "SELECT DISTINCT(name), mission_id FROM Mission_designation JOIN Aircraft USING(Mission_id)") or die (mysqli_error($conn));
                while($row=mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['mission_id'].'">';
                    echo $row['name'];
                    echo '</option>';
                }
              ?>
            </select>
          </td>
          <td> 
            <button type="submit" class="btn btn-info btn-block">Search!</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
 </form>

 <br/>
 <br/>
  <!-- SEARCHING BY County of Use --!>
  <form action="search_cou.php" method="POST">
  <div class="form-group" style="width:98%">
    <h2> Search By Country of Use:</h2>
    <table class="table">
      <tbody>
        <tr>
          <td>Select a Country:</td>
          <td>
            <select name="cou">
            <option value="" selected disabled>Please Select A Country:</option>
            <option value="all">Show A/C from all</option>
              <?php
                $sql= mysqli_query($conn, "SELECT DISTINCT(c.name), c_id FROM Aircraft_Used_By_Country JOIN Aircraft USING(ac_id) JOIN Country as c USING(c_id)") or die (mysqli_error($conn));
                while($row=mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['c_id'].'">';
                    echo $row['name'];
                    echo '</option>';
                }
              ?>
            </select>
          </td>
          <td> 
            <button type="submit" class="btn btn-info btn-block">Search!</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
 </form>

 <br/>
 <br/>
  
 <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>


