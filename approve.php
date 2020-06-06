<?php

session_start();

$db=mysqli_connect('localhost','root','','internship');
$username=$_SESSION['username'];

     $stmt1 = $db->prepare("INSERT INTO friends (username,friend) VALUES (?, ?)");
     $stmt1->bind_param("ss", $username, $_GET['username']);
     $stmt1->execute();
     $stmt1->close();

     $friends=$_GET["username"];

    $stmt2 = "DELETE FROM friendrequest WHERE username = '$friends' AND friendname = '$username'";

     $stmt3 = $db->prepare("INSERT INTO friends (username,friend) VALUES (?, ?)");
     $stmt3->bind_param("ss",$_GET['username'], $username);
     $stmt3->execute();
     $stmt3->close();

    if($stmt1 && mysqli_query($db,$stmt2) && $stmt3){

   
  echo "<SCRIPT> alert('Accepted Sucessfully')
        window.location.replace('friends.php');
    </SCRIPT>";

      }

?>