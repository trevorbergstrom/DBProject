<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Adding an Aircraft</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
    $desig = $_POST['ac_d'];
    $nato = $_POST['nato'];
    $ceiling = $_POST['sc'];
    $crew = $_POST['cc'];
    $range = $_POST['range'];
    $max_spd = $_POST['max_s'];
    $c_spd = $_POST['cruise_s'];
    $se_d = $_POST['s_date'];
    $man = $_POST['acman'];
    $miss_typ = $_POST['acmisstyp'];
    $cou = $_POST['acuse'];
    $eid = $_POST['aceng'];
    $e_qty = $_POST['e_qty'];
    $origin = $_POST['acori'];

    $desig = mysqli_real_escape_string($conn, $desig);
    $nato = mysqli_real_escape_string($conn, $nato);
    $ceiling = mysqli_real_escape_string($conn, $ceiling);
    $crew = mysqli_real_escape_string($conn, $crew);
    $range = mysqli_real_escape_string($conn, $range);
    $max_spd = mysqli_real_escape_string($conn, $max_spd);
    $c_spd = mysqli_real_escape_string($conn, $c_spd);
    $se_d = mysqli_real_escape_string($conn, $se_d);
    $man = mysqli_real_escape_string($conn, $man);
    $miss_typ = mysqli_real_escape_string($conn, $miss_typ);
    $cou = mysqli_real_escape_string($conn, $cou);
    $eid = mysqli_real_escape_string($conn, $eid);
    $e_qty = mysqli_real_escape_string($conn, $e_qty);
    $origin = mysqli_real_escape_string($conn, $origin);
// this is a small attempt to avoid SQL injection
// better to use prepared statements
    $query = "INSERT INTO Aircraft 
             (Designation, NATO_name, service_celing, max_speed, crew_count, `range`, cruise_speed, date_enter_service, m_id, mission_id, origin_c_id) 
             VALUES ('$desig', '$nato', $ceiling, $max_spd, $crew, $range, $c_spd, '$se_d', $man, $miss_typ, $origin)";
    $result= mysqli_query($conn, $query) or die (mysqli_error($conn));
    mysqli_free_result($result);

    
    $query="SELECT ac_id FROM Aircraft WHERE Designation='$desig'";
    $result= mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row= mysqli_fetch_array($result, MYSQLI_BOTH);
    $CUR_ID = $row['ac_id'];
    mysqli_free_result($result);

    $query="INSERT INTO Aircraft_has_Engine(ac_id, e_id, engine_count) VALUES($CUR_ID, $eid, $e_qty)";
    $result= mysqli_query($conn, $query) or die (mysqli_error($conn));
    mysqli_free_result($result);

?>

    <p>
        Just added Aircraft:
    <p>
    <?php
        print $desig;
        print $nato;
    ?>
    <p>
        To the database!
    </p>
<hr>
<p>
Aircraft currently in the database:
<p>

<?php
    $query2= "SELECT a.Designation as des, a.NATO_name as nname, m.name as mname FROM Aircraft as a JOIN Manufact as m USING(m_id)";
    $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result2, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[mname]  $row[des]   $row[nname]";
  }
print "</pre>";

mysqli_free_result($result2);

mysqli_close($conn);

?>

<p>
<hr>
<form action="https://ix.cs.uoregon.edu/~bergsttr/db/add_item.php">
    <input type="submit" value="Go Back" />
</form>
<p>
 
</body>
</html>
	  
