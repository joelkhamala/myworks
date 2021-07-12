<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $username=$_POST['username'];
	$password=md5($_POST['password']);
	$email=$_POST['email'];
	$mobno=$_POST['mobno'];
	$adminName=$_POST['adminName'];

     
    $query=mysqli_query($con, "insert into  tbladmin(UserName,Password,Email,MobileNumber,AdminName) value('$username','$password','$email','$mobno','$adminName')");
    if ($query) {
    $msg="User has been added.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

  
}
  ?>
<!doctype html>
<html class="no-js" lang="">
<head>
    
    <title>VPMS - Add Users</title>
   

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
   
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Registration Panel</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                 
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            
                           
                        </div> <!-- .card -->

                    </div><!--/.col-->

              

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Register </strong> Users
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>                  <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Admin Name/Full Names</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="adminName" name="adminName" class="form-control" placeholder="Full Names" required="true"></div>
                                    </div>
                                   
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">User Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="username" name="username" class="form-control" placeholder="UserName" required="true"></div>
                                    </div>
									 <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Password</label></div>
                                        <div class="col-12 col-md-9"><input type="password" id="password" name="password" class="form-control" placeholder="Password" required="true"></div>
                                    </div>
									 <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Email</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="email" name="email" class="form-control" placeholder="Email" required="true"></div>
                                    </div>
									 <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mobile Number</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="mobno" name="mobno" class="form-control" placeholder="Mobile No" required="true"></div>
                                    </div>
                                 
                                    
                                    
                                   <p style="text-align: center;"> <button type="submit" class="btn btn-primary btn-sm" name="submit" >Register</button></p>
                                </form>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="col-lg-6">
                        
                  
                </div>

           

            </div>


        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

   <?php include_once('includes/footer.php');?>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
<?php   ?>