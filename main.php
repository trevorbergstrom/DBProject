
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
        <h1 class="mt-5">A Database of Aircraft</h1>
        <p class="lead">It's kinda cool for nerds</p>
        <ul class="list-unstyled">
          <li>View Aircraft</li>
          <!--Carousel Wrapper-->
          <div id="carousel-example-2" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel">
            <!--Indicators-->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-2" data-slide-to="1"></li>
              <li data-target="#carousel-example-2" data-slide-to="2"></li>
            </ol>
            <!--/.Indicators-->
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <div class="view">
                  <img class="d-block w-100" src="img/b17.jpg" alt="First slide">
                  <div class="mask rgba-black-light"></div>
                </div>
                <div class="carousel-caption">
                  <h3 class="h3-responsive">This is the first title</h3>
                  <p>First text</p>
                </div>
              </div>
              <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                  <img class="d-block w-100" src="img/ju88.jpg" alt="Second slide">
                  <div class="mask rgba-black-light"></div>
                </div>
                <div class="carousel-caption">
                  <h3 class="h3-responsive">Thir is the second title</h3>
                  <p>Secondary text</p>
                </div>
              </div>
              <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                  <img class="d-block w-100" src="img/p38.jpg" alt="Third slide">
                  <div class="mask rgba-black-light"></div>
                </div>
                <div class="carousel-caption">
                  <h3 class="h3-responsive">This is the third title</h3>
                  <p>Third text</p>
                </div>
              </div>
            </div>
            <!--/.Slides-->
            <!--Controls-->
            <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
            <!--/.Controls-->
          </div>
          <!--/.Carousel Wrapper-->
          <li>Add Aircraft</li>
        </ul>

        <!-- Example split danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-danger">View By Country</button>
  <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <button type="button" class="btn btn-primary">View My Manufacturer</button>
  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">Separated link</a>
  </div>
</div>

<select name="owner">
<?php 
$sql = mysqli_query($conn, "SELECT name FROM Country") or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($sql)){
    
echo '<option value="'.$row['name'].'">';
echo $row['name'];
echo"</option>";
}
?>
</select>

      </div>
    </div>
  </div>
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
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>


