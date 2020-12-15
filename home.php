<?php
include "connect.php";
session_start();
$sql = "SELECT * FROM payment";
$result = mysqli_query($conn,$sql);

if(!isset($_SESSION['username']))
 {
  die(Header("Location: login.php"));
 }

 if(isset($_POST['Store']))
    {
    	$selected_val = $_POST['desc'];
    	$selected_val = $_POST['paid_by'];
      $date = date('Y-m-d');
        $sql = "INSERT INTO payment (invoiceDate,description,accNo,amount,service_charge, plateNo, roadtax, telNo, total, discount, paid, balance ,paid_by)
        VALUES ($date,'".$_POST["desc"]."','".$_POST["acc"]."','".$_POST["amount"]."','".$_POST["service"]."','".$_POST["plate"]."','".$_POST["roadtax"]."','".$_POST["phone"]."','".$_POST["total"]."','".$_POST["discount"]."','".$_POST["paid"]."','".$_POST["balance"]."','".$_POST["paid_by"]."')";
    }
    $sql = "INSERT INTO payment (invoiceDate,description,accNo,amount,service_charge, plateNo, roadtax, telNo, total, discount, paid, balance, paid_by)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssddsdsdddds" , 
          $date,$_POST['desc'],$_POST['acc'],$_POST['amount'],  $_POST['service'],  $_POST['plate'], $_POST['roadtax'], $_POST['phone'],  $_POST['total'],  $_POST['discount'],  $_POST['paid'],  $_POST['balance'],$_POST['paid_by']);
        
    if($stmt->execute())
    {
      $_SESSION["last_id"] = $conn->insert_id;
    ?> <script>alert("Successful Register")
    window.open("view.php");
    </script>
    <?php
    }
?>
<!DOCTYPE html>
<html>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,800);
body
{
	background-color: #246BB2;
    color:#f0f6f6;
	margin: 0px;
	padding: 0px;
	font-size: 20px;
	font-family: "Lucida Console", Courier, monospace;
}

h1{
  font-family:'Open Sans',Arial,Helvetica,sans-serif;
  font-size:32px;
  color:#FFFFFF;
  position: center;
  top:0px;
  margin-top: 50px;
}
</style>
<head>
	<title>Invoice</title>
</head>

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
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="data.php">Receipt List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="calculator.php">Calculator</a>
      </li>
    </ul>
  </div>

  
</nav>

<div class="container">
<form action="" method="post" class="well form-horizontal" id="form">
<fieldset>
<!-- Form Name -->

<!-- header -->
<legend><center><h2 class="display-3 mt-5"><b>Invoice Form</b></h2></center></legend><br>


<!-- Description -->
<div class="form-group row">
<label class="col-2 col-form-label">Description</label>
<div class="col-10">
<select class="form-control" name="desc" id="desc" onclick="formpop()">
	<option value=""></option>
	<option value="Astro">Astro</option>
	<option value="SADA">SADA</option>
	<option value="TNB">TNB</option>
	<option value="TM">TM</option>
	<option value="Celcom">Celcom</option>
	<option value="Digi">Digi</option>
	<option value="Redone">Redone</option>
	<option value="Maxis">Maxis</option>
	<option value="UMobile">UMobile</option>
	<option value="Photostat">Photostat</option>
	<option value="Print">Print</option>
  <option value="Insurance">Insurance</option>
</select> 
</div>
</div>

<!-- Acc No -->
<div class="form-group row">
  <label class="col-2 col-form-label">Acc No </label>
  <div class="col-10">
  <input class="form-control" type="text" name="acc" id="acc" maxlength="13">
  </div>
</div>

<!-- Amount -->
<div class="form-group row">
	<label class="col-2 col-form-label">Amount</label>
	<div class="col-10">
	<input class="form-control" type="text" name="amount" id="amount" onkeyup="cal()" required>
	</div>
</div>

