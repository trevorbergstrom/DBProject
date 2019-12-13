<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
  <title>Adding Armament</title>
  </head>
  
  <body bgcolor="white">
  
  
  <hr>
  
  
<?php
  
    $name = $_POST['arname'];
    $cal = $_POST['cal'];
    $wt = $_POST['weight'];
    $type = $_POST['artyp'];

    $name = mysqli_real_escape_string($conn, $name);
    $cal = mysqli_real_escape_string($conn, $cal);
    $wt = mysqli_real_escape_string($conn, $wt);
    $type = mysqli_real_escape_string($conn, $type);
// this is a small attempt to avoid SQL injection
// better to use prepared statements
    $query = "INSERT INTO Armament (name, caliber, weight, type) VALUES ('$name', $cal, $wt, '$type')";
    $result= mysqli_query($conn, $query) or die (mysqli_error($conn));
    mysqli_free_result($result);
?>

    <p>
        Just added Armament:
    <p>
    <?php
        print $name;
    ?>
    <p>
        To the database!
    </p>
<hr>
<p>
Armaments currently in the database:
<p>

<?php
    $query2= "SELECT name, type FROM Armament";
    $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));

print "<pre>";
while($row = mysqli_fetch_array($result2, MYSQLI_BOTH))
  {
    print "\n";
    print "$row[name]      $row[type]";
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
	  
