<?php
//include the connection details
//include "config.php";
//initializing all variables to null, a way to secure the data
$inputuname = $inputPwd= $errMsg = $loginMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function check_inputData($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  $inputuname = check_inputData($_POST["inputuname"]);
  $inputPwd = check_inputData($_POST["inputPwd"]);
  $inputPwd=md5($inputPwd);
 if(empty($inputuname) || empty($inputPwd))
 {
  $errMsg = "<p style='color: red;'>Please enter all the required fields</p>";
 }
 else
 {
include "connect.php";
$qry= "SELECT * FROM tblusers WHERE username= '$inputuname' AND password='$inputPwd'";
  $sel= mysqli_query($con,$qry);
  $count=mysqli_num_rows($sel);
  if($count>0)
  {
    $_SESSION['user'] = $inputuname;
    header("Location: homepage.php");
  }
  else
  {
     echo "<script>alert('Login Failed. Incorrect Username or Password');history.back();</script>";
  }
 }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>VPMS || Login Page</title>
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
  <section class=" py-5" id="login">
    <br>
    <br>
    <div class="container">
        <div class="row ">
            <div class="col-md-4 py-5 bg-primary text-white text-center ">
              <h2 class="py-3">VPMS Online Platform</h2>
                <div class=" ">
                    <div class="card-body">
                        <img src="registration_bg.svg" style="width:30%">
                        <h2 class="py-3">Login</h2>
                        <p style="color: rgba(255,255,255);">
                            Enter your Login Details so that the System can Verify your Authnticity to use it
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Please login with your details</h4>
                <center><?php echo $errMsg; echo '<br>'; if(isset($loginMsg)){echo $loginMsg;} ?></center>
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
                        <div class="form-group col-md-6">
                          <label>User Name</label>
                          <input type="text" class="form-control" name="inputuname" id="inputUsername" value="<?php echo $inputuname; ?>" placeholder="User Name">
                          <h6 id="uname_error"></h6>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Password</label>
                          <input type="password" class="form-control" name="inputPwd" id="inputPwd" placeholder="Enter your Password">
                          <h6 id="inputPwd_error"></h6>
                        </div>
                      </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-success" onclick="return validate()">Login</button>&nbsp
                        <button type="reset" class="btn btn-danger">Clear Details</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        <a href="registration.php" class="btn btn-info">Register</a> &nbsp
                        <a href="../index.php" class="btn btn-primary">Home</a>
                    </div>
                </form>
                <script type="text/javascript">
                    function validate(){
                    var inputuname = document.getElementById('inputUsername').value;
                    var inputPwd = document.getElementById('inputPwd').value;
                    
                    var valid=true;

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

                    return valid;
                }
                </script>
            </div>
        </div>
    </div>
</section>
</body>
</html>