<?php
session_start();
include "connect.php";
 $sql="SELECT * FROM payment ";
 $result=mysqli_query($conn,$sql);

 if(!isset($_SESSION['username']))
 {
  die(Header("Location: login.php"));
 }

  if(isset($_POST['delete']))
{
  $delete = $_POST['deleteid'];
$sql="DELETE  FROM payment WHERE  invoiceNo='$delete'";

 if($conn->query($sql)===TRUE)
 {
  ?><script>alert("Successful Delete")
        window.location.href="data.php";
      </script>
 <?php
 }

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>  
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
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
  font-size: 15px;
  background-color:  #246BB2;
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
   <form class="form-inline my-2 my-lg-0" method="POST" action="cari.php">
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
<center>
<table id="mytable">
  <thead>
<tr>
<th>Invoice No</th><th>Date</th><th>Description</th><th>Acc No</th><th>Amount</th><th>Service Charge</th><th>Plate No</th><th>Roadtax</th><th>Phone No</th><th>Total Amount</th><th>Discount</th><th>Paid</th><th>Balance</th>
<th>Paid By</th><th></th><th></th>
</tr>
</thead>
<tbody>
<?php
while($row=mysqli_fetch_array($result))
        
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
     echo $row['accNo'];
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
     <form action="" method="post">
     <input name="deleteid" type="hidden" value="<?php echo $row['invoiceNo'];?>"/>
    <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are You sure want to delete ?')"> Delete</button>
  </form>
    </td>
    <td>
       <form action="pdf.php" method="post">
     <input name="downloadid" type="hidden" value="<?php echo $row['invoiceNo'];?>"/>
    <button class="btn btn-danger" type="submit" name="download" > Download</button>
  </form>
    </td>      
</tr>
 <?php     
}
?>
</tbody>
</table>
</center>  
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  

    <script>
    $(document).ready(function () {
        $("#mytable").DataTable();
    });

</script>
</body>    
</html>
