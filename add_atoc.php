<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Adding to Country</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
    $ac = $_POST['ac_c_sel'];
    $country = $_POST['csel'];

    $ac = mysqli_real_escape_string($conn, $ac);
    $country = mysqli_real_escape_string($conn, $country);
// this is a small attempt to avoid SQL injection
// better to use prepared statements
    $query = "INSERT INTO Aircraft_Used_By_Country (ac_id, c_id) VALUES ($ac, $country)";
    $result= mysqli_query($conn, $query) or die (mysqli_error($conn));
    mysqli_free_result($result);
?>

<hr>

<?php
    $cquery= ("SELECT name from Country WHERE c_id=$country");
    $cres = mysqli_query($conn, $cquery) or die(mysqli_error($conn));
    $crow = mysqli_fetch_array($cres, MYSQLI_BOTH);

    $query2= "SELECT c.name as cname, a.Designation as des, a.NATO_name as nn, m.name as mname FROM Aircraft as a JOIN Aircraft_Used_By_Country as auc USING(ac_id) JOIN Manufact as m USING(m_id) JOIN Country as c ON auc.c_id = c.c_id WHERE c.c_id = $country"; 
    $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

print "Aircraft Used By $crow[name]:";
print "<pre>";
while($row = mysqli_fetch_array($result2, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[mname]  $row[des]   $row[nn]";
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
	  
