
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
  
  <style>
    .carousel-inner > .item {
        width:600px;
        height:600px;
    }
  </style>

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
            <a class="nav-link" href="add_link.php">Add Links to Aircraft</a>
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

<div class="container">
  <div class="row">
    <div class="col-lg-12 text-center">
      <h2> Results </h2>
      <table class='table'>
        <tbody>
        <?php
          $etyp = $_POST['e_typ'];
          $query= "SELECT a.ac_id as aid, m.name as mname, a.Designation as ad, a.NATO_name as nn, a.img_link as pic FROM Aircraft as a JOIN Manufact as m ON a.m_id=m.m_id JOIN Aircraft_has_Engine as ae ON ae.ac_id=a.ac_id JOIN Engine as e ON e.e_id=ae.e_id "; 
          if($etyp != "all") {
            $query= $query.' WHERE e.type="'.$etyp.'"';
          }

          $sql= mysqli_query($conn, $query) or die (mysqli_error($conn));
          
          while ($row=mysqli_fetch_array($sql)) {
              echo '<tr>';
              echo '<td>'.$row['mname'].'   '.$row['ad'].'  '.$row['nn'].'</td>';
              echo '<td>';
              echo '<form action="show_ac.php" method="POST">';
              echo '<button type="submit" name="a_id" value="'.$row['aid'].'">Details</button>';
              echo '</form>';
              echo '</td>';
              echo '</tr>';
          }
        ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
<br/>

<br/>
<br/>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>


