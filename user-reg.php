<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['vpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $parkingnumber=mt_rand(100000000, 999999999);
    $catename=$_POST['catename'];
     $vehcomp=$_POST['vehcomp'];
    $vehreno=$_POST['vehreno'];
    $ownername=$_POST['ownername'];
    $ownercontno=$_POST['ownercontno'];
    $enteringtime=$_POST['enteringtime'];
    
     $sel =mysqli_query($con,"SELECT * FROM tblvehicle WHERE RegistrationNumber='$vehreno'");
    $count=mysqli_num_rows($sel);
    if($sel && $count>0)
    {
        $msg="<center><p style='background-color: RGB(251,53,58); border-radius: 10px; padding: 20px; width: 50%; color: white;'>Vehicle Registration Number already exists.</p></center>"; 
    }
    else
    {
        $query=mysqli_query($con, "insert into  tblvehicle(ParkingNumber,VehicleCategory,VehicleCompanyname,RegistrationNumber,OwnerName,OwnerContactNumber) value('$parkingnumber','$catename','$vehcomp','$vehreno','$ownername','$ownercontno')");
        if ($query) {
        echo "<script>alert('Vehicle Entry Detail has been added');</script>";
        echo "<script>window.location.href ='manage-incomingvehicle.php'</script>";
          }
        else
        {
         echo "<script>alert('Something Went Wrong. Please try again.');</script>";       
        }
    }
  
}
  ?>