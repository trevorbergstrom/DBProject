<?php

    include('connectionData.txt');

    $conn = mysqli_connect($server, $user, $pass, $dbname, $port) or die ('Error connecting to MYSQL server');
?>

<html>
<head>
    <title>Uploading an Image...</title>
</head>

<body bgcolor="white">

<hr>

<?php
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $ac_id = $_POST['a_i_sel'];
    echo $ac_id;
    $query="UPDATE Aircraft SET img_link = '$target_file' WHERE ac_id = $ac_id";
    //$query="UPDATE Aircraft SET Designation = 'P-38' WHERE ac_id = $ac_id";
    echo $query;
    if (mysqli_query($conn,$query)) {
        echo "UPDATED!";
    } else {
        echo "ERROR!";
    }
    //$result = mysql_query($conn, $query) or die (mysqli_error($conn));
    //echo $result;
    //mysqli_free_result($result);

?>

<p> Added an Image! <p>

<hr>

<p>
<form action='https://ix.cs.uoregon.edu/~bergsttr/db/add_link.php'>
    <input type="submit" value="Go Back" />
</form>
<p>

</body>
</html>

