<?php
//pdf.php;
require_once __DIR__ .'/vendor/autoload.php';


/*
<?php
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
$connector = new FilePrintConnector("/dev/usb/lp0");
$printer = new Printer($connector);

$printer -> text("Hello World!\n");
$printer -> cut();

$printer -> close();

//print to thermal printer 

*/
include ("connect.php");

     $_SESSION['downloadid'] = $_POST['downloadid'];
     $id = $_SESSION['downloadid'] ;
     $sql = "SELECT * FROM payment WHERE invoiceNo ='$id'";
     $result  = mysqli_query($conn,$sql);
     $row = mysqli_fetch_assoc($result);


$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [60,170], 'margin_left' => '5']);
$mpdf->SetHTMLHeader('
<div style="text-align: center; font-weight: bold; font-size:14px;">
    MARSA AGENCY 
</div>');
$mpdf->SetHTMLFooter('
<div style="text-align: center; font-weight: bold; font-size:11px;">
    Terima Kasih dan Sila Datang Lagi 
</div>');
$data = "";
$data = '<div style="text-align: center; font-size:11px; margin-top:50px;">
    KM 13.5 JALAN TITI HAJI IDRIS,
</div>';
$data .= '<div style="text-align: center; font-size:11px;">
    06500 LANGGAR, 
</div>';
$data .= '<div style="text-align: center; font-size:11px;">
     KEDAH
</div>';
$data .= '<div style="text-align: center; font-size:11px;">
     TEL : 019-5163088 / 04-7870425
</div><br><br>';
$data .= '<div style="font-size:10px;">';
$data .= '<b>Invoice No :   ' .$row['invoiceNo']. '<br/><br/>';
$data .= 'Date :   ' .$row['invoiceDate']. '<br/><br/>';
$data .= 'Description :   ' .$row['description']. '<br/><br/>';
$data .= 'Acc No :   ' .$row['accNo']. '<br/><br/>';
$data .= 'Plate No :   ' .$row['plateNo']. '<br/><br/>';
$data .= 'Amount :   RM' .$row['amount']. '<br/><br/>';
$data .= 'Service Charge :   RM' .$row['service_charge']. '<br/><br/>';
$data .= 'Roadtax :   ' .$row['roadtax']. '<br/><br/>';
$data .= 'Total Amount :   RM' .$row['total']. '<br/><br/>';
$data .= 'Discount :   RM' .$row['discount']. '<br/><br/>';
$data .= 'Paid :   RM' .$row['paid']. '<br/><br/>';
$data .= 'Balance :   RM' .$row['balance']. '<br/><br/>';
$data .= 'Paid By :   ' .$row['paid_by']. '<br/><br/>';
$data .= 'Tel No :   ' .$row['telNo']. '</b><br/><br/>';
$data .= '</div>';

$mpdf->writeHTML($data);
$mpdf->Output('file.pdf', 'D');
$mpdf->SetJS('this.print();');
?>