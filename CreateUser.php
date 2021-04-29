<?php
$mysqli = new mysqli("mysql.eecs.ku.edu","carlosdevera","ois3Phai","carlosdevera");
$newUser = $_POST["user"];
$present = FALSE;
//echo "<p>".$newUser. "</p>";
if($mysqli->connect_errno){
     echo "<p>Connection Failed</p>";
     exit();
}

$query = "SELECT user_id FROM Users";

if ($newUser != ""){
    if($result = $mysqli->query($query)){
        while($row = $result->fetch_assoc()){
            if ($newUser == $row["user_id"]){
                $present = TRUE;
            }
        }

        $result->free();
    }
    if(!$present){
        $query = "INSERT INTO Users (user_id)
        VALUES ('$newUser')";
     
        if($mysqli->query($query) ==TRUE){
            echo "<p>Added New UserName</p>";
        }
        else{
            echo "<p>New User Name not added</p>";
        }
     }
}
else{
    echo "<p>Cannot have a blank username</p><br>";
}

$mysqli->close();

?>