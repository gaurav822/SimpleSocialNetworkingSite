<?php

session_start();

$db=mysqli_connect('localhost','root','','internship');
$username=$_SESSION['username'];


     $friends=$_GET["username"];

    $stmt2 = "DELETE FROM friendrequest WHERE username = '$friends' AND friendname = '$username'";

    if(mysqli_query($db,$stmt2)){

   
  echo "<SCRIPT> alert('Rejected Sucessfully')
        window.location.replace('friends.php');
    </SCRIPT>";

      }

?>