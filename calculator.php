<?php
include "connect.php";
session_start();
$sql = "SELECT * FROM payment";
$result = mysqli_query($conn,$sql);

if(!isset($_SESSION['username']))
 {
  die(Header("Location: login.php"));
 }
?>
<!DOCTYPE html>
<html>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<head>
	<title>Calculator</title>
</head>
<style>
body {
	background-color: #246BB2;
    color:#f0f6f6;
  margin: 0px;
  padding: 0px;
  font-size: 20px;
  font-family: "Lucida Console", Courier, monospace;
}
</style>
<body>
  <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <b class="font-weight-bolder text-dark ">Bill Payment System</b>
    <b class="font-weight-bolder  ">
  <a class="text-dark text-decoration-none" href="logout.php">Logout</a>
  </b>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="data.php">Receipt List<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="calculator.php">Calculator</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
<form action="home.php" method="post" class="well form-horizontal">
<fieldset>
<!-- Form Name -->

<!-- header -->
<legend><center><h2 class="display-3 mt-5"><b>Calculator</b></h2></center></legend><br>

<!-- Bill 1 -->
<div class="form-group row">
<label for="example-date-input" class="col-2 col-form-label">Bill 1 </label>
<div class="col-10">
<input class="form-control" type="text" name="bill1" id="bill1">
</div>
</div>

<!-- Bill 2 -->
<div class="form-group row">
	<label class="col-2 col-form-label">Bill 2</label>
	<div class="col-10">
	<input class="form-control" type="text" name="bill2" id="bill2">
	</div>
</div>

<!-- Bill 3 -->
<div class="form-group row">
	<label class="col-2 col-form-label">Bill 3</label>
    <div class="col-10"> 
	<input class="form-control" type="text" name="bill3" id="bill3">
	</div>
</div>

<!-- Bill 4 -->
<div class="form-group row">
	<label class="col-2 col-form-label">Bill 4</label>
	<div class="col-10">
	<input class="form-control" type="text" name="bill4" id="bill4">
	</div>	
</div>

<!-- Total -->
<div class="form-group row">
	<label class="col-2 col-form-label">Total</label>
	<div class="col-10">
	<input class="form-control" type="text" name="total" id="total" readonly>
	</div>	
</div>

<!-- Paid -->
<div class="form-group row">
	<label class="col-2 col-form-label">Paid</label>
	<div class="col-10">
	<input class="form-control" type="text" name="paid" id="paid">
	</div>	
</div>

<!-- Balance -->
<div class="form-group row">
	<label class="col-2 col-form-label">Balance</label>
	<div class="col-10">
	<input class="form-control" type="text" name="balance" id="balance" readonly>
	</div>	
</div>

<button type="button" class="btn btn-warning" onclick="caltotal()">Generate</button>
</form>
</fieldset>
</div>
<script>
	function caltotal()
	{
		var bill1 = document.getElementById("bill1").value;
		var bill2 = document.getElementById("bill2").value;
		var bill3 = document.getElementById("bill3").value;
		var bill4 = document.getElementById("bill4").value;
		var paid = document.getElementById("paid").value;
		var total = parseFloat(bill1)+parseFloat(bill2)+parseFloat(bill3)+parseFloat(bill4);
		document.getElementById("total").value = total;
		document.getElementById("balance").value = parseFloat(paid) - total;
	}
</script>

 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>  
</body>
</html>