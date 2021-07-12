<?php
//include the connection details
//include "config.php";
//initializing all variables to null, a way to secure the data
$fname = $mname = $inputlname = $inputuname = $email = $mobilenumber = $inputCounty = $inputCategoryname = $inputCompanyname = $inputRegNo = $inputPwd = $inputConfPwd = $errMsg = $subscribing = $loginMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function check_inputData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  $fname = check_inputData($_POST["fname"]);
  $mname = check_inputData($_POST["mname"]);
  $inputlname = check_inputData($_POST["inputlname"]);
  $inputuname = check_inputData($_POST["inputuname"]);
  $email = check_inputData($_POST["email"]);
  $mobilenumber = check_inputData($_POST["mobilenumber"]);
  $inputCounty = check_inputData($_POST["inputCounty"]);
  $inputCategoryname = check_inputData($_POST["inputCategoryname"]);
  $inputCompanyname = check_inputData($_POST["inputCompanyname"]);
  $inputRegNo = check_inputData($_POST["inputRegNo"]);
  $inputPwd = check_inputData($_POST["inputPwd"]);
  $inputConfPwd = check_inputData($_POST["inputConfPwd"]);
  $inputPwd=md5($inputPwd);
 if(empty($fname) || empty($mname) || empty($inputlname) || empty($inputuname) || empty($email) || empty($mobilenumber) || empty($inputCounty) || empty($inputCategoryname) || empty($inputCompanyname) || empty($inputRegNo) || empty($inputPwd) || empty($inputConfPwd))
 {
  $errMsg = "<p style='color: red;'>Please enter all the required fields</p>";
 }
 else
 {
  if(isset($_POST['subscribing']))
  {
    $subscribing = check_inputData($_POST["subscribing"]);
  }
  else
  {
    $subscribing = $_POST['subscribing'] = 0;
  }
  

$con=mysqli_connect("sql210.epizy.com", "epiz_28285137", "F0rgeCpNBoo0PI", "epiz_28285137_vpmsdb");

$qry= "SELECT * FROM tblusers WHERE username= '$inputuname' OR vehiclereg='$inputRegNo'";
  $sel= mysqli_query($con,$qry);
  $count=mysqli_num_rows($sel);
  $qrysel= "SELECT * FROM tblcategory WHERE VehicleCat= '$inputCategoryname'";
  $selqry= mysqli_query($con,$qrysel);
  $countsel=mysqli_num_rows($selqry);

  if($countsel<=0)
  {
    $updateCat = "INSERT INTO tblcategory (VehicleCat) VALUES ('$inputCategoryname')";
    $updatecat_action=mysqli_query($con,$updateCat);
  }
  if($count>0)
  {
    $errMsg= "<span style='padding: 10px; background-color: #de6ecf; color:#fff; border-radius:10px;'>Username or Vehicle Registration already exists. Please click <a href='login.php'>here</a> to Login</span>";
  }
  else
  {
      $insert= "INSERT INTO tblusers (firstname, middlename, lastname, username, email, phone, residence, vehiclecategory, vehiclecompany, vehiclereg, password) VALUES('$fname','$mname','$inputlname','$inputuname','$email','$mobilenumber','$inputCounty','$inputCategoryname','$inputCompanyname','$inputRegNo','$inputPwd')";
      $add= mysqli_query($con,$insert);
      $errMsg="";
      if(isset($subscribing))
      {
        $update="UPDATE tblusers SET subscribed='$subscribing' WHERE vehiclereg='$inputRegNo'";
        $update_action=mysqli_query($con,$update);
        if($update_action)
        {
          $errMsg ="<span style='padding: 10px; background-color: green; color:#fff; border-radius:10px;'>Thank you for subscribing to our Notifications.</span>";
        }
        else
        {
          $errMsg="";
        }
      }
      if($insert)
      {
          echo "<script>alert('Successfully Registered, please login.'); window.location='login.php';</script>";
      }
  }
 }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>VPMS || Registration Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/bootstrap.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
  <style type="text/css">
      img {width:100%;}
      .text-class
      {
        margin-top: 40%;
      }
  </style>
