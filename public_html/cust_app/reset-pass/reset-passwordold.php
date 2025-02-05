<?php
include ('../../conn.php');
$pwd_success = 0;
?>


<?php
    if(isset($_POST["update"]))
    { 
        
         $n_pwd = $_POST['n_pwd'];
	     $r_pwd = $_POST['r_pwd'];
	     $email = $_POST["email"];
	     
	     if($n_pwd == $r_pwd)
	     {
	        $proceed = 1;
	     }
	     else
	     {
	        $proceed = 0;
	     }
	     
	     
	     if($proceed == 1)
	        {
	            $n_pwd = md5($n_pwd);
	            $sql = "UPDATE customers SET password = '$n_pwd' WHERE email = '$email' ";
	            if($conn->query($sql))
	            {
	                $pwd_success = 1;
	                $conn->query("DELETE FROM password_reset_temp WHERE email = '$email' ");
	                echo "<script>alert('Password updated successfully.')</script>";
	            }
	            else
	            {
	                
	                echo "<script>alert('Something went wrong.')</script>";
	            }
	        }
	        else
	        {
	             echo "<script>alert('Password does not matched.')</script>";
	        }
        
        
    }

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../img/fav.png">
    <title>Wah Meal - Password Reset</title>
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="../vendor/slick/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/slick/slick-theme.min.css" />
    <!-- Feather Icon-->
    <link href="../vendor/icons/feather.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="../vendor/sidebar/demo.css" rel="stylesheet">
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial;
  font-size: 17px;
}

#myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
}

.content {
  position: fixed;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
}

#myBtn {
  width: 200px;
  font-size: 18px;
  padding: 10px;
  border: none;
  background: #000;
  color: #fff;
  cursor: pointer;
}

#myBtn:hover {
  background: #ddd;
  color: black;
}
</style>
</head>
<body>

<video autoplay muted loop id="myVideo">
  <source src="../img/bg.mp4" type="video/mp4">
  Your browser does not support HTML5 video.
</video>

<div class="content login-page">
  <h1>Reset Password</h1>
  
  <?php
  
  if($pwd_success == 0)
  {
  
  if (isset($_GET["key"]) && isset($_GET["email"])
&& isset($_GET["action"]) && ($_GET["action"]=="reset")
&& !isset($_POST["action"]))

{
    
    $key = $_GET["key"];
$email = $_GET["email"];
$curDate = date("Y-m-d H:i:s");

 $sql = "SELECT * FROM password_reset_temp WHERE email = '$email' AND key_id = '$key' ";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    $row = $result->fetch_assoc();
			    
			    if(date("Y-m-d H:i:s", strtotime($row['expDate'])) >= $curDate)
			    {
    
    ?>
  
  <p style="color: #f1f1f1;">Create your new password.</p>
  
 <form action="" method="post"  class="mt-5 mb-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="New Password" required name="n_pwd">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Retype Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Retype Password" required name="r_pwd">
                        </div>
                        
                        <input type="hidden" name="email" value="<?php echo $email;?>"/>
                        <button type="submit" name="update" class="btn btn-primary btn-lg btn-block">CHANGE</button>
  </form>
<?php } else { ?>

                        <div class="form-group">
                            <label>The link is expired.</label>
                        </div>

<?php } } else { ?>

                        <div class="form-group">
                            <label>The link is invalid.</label>
                        </div>

<?php } } } else { ?>


                        <div class="form-group">
                            <label>New password updated.</label>
                        </div>


<?php } ?>




</div>

 <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- slick Slider JS-->
    <script type="text/javascript" src="../vendor/slick/slick.min.js"></script>
    <!-- Sidebar JS-->
    <script type="text/javascript" src="../vendor/sidebar/hc-offcanvas-nav.js"></script>
    <!-- Custom scripts for all pages-->
    <script type="text/javascript" src="../js/osahan.js"></script>

</body>
</html>
