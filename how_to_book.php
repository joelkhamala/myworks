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
  <title>VPMS || How to Book Parking Space</title>
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
                        How to Book
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-7">
                          <h4>Steps on how to book</h4>
                          <ol>
                            <li>
                              Go to Mpesa Menu
                            </li>
                            <li>
                              Select Lipa Na Mpesa
                            </li>
                            <li>
                              Select Buy Goods and Services
                            </li>
                            <li>
                              Enter Business Number, <b>430030</b>
                            </li>
                            <li>
                              Enter <b>Account Name</b> as your <b><i>User Name</i></b>
                            </li>
                            <li>
                              Enter Parking Amount according to the Charge Sheet
                            </li>
                            <li>
                              Enter Mpesa PIN and Send
                            </li>
                            <li>
                              <dl>
                                <dt>
                                  On the System
                                </dt>
                                <dd>
                                  <ul>
                                    <li>
                                      Click on <a href="parking.php" class=""><b>Reserve Parking</b></a> button.
                                    </li>
                                    <li>
                                      Select an Empty Space
                                    </li>
                                    <li>
                                      Enter Aaverage Parking Time, which is the amount of timr you intent to park
                                    </li>
                                    <li>
                                      Enter the MPESA Confirmation Code, e.g <i>QWERTY102</i>
                                  <br>
                                  <i><b>N.B.: Don't enter the Whole Message, only the CODE</b></i>
                                    </li>
                                    <li>
                                      Click <b>Book Parking Space</b> button.
                                    </li>
                                  </ul>
                                </dd>
                              </dl>
                            </li>
                          </ol>
                        </div>
                        <div class="col-md-5">
                          <table class="table table-bordered">
                            <tr>
                              <th colspan="2" style="text-align: center;">Parking Charge Sheet</th>
                            </tr>
                            <tr>
                              <th>
                                Vehicle Type
                              </th>
                              <th>
                                Parking Amount
                              </th>
                            </tr>
                            <?php
                            $selCat = mysqli_query($con, "SELECT * FROM tblcategory");
                            while($rowCat = mysqli_fetch_assoc($selCat))
                            {
                            ?>
                            <tr>
                              <td>
                                <?php echo $rowCat['VehicleCat']; ?>
                              </td>
                              <td>
                                <?php echo $rowCat['parking_charge']; ?>
                              </td>
                            </tr>
                            <?php
                            }
                            ?>
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