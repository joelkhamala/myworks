<?php
include "connect.php";
if(isset($_SESSION['user']))
{
  
$inputuname = $mobilenumber = $inputCounty = $inputCategoryname = $inputCompanyname = $inputRegNo = $errMsg = $subscribing = $loginMsg = "";

$parkingnumber=mt_rand(100000000, 999999999);
$dateIn = date("Y-m-d");

$user=$_SESSION['user'];
$seluser = "SELECT * FROM tblvehicle WHERE OwnerName='$user'";
$seluserqry= mysqli_query($con,$seluser);
$countusersel=mysqli_num_rows($seluserqry);

function testInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
                        Total Spending Breakdown
                    </div>
                    <div class="panel-body">
                      <?php
                      $i=1;
                      if($countusersel>0)
                      {
                        ?>
                      <div class="col-md-8">
                        Your Total Spending is: <br>
                        <table class="table table-bordered">
                          <tr>
                            <th>
                              Parking Number &nbsp
                            </th>
                            <th>
                              Vehicle Company Name &nbsp
                            </th>
                            <th>
                              Vehicle Category &nbsp
                            </th>
                            <th>
                              Registration Number &nbsp
                            </th>
                            <th>
                              Amount
                            </th>
                          </tr>
                          <?php
                      $i=1;
                          while($userData=mysqli_fetch_assoc($seluserqry))
                          {
                            $charge = $userData['ParkingCharge'];
                            ?>
                          <tr>
                            <td>
                              <?php echo $userData['ParkingNumber']; ?>
                            </td>
                            <td>
                              <?php echo $userData['VehicleCompanyname']; ?>
                            </td>
                            <td>
                              <?php echo $userData['VehicleCategory']; ?>
                            </td>
                            <td>
                              <?php echo $userData['RegistrationNumber']; ?>
                            </td>
                            <td>
                              <?php echo $charge; ?>
                            </td>
                          </tr>
                          <?php
                              $i++;
                            }
                            $selSum=mysqli_query($con,"SELECT SUM(ParkingCharge) as sum FROM tblvehicle WHERE OwnerName='".$_SESSION['user']."'");
                            $rowSum = mysqli_fetch_assoc($selSum);
                            $TotalCharge = $rowSum['sum'];
                            ?>
                            <tr>
                              <td colspan="4">
                                <b>TOTALS</b> &nbsp &nbsp
                              </td>
                              <td>
                                <b><?php echo $TotalCharge; ?></b>
                              </td>
                            </tr>
                            <?php
                          ?>
                          <tr>
                            <td colspan="5">
                              <p>
                                <center>
                                  <i>
                                    Book more for a chance to win amazing prices!!<br>
                                    This message is brought to you by Management, Terms and Conditions Apply.
                                  </i>
                              </center>
                            </p>
                            </td>
                          </tr>
                        </table>
                        </div>
                          <div class="col-md-4">
                            <form action="pdfdownloader.php" method="POST" target="_blank">
                              <button name="download" class="btn btn-success">Download Receipt</button>
                            </form>
                          </div>
                          <?php
                            }
                          else
                          {
                          ?>
                              No Spending Breakdown, since you have never booked on this system. <a href="parking.php" class="btn btn-primary">Book Now</a>
                          <?php
                          }
                          ?>
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