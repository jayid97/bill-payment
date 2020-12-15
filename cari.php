<?php
session_start();
include "connect.php";
 $sql="SELECT * FROM payment ";
 $result=mysqli_query($conn,$sql);

 if(!isset($_SESSION['username']))
 {
  die(Header("Location: login.php"));
 }

 if(isset($_POST['search']))
{
  $cari = $_POST['cari'];
  
     $search = mysqli_query($conn,"SELECT * FROM payment WHERE invoiceNo LIKE '$cari' OR invoiceDate LIKE '$cari' OR description LIKE '$cari' OR amount LIKE '$cari' OR service_charge LIKE '$cari' OR plateNo LIKE '$cari' OR roadtax LIKE '$cari' OR telNo LIKE '$cari' OR  total LIKE '$cari' OR discount LIKE '$cari' OR paid LIKE '$cari' OR balance LIKE '$cari' OR paid_by LIKE '$cari'");
  $count = mysqli_num_rows($search);
}
?>﻿

<html>
<title>Receipt List</title>
<head>
     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
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
  font-size:32px;
  color:#FFFFFF;
  position: center;
  top:0px;
  margin-top:50px;
  margin-bottom: 30px; 
}

table td,table th
{
  border: 1px solid white;
  padding: 5px;
  font-size: 20px;
}

.print
{
    background: #FF5050;
    color: #FFFFFF;
    padding: 10px;
    font-size: 15px;
    border: none;
    margin-top: 10px;

}
</style>
</head>

<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <b class="font-weight-bolder text-dark ">Bill Payment System</b>
   <form class="form-inline my-2 my-lg-0" method="POST" action="">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="cari">
      <button class="btn btn-success my-2 my-sm-0" type="submit" name="search">Search</button>
    </form>
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
      <li class="nav-item">
        <a class="nav-link " href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<center><h1>Customer Receipt</h1></center>
<?php
if(isset($_POST['search']))
{
  $cari = $_POST['cari'];
  
   $search = mysqli_query($conn,"SELECT * FROM payment WHERE invoiceNo LIKE '$cari' OR invoiceDate LIKE '$cari' OR description LIKE '$cari' OR amount LIKE '$cari' OR service_charge LIKE '$cari' OR plateNo LIKE '$cari' OR roadtax LIKE '$cari' OR telNo LIKE '$cari' OR  total LIKE '$cari' OR discount LIKE '$cari' OR paid LIKE '$cari' OR balance LIKE '$cari' OR paid_by LIKE '$cari'");
  $count = mysqli_num_rows($search);
  if($count == 0)
  {
    echo "'<h2>'Not Found'</h2>'";
  }
  else
  {
    ?>
<center><table>
<tr>
<th>Invoice No</th><th>Date</th><th>Description</th><th>Amount</th><th>Service Charge</th><th>Plate No</th><th>Roadtax</th><th>Phone No</th><th>Total Amount</th><th>Discount</th><th>Paid</th><th>Balance</th>
<th>Paid By</th><th></th>
</tr>
<?php
 $count =1;
    while($row=mysqli_fetch_array($search))
        
    {
?>    
<tr>
<td><?php
     echo $row['invoiceNo'];
?></td>
<td>
<?php
     echo $row['invoiceDate'];
?>
    </td>
<td>
<?php
     echo $row['description'];
?>
    </td>
<td>
<?php
     echo $row['amount'];
?>
    </td>    
<td>
<?php
     echo $row['service_charge'];
?>
    </td>
    <td>
<?php
     echo $row['plateNo'];
?>
    </td>
    <td>
<?php
     echo $row['roadtax'];
?>
    </td>
    <td>
<?php
     echo $row['telNo'];
?>
    </td>
<td>
<?php
     echo $row['total'];
?>
    </td>
<td><?php
     echo $row['discount'];
?></td>
<td><?php
     echo $row['paid'];
?></td>
<td><?php
     echo $row['balance'];
?></td>
<td>
<?php
     echo $row['paid_by'];
?>
    </td>  
    <td>
     <form action="pdf.php" method="post">
     <input name="printid" type="hidden" value="<?php echo $row['invoiceNo'];?>"/>
    <button class="btn btn-danger" type="submit" name="print"> Print</button>
  </form>
    </td>      
</tr>
 <?php     
}
}
}
?>
</table>
</center>  
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>  
</body>    
</html>
