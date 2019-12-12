
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
            <a class="nav-link" href="#">Home
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
            <a class="nav-link" href="links.php">Really Cool Stuff</a>
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
        <h1 class="mt-5">Search The Database</h1>
        <p class="lead">Select your search terms from the drop downs below</p>
        <ul class="list-unstyled">
          <li>View Aircraft</li>
        </ul>

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Search by Manufacturer
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <?php
                    $sql=mysqli_query($conn, "SELECT name FROM Manufact") or die(mysqli_error($conn));
                    while($row = mysqli_fetch_array($sql)){
                        echo '<li><a href="#">'.$row['name'].'</a></li>';
                    }
                ?>
            </ul>
        </div>

        <br />

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Search by Engine Type
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <?php
                    $sql=mysqli_query($conn, "SELECT DISTINCT type FROM Engine") or die(mysqli_error($conn));
                    while($row = mysqli_fetch_array($sql)){
                        echo '<li><a href="#">'.$row['type'].'</a></li>';
                    }
                ?>
            </ul>
        </div>

        <br />

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Search by Country Used By
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <?php
                    $sql=mysqli_query($conn, "SELECT DISTINCT c.name FROM Aircraft_Used_By_Country JOIN Aircraft USING(ac_id) JOIN Country as c USING(c_id)") or die(mysqli_error($conn));
                    while($row = mysqli_fetch_array($sql)){
                        echo '<li><a href="#">'.$row['name'].'</a></li>';
                    }
                ?>
            </ul>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>


