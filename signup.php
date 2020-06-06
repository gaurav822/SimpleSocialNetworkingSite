<?php

$db=mysqli_connect('localhost','root','','internship');
session_start();
if (isset($_POST['signup'])){
  

    $stmt = $db->prepare("SELECT * FROM userdetails WHERE username = ?");

    $stmt->bind_param("s", $_POST['username']);

    $result = $stmt->execute();
    $stmt->store_result(); 

   if ($stmt->num_rows > 0) { 

    
          echo "<SCRIPT> alert('Username already taken, try anothername')
        window.location.replace('index.html');
       </SCRIPT>";
   }


    else{

      $_SESSION['username'] = $_POST['username'];

      $password=md5($_POST['password']);

      $stmt = $db->prepare("INSERT INTO userdetails (username,password) VALUES (?, ?)");
     $stmt->bind_param("ss", $_POST['username'], $password);
     $stmt->execute();
     $stmt->close();

    if($stmt){

   
  echo "<SCRIPT> alert('Registered Sucessfully!')
        window.location.replace('homepage.php');
    </SCRIPT>";

      }

    }

}

if (isset($_POST['signin'])){

$password = md5($_POST['password']);

$stmt = $db->prepare("SELECT * FROM userdetails WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $_POST['username'], $password);
$stmt->execute();
 $stmt->store_result(); 
if ($stmt->num_rows ==1 ) { 

  $_SESSION['username'] = $_POST['username'];
  header("Location: homepage.php");
}
else
{
$message='Invalid email or password';
  echo "<SCRIPT> //not showing me this
        alert('$message')
        window.location.replace('index.html');
    </SCRIPT>";
}
}


?>