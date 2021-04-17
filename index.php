<?php
//checking connection and connecting to a database
require_once('connection/config.php');
error_reporting(1);
//Connect to mysqli server
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
    if(!$conn) {
        die('Failed to connect to server: ' . mysqli_error());
    }
    
  
    
//retrieve questions from the questions table
$questions=mysqli_query($conn,"SELECT * FROM questions")
or die("Something is wrong ... \n" . mysqli_error());
?>
<?php
//setting-up a remember me cookie
    if (isset($_POST['Submit'])){
        //setting up a remember me cookie
        if($_POST['remember']) {
            $year = time() + 31536000;
            setcookie('remember_me', $_POST['login'], $year);
        }
        else if(!$_POST['remember']) {
            if(isset($_COOKIE['remember_me'])) {
                $past = time() - 100;
                setcookie(remember_me, gone, $past);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-flex align-items-center fixed-top topbar-transparent">
    <div class="container text-right">
      <i class="icofont-phone"></i> +15714571822
      <i class="icofont-clock-time icofont-rotate-180"></i> Mon-Sat: 11:00 AM - 10:00 PM
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><span>Sadia's Kitchen</span></a></h1>
      
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
   <!-- ======= Login Registration Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container">

        <div class="section-title">
           <h2>Login <span>Register Area</span></h2>
          
        </div>
        <div class="row">
<div class="col-lg-6">
  <h2>Register Here</h2>
       <form id="loginForm" name="loginForm" method="post" action="register-exec.php" onsubmit="return registerValidate(this)">
              <table width="450" border="0" align="center" cellpadding="2" cellspacing="0">
                
                <tr>
                  <th>First Name *</th>
                  <td><input name="fname" type="text" class="form-control" id="fname" /></td>
                </tr>
                <tr>
                  <th>Last Name *</th>
                  <td><input name="lname" type="text" class="form-control" id="lname" /></td>
                </tr>
                <tr>
                  <th width="124">Email *</th>
                  <td width="168"><input name="login" type="text" class="form-control" id="login" /></td>
                </tr>
                <tr>
                  <th>Password *</th>
                  <td><input name="password" type="password" class="form-control" id="password" /></td>
                </tr>
                <tr>
                  <th>Confirm Password *</th>
                  <td><input name="cpassword" type="password" class="form-control" id="cpassword" /></td>
                </tr>
				  <tr>
                  <th>Security Question </th>
                    <td><font color="#FF0000">* </font><select name="question" id="question">
                    <option value="select">- select question -
                    <?php 
                    //loop through quantities table rows
                    while ($row=mysqli_fetch_array($questions)){
                    echo "<option value=$row[question_id]>$row[question_text]"; 
                    }
                    ?>
                    </select></td>
                </tr>
                <tr>
                  <th>Security Answer</th>
                  <td><font color="#FF0000">* </font><input name="answer" type="text" class="textfield" id="answer" /></td>
                </tr>
                
               
                <tr>
                <td colspan="2"><input type="reset" class="btn btn-primary" value="Clear Fields"/>
                <input type="submit" class="btn btn-primary" name="Submit" value="Register" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
              </table>
            </form>
      </div>
<div class="col-lg-6">
  <h2>Login Here</h2>
        <form id="loginForm" name="loginForm" method="post" action="login-exec.php" onsubmit="return loginValidate(this)">
              <table width="290" border="0" align="center" cellpadding="2" cellspacing="0">
                
                <tr>
                  <td width="112"><b>Email</b></td>
                  <td width="188"><input name="login" type="text" class="form-control" id="login" /></td>
                </tr>
                <tr>
                  <td><b>Password</b></td>
                  <td><input name="password" type="password" class="form-control" id="password" /></td>
                </tr>
               
                <tr>
                    <td colspan="2"><input type="reset"class="btn btn-primary" value="Clear Fields"/>
                  <input type="submit" class="btn btn-primary"name="Submit" value="Login" /></td>
                </tr>
                <tr><td>&nbsp;</td></tr>
              </table>
            </form>
      </div>
    </div>
      </div>
    </section><!-- End Book A Table Section -->

  </main><!-- End #main -->

<?php include 'footer.php'; ?>

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