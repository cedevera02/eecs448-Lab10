<?php
$mysqli = new mysqli("mysql.eecs.ku.edu","carlosdevera","ois3Phai","carlosdevera");
if($mysqli->connect_errno){
    echo "<p>Connection Failed</p>";
    exit();
}
$checks = $_POST["posts"];
$id = 0;

if(!empty($checks)){
    foreach($_POST["posts"] as $value){
        $query = "SELECT post_id FROM Posts WHERE content=\"".$value."\"";
        if($result = $mysqli->query($query)){
            while($row = $result->fetch_assoc()){
                $id = $row["post_id"];  
                //echo "<p>Deleted post: ".$id."</p><br>";  
            }
            $result->free();
        }
        echo "<p>Working on: ".$id."</p><br>";
        $query = "DELETE FROM Posts WHERE post_id=\"".$id."\"";
        if($result = $mysqli->query($query)){
             echo "<p>Deleted post: ".$id."</p><br>";
             //$result->free();
        }
    }
}

$mysqli->close();

?>