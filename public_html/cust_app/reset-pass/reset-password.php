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
    	<b>Reset Password</b>
    </div>

</div>        


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

	

<div style="margin-top: 90px;" class="mx-4">

<form action="" method="post">

<div style="box-shadow: 5px 5px 10px gray; border-radius: 16px;">
	<div   class="form-field input-group mb-3">
    <div  class="input-group-prepend">
      <span  class="input-group-text"><i class="icon ion-key" ></i></span>
    </div>
    <input type="password" class="form-control" placeholder="Enter Password" required id="password" name="n_pwd">
  </div>
</div>  

<div style="box-shadow: 5px 5px 10px gray; border-radius: 16px;">
	<div   class="form-field input-group mb-3">
    <div  class="input-group-prepend">
      <span  class="input-group-text"><i class="icon ion-key" ></i></span>
    </div>
    <input type="password" class="form-control" placeholder="Confirm Password" required id="cpassword" name="r_pwd">
  </div>
</div> 

 <input type="hidden" name="email" value="<?php echo $email;?>"/>

<p style="color:gray !important; margin-left: 2px;">
  <input type="checkbox" onclick="showPwdSignup()" /> Show Password
</p>


  
  <button type="submit"  class="btn btn-primary w-100 mt-5 mb-2 login-csutom-btn">RESET</button>
  
</form>

</div>



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



<script>
    	function showPwdSignup()
	{
		var x = document.getElementById("password");
		if(x.type === "password")
		{
			x.type = "text";
		}
		else
		{
			x.type = "password";
		}

		var y = document.getElementById("cpassword");
		if(y.type === "password")
		{
			y.type = "text";
		}
		else
		{
			y.type = "password";
		}
	}
</script>

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
