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
 .element {
          background-image: linear-gradient(#4C6034, #BCDD5A);   
          color: white;
          width: 100%;
          height: 200px;
          margin:0;
          
        }
        
        .element-1 {
          border-bottom-left-radius: 50px;
        }
        
        
        
        .form-field input {
          border: 1px solid gray !important;
          border-left:none !important;
          text-align: center;
          width: 100%;
          border-radius: 16px;
          height: 36px;
          background: #fff;
          color: gray;
          outline: none !important;
          transition: all 0.2s;
          height:36px;
        }
        
        input:focus
        {
            box-shadow: none !important;
            border: 1px solid gray !important;
            border-left:none !important;
        }
        
        .input-group-text{
        
        border-top-left-radius:16px; 
        border-bottom-left-radius:16px;
        box-shadow: 0px 5px 100px gray;
        height:36px;
        background: #fff;
         border: 1px solid gray !important;
         border-right:none !important;
        }
        
        .login-csutom-btn{
          border-radius: 16px;
            background-image: linear-gradient(#4C6034, #BCDD5A); 
            border-color:#BCDD5A !important;
            height: 36px;
        }
        
        .btn:focus, .btn:active:focus, .btn.active:focus{
            outline:none;
            box-shadow:none;
        }
</style>
</head>
<body>

<div class="element element-1">

	<div class="d-flex justify-content-center ">
   		<div class="mt-5">
        	<img style="width:80px;" class="rounded-circle" src="admin.jpg" />
        </div>
	</div>
    
    <div class="d-flex justify-content-end px-3 mt-4">
    	<b>Reset Your Password</b>
    </div>

</div>        

	

<div style="margin-top: 90px;" class="mx-4">


<form action="" method="post">

<div style="box-shadow: 5px 5px 10px gray; border-radius: 16px;">
	<div   class="form-field input-group mb-3">
    <div  class="input-group-prepend">
      <span  class="input-group-text"><i class="icon ion-email" ></i></span>
    </div>
    <input required type="email" class="form-control" placeholder="Enter Email" id="email" name="email">
  </div>
</div>  

 




  
  <button type="submit"  class="btn btn-primary w-100 mt-5 mb-2 login-csutom-btn">RESET</button>
  
</form>

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
