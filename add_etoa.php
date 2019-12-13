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
  
    $ac = $_POST['acsel'];
    $eng = $_POST['esel'];
    $count = $_POST['e_qty'];

    //$name = mysqli_real_escape_string($conn, $name);
    //$power = mysqli_real_escape_string($conn, $power);
// this is a small attempt to avoid SQL injection
// better to use prepared statements
    $query = "INSERT INTO Aircraft_has_Engine(ac_id, e_id, engine_count) VALUES($ac, $eng, $count)";
    echo $query;
    $result= mysqli_query($conn, $query) or die (mysqli_error($conn));
    mysqli_free_result($result);
?>

    <p>
        Just added engine to aircraft!
    <p>
<hr>
<p>
This aircraft currently has the following engines:
<p>

<?php
    $query2= "SELECT e.name as en, m.name as m_name, ae.count as cnt FROM Aircraft_has_Engine as ae JOIN Engine as e USING(e_id) JOIN Manufact as m USING(m_id) WHERE ae.ac_id=$ac";
    $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result2, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[m_name]     $row[en]        $row[cnt]";
  }
print "</pre>";

mysqli_free_result($result2);

mysqli_close($conn);

?>

<p>
<hr>
<form action="https://ix.cs.uoregon.edu/~bergsttr/db/add_link.php">
    <input type="submit" value="Go Back" />
</form>
<p>
 
</body>
</html>
	  
