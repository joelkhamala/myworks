
<?php
include "connect.php";
require('fpdf/fpdf.php');
if (isset($_POST['download']))
{
$user=$_SESSION['user'];
class PDF extends FPDF
{
// Page header
function Header()
{
	$this->Image('../images/logo3.png',80,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(70,60,'Sharrif\'s Vehicle Parking receipt',5,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,"Page".$this->PageNo().'/{nb}'.'               				     '. '                              '."THIS RECEIPT IS VERIFIED",0,1);
    // Page number\
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetAuthor('By: Admin');
$pdf->SetTitle('Online Parking Receipt');
	$qry = mysqlI_query($con, "SELECT * FROM tblusers WHERE username= '$user'");
	$row = mysqli_fetch_assoc($qry);
	$date = date('D, d, M Y');
	$br = "<br>";
	if($qry)
	{
		$qsl = mysqli_query($con, "SELECT * FROM tblvehicle WHERE OwnerName = '$user'");
			$y = 30;
			$x = 10;  
			 
			$pdf->setXY($x, $y);
		$pdf->setFont("Arial","","9");
		$pdf->Cell(0,10," ",0,1);
		$pdf->Cell(0,10," ",0,1);
		$pdf->Cell(0,-10,"CLIENT PERSONAL DETAILS:",0,1);
			$pdf->SetFillColor(170, 170, 170); //gray
			$pdf->setFont("Arial","B","9");
			$pdf->setXY(10, 50); 
			$pdf->Cell(35, 10, "First Name", 1, 0, "L", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
			$pdf->Cell(30, 10, "Middle Name", 1, 0, "L", 1);
			$pdf->Cell(25, 10, "Last Name", 1, 0, "L", 1);
			$pdf->Cell(35, 10, "Email", 1, 0, "L", 1);
			$pdf->Cell(30, 10, "Phone", 1, 0, "L", 1);
 
			$y = 60;
			$x = 10;  
			 
			$pdf->setXY($x, $y);
			 
			$pdf->setFont("Arial","","9");
		$pdf->Cell(35, 8, $row['firstname'], 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
        $pdf->Cell(30, 8, $row['middlename'], 1);
        $pdf->Cell(25, 8, $row['lastname'], 1);
        $pdf->Cell(35, 8, $row['email'], 1);
        $pdf->Cell(30, 8, "+254 ".$row['phone'], 1);
		$pdf->Cell(0,10," ",0,1);

		$pdf->Cell(0,10," ",0,1);
		$pdf->Cell(0,10," ",0,1);
		$pdf->Cell(0,-30,"PAYMENT DATA:",0,1);
			$pdf->SetFillColor(170, 170, 170); //gray
			$pdf->setFont("Arial","B","9");
			$pdf->setXY(10, 80);
			$pdf->Cell(35, 10, "Parking Reference", 1, 0, "L", 1); 
			$pdf->Cell(40, 10, "Vehicle Type", 1, 0, "L", 1);
			$pdf->Cell(36, 10, "Vehicle Make", 1, 0, "L", 1);
			$pdf->Cell(45, 10, "Vehicle Registration", 1, 0, "L", 1);
			$pdf->Cell(35, 10, "Parking Charge", 1, 0, "L", 1);

 
			$y = 90;
			$x = 10;
			 
			 while($rows = mysqli_fetch_array($qsl))
			 {
			 	$pdf->setXY($x, $y);
				$pdf->setFont("Arial","","9");
				$pdf->Cell(35, 8, $rows['ParkingNumber'], 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
        		$pdf->Cell(40, 8, $row['vehiclecategory'], 1);
        		$pdf->Cell(36, 8, $rows['VehicleCompanyname'], 1);
				$pdf->Cell(45, 8,$rows['RegistrationNumber'],1);
				$pdf->Cell(35, 8,$rows['ParkingCharge'],1);
				$y+=8;
			}
					$selSum=mysqli_query($con,"SELECT SUM(ParkingCharge) as sum FROM tblvehicle WHERE OwnerName='".$_SESSION['user']."'");
                    $rowSum = mysqli_fetch_assoc($selSum);
                    $TotalCharge = $rowSum['sum'];
				$pdf->setXY($x,$y);
				$pdf->setFont("Arial","B","9");
				$pdf->Cell(156, 8, "TOTALS",1,"C"); 
				$pdf->Cell(35, 8,$TotalCharge,1);

				if($y>95)
				{
					$y=$y+30;
				}
				else
				{
					$y = 100;
				}
			
			$x = 10;

			$pdf->setXY($x, $y);

		$pdf->setFont("Arial","B","9");
		$pdf->Cell(0,10,"VERIFICATION",0,1,"C","B");
		$pdf->Cell(0,10,"CUSTOMERS USE:",0,1);
		$pdf->setFont("Arial","","9");
		$pdf->Cell(20,10,"CLIENT SIGN HERE: ___________________",0,1);
		$pdf->setFont("Arial","B","9");
		$pdf->Cell(0,10,"FOR OFFICIAL USE ONLY:",0,1);
		$pdf->setFont("Arial","","9");
		$pdf->Cell(20,10,"OFFICIAL SIGN HERE: ___________________          STAMP:___________________",0,1);

		$pdf->setFont("Arial","B","9");
		$pdf->Cell(0,10,"DATE OF DOWNLOAD: ".$date.".",0,1);
		$pdf->Output();
    
	}
	
}