
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
  .img-fluid {
        max-width: 80%;
        height: auto;
        border: solid black;
        border-radius: 5px;
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
    <?php
        $aid = $_POST['a_id'];
 
        $sql_1= mysqli_query($conn, "SELECT a.Designation, a.NATO_name, m.name, a.img_link as pic FROM Aircraft as a JOIN Manufact as m USING(m_id) WHERE ac_id=$aid") or die(mysqli_error($conn));
        $row_1= mysqli_fetch_array($sql_1);

        echo '<h1>'.$row_1['name'].' - '.$row_1['Designation'].' '.$row_1['NATO_name'].'</h1>';
        echo '<img src="'.$row_1['pic'].'" class="img-fluid" alt="Responsive image"> <br/>'; 
        
        $sql_2= mysqli_query($conn, "SELECT service_celing as sc, max_speed as ms, crew_count as cc, date_enter_service as des, `range` as r, cruise_speed as cs, mission_id as misid, origin_c_id as ocid from Aircraft WHERE ac_id=$aid") or die(mysqli_error($conn));
        $row2= mysqli_fetch_array($sql_2);

        $ceiling = $row2['sc'];
        $max_spd = $row2['ms'];
        $crew = $row2['cc'];
        $range = $row2['r'];
        $cruise_spd = $row2['cs'];
        $date = $row2['des'];

        $msid = $row2['misid'];

        $get_miss= mysqli_query($conn, "SELECT name from Mission_designation WHERE mission_id =$msid") or die(mysqli_error($conn));
        $got_miss= mysqli_fetch_array($get_miss);

        
        $coid = $row2['ocid'];

        $get_co= mysqli_query($conn, "SELECT name from Country WHERE c_id =$coid") or die(mysqli_error($conn));
        $got_co= mysqli_fetch_array($get_co);

        $mission = $got_miss['name'];
        $coo = $got_co['name'];
    ?>
    </div>

    <br />
    <div class="col-lg-12 text-left"> 
    <table class='table>'>
      <tbody>
      <?php
        echo '<h2> Specifications: </h2>';
        echo '<tr>';
        echo '<td>Crew Count:</td>';
        echo '<td>'.$crew.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Mission Designation:</td>';
        echo '<td>'.$mission.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Country of Origin:</td>';
        echo '<td>'.$coo.'</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Date of Service Entry:</td>';
        echo '<td>'.$date.'</td>';
        echo '</tr>';
      ?>
    </tbody>
    </table>
    </div>
    <br/>
    <br/>
    <br/>
    
    <div class="col-lg-12 text-left"> 
    <table class='table>'>
      <tbody>
        <?php
            $get_eng= mysqli_query($conn, "SELECT ae.engine_count as cnt, e.name as ename, e.output_power as pwr, m.name as mn from Engine as e JOIN Manufact as m USING(m_id) JOIN Aircraft_has_Engine as ae USING(e_id) WHERE ac_id =$aid") or die(mysqli_error($conn));
            $got_eng= mysqli_fetch_array($get_eng);
        
            echo '<h2>Engine Specifications:</h2>';
            
            echo '<tr>';
            echo '<td>Engine Manufacturer:</td>';
            echo '<td>'.$got_eng['mn'].'</td>';
            echo '</tr>';
            
            echo '<tr>';
            echo '<td>Engine(s):</td>';
            echo '<td>'.$got_eng['ename'].'</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Engine Count:</td>';
            echo '<td>'.$got_eng['cnt'].'</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Output Power (each):</td>';
            echo '<td>'.$got_eng['pwr'].' (hp)</td>';
            echo '</tr>';

        ?>
    </tbody>
    </table>
    </div>
    <br/>
    <br/>
    <br/>


    <div class="col-lg-12 text-left"> 
    <table class='table>'>
      <tbody>
      <?php

        
        echo '<h2> Performance: </h2>';
        echo '<tr>';
        echo '<td>Max Speed:</td>';
        echo '<td>'.$max_spd.' (mph)</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Cruise Speed:</td>';
        echo '<td>'.$cruise_spd.' (mph)</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Range:</td>';
        echo '<td>'.$range.' (mi)</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Service Ceiling:</td>';
        echo '<td>'.$ceiling.' (ft)</td>';
        echo '</tr>';
      ?>
    </tbody>
    </table>
    </div>

<br/>

<br/>
<br/>
    
    <div class="col-lg-12 text-left"> 
    <table class='table>'>
      <tbody>
        <?php
            $get_arm= mysqli_query($conn, "SELECT ar.caliber as ca, ar.weight as wt, ar.name as nn, ar.type as typ FROM Armament as ar JOIN Aircraft_has_Armament USING(arm_id) WHERE ac_id =$aid") or die(mysqli_error($conn));

            
            echo '<h2>Armament Specifications:</h2>';
            
            while($got_arm= mysqli_fetch_array($get_arm)) {
                
                $art= $got_arm['typ'];
                echo '<tr>';
                echo '<td>Name:</td>';
                echo '<td>'.$got_arm['nn'].'</td>';
                echo '</tr>';
            
                echo '<tr>';
                echo '<td>Type:</td>';
                echo '<td>'.$art.'</td>';
                echo '</tr>';

                if($art == 'Gun' || $art == 'Cannon') {
                    echo '<tr>';
                    echo '<td>Caliber:</td>';
                    echo '<td>'.$got_arm['ca'].'(mm) </td>';
                    echo '</tr>';
                } else {

                    echo '<tr>';
                    echo '<td>Bomb Capacity:</td>';
                    echo '<td>'.$got_arm['wt'].' (kg)</td>';
                    echo '</tr>';
                }
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


