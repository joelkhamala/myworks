<?php
if($count>0)
  {
    echo "Record already exists. Please click <a href='login.php'>here</a> to Login";
  }
  else
  {
      $insert= "INSERT INTO tblusers (firstname, middlename, lastname, username, email, phone, residence, vehiclecategory, vehiclecompany, vehiclereg, password) VALUES('$fname','$mname','$inputlname','$inputuname','$email','$mobilenumber','$inputCounty','$inputCategoryname','$inputCompanyname','$inputRegNo','$inputPwd')";
      $add= $con->prepare($insert);
      $add->execute();
      if(isset($subscribing))
      {
        $update="UPDATE tblusers SET subscribed='$subscribing' WHERE vehiclereg='$inputRegNo'";
        
      }
  }
  ?>