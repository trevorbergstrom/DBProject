
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
<br />
<br />

<!-- ++++++++++++++++++++++++++++++++++++ ADD ENGINE TO AIRCRAFT SECTION +++++++++++++++++++++++++++++++++++++++++ --!>
<form action="add_etoa.php" method="POST">
<div class="form-group" style="width:98%">
  <h1>Add Engine to Aircraft</h1>
  <table class='table'>
    <tbody>
    <tr>
        <td> Select Aircraft:</td>
        <td>
            <select name="acsel">
            <option value="" selected disabled>Please select</option>
            <?php 
                $sql = mysqli_query($conn, "SELECT a.ac_id as aid, a.NATO_name as nn, a.Designation as ad, m.name as m_name FROM Aircraft as a JOIN Manufact as m USING(m_id)") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['aid'].'">';
                    echo $row['m_name'].' '.$row['ad'].' '.$row['nn'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
    </tr>

    <tr>
        <td> Select Engine:</td>
        <td>
            <select name="esel">
            <option value="" selected disabled>Please select</option>
            <?php 
                $sql = mysqli_query($conn, "SELECT e.e_id as eid, e.name as e_name, m.name as m_name FROM Engine as e JOIN Manufact as m USING(m_id)") or die(mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['eid'].'">';
                    echo $row['m_name'].' '.$row['e_name'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
        <td>Number of Engines:</td>
        <td>
            <input type="number" name="e_qty" style="width: 150px; padding: 1px">
        </td>
    </tr>
    </tbody>
  </table>
  <button type="submit" class="btn btn-block btn-success btn-large">Modify Aircraft with Engine</button>
</div>
</form>
<br />


<!-- ++++++++++++++++++++++++++++++++++++ ADD ARMENT TO AIRCRAFT SECTION +++++++++++++++++++++++++++++++++++++++++ --!>
<form action="add_artoa.php" method="POST">
<div class="form-group" style="width:98%">
  <h1>Add Armament to Aircraft</h1>
  <table class='table'>
    <tbody>
    <tr>
        <td> Select Aircraft:</td>
        <td>
            <select name="ac_ar_sel">
            <option value="" selected disabled>Please select</option>
            <?php 
                $sql = mysqli_query($conn, "SELECT a.ac_id as aid, a.NATO_name as nn, a.Designation as ad, m.name as m_name FROM Aircraft as a JOIN Manufact as m USING(m_id)") or die (mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['aid'].'">';
                    echo $row['m_name'].' '.$row['ad'].' '.$row['nn'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
    </tr>

    <tr>
        <td> Select Armament:</td>
        <td>
            <select name="arsel">
            <option value="" selected disabled>Please select</option>
            <?php 
                $sql = mysqli_query($conn, "SELECT arm_id as arid, name as arname FROM Armament") or die (mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['arid'].'">';
                    echo $row['arname'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
        <td>Number of Armaments:</td>
        <td>
            <input type="number" name="ar_qty" style="width: 150px; padding: 1px">
        </td>
    </tr>
    </tbody>
  </table>
  <button type="submit" class="btn btn-block btn-success btn-large">Modify Aircraft with Armament</button>
</div>
</form>
<br />
<br />

<!-- ++++++++++++++++++++++++++++++++++++ ADD AIRCRAFT TO COUNTRY SECTION +++++++++++++++++++++++++++++++++++++++++ --!>
<form action="add_atoc.php" method="POST">
<div class="form-group" style="width:98%">
  <h1>Add Aircraft to Country of Use</h1>
  <table class='table'>
    <tbody>
    <tr>
        <td> Select Aircraft:</td>
        <td>
            <select name="ac_c_sel">
            <option value="" selected disabled>Please select</option>
            <?php 
                $sql = mysqli_query($conn, "SELECT a.ac_id as aid, a.NATO_name as nn, a.Designation as ad, m.name as m_name FROM Aircraft as a JOIN Manufact as m USING(m_id)") or die (mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['aid'].'">';
                    echo $row['m_name'].' '.$row['ad'].' '.$row['nn'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
    </tr>

    <tr>
        <td> Select Country:</td>
        <td>
            <select name="csel">
            <option value="" selected disabled>Please select</option>
            <?php 
                $sql = mysqli_query($conn, "SELECT c_id, name FROM Country") or die (mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['c_id'].'">';
                    echo $row['name'];
                    echo"</option>";
                }
            ?>
            </select>
        </td>
    </tr>
    </tbody>
  </table>
  <button type="submit" class="btn btn-block btn-success btn-large">Add to Country</button>
</div>
</form>
<br />
<br />

<!-- ++++++++++++++++++++++++++++++++++ UPLOAD IMAGE ++++++++++++++++++++++++++++++++++++ --!>
<h2>Upload an Image to an Aircraft</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
            <select name="a_i_sel">
            <option value="" selected disabled>Please Select An Aircraft</option>
            <?php 
                $sql = mysqli_query($conn, "SELECT a.ac_id as aid, a.NATO_name as nn, a.Designation as ad, m.name as m_name FROM Aircraft as a JOIN Manufact as m USING(m_id)") or die (mysqli_error($conn));
                while ($row = mysqli_fetch_array($sql)){
                    echo '<option value="'.$row['aid'].'">';
                    echo $row['m_name'].' '.$row['ad'].' '.$row['nn'];
                    echo"</option>";
                }
            ?>
            </select>
            <br />
    Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
</form>
<br />
<br />

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>


