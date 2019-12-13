
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
      <a class="navbar-brand" href="#">Warbird Database</a>
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
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="mt-5">"With great power comes great responsibility..."</h1>
        <h2 class="mt-5">-George Lucas 1775, Signing of the Declaration of Independence</h2>
        <p class="lead">Please do not tamper with this database with ill intentions.</p>
      </div>
    </div>
  </div>

<!-- ++++++++++++++++++++++++++++++++++++ ADD AIRCRAFT SECTION +++++++++++++++++++++++++++++++++++++++++ --!>
<form action="addac.php" method="POST">
<div class="form-group" style="width:98%">
  <h1>Add Aircraft</h1>
  <table class="table">
    <tbody>
      <tr>
        <td>Designation</td>
        <td>
          <input type="text" name="ac_d" style="width: 150px; padding: 1px" placeholder="ex. P-51"> 
        </td>44444
        <td>NATO Name</td>
        <td>
          <input type="text" name="nato" style="width: 150px; padding: 1px" placeholder="ex. Mustang"> 
        </td>
        <td>Service Ceiling (ft)</td>
        <td>
          <input type="int" name="sc" style="width: 80px; padding: 1px" value="0"> 
        </td>
        <td>Crew Count</td>
        <td>
          <input type="number" name="cc" style="width: 50px; padding: 1px" value="0"> 
        </td>
      </tr>
      <tr>
        <td>Range (mi)</td>
        <td>
          <input type="number" name="range" style="width: 80px; padding: 1px" value="0"> 
        </td>
        <td>Max Speed (mph)</td>
        <td>
          <input type="number" name="max_s" style="width: 80px; padding: 1px" value="0"> 
        </td>
        <td>Cruise Speed (mph)</td>
        <td>
          <input type="number" name="cruise_s" style="width: 80px; padding: 1px" value="0"> 
        </td>
        <td>Enter Service Date</td>
        <td>
          <input type="date" name="s_date" style="width: 200px; padding: 1px" value="0"> 
        </td>
      </tr>
      <tr>
        <td> Select Manufacturer:</td>
        <td>
            <select name="acman">
            <?php 
                $sql = mysqli_query($conn, "SELECT m_id, name FROM Manufact") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['m_id'].'">';
                    echo $row['name'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
        
        <td> Select Mission Type:</td>
        <td>
            <select name="acmisstyp">
            <?php 
                $sql = mysqli_query($conn, "SELECT mission_id, name FROM Mission_designation") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['mission_id'].'">';
                    echo $row['name'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
        <td> Select Country of Use:</td>
        <td>
            <select name="acuse">
            <?php 
                $sql = mysqli_query($conn, "SELECT c_id, name FROM Country") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['c_id'].'">';
                    echo $row['name'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
        <td> Select Country of Origin:</td>
        <td>
            <select name="acori">
            <?php 
                $sql = mysqli_query($conn, "SELECT c_id, name FROM Country") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['c_id'].'">';
                    echo $row['name'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
      </tr>
      </tr>
      <tr>
        <td> Select Engine:</td>
        <td>
            <select name="aceng">
            <?php 
                $sql = mysqli_query($conn, "SELECT e.e_id, e.name, m.name as mname FROM Engine as e JOIN Manufact as m USING(m_id)") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['e_id'].'">';
                    echo $row['mname'].' '.$row['name'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
        <td> Engine Quantity:</td>
        <td>
          <input type="number" name="e_qty" style="width: 150px; padding: 1px" placeholder="ex. 2"> 
        </td>
      </tr>
      <tr>
        <button type="submit" class="btn btn-block btn-success btn-large">Add Aircraft</button>
      </tr>
    </tbody>
  </table>
</div>
</form>
<br />

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++ ADD ENGINE SECTION ++++++++++++++++++++++++++++ --!>

<form action="addeng.php" method="POST">
<div class="form-group" style="width:98%">
  <h1>Add Engine</h1>
  <table class="table">
    <tbody>
      <tr>
        <td>Engine Designation:</td>
        <td>
          <input type="text" name="eng_name" id='e_name' style="width: 150px; padding: 1px" placeholder="ex. V-1710"> 
        </td>
        <td>Output Power (hp):</td>
        <td>
          <input type="text" name='eng_pwr' id='e_pwr' style="width: 150px; padding: 1px" placeholder="ex. 1600"> 
        </td>
      </tr>
      <tr>
        <td> Select Manufacturer:</td>
        <td>
            <select name="e_mid" id="emid">
            <?php 
                $sql = mysqli_query($conn, "SELECT m_id, name FROM Manufact") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['m_id'].'">';
                    echo $row['name'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
        
        <td> Select Engine Type:</td>
        <td>
            <select name="e_typ" id="e_t">
                <option value="piston">(Propeller) Piston</option>
                <option value="Turbo Jet">(Jet) Turbo Jet</option>
                <option value="Turbo Prop">(Propeller) Turbo Prop</option>
                <option value="Turbo Fan">(Jet) Turbo Fan</option>
            </select>
        </td>
      </tr>
      <tr>
        <button type="submit" class="btn btn-block btn-success btn-large">Add Engine</button>
      </tr>
    </tbody>
  </table>
</div>
</form>
<br />
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++ ADD ARRMAMENT SECTION ++++++++++++++++++++++++++++ --!>

<form action="addarm.php" method="POST">
<div class="form-group" style="width:98%">
  <h1>Add Armament</h1>
  <table class="table">
    <tbody>
      <tr>
        <td>Armament Name:</td>
        <td>
          <input type="text" name="arname" style="width: 150px; padding: 1px" placeholder="ex. Browning M2 Machine Gun"> 
        </td>
        <td>Armament Type:</td>
        <td>
            <select name="artyp">
                <option value="Gun">Gun</option>
                <option value="Cannon">Cannon</option>
                <option value="Bomb">Bomb</option>
                <option value="Rocket">Rocket</option>
            </select>
        </td>
        <td>Caliber size (mm) - Guns/Cannon:</td>
        <td>
          <input type="text" name='cal' style="width: 150px; padding: 1px" placeholder="ex. 12.7"> 
        </td>
        <td>Weight (kg) - Bomb:</td>
        <td>
          <input type="text" name='weight' style="width: 150px; padding: 1px" placeholder="ex. 1134"> 
        </td>
      </tr>
      <tr>
        <button type="submit" class="btn btn-block btn-success btn-large">Add Engine</button>
      </tr>
    </tbody>
  </table>
</div>
</form>

<br />
<br />

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>


