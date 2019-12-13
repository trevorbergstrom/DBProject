<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Adding an Engine</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
    $ac = $_POST['ac_ar_sel'];
    $arm = $_POST['arsel'];
    $count = $_POST['ar_qty'];

    //$name = mysqli_real_escape_string($conn, $name);
    //$power = mysqli_real_escape_string($conn, $power);
// this is a small attempt to avoid SQL injection
// better to use prepared statements
    $query = "INSERT INTO Aircraft_has_Armament (ac_id, arm_id, count) VALUES ($ac, $arm, $count)";
    $result= mysqli_query($conn, $query) or die (mysqli_error($conn));
    mysqli_free_result($result);
?>

    <p>
        Just added armament to aircraft!
    <p>
<hr>
<p>
This aircraft currently has the following armament:
<p>

<?php
    $query2= "SELECT ar.name as arn, aha.count as cnt FROM Aircraft_has_Armament as aha JOIN Armament as ar USING(arm_id) WHERE aha.ac_id=$ac";
    $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result2, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[arn]        $row[cnt]";
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
	  
