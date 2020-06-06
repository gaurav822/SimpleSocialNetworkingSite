<?php

session_start();
$db=mysqli_connect('localhost','root','','internship');
$username=$_SESSION['username'];

if(isset($_POST['postbtn'])){

	$stmt = $db->prepare("INSERT INTO tweets (username,message) VALUES (?, ?)");
     $stmt->bind_param("ss", $username, $_POST['message']);
     $stmt->execute();
     $stmt->close();

    if($stmt){

   
  echo "<SCRIPT> alert('Posted Sucessfully!')
        window.location.replace('homepage.php');
    </SCRIPT>";

      }
}

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  top: 0;
  width: 100%;

}

.topnav a {
   float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

.topnav-right {
  float: right;
}

h2 {
  position: absolute;
  right: 200px;
  top: 100px;
}



textarea {
	position: absolute;
  width: 20%;
  height: 20%;
  margin: 0; /* don't want to add to container size */
  border: 0;
  right:115px;
  top:170px; /* don't want to add to container size */
}
#postbtn {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  position: absolute;
  top:320px;
  right: 310px;
}

.main {
  padding: 16px;
  margin-top: 30px;
  height: 1500px;
  /* Used in this example to enable scrolling */
}

</style>
</head>
<body style="background-color:powderblue;">

<div class="topnav">
  <a class="active" href="homepage.php"><?php echo "$username"; ?></a>
  <div class="topnav-right">
    <a href="friends.php">Friends</a>
    <a href="index.html">Logout</a>
  </div>
</div>

<div class="main">

<h2>Post a new update</h2>

<form method="post" id="postform">
  <textarea name="message" id="message" rows="30" cols="30" placeholder="Type your status update here.." maxlength="200"></textarea>
  <br><br>
  <button type="submit" name="postbtn" id="postbtn">Post</button>
</form>

<h3 style="position:absolute;top:50px;left:50px">Updates</h3>

<?php
$sql = "SELECT username, message FROM tweets order by timeadded DESC LIMIT 20";
$result = $db->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo nl2br("<br><div style='font-size:1.25em;color:#008000;position:absolute;left:50px'>Update from ". $row["username"]. "</div>\n<div style='position:absolute;left:50px'>" . $row["message"] . "</div><br>");
    }
} else {
    echo "0 results";
}

$db->close();
?>


</div>

</body>
</html>
