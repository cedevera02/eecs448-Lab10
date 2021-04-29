<?php
$mysqli = new mysqli("mysql.eecs.ku.edu","carlosdevera","ois3Phai","carlosdevera");
$UserN = $_POST["user"];
$content = $_POST["userpost"];
$present = FALSE;
//echo "<p>".$content. "</p><br>";
//echo "<p>".$UserN. "</p><br>";
if($mysqli->connect_errno){
     echo "<p>Connection Failed</p>";
     exit();
}



if ($UserN != ""){
    if ($content != ""){
        $query = "SELECT user_id FROM Users";
        if($result = $mysqli->query($query)){
            while($row = $result->fetch_assoc()){
                if ($UserN == $row["user_id"]){
                    $present = TRUE;
                }
            }

            $result->free();
        }

        // $query = "SELECT content, author_id FROM Posts";
        // if($result = $mysqli->query($query)){
        //     while($row = $result->fetch_assoc()){
        //         echo "<p>".$row["content"]."</p><br>";  
        //     }

        //     $result->free();
        // }

        if ($present){
            $query = "INSERT INTO Posts (content, author_id)
            VALUES ('$content', '$UserN')";
            if ($mysqli->query($query)==TRUE){
                echo "<p>Added New Post</p><br>";
            }
            else{
                echo "<p>New Post could not be added</p><br>";
            }
        }else{
            echo "<p>Not present</p><br>";
        }
    }else{
        echo "<p>Cannot have a blank post to save.</p><br>";
    }
}
else{
    echo "<p>Cannot have a blank username to create a post.</p><br>";
}

$mysqli->close();

?>