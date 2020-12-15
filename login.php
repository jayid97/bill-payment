<?php
include "connect.php";
session_start();
$sql="SELECT * FROM customer ";
 $result=mysqli_query($conn,$sql);


    if(isset($_POST['signup']))
    {
        $sql = "INSERT INTO customer (username,ic,pass)
        VALUES (".$_POST["username"]."','".$_POST["ic"]."','".$_POST["pass"]."')";
    }
    $sql = "INSERT INTO customer (username,ic,pass)
        VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis" ,  $_POST['username'], 
          $_POST['ic'],$_POST['pass']);
        
    if($stmt->execute())
    {
    ?> <script>alert("Successful Register")
    window.location.href="login.php";
    </script>
    <?php
   {
    echo "Unable to add".$conn->error;
    }
    }

    if(isset($_POST['login']))
    {
      $username = $_POST['username'];
      $pass = $_POST['pass'];

      $_SESSION['username'] = $username;

      $sql = "SELECT * FROM customer where username = '$username' and pass='$pass'";
       $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)!=0)
  {
echo "<script>alert('Login successful');</script>";
header("Location:home.php");
  }
  else
echo "<script>alert('Invalid username or password');</script>";
    }

?>
<title>Login</title>
<link style="stylesheet" type="text/css" href="login.css">
<style>
body
{
	background: #246BB2;
    color:#f0f6f6;
    font-size: 18px;
	margin: 0px;
	padding: 0px;

}

input[type=text] {
  width: 40%;
  padding: 10px 10px;
  margin: 8px 0;
  box-sizing: border-box;
   border: 2px solid black;
  border-radius: 4px;
}

input[type=password] {
  width: 40%;
   padding: 10px 10px;
  margin: 8px 0;
  box-sizing: border-box;
    border: 2px solid black;
  border-radius: 4px;
}

input[name=ic] {
 margin-left: 56px;
}

input[type=submit]
{
	background-color: #d4180b; 
  border: none;
  color: white;
  padding: 12px 50px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

input[name=cancel]
{
	background-color: #30b360; 
}
input[name=login]
{
	margin-top: 10px;
	margin-left: 90px;
}

input[name=signup]
{
	margin-left: 90px;
}

input[type=checkbox]
{
	margin-left: 90px;
}
</style>
<body>

<div class="signup" style="width: 45%; height: 100%; border: solid black 2px; float:left; padding: 10px;">
<div style="border: solid black 2px; padding: 10px; text-align: center;">
<h2>Sign Up</h2>
</div>
<div style="border: solid black 2px; padding: 10px;">
	<div style="margin-left: 30px">
	<h3>Please Fill the Form to Continue </h3>
	<form method="POST" action="login.php">
Username : <input type="text" name="username"><br><br>
Ic : <input type="text" name="ic"><br><br>
Password : <input type="password" name="pass" id="myInput"><br><br>
<input type="checkbox" onclick="myFunction()">Show Password <br><br>
<input type="submit" name="signup" value="Submit"><input type="submit" name="cancel" value="Cancel">
</form>
<br><br><br>
</div>
</div>
</div>

<div class="login" style="width: 45%; height: 100%; border: solid black 2px; float:left; padding: 10px; ">
<div style="border: solid black 2px; text-align: center; padding: 10px;">
	<h2>Welcome to Bill Payment</h2>
</div>
<div style="border: solid black 2px; height: 48.3%; padding: 10px;">
<div style="margin-left: 30px">
<h3>Please Login to Continue</h3>
<form action="login.php" method="post">
Username : <input type="text" name="username"><br><br>
Password : <input type="password" name="pass"><br><br>
<input type="submit" name="login" value="Login"><input type="submit" name="cancel" value="Cancel"><br><br><br>
</div>
</div>
</div>

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>