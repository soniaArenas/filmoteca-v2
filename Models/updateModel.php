<?php
include("../Config/dbConnection.php");

$queryDb="UPDATE films SET img='$linkImg', description='$description', director='$director', duration='$duration', genre='$genre', stars='$stars'
WHERE name='$name'";
	
	

if(mysqli_query($connect, $queryDb)){
    echo "Records were updated successfully.";
} else {
    echo "ERROR: Could not able to execute" . mysqli_error($connect);
}
 
?>