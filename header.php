<!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
     <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
<style type="text/css">
  ul .nav-item
  {
    list-style: none;
    margin-left: -40px;
    line-height: 50px;
    text-align: center;
  }
</style>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav">

          <a class="nav-link navlogo text-center" href="#">
            <img src="logo2.png" width="100px">
          </a>

        <li class="nav-item">
          <a class="nav-link sidefrst" href="homepage.php">
            <span class="textside">Home Page</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link sidesecnd" href="parking.php">
            <span class="textside">Reserve Parking</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link sidesthrd" href="spending.php">
            <span class="textside">Mini-statement</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link sidesforth" href="how_to_book.php">
            <span class="textside">How To Book</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link sidesix" href="service.php">
            <span class="textside">Rate Our Services</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link sidesix" href="logout.php">
            <span class="textside">Logout</span>
          </a>
        </li>
      </ul>
      
      <ul class="navbar-nav2 ml-auto pull-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $_SESSION['user']; ?></a>
            <ul class="dropdown-menu">
                <li class="resflset"><a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
            </ul>
        </li>
      </ul>
      
    </div>
  </nav>
  <br>