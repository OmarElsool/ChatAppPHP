<?php
    $conn = mysqli_connect("localhost","root","","chat");
    if(!$conn){
        echo "connection Failed" . mysqli_connect_error();
    }
?>