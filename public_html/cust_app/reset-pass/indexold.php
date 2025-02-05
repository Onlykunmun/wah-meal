<?php
include ('../../conn.php');

if(isset($_POST['email']))
{
    $email = $_POST['email'];
    
            $sql = "SELECT * FROM customers WHERE email = '$email'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
			    $user_data = $row;
			    
			    $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
	            $expDate = date("Y-m-d H:i:s",$expFormat);
	            $key = md5((2418*2).$email);
	            $addKey = substr(md5(uniqid(rand(),1)),3,10);
	            $key = $key . $addKey;
	            
	            $conn->query("INSERT INTO password_reset_temp SET email = '$email', key_id = '$key', expDate = '$expDate' ");
	            
	            
	            $output='<p>Dear '.$user_data["fullname"].',</p>';
                $output.='<p>Please click on the following link to reset your password.</p>';
                $output.='<p>-------------------------------------------------------------</p>';
                $output.='<p><a href="https://wahmeal.in/cust_app/reset-pass/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">https://wahmeal.in/cust_app/reset-pass/reset-password.php?key='.$key.'&email='.$email.'&action=reset</a></p>';		
                $output.='<p>-------------------------------------------------------------</p>';
                $output.='<p>Please be sure to copy the entire link into your browser.
                The link will expire after 1 day for security reason.</p>';
                $output.='<p>If you did not request this forgotten password email, no action 
                is needed, your password will not be reset.</p>';   	
                $output.='<p>Thanks,</p>';
                $output.='<p>Wah Meal </p>';
                
                $body = $output; 
                $subject = "Password Recovery - Wah Meal";
                
                $email_to = $email;
                $fromserver = "mcx@mcxcommodityresearchapp.com"; 
                require("PHPMailer/PHPMailerAutoload.php");
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = "mail.mcxcommodityresearchapp.com"; // Enter your host here
                $mail->SMTPAuth = true;
                $mail->Username = "mcx@mcxcommodityresearchapp.com"; // Enter your email here
                $mail->Password = "hackTHEplanet@123"; //Enter your password here
                $mail->Port = 25;
                $mail->IsHTML(true);
                $mail->From = "mcx@mcxcommodityresearchapp.com";
                $mail->FromName = "Wah Meal";
                $mail->Sender = $fromserver; // indicates ReturnPath header
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AddAddress($email_to);
                if(!$mail->Send()){
                    $mail_sent = 0; 
                }else{
                    $mail_sent = 1; 
                }
                
                echo "<script>alert('Email with password reset link sent to your registered email address.');</script>";
				
			}
			else
			{
			    $mail_sent = 0; 
				echo "<script>alert('User email not found!!!');</script>";
			}
    
}


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../img/fav.png">
    <title>Wah Meal - Forgot Password</title>
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
  <h1>Forgot Password</h1>
  <p style="color: #f1f1f1;">Enter your email address below and we'll send you an email with instructions on how to change your password.</p>
  
  
  <?php
  if(isset($_POST['email']) && $mail_sent == 1)
    {
  ?>
                        <div class="form-group">
                            <label>Password reset link sent</label>
                        </div>
   <button id="myBtn" href='javascript:history.go(-1)'>Go Back</button>
   
   <?php 
   
    } else {
    
    ?>
    
    <form action="" method="post" class="mt-5 mb-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your registered email address" required name="email">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">SEND</button>
  </form>
    
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