</head>
<body>
  <section class="testimonial py-5" id="testimonial">
    <div class="container">
        <div class="row ">
            <div class="col-md-4 py-5 bg-primary text-white text-center ">
              <h2 class="py-3">VPMS Online Platform</h2>
                <div class="text-class">
                    <div class="card-body">
                        <img src="registration_bg.svg" style="width:30%">
                        <h2 class="py-3">Registration</h2>
                        <p style="color: rgba(255,255,255);">
                            Welcome to the Shariff's Parking System. Here, you are able to register as a User of the system so as to get first hand service and a personal touch of the System. You are able to secure the best parking places all by yourself, and at your convenience.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Please fill with your details to register</h4>
                <center><?php echo $errMsg; echo '<br>'; ?></center>
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <style type="text/css">
                        .col-md-12 h5
                        {
                            color: #5a635d;
                        }
                        .pb-4
                        {
                            color: #157ecf;
                            text-align: center;
                        }

                        .col-md-6 h6, .col-md-4 h6
                        {
                            background-color: #f51159;
                            border-radius: 8px;
                            margin-top: 10px;
                            color: #fff;
                        }
                    </style>
                    <div class="form-row">
                        <div class="col-md-12">
                            <h5><u>Personal Details</u></h5>
                        </div>
                        <div class="form-group col-md-4">
                          <label>First Name</label>
                            <input id="fname" name="fname" value="<?php echo $fname; ?>" placeholder="First Name" class="form-control" type="text" required>
                            <h6 id="fname_error"></h6>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Middle Name</label>
                          <input type="text" class="form-control" name="mname" id="inputmname" value="<?php echo $mname; ?>" placeholder="Middle Name" required>
                          <h6 id="mname_error"></h6>
                        </div>
                        <div class="form-group col-md-4">
                          <label>Last Name</label>
                          <input type="text" class="form-control" name="inputlname" id="inputlname" value="<?php echo $inputlname; ?>" placeholder="Last Name" required>
                          <h6 id="lname_error"></h6>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>User Name</label>
                          <input type="text" class="form-control" name="inputuname" id="inputUsername" value="<?php echo $inputuname; ?>" placeholder="User Name" required>
                          <h6 id="uname_error"></h6>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Email</label>
                          <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email" required>
                          <h6 id="email_error"></h6>
                        </div>
                      </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>Phone Number</label>
                            <input id="MobileNo" name="mobilenumber" value="<?php echo $mobilenumber; ?>" placeholder="Mobile No." class="form-control" type="text" required>
                            <h6 id="MobileNo_error"></h6>
                        </div>
                        <div class="form-group col-md-6">
                          <label>County of Residence</label>
                                  <select id="inputCounty" name="inputCounty" class="form-control"  value="<?php echo $inputCounty; ?>" style="height: 2.8em;" required>
                                    <option value="" selected>Choose County of Residence ...</option>
                                    <option value="baringo">Baringo</option>
                                    <option value="bomet">Bomet</option>
                                    <option value="bungoma">Bungoma</option>
                                    <option value="busia">Busia</option>
                                    <option value="elgeyo marakwet">Elgeyo Marakwet</option>
                                    <option value="embu">Embu</option>
                                    <option value="garissa">Garissa</option>
                                    <option value="homa bay">Homa Bay</option>
                                    <option value="isiolo">Isiolo</option>
                                    <option value="kajiado">Kajiado</option>
                                    <option value="kakamega">Kakamega</option>
                                    <option value="kericho">Kericho</option>
                                    <option value="kiambu">Kiambu</option>
                                    <option value="kilifi">Kilifi</option>
                                    <option value="kirinyaga">Kirinyaga</option>
                                    <option value="kisii">Kisii</option>
                                    <option value="kisumu">Kisumu</option>
                                    <option value="kitui">Kitui</option>
                                    <option value="kwale">Kwale</option>
                                    <option value="laikipia">Laikipia</option>
                                    <option value="lamu">Lamu</option>
                                    <option value="machakos">Machakos</option>
                                    <option value="makueni">Makueni</option>
                                    <option value="mandera">Mandera</option>
                                    <option value="meru">Meru</option>
                                    <option value="migori">Migori</option>
                                    <option value="marsabit">Marsabit</option>
                                    <option value="mombasa">Mombasa</option>
                                    <option value="muranga">Muranga</option>
                                    <option value="nairobi">Nairobi</option>
                                    <option value="nakuru">Nakuru</option>
                                    <option value="nandi">Nandi</option>
                                    <option value="narok">Narok</option>
                                    <option value="nyamira">Nyamira</option>
                                    <option value="nyandarua">Nyandarua</option>
                                    <option value="nyeri">Nyeri</option>
                                    <option value="samburu">Samburu</option>
                                    <option value="siaya">Siaya</option>
                                    <option value="taita taveta">Taita Taveta</option>
                                    <option value="tana river">Tana River</option>
                                    <option value="tharaka nithi">Tharaka Nithi</option>
                                    <option value="trans nzoia">Trans Nzoia</option>
                                    <option value="turkana">Turkana</option>
                                    <option value="uasin gishu">Uasin Gishu</option>
                                    <option value="vihiga">Vihiga</option>
                                    <option value="wajir">Wajir</option>
                                    <option value="pokot">West Pokot</option>
                                  </select>
                                  <h6 id="inputCounty_error"></h6>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <h5><u>Vehicle Details</u></h5>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Vehicle Type</label>
                          <input type="text" class="form-control" name="inputCategoryname" id="inputCategoryname" value="<?php echo $inputCategoryname; ?>" placeholder="Vehicle Category e.g Saloon Car, Lorry, Truck" required>
                          <h6 id="inputCategoryname_error"></h6>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Vehicle Make</label>
                          <input type="text" class="form-control" name="inputCompanyname" id="inputCompanyname" value="<?php echo $inputCompanyname; ?>" placeholder="Vehicle Company Name" required>
                          <h6 id="inputCompanyname_error"></h6>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Vehicle Registration Number</label>
                          <input type="text" class="form-control" name="inputRegNo" id="inputRegNo" value="<?php echo $inputRegNo; ?>" placeholder="Vehicle Registration Number" required>
                          <h6 id="inputRegNo_error"></h6>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-12">
                            <h5><u>Password Details</u></h5>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Type Password</label>
                          <input type="password" class="form-control" name="inputPwd" id="inputPwd" placeholder="Enter a Password" required>
                          <h6 id="inputPwd_error"></h6>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Confirm Password</label>
                          <input type="password" class="form-control" name="inputConfPwd" id="inputConfPwd" placeholder="Repeat the Password to confirm" required>
                          <h6 id="inputConfPwd_error"></h6>
                        </div>
                      </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="1" name="subscribing" id="invalidCheck2" checked="checked">
                                  <label class="form-check-label" for="invalidCheck2">
                                    <small>Subscribe to Our Emailing and SMS Services. By subscribing, you will recieve notifications of offers and notices.</small>
                                  </label>
                                </div>
                              </div>
                    
                          </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-success" onclick="return validate()">Register</button>&nbsp
                        <button type="reset" class="btn btn-danger">Clear Details</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <a href="/" class="btn btn-info">Login as User</a> &nbsp
                        <a href="../adminlogin.php" class="btn btn-primary">Login as Admin</a>
                    </div>
                </form>
                <script type="text/javascript">
                    function validate(){
                    var fname = document.getElementById('fname').value;
                    var mname = document.getElementById('inputmname').value;
                    var inputlname = document.getElementById('inputlname').value;
                    var inputuname = document.getElementById('inputUsername').value;
                    var email = document.getElementById('inputEmail4').value;
                    var mobilenumber = document.getElementById('MobileNo').value;
                    var inputCounty = document.getElementById('inputCounty').value;
                    var inputCategoryname = document.getElementById('inputCategoryname').value;
                    var inputCompanyname = document.getElementById('inputCompanyname').value;
                    var inputRegNo = document.getElementById('inputRegNo').value;
                    var inputPwd = document.getElementById('inputPwd').value;
                    var inputConfPwd = document.getElementById('inputConfPwd').value;
                    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
                    
                    var valid=true;

                    if(fname == ""){
                        valid = false;
                        document.getElementById('fname_error').innerHTML = "Please input your First Name.";
                        document.getElementById('fname_error').style.padding = "10px";
                        document.getElementById('fname').focus();
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('fname_error').innerHTML = "";
                    }

                    if(mname == ""){
                        valid = false;
                        document.getElementById('mname_error').innerHTML = "Please input Middle Name.";
                        document.getElementById('mname_error').style.padding = "10px";
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('mname_error').innerHTML = "";
                    }

                    if(inputlname == ""){
                        valid = false;
                        document.getElementById('lname_error').innerHTML = "Please input your Last Name.";
                        document.getElementById('lname_error').style.padding = "10px";
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('lname_error').innerHTML = "";
                    }

                    if(inputuname == ""){
                        valid = false;
                        document.getElementById('uname_error').innerHTML = "Please input your User Name.";
                        document.getElementById('uname_error').style.padding = "10px";
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('uname_error').innerHTML = "";
                    }

                    if(email == ""){
                        valid = false;
                        document.getElementById('email_error').innerHTML = "Please input your Email.";
                        document.getElementById('email_error').style.padding = "10px";
                    } else {
                        if(!emailRegex.test(email)){
                            valid = false;
                            document.getElementById('email_error').innerHTML = "invalid Email.";
                        }
                               valid = true;
                            document.getElementById('email_error').innerHTML = "";
                    }
                    if(mobilenumber == ""){
                        valid = false;
                        document.getElementById('MobileNo_error').innerHTML = "Please input your Mobile Number.";
                        document.getElementById('MobileNo_error').style.padding = "10px";
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('MobileNo_error').innerHTML = "";
                    }

                    if(inputCounty == ""){
                        valid = false;
                        document.getElementById('inputCounty_error').innerHTML = "Please Choose a County.";
                        document.getElementById('inputCounty_error').style.padding = "10px";
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('inputCounty_error').innerHTML = "";
                    }

                    if(inputCategoryname == ""){
                        valid = false;
                        document.getElementById('inputCategoryname_error').innerHTML = "Please input your Vehicle category.";
                        document.getElementById('inputCategoryname_error').style.padding = "10px";
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('inputCategoryname_error').innerHTML = "";
                    }

                    if(inputCompanyname == ""){
                        valid = false;
                        document.getElementById('inputCompanyname_error').innerHTML = "Please input your Vehicle Company.";
                        document.getElementById('inputCompanyname_error').style.padding = "10px";
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('inputCompanyname_error').innerHTML = "";
                    }


                    if(inputRegNo == ""){
                        valid = false;
                        document.getElementById('inputRegNo_error').innerHTML = "Please input your Vehicle Registration Number.";
                        document.getElementById('inputRegNo_error').style.padding = "10px";
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('inputRegNo_error').innerHTML = "";
                    }

                    if(inputPwd == "" ){
                        valid = false;
                        document.getElementById('inputPwd_error').innerHTML = "Please enter a password.";
                        document.getElementById('inputPwd_error').style.padding = "10px";
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('inputPwd_error').innerHTML = "";
                    }

                    if(inputConfPwd == "" ){
                        valid = false;
                        document.getElementById('inputConfPwd_error').innerHTML = "Please Confirm Your password.";
                        document.getElementById('inputConfPwd_error').style.padding = "10px";
                    }
                    else
                    {
                           valid = true;
                        document.getElementById('inputConfPwd_error').innerHTML = "";
                    }

                    if(inputPwd != inputConfPwd){
                        valid = false;
                        document.getElementById('inputConfPwd_error').innerHTML = "Both passwords must be same.";
                        document.getElementById('inputConfPwd_error').style.padding = "10px";
                    }

                    return valid;
                }
                </script>
            </div>
        </div>
    </div>
</section>
</body>
</html>