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

  // Below function will convert datetime to time elapsed string.
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

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
// Page ID needs to exist, this is used to determine which reviews are for which page.
if (isset($_GET['page_id'])) {
    if (isset($_POST['name'], $_POST['rating'], $_POST['content'])) {
        // Insert a new review (user submitted form)
        $stmt = $pdo->prepare('INSERT INTO reviews (page_id, name, content, rating, submit_date) VALUES (?,?,?,?,NOW())');
        $stmt->execute([$_GET['page_id'], $_POST['name'], $_POST['content'], $_POST['rating']]);
        echo "<script>alert('Your review has been submitted!'); history.back();</script>";
    }
    // Get all reviews by the Page ID ordered by the submit date
    $stmt = $pdo->prepare('SELECT * FROM reviews WHERE page_id = ? ORDER BY submit_date DESC');
    $stmt->execute([$_GET['page_id']]);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Get the overall rating and total amount of reviews
    $stmt = $pdo->prepare('SELECT AVG(rating) AS overall_rating, COUNT(*) AS total_reviews FROM reviews WHERE page_id = ?');
    $stmt->execute([$_GET['page_id']]);
    $reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "<script>alert('Please provide the page ID'); history.back();</script>";
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
                    Rate Our Services
                </div>
                <div class="panel-body">
                  <style type="text/css">

                    .navtop {
    background-color: #3f69a8;
    height: 60px;
    width: 100%;
    border: 0;
}
.navtop div {
    display: flex;
    margin: 0 auto;
    width: 1000px;
    height: 100%;
}
.navtop div h1, .navtop div a {
    display: inline-flex;
    align-items: center;
}
.navtop div h1 {
    flex: 1;
    font-size: 24px;
    padding: 0;
    margin: 0;
    color: #ecf0f6;
    font-weight: normal;
}
.navtop div a {
    padding: 0 20px;
    text-decoration: none;
    color: #c5d2e5;
    font-weight: bold;
}
.navtop div a i {
    padding: 2px 8px 0 0;
}
.navtop div a:hover {
    color: #ecf0f6;
}
.content {
    width: 1000px;
    margin: 0 auto;
}
.content h2 {
    margin: 0;
    padding: 25px 0;
    font-size: 22px;
    border-bottom: 1px solid #ebebeb;
    color: #666666;
}
                    .reviews .overall_rating .num {
    font-size: 30px;
    font-weight: bold;
    color: #F5A624;
}
.reviews .overall_rating .stars {
    letter-spacing: 3px;
    font-size: 32px;
    color: #F5A624;
    padding: 0 5px 0 10px;
}
.reviews .overall_rating .total {
    color: #777777;
    font-size: 14px;
}
.reviews .write_review_btn, .reviews .write_review button {
    display: inline-block;
    background-color: #565656;
    color: #fff;
    text-decoration: none;
    margin: 10px 0 0 0;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 600;
    border: 0;
}
.reviews .write_review_btn:hover, .reviews .write_review button:hover {
    background-color: #636363;
}
.reviews .write_review {
    display: none;
    padding: 20px 0 10px 0;
}
.reviews .write_review textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    height: 150px;
    margin-top: 10px;
}
.reviews .write_review input {
    display: block;
    width: 250px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-top: 10px;
}
.reviews .write_review button {
    cursor: pointer;
}
.reviews .review {
    padding: 20px 0;
    border-bottom: 1px solid #eee;
}
.reviews .review .name {
    padding: 0 0 3px 0;
    margin: 0;
    font-size: 18px;
    color: #555555;
}
.reviews .review .rating {
    letter-spacing: 2px;
    font-size: 22px;
    color: #F5A624;
}
.reviews .review .date {
    color: #777777;
    font-size: 14px;
}
.reviews .review .content {
    padding: 5px 0;
}
.reviews .review:last-child {
    border-bottom: 0;
}


.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
  max-width: 100%;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
                  </style>
                    <h4 style="text-align: center;">Write a Review</h4><hr>
                    <div class="write_review">
                      <form action="" method="POST">
                        <div class="row">
                          <div class="col-md-5">
                            <input name="name" type="hidden" value="<?php echo $user; ?>">
                            <label for="email" class="mr-sm-2">Rating: </label>
                            <input name="rating" type="number" class="form-control mb-2 mr-sm-2"  min="1" max="5" placeholder="Rating (1-5)" required>
                            <label for="pwd" class="mr-sm-2">Message</label>
                            <textarea name="content" class="form-control mb-2 mr-sm-2" placeholder="Write your review here..." required></textarea>
                          </div>
                          <div class="col-md-7 text-center my-5 px-5 ">
                            <div class="overall_rating alert alert-info w-50 text-dark">
                              <h5>Overall Reviews</h5>
                              <span class="num"><?=number_format($reviews_info['overall_rating'], 1)?></span>
                              <span class="stars"><?=str_repeat('&#9733;', round($reviews_info['overall_rating']))?></span>
                              <span class="total"><?=$reviews_info['total_reviews']?> reviews</span>
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <button type="submit" class="btn btn-primary mb-2">Submit Review</button>
                          </div>
                        </div>
                      </form>
                    </div>
                      <?php foreach ($reviews as $review): ?>
                      <div class="review alert container">
                          <h3 class="name"><?=htmlspecialchars($review['name'], ENT_QUOTES)?></h3>
                          <div>
                              <span class="rating"><?=str_repeat('&#9733;', $review['rating'])?></span>
                              <span class="date time-right"><?=time_elapsed_string($review['submit_date'])?></span>
                          </div>
                          <p class="content"><?=htmlspecialchars($review['content'], ENT_QUOTES)?></p>
                      </div>
                      <?php endforeach ?>
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