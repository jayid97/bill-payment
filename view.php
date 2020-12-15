<!DOCTYPE html>
<html>
<?php
include ("connect.php");
session_start();
 
     $id = $_SESSION["last_id"];
     $sql = "SELECT * FROM payment WHERE invoiceNo ='$id'";
     $result  = mysqli_query($conn,$sql);
     $row = mysqli_fetch_assoc($result);
?>

<head>
	<title>Print</title>
</head>
<style>
h1{
  font-size: 24px;
  color: #222;
}
h2{font-size: 16px;}
h3{
  font-size: 16px;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: 20px;
  line-height: 1.2em;
}
 
#top, #mid,#bot{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}

#top{min-height: 60px;}
#mid{min-height: 80px;} 
#bot{ min-height: 50px;}

#top .logo{
  //float: left;
	height: 60px;
	width: 60px;
	background: url(logo.jpg) no-repeat;
	background-size: 60px 60px;
}
.clientlogo{
  float: left;
	height: 60px;
	width: 60px;
	background: url(logo.jpg) no-repeat;
	background-size: 60px 60px;
    border-radius: 50px;
}
.info{
  display: block;
  //float:left;
  margin-left: 0;
}
.title{
  float: right;
}
table{
  width: 100%;
  border-collapse: collapse;
  font-size: 20px;
}
td{
  padding: 4px;
  border: none;
}


#legalcopy{
  margin-top: 5mm;
}
#invoice-POS{
  padding:0;
  margin-right: 10px;
  width: 50mm;
  background: #FFF;
}

#print
{
	background: #520d08;
	width: 200px;
	color:white;
	border: none;
	padding: 10px;
}

@page
{
	margin: 0;
	padding: 0;
}

@media print
{
	#print{
    display: none;
  }
}
</style>
<body>

<div id="invoice-POS"> 
    <div id="mid">
        <b><p>Marsa Agency</p></b>
        <p> 
            Alamat : KM13.5, Jalan Titi Haji Idris, 06500 Langgar, Kedah</br>
            Tel No   : 019-5163088</br>
        </p>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

					<div id="table">
						<table>
							<tr>
								<td >Invoice No:</td>
								<td><?php echo $row['invoiceNo']?></td>
							</tr>

							<tr>
								<td>Date: </td>
								<td><?php echo $row['invoiceDate']?></td>
							</tr>

							<tr>
								<td>Description:</td>
								<td><?php echo $row['description']?></td>
							</tr>

							<tr>
								<td>Acc No:</td>
								<td><?php echo $row['accNo']?></td>
							</tr>

							<tr>
								<td>Plate No:</td>
								<td><?php echo $row['plateNo']?></td>
							</tr>

							<tr>
								<td>Amount:</td>
								<td><?php echo $row['amount']?></td>
							</tr>

								<tr>
								<td>Roadtax:</td>
								<td><?php echo $row['roadtax']?></td>
							</tr>

							<tr>
								<td>Service Charge:</td>
								<td><?php echo $row['service_charge']?></td>
							</tr>


							<tr>
								<td>Discount:</td>
								<td><?php echo $row['discount']?></td>
							</tr>

							<tr>
								<td >Total:</td>
								<td><?php echo $row['total']?></td>
							</tr>
							<tr>
								<td>Paid:</td>
								<td><?php echo $row['paid']?></td>
							</tr>
							<tr>
								<td>Balance:</td>
								<td><?php echo $row['balance']?></td>
							</tr>
							<tr>
								<td>Paid By:</td>
								<td><?php echo $row['paid_by']?></td>
							</tr>
							<tr>
								<td>Tel No:</td>
								<td><?php echo $row['telNo']?></td>
							</tr>

						</table>
					</div><!--End Table-->

					<div id="legalcopy">
						<p class="legal">
							Terima Kasih <br>
							Sila Datang Lagi
						</p>
					</div>

				</div><!--End InvoiceBot-->
</div><!--End Invoice-->

<button type="submit" id="print" class="btn btn-danger" onclick="window.print()">Print</button>
</body>
</html>