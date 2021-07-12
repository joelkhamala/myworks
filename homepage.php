<?php
include "connect.php";
if(isset($_SESSION['user']))
{
?>
<!DOCTYPE html>
<html>
<head>
  <title>VPMS || User Homepage</title>
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
      <?php include "panel.php";?>
          <div class=" ">
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Your Details
                    </div>
                    <div class="panel-body">
                      <?php
                      $inputuname = $_SESSION['user'];
                        $qry= "SELECT * FROM tblusers WHERE username= '$inputuname'";
                        $sel= mysqli_query($con,$qry);
                        while ($fetchData=mysqli_fetch_assoc($sel)) {
                        ?>
                        <div class="row">
                          <div class="col-md-8 row">
                            <div class="col-md-6">
                              <table class="table table-responsive container-fluid pull-right col-md-6">
                              <tr>
                                <th>Personal Details</th>
                              </tr>
                          <tr>
                            <td>
                              First Name
                            </td>
                            <td>
                              <?php echo $fetchData['firstname']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Middle Name
                            </td>
                            <td>
                              <?php echo $fetchData['middlename']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Last Name
                            </td>
                            <td>
                              <?php echo $fetchData['lastname']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              User Name
                            </td>
                            <td>
                              <?php echo $fetchData['username']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Email Address
                            </td>
                            <td>
                              <?php echo $fetchData['email']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Phone Number
                            </td>
                            <td>
                              +254 <?php echo $fetchData['phone']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              County of Residence
                            </td>
                            <td>
                              <?php echo $fetchData['residence']; ?>
                            </td>
                          </tr>
                        </table>
                            </div>
                        <div class="col-md-6">
                          <table class="table table-responsive container-fluid pull-right">
                          <tr>
                            <th>Vehicle Details</th>
                          </tr>
                          <tr>
                            <td>
                              Current Type of Vehicle
                            </td>
                            <td>
                              <?php
                              $VehicleCat = $fetchData['vehiclecategory'];
                              echo $VehicleCat;
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Parking Charge
                            </td>
                            <td>
                              <?php
                                $qryCat= "SELECT * FROM tblcategory WHERE VehicleCat= '$VehicleCat'";
                                $selCat= mysqli_query($con,$qryCat);
                                while ($fetchCatData=mysqli_fetch_assoc($selCat))
                                {
                                  echo "Kshs. ".$fetchCatData['parking_charge'];
                                }
                              ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Current Vehicle Manufacturer
                            </td>
                            <td>
                              <?php echo $fetchData['vehiclecompany']; ?>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Vehicle Number Plate
                            </td>
                            <td>
                              <?php echo $fetchData['vehiclereg']; ?>
                            </td>
                          </tr>
                        </table>
                        </div>
                          </div>
                          <div class="col-md-4">
                            <img src="screenshot.fifa-17.1278x715.2016-08-17.36.jpg" class="img img-thumbnail img-responsive" style="width: 100%; height: 100%;">
                            
                          </div>
                        </div>
                        
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

</body>
</html>
<?php
}
else
{
    die("<script>alert('The system is detecting unusual behaviour, hence any further operations have been cancelled. Please Login to continue using the system.'); window.location='http://www.vpms.epizy.com/userAccount/login.php';</script>");
}
?>