<?php
//checking connection and connecting to a database
require_once('connection/config.php');
//Connect to mysqli server
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
	if(!$conn) {
		die('Failed to connect to server: ' . mysqli_error());
	}
	
	
//retrive promotions from the specials table
$result=mysqli_query($conn,"SELECT * FROM specials")
or die("There are no records to display ... \n" . mysqli_error()); 
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysqli_query($conn,"SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-flex align-items-center fixed-top topbar-transparent">
    <div class="container text-right">
      <i class="icofont-phone"></i> +1 5589 55488 55
      <i class="icofont-clock-time icofont-rotate-180"></i> Mon-Sat: 11:00 AM - 10:00 PM
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.php"><span>Sadia's Kitchen</span></a></h1>
        
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>
  <li><a href="foodzone.php">Food Zone</a></li>
  <li><a href="specialdeals.php">Special Deals</a></li>
  <li><a href="member-index.php">My Account</a></li>
  <li><a href="contactus.php">Contact Us</a></li>

          
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
   <!-- ======= Hero Section ======= -->
  <section id="hero" style="height: 60vh">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background: url(assets/img/slide/slide-1.jpg);">
            <div class="carousel-container">
             
            </div>
          </div>
        </div>

      </div>
    </div>
  </section><!-- End Hero -->
<main id="main">

    

    <!-- ======= Whu Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="section-title">
  <h1>SPECIAL DEALS</h1>
  <hr>
  <p>Check out our special deals below. These are for a limited time only. Make your decision now.</p>
  <h3>Note: In order to create your order, please go to Food Zone and choose Specials under categories list.</h3>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<table width="850" align="center">
        <tr>
                <th>Promo Photo</th>
                <th>Promo Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Promo Price</th>
        </tr>
        <?php
                $symbol=mysqli_fetch_assoc($currencies); //gets active currency
                while ($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo '<td><a href=images/'. $row['special_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['special_photo']. ' width="80" height="70"></a></td>';
                    echo "<td>" . $row['special_name']."</td>";
                    echo "<td>" . $row['special_start_date']."</td>";
                    echo "<td>" . $row['special_end_date']."</td>";
                    echo "<td>" . $symbol['currency_symbol']. "" . $row['special_price']."</td>";
                    echo "</td>";
                    echo "</tr>";
                    }
            mysqli_free_result($result);
            mysqli_close($conn);
?>
</table>
  </div>
          </div>

          

        </div>

      </div>
    </section><!-- End Whu Us Section -->

   

  </main><!-- End #main -->

  <?php include 'footer.php' ?>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>