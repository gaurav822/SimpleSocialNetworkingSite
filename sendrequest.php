<?php

session_start();

$db=mysqli_connect('localhost','root','','internship');
     $username=$_SESSION['username'];

    $stmt = $db->prepare("SELECT * FROM friendrequest WHERE username = ? AND friendname = ?");
     $stmt->bind_param("ss",$username,$_GET['username']);
     $result = $stmt->execute();
     
    $stmt->store_result(); 


    $stmt2 = $db->prepare("SELECT * FROM friends WHERE username = ? AND friend = ?");
     $stmt2->bind_param("ss",$_GET['username'],$username);
     $result2 = $stmt2->execute();
     
    $stmt2->store_result(); 


    if ($stmt2->num_rows > 0) { 

    
          echo "<SCRIPT> alert('Already friends!')
        window.location.replace('friends.php');
       </SCRIPT>";
   }



   elseif ($stmt->num_rows > 0) { 

    
          echo "<SCRIPT> alert('Already Requested')
        window.location.replace('friends.php');
       </SCRIPT>";
   }

   else{

    $stmt = $db->prepare("INSERT INTO friendrequest (username,friendname) VALUES (?, ?)");
     $stmt->bind_param("ss", $username, $_GET['username']);
     $stmt->execute();
     $stmt->close();

    if($stmt){

   
  echo "<SCRIPT> alert('Requested Sucessfully')
        window.location.replace('friends.php');
    </SCRIPT>";

      }

    }


?>