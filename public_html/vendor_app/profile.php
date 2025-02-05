<?php

session_start();

include ('../conn.php');

if(!isset($_SESSION["userdata"]))
{
		if(!isset($_GET['username']))
		{
			exit();
		}
		else
		{
			$username = $_GET['username'];
			$sql = "SELECT * FROM vendors WHERE email = '$username'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$_SESSION["username"] = $row['email'];
				$_SESSION["userdata"] = $row;
				$_SESSION["welcome"] = 1;
			}
			else
			{
				exit();
			}
		}
}




?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Portal - Vendor</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

    <style>
        th { 
    display: none;
}
    </style>

</head> 

<body class="app">   	


<?php

if( isset($_POST['password']) && $_POST['password'] != "" && isset($_POST['cpassword']) && $_POST['cpassword'] && $_POST['oldpassword'] )
{
	
	
    if($_POST['password'] == $_POST['cpassword'])
    {
        if($_SESSION["userdata"]["password"] == md5($_POST["oldpassword"]))
        {
            $password = md5($_POST['password']); 
            $userid = $_SESSION["userdata"]["id"];
            $sql_pwd = "UPDATE vendors SET password = '".$password."' WHERE id = '$userid'";
	        if($conn->query($sql_pwd))
	        {
                $_SESSION["userdata"]["password"] = $password;
		        echo "<script>alert('Password changed successfully');</script>";
	        } 
        }
        else
        {
            echo "<script>alert('Incorrect current password.');</script>";
        }
    }
    else
    {
        echo "<script>alert('Password does not matched.');</script>";
    }
}




if(isset($_POST['available_settings']) && $_POST['available_settings'] != "")
{
    $type = $_POST['available_settings'];
     $userid = $_SESSION["userdata"]["id"];
    if($type == 0)
    {
        $sql_chk = "SELECT * FROM vendor_unavailable_request WHERE vendor_id = '$userid' AND status = '0' ";
        $result_chk = $conn->query($sql_chk);
        if ($result_chk->num_rows == 0) {
            
            $sql = "INSERT INTO vendor_unavailable_request SET vendor_id = '$userid'";
            if($conn->query($sql))
	        {
		        echo "<script>alert('Beign unavailable requested successfully');</script>";
	        } 
	        else
	        {
	            echo "<script>alert('Something went wrong!!!');</script>";
	        }
            
        }
        else
        {
                echo "<script>alert('You have already a unavailable request pending!!!');</script>";
        }
    }
    else
    {
            $sql = "UPDATE vendors SET is_available = '1' WHERE id = '$userid'";
	        if($conn->query($sql))
	        {
                $_SESSION["userdata"]["is_available"] = 1;
		        echo "<script>alert('You are now available to take the orders.');</script>";
	        } 
    }
}







?>


    
    <div class="app-wrapper mt-5">
	    
	    <div class="app-content ">
		    <div class="container">
			    

            <div class="row g-4 mb-4 settings-section">                
				   

            <div class="col-12 col-md-4">
		                <h3 class="section-title">General Profile</h3>
                        <div class="section-intro">General profile section includes your profile data like are follows:</div>

	        </div>


            <div class="col-12 col-md-12">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" method="post">
								    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Full Name</label>
									    <input type="text" class="form-control"  value="<?php echo $_SESSION['userdata']['fullname']; ?>" readonly >
									</div>
									<div class="mb-3">
									    <label for="setting-input-1" class="form-label">Email</label>
									    <input type="email" class="form-control"  value="<?php echo $_SESSION['userdata']['email']; ?>" readonly >
									</div>
								    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Contact Number</label>
									    <input type="text" class="form-control"  value="<?php echo $_SESSION['userdata']['phone']; ?>" readonly >
									</div>

                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Current Password</label>
									    <input type="password" class="form-control"  value="" name="oldpassword"   required >
									</div> 

                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">New Password</label>
									    <input type="password" class="form-control"  value="" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"  required >
									</div> 
                                    
                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Confirm Password</label>
									    <input type="password" class="form-control"  value="" name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"  required >
									</div> 


									<button type="submit" class="btn app-btn-primary w-100" >Save Changes</button>
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	            </div>
				   
			</div>


            <div class="col-12 col-md-4">
		                <h3 class="section-title">Company Profile</h3>
                        <div class="section-intro">Company profile section includes your company data like are follows:</div>

	        </div>


            <div class="col-12 col-md-12 mt-4">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form">
                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Business Name</label>
									    <input type="text" class="form-control"  value="<?php echo $_SESSION['userdata']['business_name']; ?>" readonly >
									</div>
									<div class="mb-3">
									    <label for="setting-input-1" class="form-label">Business Location - City</label>
									    <input type="text" class="form-control"  value="<?php echo $_SESSION['userdata']['business_city']; ?>" readonly >
									</div>
								    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Business Location - PIN</label>
									    <input type="text" class="form-control"  value="<?php echo $_SESSION['userdata']['business_pin']; ?>" readonly >
									</div>
                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Business Complete Address</label>
									    <textarea style="height:80px;" class="form-control"   readonly ><?php echo $_SESSION['userdata']['business_address']; ?></textarea>
									</div>
                                    
                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Business Location</label>
                                         <div class="form-control w-100" id="mapholder"></div>   
                                    </div>
                                    
                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Business Logo</label>
									    <img src="uploads/logo/<?php echo $_SESSION['userdata']['logo']; ?>" class="rounded mx-auto d-block img-thumbnail" alt="...">
									</div>

                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Business Caption</label>
									    <input type="text" class="form-control"  value="<?php echo $_SESSION['userdata']['business_caption']; ?>" readonly >
									</div>
                                    
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	        </div>
				   
			             
			             
			<div class="col-12 col-md-4 mt-4">
		                <h3 class="section-title">Availabity Settings</h3>
                        <div class="section-intro">You can request for being unavailable to the Admin:</div>

	        </div>


            <div class="col-12 col-md-12 mt-4 mb-5">
		                <div class="app-card app-card-settings shadow-sm p-4">
						    
						    <div class="app-card-body">
							    <form class="settings-form" method="POST" action>
							        
                                    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Available/Unavailable</label>
									    <select class="form-select" name="available_settings">
                                            <option value="0" <?php if($_SESSION['userdata']['is_available'] == 0){ echo "selected"; } ?> >Unavailable</option>
                                            <option value="1" <?php if($_SESSION['userdata']['is_available'] == 1){ echo "selected"; } ?> >Available</option>
                                        </select>
									</div>
								
								    <div class="mb-3">
									    
									</div>
									
									<button type="submit" class="btn app-btn-primary w-100" >Save Changes</button>
                                 
                                    
							    </form>
						    </div><!--//app-card-body-->
						    
						</div><!--//app-card-->
	        </div>

           


			  
                </div><!--//row-->   
			  
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    
	    
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->

    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

    <script async defer src="https://maps.google.com/maps/api/js?key=&callback=showPosition"></script>

<script>

function showPosition() {
  var lat = '<?php echo $_SESSION['userdata']['lat']; ?>';
  var lon = '<?php echo $_SESSION['userdata']['lng']; ?>';
  var latlon = new google.maps.LatLng(lat, lon)
  var mapholder = document.getElementById("mapholder")
  mapholder.style.height = "250px";
  mapholder.style.width = "280px";

  var myOptions = {
    center:latlon,zoom:14,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:false,
    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
  }
    
  var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
  var marker = new google.maps.Marker({position:latlon,map:map,title:"My Business Location"});
}


</script>

</body>
</html> 

