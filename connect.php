<?php
$conn=mysqli_connect("localhost","root","","bill");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>