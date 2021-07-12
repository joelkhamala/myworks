<?php
include "connect.php";
if(isset($_SESSION['user']))
{
  
$inputuname = $mobilenumber = $inputCounty = $inputCategoryname = $inputCompanyname = $inputRegNo = $errMsg = $subscribing = $loginMsg = "";

$parkingnumber=mt_rand(100000000, 999999999);
$dateIn = date("Y-m-d");


$user=$_SESSION['user'];
$seluser = "SELECT * FROM tblusers WHERE username='$user'";
$seluserqry= mysqli_query($con,$seluser);
$countusersel=mysqli_num_rows($seluserqry);
$userData=mysqli_fetch_assoc($seluserqry);

function testInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if(isset($_POST['submitbook']))
{
if($countusersel>0)
{
    $parking = testInput($_POST['parking']);
    $_SESSION['parking'] = $parking;
    $charge = testInput($_POST['charge']);
    $confirmCode = testInput($_POST['confirmCode']);
		$inputRegNo = $userData['vehiclereg'];
		$inputCategoryname = $userData['vehiclecategory'];
		$inputCompanyname = $userData['vehiclecompany'];
		$mobilenumber = $userData['phone'];
    $time = testInput($_POST['expectedTime']);



		$qryselreg= "SELECT * FROM tblvehicle WHERE RegistrationNumber= '$inputRegNo' AND Status='' AND DateIn = '$dateIn'";
  		$selregqry= mysqli_query($con,$qryselreg);
      $rowregqry = mysqli_fetch_assoc($selregqry);
  		$countregsel=mysqli_num_rows($selregqry);
          /*
          //Code to automatically Refresh Spaces
        $selSpaces = mysqli_query($con,"SELECT * FROM transactions WHERE User_ID='".$userData['User_ID']."'");
        $cntTra = mysqli_fetch_assoc($selSpaces);

        $beginDate = $cntTra['paydate'];
        $todayDate = $dateIn;

        function differenceInHours($startdate,$enddate)
        {
            $starttimestamp = strtotime($startdate);
            $endtimestamp = strtotime($enddate);
            $difference = abs($endtimestamp - $starttimestamp)/3600;
            return $difference;
        }
        $hours_difference = differenceInHours($beginDate,$todayDate);
        if($cntTra>0 && $hours_difference>24)
        {
            for($i=1;$i<21;$i++)
            {
                $updateSpaces = mysqli_query($con,"UPDATE spaces SET booked='0', classname='not_booked', time_booked='0' WHERE Space_ID='$i'");
            }
            if($updateSpaces)
            {
                echo "<script>alert('Spaces Cleared!'); history.back();</script>";
            }
        }
        */
  if($countregsel>0)
      {
        die ("<script>alert('You already booked a space today, Please Park where you have booked or select a free parking spot'); history.back();</script>");
      }
      else
      {
        	if(empty($parking))
  		  {
  		    echo "<script>alert('Please Select a Free Space from the List Provided'); history.back();</script>";
  		  }
  		  else
  		  {
    		    $selPark = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='$parking' AND classname='booked'");
    		    $countpark = mysqli_fetch_assoc($selPark);
    		    if($countpark>0)
    		    {
    		      $errMsg = "<p style='color: red;'>Space Already Booked.</p>";
    		    }
    		    else
    		    {
    		      unset($_SESSION['space_booked']);
    		      $_SESSION['space_booked']="None";
    		      $park = $userData['parking_frequency']+1;

            	  $selectTrans = mysqli_query($con, "SELECT * FROM transactions WHERE confirmationCode='$confirmCode' AND User_ID='".$userData['User_ID']."'");
            	  $countTrans = mysqli_num_rows($selectTrans);
            	  if($countTrans>0)
            	  {
            	  	$updateVehicle = "INSERT INTO tblvehicle (ParkingNumber, VehicleCategory, VehicleCompanyname, RegistrationNumber, OwnerName, OwnerContactNumber, ParkingCharge, expectedOutTime, DateIn) VALUES ('$parkingnumber','$inputCategoryname', '$inputCompanyname','$inputRegNo', '$user', '$mobilenumber', '$charge', '$time', '$dateIn')";
            	  $updateVehicle_action=mysqli_query($con,$updateVehicle);
            	  	$insert = mysqli_query($con,"UPDATE spaces SET User_ID='".$userData['User_ID']."', booked='1', classname='booked',time_booked='$time' WHERE Space_name='$parking'");
    			      $upCharge=mysqli_query($con,"UPDATE tblvehicle SET ParkingCharge='$charge' WHERE OwnerName='".$_SESSION['user']."'");
                      $upTrans=mysqli_query($con,"UPDATE transactions SET space_booked='$parking' WHERE User_ID='".$userData['User_ID']."'");
    			      $upFreq = mysqli_query($con, "UPDATE tblusers SET parking_frequency='$park' WHERE username = '".$_SESSION['user']."'");
    			      $_SESSION['space_booked'] = $parking;
    			      echo "<script>alert('Space booked Successfully. Thank you for your continued trust in us.'); history.back();</script>";
            	  }
    		      else
    		      {
    		      	echo "<script>alert('Space not booked because Payment Details are not yet Updated. Please try re-entering again or Check with the Accounts Clerk.'); history.back();</script>";
    		      }
    		    }
    		}
      }
}
else
{
	die(header("Location: parking.php"));
}
}

if(isset($_POST['submitUpdate']))
{
  $inputCategoryname1 = testInput($_POST['inputCategoryname']);
  $inputCompanyname1 = testInput($_POST['inputCompanyname']);
  $inputRegNo1 = testInput($_POST['inputRegNo']);

  $updateQry = mysqli_query($con,"UPDATE tblvehicle SET VehicleCategory='$inputCategoryname1', VehicleCompanyname='$inputCompanyname1', RegistrationNumber='$inputRegNo1' WHERE OwnerName='$user'");
  $updateUserQry = mysqli_query($con,"UPDATE tblusers SET vehicleCategory='$inputCategoryname1', vehiclecompany='$inputCompanyname1', vehiclereg='$inputRegNo1' WHERE username='$user'");

  if($updateQry && $inputRegNo != $inputRegNo1 && $updateUserQry)
  {
    die("<script>alert('Vehicle Details Updated Successfully'); history.back();</script>");
  }
  else
  {
    die("<script>alert('Vehicle Details Failed. Please try entering new Number Plate Details'); history.back();</script>");
  }
}

if(isset($_POST['submitunbook']))
{
  $ParkSel = mysqli_query($con, "SELECT * FROM spaces WHERE User_ID='".$userData['User_ID']."'");
  if($ParkSel)
  {
    while($mypick=mysqli_fetch_assoc($ParkSel))
    {
      $unbook = mysqli_query($con,"UPDATE spaces SET booked='0', classname='not_booked', time_booked='0', User_ID='0' WHERE Space_name='".$mypick['Space_name']."'");
      if($unbook)
      {
          echo "<script>alert('Space unbooked Successfully! Thank you for using our online system.');history.back();</script>";
      }
    }
  }
  else
  {
    echo "<script>alert('You have not booked any Space yet! Kindly follow the procedure for paying and book an empty space. VPMS, Parking made easy.');history.back();</script>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>VPMS || Book Parking Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link href="css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<link href="css/styles.css" rel="stylesheet" id="style-css">

<style type="text/css">
  *
  {
    font-family: arial;
  }
  .content-wrapper, .panel {
    margin-top: 2rem;
  }
</style>
</head>
<body>
<?php include "header.php"; ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <?php include "panel.php"; ?>
    <div class="">
          <div class="">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Book Parking Space
                    </div>
                    <style type="text/css">
                    	.table tr td
                    	{
                    		height: 2.4em;
                        width: 30em;
                    	}
                    </style>
                    <div class="panel-body">
                      <div class="col-md-4">
                          <table class="table table-responsive container-fluid">
                          <tr>
                            <th colspan="2">Your Current Vehicle Details</th>
                          </tr>
                          <tr>
                            <td>
                              Current category of Vehicle
                            </td>
                            <td>
                              <?php
                              $VehicleCat = $userData['vehiclecategory'];
                              echo $userData['vehiclecategory']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Current Vehicle Manufacturer
                            </td>
                            <td>
                              <?php echo $userData['vehiclecompany']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Vehicle Number Plate
                            </td>
                            <td>
                              <?php echo $userData['vehiclereg']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Parking fee to pay
                            </td>
                            <td>
                              <?php
                                $qryCat= "SELECT * FROM tblcategory WHERE VehicleCat= '$VehicleCat'";
                                $selCat= mysqli_query($con,$qryCat);
                                while ($fetchCatData=mysqli_fetch_assoc($selCat))
                                {
                                  $_SESSION['parking_charge'] = $fetchCatData['parking_charge'];
                                  if($fetchCatData['parking_charge'] != '')
                                  {
                                    echo "Kshs. ".$fetchCatData['parking_charge'];
                                  }
                                  else
                                  {
                                    echo "Parking Fees Not Enlisted";
                                  }
                                }
                              ?>
                            </td>
                          </tr>
                          <tr>
                          	<td colspan="2">
                          		<form action="" method="POST" id-="spaceForm">
                          			<div class="form-row">
	                          				<?php echo $errMsg; ?>
	                                  		<input type="hidden" name="charge" value="<?php echo $_SESSION['parking_charge']; ?>">
	                                  		<div class="row">
	                                  			<div class="form-group col-md-12">
	                                  				<label>Select a Parking Space</label><br>
		                                  			<select class="form-control" name="parking" style="height: 3em; " id="selectedSpace">
			                          					<option value="">--SELECT A SPACE--</option>
			                          					<?php
			                          						$selspace = mysqli_query($con,"SELECT * FROM spaces");
			                          						while($rowspaces = mysqli_fetch_assoc($selspace))
			                          						{
			                          							if($rowspaces['booked'] != 1)
			                          							{
				                          							?>
				                          								<option value="<?php echo $rowspaces['Space_name'];?>">
				                          									<?php echo strtoupper(str_replace("_", " ", $rowspaces['Space_name']));?>
				                          								</option>
				                          							<?php
			                          							}
			                          							else
			                          							{
			                          								?>
			                          								<option value="<?php echo $rowspaces['Space_name'];?>" disabled="disabled"><?php echo strtoupper(str_replace("_", " ", $rowspaces['Space_name']));?>~<i>Booked</i></option>
			                          								<?php
			                          							}
			                          						}
			                          					?>
			                          				</select>
			                          			</div>
		                          				
	                                  		</div>
	                          			<div class="row">
	                          				<div class="form-group col-md-6">
			                                  <label>Avg Parking Time</label>
			                                  <?php echo $errMsg; ?>
			                                  <select class="form-control" name="expectedTime" style="height: 3em; width: 10em;" required>
			                                    <option>--SET A LIMIT--</option>
			                                    <option value="0.5">30 Minutes</option>
			                                    <option value="1">1 Hour</option>
			                                    <option value="1.5">1 Hour 30 Minutes</option>
			                                    <option value="2">2 Hours</option>
			                                    <option value="2.5">2 Hours 30 Minutes</option>
			                                    <option value="3">3 Hours</option>
			                                    <option value="3.5">3 Hours 30 Minutes</option>
			                                    <option value="4">4 Hours</option>
			                                    <option value="4.5">4 Hours 30 Minutes</option>
			                                    <option value="5">5 Hours</option>
			                                    <option value="6">Over 5 Hours</option>
			                                  </select>
			                                </div>
			                                <div class="form-group col-md-6">
			                                  <label>MPESA Code</label>
			                                  <?php echo $errMsg; ?>
			                                  <input class="form-control" name="confirmCode" style="height: 3em; width: 9em;" required>
			                                </div>
	                          			</div>
                          			</div>
                          			<div class="form-row">
                                  <div class="col-md-7">
                                    <button type="submit" name="submitbook" class="btn btn-success">Book Parking Space</button>
                                  </div>
                                  <div class="col-md-5">
                                    <a href="how_to_book.php" class="btn btn-info">How to Book</a>
                                  </div>
								                </div>
                          		</form>
                          		
                          	</td>
                          </tr>
                          <tr>
                            <td style="text-align: center;" colspan="2">
                                <form action="" method="POST">
                                  <div class="form-row">
                                    <button type="submit" name="submitunbook" class="btn btn-danger" onclick="return confirm('Are you sure you want to unbook parking space? You will not be able to book space again today. Continue?')">Unbook Parking Space</button>
                                  </div>
                                </form>
                            </td>
                          </tr>
                        </table>
                        </div>
                        <script>
                        //Using Javascript Sessions to store selected data for easy display. The data will be stored in the browser
                            function store(){ //stores items in sessionStorage
                            var selected = document.getElementById('selectedSpace').value;

                            const space = {
                                selectedSpace: selectedSpace,
                            }

                            window.sessionStorage.setItem('space',JSON.stringify(space));  
                            //converting object to string
                        }

                        function retrieveRecords(){ //retrieves items in sessionStorage
                            var records = window.sessionStorage.getItem('space');
                            var element = document.getElementById("retrieve");
                            element.value = records;
                    }

                    function removeItem(){//deletes item from sessionStorage
                            sessionStorage.removeItem('space');
                    }

                    window.onload =function() { //ensures the page is loaded before functions are executed.
                            document.getElementById("spaceForm").onsubmit = store;
                            document.getElementById("submitbook").onclick = retrieveRecords;
                    }
                        </script>
                        <style type="text/css">
                        	.tabl tr td
                        	{
                        		border: 1px solid black;
                        		height: 30px;
                        		width: 150px;
                        		text-align: center;
                        		line-height: 2.5em;
                        	}
                        	.tabl th
                        	{
                        		border: none;
                        		line-height: 2em;
                        		text-align: center;
                        	}
                        	.tabl tr .booked
                        	{
                        		background: #ffd345;
                        	}
                        	.tabl tr .not_booked
                        	{
                        		background: white;
                        	}
                        </style>
                          <div class="col-md-4">
                            <table class="tabl">
                            	<tr>
                            		<th colspan="3">
                            			Parking Map
                            		</th>
                            	</tr>
                            	<tr>
                            		<?php
                            		$selSpace1 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_1'");
                            		?>
                            		<td class="<?php
									while($rowSpace1= mysqli_fetch_assoc($selSpace1))
									{
										echo $rowSpace1['classname'];
									}
									?>">
                            			1
                            		</td>
                            		<td>
                            			
                            		</td>
                            		<?php
                            		$selSpace11 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_11'");
                            		?>
                            		<td class="<?php
									while($rowSpace11= mysqli_fetch_assoc($selSpace11))
									{
										echo $rowSpace11['classname'];
									}
									?>">
                            			11
                            		</td>
                            	</tr>
                            	<tr>
                            		<?php
                            		$selSpace2 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_2'");
                            		?>
                            		<td class="<?php
									while($rowSpace2= mysqli_fetch_assoc($selSpace2))
									{
										echo $rowSpace2['classname'];
									}
									?>">
                            			2
                            		</td>
                            		<td>
                            			
                            		</td>
                            		<?php
                            		$selSpace12 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_12'");
                            		?>
                            		<td class="<?php
									while($rowSpace12= mysqli_fetch_assoc($selSpace12))
									{
										echo $rowSpace12['classname'];
									}
									?>">
                            			12
                            		</td>
                            	</tr>
                            	<tr>
                            		<?php
                            		$selSpace3 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_3'");
                            		?>
                            		<td class="<?php
									while($rowSpace3= mysqli_fetch_assoc($selSpace3))
									{
										echo $rowSpace3['classname'];
									}
									?>">
                            			3
                            		</td>
                            		<td>
                            			
                            		</td>
                            		<?php
                            		$selSpace13 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_13'");
                            		?>
                            		<td class="<?php
									while($rowSpace13= mysqli_fetch_assoc($selSpace13))
									{
										echo $rowSpace13['classname'];
									}
									?>">
                            			13
                            		</td>
                            	</tr>
                            	<tr>
                            		<?php
                            		$selSpace4 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_4'");
                            		?>
                            		<td class="<?php
									while($rowSpace4= mysqli_fetch_assoc($selSpace4))
									{
										echo $rowSpace4['classname'];
									}
									?>">
                            			4
                            		</td>
                            		<td>
                            			
                            		</td>
                            		<?php
                            		$selSpace14 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_14'");
                            		?>
                            		<td class="<?php
									while($rowSpace14= mysqli_fetch_assoc($selSpace14))
									{
										echo $rowSpace14['classname'];
									}
									?>">
                            			14
                            		</td>
                            	</tr>
                            	<tr>
                            		<?php
                            		$selSpace5 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_5'");
                            		?>
                            		<td class="<?php
									while($rowSpace5= mysqli_fetch_assoc($selSpace5))
									{
										echo $rowSpace5['classname'];
									}
									?>">
                            			5
                            		</td>
                            		<td>
                            			
                            		</td>
                            		<?php
                            		$selSpace15 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_15'");
                            		?>
                            		<td class="<?php
									while($rowSpace15= mysqli_fetch_assoc($selSpace15))
									{
										echo $rowSpace15['classname'];
									}
									?>">
                            			15
                            		</td>
                            	</tr>
                            	<tr>
                            		<?php
                            		$selSpace6 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_6'");
                            		?>
                            		<td class="<?php
									while($rowSpace6= mysqli_fetch_assoc($selSpace6))
									{
										echo $rowSpace6['classname'];
									}
									?>">
                            			6
                            		</td>
                            		<td>
                            			
                            		</td>
                            		<?php
                            		$selSpace16 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_16'");
                            		?>
                            		<td class="<?php
									while($rowSpace16= mysqli_fetch_assoc($selSpace16))
									{
										echo $rowSpace16['classname'];
									}
									?>">
                            			16
                            		</td>
                            	</tr>
                            	<tr>
                            		<?php
                            		$selSpace7 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_7'");
                            		?>
                            		<td class="<?php
									while($rowSpace7= mysqli_fetch_assoc($selSpace7))
									{
										echo $rowSpace7['classname'];
									}
									?>">
                            			7
                            		</td>
                            		<td>
                            			
                            		</td>
                            		<?php
                            		$selSpace17 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_17'");
                            		?>
                            		<td class="<?php
									while($rowSpace17= mysqli_fetch_assoc($selSpace17))
									{
										echo $rowSpace17['classname'];
									}
									?>">
                            			17
                            		</td>
                            	</tr>
                            	<tr>
                            		<?php
                            		$selSpace8 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_8'");
                            		?>
                            		<td class="<?php
									while($rowSpace8= mysqli_fetch_assoc($selSpace8))
									{
										echo $rowSpace8['classname'];
									}
									?>">
                            			8
                            		</td>
                            		<td>
                            			
                            		</td>
                            		<?php
                            		$selSpace18 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_18'");
                            		?>
                            		<td class="<?php
									while($rowSpace18= mysqli_fetch_assoc($selSpace18))
									{
										echo $rowSpace18['classname'];
									}
									?>">
                            			18
                            		</td>
                            	</tr>
                            	<tr>
                            		<?php
                            		$selSpace9 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_9'");
                            		?>
                            		<td class="<?php
									while($rowSpace9= mysqli_fetch_assoc($selSpace9))
									{
										echo $rowSpace9['classname'];
									}
									?>">
                            			9
                            		</td>
                            		<td>
                            			
                            		</td>
                            		<?php
                            		$selSpace19 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_19'");
                            		?>
                            		<td class="<?php
									while($rowSpace19= mysqli_fetch_assoc($selSpace19))
									{
										echo $rowSpace19['classname'];
									}
									?>">
                            			19
                            		</td>
                            	</tr>
                            	<tr>
                            		<?php
                            		$selSpace10 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_10'");
                            		?>
                            		<td class="<?php
									while($rowSpace10= mysqli_fetch_assoc($selSpace10))
									{
										echo $rowSpace10['classname'];
									}
									?>">
                            			10
                            		</td>
                            		<td>
                            			
                            		</td>
                            		<?php
                            		$selSpace20 = mysqli_query($con,"SELECT * FROM spaces WHERE Space_name='space_20'");
                            		?>
                            		<td class="<?php
									while($rowSpace20= mysqli_fetch_assoc($selSpace20))
									{
										echo $rowSpace20['classname'];
									}
									?>">
                            			20
                            		</td>
                            	</tr>
                            </table><br>
                            <div class="row">
                            	<table class="tabl" style="width: 100%;">
                            		<tr>
	                            		<th colspan="2">
	                            			<b>Key</b>
	                            		</th>
	                            	</tr>
	                            	<tr>
	                            		<td style="background: #ffd345;">
	                            			
	                            		</td>
	                            		<td colspan="2">
	                            			Yellow - Booked/Occupied
	                            		</td>
	                            	</tr>
	                            	<tr>
	                            		<td style="background: #fff;">
	                            			
	                            		</td>
	                            		<td colspan="2">
	                            			White - Not Booked/Free
	                            		</td>
	                            	</tr>
                            	</table>
                            </div>
                            <br><br>
                          </div>
                        <div class="col-md-4">
                        	<table class="table table-responsive container-fluid pull-right">
                        		<tr>
                        			<th>
                        				Update Vehicle Details
                        			</th>
                        		</tr>
                        		<tr>
                        			<td>
                        				<form action="" method="POST">
                        					<div class="form-row">
						                        <div class="form-group col-md-6">
						                          <label>Vehicle Type</label>
                                      <select name="inputCategoryname" class="form-control" style="height: 36px; width: 100%;">
                                        <option value="<?php echo $userData['vehiclecategory']; ?>">
                                          <?php echo $userData['vehiclecategory']; ?>
                                        </option>
                                        <?php
                                          $selCategory = mysqli_query($con, "SELECT * FROM tblcategory");
                                          while($rowsCat = mysqli_fetch_assoc($selCategory))
                                          {
                                            ?>
                                              <option value="<?php echo $rowsCat['VehicleCat']; ?>">
                                                <?php echo $rowsCat['VehicleCat']."~ Kshs. ".$rowsCat['parking_charge']; ?>
                                              </option>
                                            <?php
                                          }
                                        ?>
                                      </select>
						                          <h6 id="inputCategoryname_error"></h6>
						                        </div>
						                        <div class="form-group col-md-6">
						                          <label>Vehicle Make</label>
						                          <input type="text" class="form-control" name="inputCompanyname" id="inputCompanyname" value="<?php echo $userData['vehiclecompany']; ?>" placeholder="Vehicle Company Name">
						                          <h6 id="inputCompanyname_error"></h6>
						                        </div>
						                        <div class="form-group col-md-8">
						                          <label>Vehicle Registration Number</label>
						                          <input type="text" class="form-control" name="inputRegNo" id="inputRegNo" value="<?php echo $userData['vehiclereg']; ?>" placeholder="Vehicle Registration Number">
						                          <h6 id="inputRegNo_error"></h6>
						                        </div>
						                      </div>
						                       <div class="form-row">
							                        <button type="submit" name="submitUpdate" class="btn btn-success">Update Details</button>
							                    </div>
                        				</form>
                        			</td>
		                        </tr>
                        	</table>
                        </div>
                    </div>
                 </div>
                        </div>
                        
                    </div>
                </div>
            </div>
          </div>
        </div>
  </div>
</div>

</body>
</html>
<?php
}
else
{
    die("<script>alert('The system is detecting unusual behaviour, hence any further operations have been cancelled. Please Login to continue using the system.'); window.location='http://www.vpms.epizy.com/userAccount/login.php';</script>");
}
?>