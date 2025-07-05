<?php

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "Myproject1";

$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("coonection failed" . $conn->connect_error);
}


$sql = "INSERT INTO mytable1 (name,location) VALUES('shanawas','sholliganalur'),('keerthi','guindy'),('hari','erode')";

if($conn->query($sql)){
    echo "Created successfully"; 
}    

else{
    echo "Something went wrong" . $sql . "<br>" . $conn->error;
}


?>
    