<!-- Service Charge -->
<div class="form-group row">
	<label class="col-2 col-form-label">Service Charge</label>
    <div class="col-10"> 
	<input class="form-control" type="text" name="service" id="service" onkeyup="cal()" required>
	</div>
</div>

<div id="ins">
<!-- Plate No -->
<div class="form-group row">
  <label class="col-2 col-form-label">Plate No</label>
    <div class="col-10"> 
  <input class="form-control" type="text" name="plate" id="plate">
  </div>
</div>

<!-- Roadtax -->
<div class="form-group row">
  <label class="col-2 col-form-label">Roadtax</label>
    <div class="col-10"> 
  <input class="form-control" type="text" name="roadtax" onkeyup="cal()" id="roadtax">
  </div>
</div>

<!-- Telephone No -->
<div class="form-group row">
  <label class="col-2 col-form-label">Tel No</label>
    <div class="col-10"> 
  <input class="form-control" type="text" name="phone" id="phone">
  </div>
</div>

</div>

<!-- Discount -->
<div class="form-group row">
  <label class="col-2 col-form-label">Discount</label>
  <div class="col-10">
  <input class="form-control" type="text" name="discount" onkeyup="cal()" id="discount">
  </div>  
</div>

<!-- Total Amount -->
<div class="form-group row">
	<label class="col-2 col-form-label">Total Amount</label>
	<div class="col-10">
	<input class="form-control" type="text" name="total" onkeyup="cal()" id="total" readonly>
	</div>	
</div>



<!-- Paid -->
<div class="form-group row">
	<label class="col-2 col-form-label">Paid</label>
	<div class="col-10">
	<input class="form-control" type="text" name="paid" onkeyup="cal()" id="paid" required>
	</div>	
</div>

<!-- Balance -->
<div class="form-group row">
	<label class="col-2 col-form-label">Balance</label>
	<div class="col-10">
	<input class="form-control" type="text" name="balance" id="balance" readonly>
	</div>	
</div>


<!-- Paid By -->
<div class="form-group row">
	<label class="col-2 col-form-label">Paid By</label>
	<div class="col-10">
	<select name="paid_by" class="form-control">
	<option value=""></option>
	<option value="cash">cash</option>
	<option value="credit card">credit card</option>
</select>
</div>	
</div>

<input type="submit" class="btn btn-danger" name="Store" value="Register">
</form>
</fieldset>
</div>
</div>
</div>
</body>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
<script>
	function cal()
	{
		var amounts = document.getElementById("amount").value;
		var services = document.getElementById("service").value;
		var discount = document.getElementById("discount").value;
    var roadtax = document.getElementById("roadtax").value;
		var paid = document.getElementById("paid").value;

  if(amounts == 0 && discount == 0)
    {
    var total = parseFloat(services)+parseFloat(roadtax);
    document.getElementById("total").value = total.toFixed(2);
    }
  else if(roadtax == 0 && discount == 0)
    {
      var total = parseFloat(amounts)+parseFloat(services);
    document.getElementById("total").value = total.toFixed(2);
    }
   else if (discount == 0) {
      var total = parseFloat(amounts)+parseFloat(services)+parseFloat(roadtax);
    document.getElementById("total").value = total.toFixed(2);
   }

    else if(roadtax == 0)
    {
    var total = parseFloat(amounts)+parseFloat(services)-parseFloat(discount);
    document.getElementById("total").value = total.toFixed(2);
    }
    else
    {
     var total = parseFloat(amounts)+parseFloat(services)-parseFloat(discount)+parseFloat(roadtax);
    document.getElementById("total").value = total.toFixed(2);
    }
    
    

		var balance = parseFloat(paid)- parseFloat(total)
		document.getElementById("balance").value = balance.toFixed(2);

	}

  function formpop()
  {
    var e = document.getElementById("desc");
    var strUser = e.options[e.selectedIndex].value;

    if(strUser == "Insurance")
    {
     document.getElementById("ins").style.display = 'block';
    }
    else
    {
     document.getElementById("ins").style.display = 'none';
    }
  }


</script>


</html>