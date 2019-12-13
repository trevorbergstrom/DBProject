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
  
    $name = $_POST['eng_name'];
    $power = $_POST['eng_pwr'];
    $man_id = $_POST['e_mid'];
    $type = $_POST['e_typ'];

    $name = mysqli_real_escape_string($conn, $name);
    $power = mysqli_real_escape_string($conn, $power);
    $man_id = mysqli_real_escape_string($conn, $man_id);
    $type = mysqli_real_escape_string($conn, $type);
// this is a small attempt to avoid SQL injection
// better to use prepared statements
    $query = "INSERT INTO Engine (name, output_power, type, m_id) VALUES ('$name', $power, '$type', $man_id)";
    $result= mysqli_query($conn, $query) or die (mysqli_error($conn));
    mysqli_free_result($result);
?>

    <p>
        Just added engine:
    <p>
    <?php
        print $name;
    ?>
    <p>
        To the database!
    </p>
<hr>
<p>
Engines currently in the database:
<p>

<?php
    $query2= "SELECT e.name as ename, m.name as mname, e.type, e.output_power FROM Engine as e JOIN Manufact as m USING(m_id)";
    $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result2, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[mname]  $row[ename]   $row[type]    $row[output_powe]";
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
	  
