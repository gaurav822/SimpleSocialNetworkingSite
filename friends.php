<?php

include_once "navbar.php";
$db=mysqli_connect('localhost','root','','internship');
$username=$_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>friendspage</title>

<style>
body {
margin: 0;
font-family: Arial, Helvetica, sans-serif;
}

		
</style>


</head>
<body>

<h3 style="position: absolute;right: 200px;top: 50px;color:#008000;">All Users</h3>

<h3 style="text-align: center;color:#008000;">Friends</h3>

<?php
$sql = "SELECT friend FROM friends where username='".$username."'";
$result = $db->query($sql);

    while($row = $result->fetch_assoc()) { ?>
       <?php echo "<br>"; echo ("<br><div style='font-size:1.25em;text-align:center'>". $row["friend"]. "</div><br>"); ?>
 <?php } ?>


<h3 style="position:absolute;top:50px;left:50px;color:#008000">Friends Requests</h3>

<?php
$sql = "SELECT username FROM friendrequest where friendname='".$username."'";
$result = $db->query($sql);

    while($row = $result->fetch_assoc()) { ?>
       <?php echo "<br>"; echo ("<br><div style='font-size:1.25em;position:absolute;left:50px'>". $row["username"]. "</div><br>"); ?>
       <a href="approve.php?username=<?php echo $row["username"]; ?>" style="position: absolute;left: 100px">YES</a>
       <a href="decline.php?username=<?php echo $row["username"]; ?>" style="position: absolute;left: 150px">NO</a>
 <?php } ?>



<?php
$sql = "SELECT username FROM userdetails where username!='$username'";
$result = $db->query($sql);

    while($row = $result->fetch_assoc()) { ?>
       <?php echo "<br>"; echo ("<br><div style='font-size:1.25em;position:absolute;right:200px'>". $row["username"]. "</div><br>"); ?>
       <a href="sendrequest.php?username=<?php echo $row["username"]; ?>" style="position: absolute;right: 80px">Send Request</a>
 <?php } ?>


 

</body>
</html>

