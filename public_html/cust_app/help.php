<?php

session_start();


include ('../conn.php');


if(!isset($_SESSION["userdata_c"]))
{
		if(!isset($_GET['username']))
		{
			exit();
		}
		else
		{
			$username = $_GET['username'];
			$sql = "SELECT * FROM customers WHERE email = '$username'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$_SESSION["username"] = $row['email'];
				$_SESSION["userdata_c"] = $row;
				$_SESSION["welcome"] = 1;
			}
			else
			{
				exit();
			}
		}
}


	function getSettings($conn, $key)
	{
	    	$sql = "SELECT * FROM settings WHERE key_id = '$key' ";
			$result =  $conn->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				
			    return $row['value'];
				
			}
			else
			{
				return 0;
			}
	}
	
	
	if(isset($_POST['send_msg']))
	{
	    $name = $_POST['fullname'];
	    $mobile = $_POST['mobile'];
	    $msg = $_POST['msg'];
	    $email = $_SESSION["username"];
	    
	    $sql = "INSERT INTO messages SET fullname = '$name', email = '$email', mobile = '$mobile', msg = '$msg'";
	    if($conn->query($sql))
	    {
	        echo "<script>alert('Message sent successfully.')</script>";
	    }
	    else
	    {
	        echo "<script>alert('Something went wrong.')</script>";
	    }
	}
		
		



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <link rel="icon" type="image/png" href="img/fav.png">
    <title>Swiggiweb - Online Food Ordering Website Template</title>
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick-theme.min.css" />
    <!-- Feather Icon-->
    <link href="vendor/icons/feather.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="vendor/sidebar/demo.css" rel="stylesheet">
    <script src="../vendor_app/assets/js/RdataTB.js"></script>
    <style>
         th { 
    display: none;
	}
        	.modal-dialog {
                margin-top: 11vh;
            }

            .form-select{
                display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            }

    </style>
</head>

<body class="fixed-bottom-bar">
   
   
      


    <div class="container position-relative" style="margin-top: 4rem!important;">
            <div class="py-5 osahan-profile row">
               
                <div class="col-md-8 mb-3">
                    <div class="rounded shadow-sm">
                        <div class="osahan-cart-item-profile bg-white rounded shadow-sm p-4">
                            <div class="flex-column">
                                <h6 class="font-weight-bold">Reach Us</h6>
                                <p class="text-muted">Whether you have questions or you would just like to say hello, contact us.</p>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="small font-weight-bold">Your Name</label>
                                        <input required type="text" class="form-control" name="fullname" id="exampleFormControlInput1" placeholder="Full Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2" class="small font-weight-bold">Email Address</label>
                                        <input required type="email" class="form-control" name="email" id="exampleFormControlInput2" value="<?php echo $username; ?>" readonly placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput3" class="small font-weight-bold">Phone Number</label>
                                        <input required type="number" class="form-control" name="mobile" id="exampleFormControlInput3" placeholder="Mobile">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="small font-weight-bold">HOW CAN WE HELP YOU?</label>
                                        <textarea required class="form-control" name="msg" id="exampleFormControlTextarea1" placeholder="Hi there, I would like to ..." rows="3"></textarea>
                                    </div>
                                    <button type="submit" name="send_msg" class="btn btn-primary btn-block" >SUBMIT</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- slick Slider JS-->
    <script type="text/javascript" src="vendor/slick/slick.min.js"></script>
    <!-- Sidebar JS-->
    <script type="text/javascript" src="vendor/sidebar/hc-offcanvas-nav.js"></script>
    <!-- Custom scripts for all pages-->
    <script type="text/javascript" src="js/osahan.js"></script>
   
   

   
<script>



function foo(elmnt){
        console.log(elmnt.id);
        parent.postMessage(elmnt.id, "*");
    }
    
    
  
    

</script>


</body>

</html>