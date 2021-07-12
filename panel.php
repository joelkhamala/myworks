<div class="row">

      <!-- Icon Cards-->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
            <div class="inforide">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-4 rideone">
                    <img src="logo2.png" width="100px">
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                    <h4>Available Spaces</h4>
                    <?php
                      $user = $_SESSION['user'];
                      $selSpace = "SELECT * FROM spaces WHERE booked='0'";
                      $qrySpace= mysqli_query($con,$selSpace);
                      $countSpace=mysqli_num_rows($qrySpace);
                    ?>
                    <h2><?php echo $countSpace; ?></h2>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
            <div class="inforide">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridetwo">
                    <img src="logo2.png" width="100px">
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                    <h4>Parking frequency</h4>
                    <?php
                      $selPark = "SELECT * FROM tblvehicle WHERE OwnerName='$user'";
                      $selParkqry= mysqli_query($con,$selPark);
                      $countPark=mysqli_num_rows($selParkqry);
                    ?>
                    <h2><?php echo $countPark; ?></h2>
                </div>
              </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
            <div class="inforide">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridethree">
                    <img src="logo2.png" width="100px">
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                    <h4>Client Rating</h4>
<style type="text/css">
.stars
{
     text-align: right;
     margin-right: 20px;
}
 .stars i {
     font-size: 12px;
     color: #28a745;
     margin-right: 10px;
 }
 .prating {
     text-align: right;
     margin-right: 20px;
 }
 .prating .product-rating
 {
     font-size: 18px;
 }

</style>
                    <?php
// Update the details below with your MySQL details
$DATABASE_HOST = 'sql210.epizy.com';
$DATABASE_USER = 'epiz_28285137';
$DATABASE_PASS = 'F0rgeCpNBoo0PI';
$DATABASE_NAME = 'epiz_28285137_vpmsdb';
try {
    $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to database!');
}

$_GET['page_id']=1;
$stmt = $pdo->prepare('SELECT AVG(rating) AS overall_rating, COUNT(*) AS total_reviews FROM reviews WHERE page_id = ?');
    $stmt->execute([$_GET['page_id']]);
    $reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);
?>
  <div class="prating">
    <span class="product-rating"><?=number_format($reviews_info['overall_rating'], 1)?></span><span>/5</span>
  </div>
  <div class="stars">
   <?php for($i=0;$i<round($reviews_info['overall_rating']);$i++)
   {?>
    <i class="fa fa-star"></i>
    <?php
  }
    if($i<5)
    {
      for($i=0;$i<(5-round($reviews_info['overall_rating']));$i++)
      {
      ?>
      <i class="fa fa-star text-dark"></i>
    <?php
  }
    }
    ?>

  </div>
                </div>
              </div>
            </div>
        </div>
    </div>