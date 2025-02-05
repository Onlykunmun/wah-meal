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



	if(isset($_POST['update_profile']))
	{
	    $name = $_POST['fullname'];
	    $phone = $_POST['phone'];
	    $address = $_POST['address'];
	    $email = $_SESSION["username"];
	    $lat = $_POST['lat'];
	    $lng = $_POST['lng'];
	    
	    $sql = "UPDATE customers SET fullname = '$name',  phone = '$phone', address = '$address', lat = '$lat', lng = '$lng' WHERE email = '$email' ";
	    if($conn->query($sql))
	    {
	        $sql = "SELECT * FROM customers WHERE email = '$email'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$_SESSION["username"] = $row['email'];
				$_SESSION["userdata_c"] = $row;
				$_SESSION["welcome"] = 1;
			}
	        echo "<script>alert('Profile updated successfully.')</script>";
	    }
	    else
	    {
	        echo "<script>alert('Something went wrong.')</script>";
	    }
	}
	


	if(isset($_POST['update_password']))
	{
	    $c_pwd = md5($_POST['c_pwd']);
	    $n_pwd = $_POST['n_pwd'];
	    $r_pwd = $_POST['r_pwd'];
	    $email = $_SESSION["username"];
	    
	    if($n_pwd == $r_pwd)
	    {
	        $proceed = 1;
	    }
	    else
	    {
	        $proceed = 0;
	    }
	    
	    if($c_pwd == $_SESSION["userdata_c"]['password'])
	    {
	        if($proceed == 1)
	        {
	            $n_pwd = md5($n_pwd);
	            $sql = "UPDATE customers SET password = '$n_pwd' WHERE email = '$email' ";
	            if($conn->query($sql))
	            {
	                $sql = "SELECT * FROM customers WHERE email = '$email'";
		        	$result = $conn->query($sql);
		        	if ($result->num_rows > 0) {
		        		$row = $result->fetch_assoc();
		        		$_SESSION["username"] = $row['email'];
		        		$_SESSION["userdata_c"] = $row;
		        		$_SESSION["welcome"] = 1;
		        	}
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
	    else
	    {
	        echo "<script>alert('Wrong current password.')</script>";
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
            
                                    .custom-map-control-button {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  height: 40px;
  cursor: pointer;
      left: 200px !important;
        outline: none !important;

}
.custom-map-control-button:hover {
  background: #ebebeb;
}
 

    </style>
</head>

<body class="fixed-bottom-bar">
   
   
      


    <div class="container position-relative" style="margin-top: 4rem!important;">
        
        <div class="py-2">
        
                 <div class="d-flex align-items-center mt-1">
                    <h3 class="font-weight-bold text-dark mb-0">Profile</h3>
                    <a id="logout" onclick="foo(this);" class="ml-auto btn btn-danger text-white">Logout</a>
                </div>
        </div>
        
            <div class="py-5 osahan-profile row">
                
               
               
                <div class="col-md-8 mb-3">
                    <div class="rounded shadow-sm">
                        <div class="osahan-cart-item-profile bg-white rounded shadow-sm p-4">
                            <div class="flex-column">
                                <h6 class="font-weight-bold">Update Profile Inforamtion</h6>
                                <p class="text-muted">Update your profile information</p>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="small font-weight-bold">Your Name</label>
                                        <input required type="text" class="form-control" name="fullname" id="exampleFormControlInput1" placeholder="Full Name" value='<?php echo $_SESSION["userdata_c"]["fullname"]; ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2" class="small font-weight-bold">Email Address</label>
                                        <input required type="email" class="form-control" name="email" id="exampleFormControlInput2" value='<?php echo $_SESSION["userdata_c"]["email"]; ?>' readonly placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput3" class="small font-weight-bold">Phone Number</label>
                                        <input required type="number" class="form-control" name="phone" id="exampleFormControlInput3" placeholder="Mobile" value='<?php echo $_SESSION["userdata_c"]["phone"]; ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" class="small font-weight-bold">Address</label>
                                        <textarea required class="form-control" name="address" id="exampleFormControlTextarea1" placeholder="Address ..." rows="3"><?php echo $_SESSION["userdata_c"]["address"]; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput3" class="small font-weight-bold">Address on Map</label>
                                        <div id="googleMap" style="height: 320px;"></div>
                                        <input type="hidden" id="lat" name="lat" value='<?php echo $_SESSION["userdata_c"]["lat"]; ?>'>
                                        <input type="hidden" id="lng" name="lng" value='<?php echo $_SESSION["userdata_c"]["lng"]; ?>'>
                                    </div>
                                    <button type="submit" name="update_profile" class="btn btn-primary btn-block" >UPDATE</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="col-md-8 mb-3">
                    <div class="rounded shadow-sm">
                        <div class="osahan-cart-item-profile bg-white rounded shadow-sm p-4">
                            <div class="flex-column">
                                <h6 class="font-weight-bold">Update Password</h6>
                                <p class="text-muted">Update your profile password</p>
                                <form action="" method="post">
                                    
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="small font-weight-bold">Current Password</label>
                                        <input required type="password" class="form-control" name="c_pwd" id="exampleFormControlInput1" placeholder="Current Password" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2" class="small font-weight-bold">New Password</label>
                                        <input required type="password" class="form-control" name="n_pwd" id="exampleFormControlInput2"  placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput3" class="small font-weight-bold">Retype Password</label>
                                        <input required type="password" class="form-control" name="r_pwd" id="exampleFormControlInput3" placeholder="Retype Password" >
                                    </div>
                                    
                                    <button type="submit" name="update_password" class="btn btn-primary btn-block" >UPDATE</button>
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
   
   
   
   
   
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtUmkoqsmGSa-k15hhbr75lEj1r-ItKzE&v=3"></script>

    <script>
        var mylat, mylong;
        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          } else { 
            console.log("Geolocation is not supported by this browser.");
          }
        }
        
        function showPosition(position) {
            
            
        <?php
            if($_SESSION["userdata_c"]["lat"] == "" || $_SESSION["userdata_c"]["lng"] == "")
            {
        ?>

                
                    mylat = position.coords.latitude ; 
                    mylong = position.coords.longitude;
               

        <?php
            }else{
        ?>
                    mylat = "<?php echo $_SESSION["userdata_c"]["lat"]; ?>" ; 
                    mylong = "<?php echo $_SESSION["userdata_c"]["lng"]; ?>" ; 
            
          <?php } ?>
          
          
        initialize();
        }
        
        
        
        getLocation();
        
        function initialize() {
        
        
        
        
        
        var myLatlng = new google.maps.LatLng(mylat,mylong);
          var mapProp = {
            center:myLatlng,
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP
              
          };
          var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
            var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              title: 'My Location',
              draggable:true  
          });
            document.getElementById('lat').value= mylat
            document.getElementById('lng').value= mylong  
            $('#add-vendor').removeAttr("disabled");
            // marker drag event
            google.maps.event.addListener(marker,'drag',function(event) {
                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('lng').value = event.latLng.lng();
            });
        
            //marker drag event end
            google.maps.event.addListener(marker,'dragend',function(event) {
                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('lng').value = event.latLng.lng();
            });
            
            
            
                         infoWindow = new google.maps.InfoWindow();

  const locationButton = document.createElement("button");
    locationButton.type = "button";
  locationButton.innerHTML = "<img style='width:30px;' src='img/crosshairs_gps_icon_136721.png' />";
  locationButton.classList.add("custom-map-control-button");
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
  locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };
            document.getElementById('lat').value= position.coords.latitude
            document.getElementById('lng').value= position.coords.longitude
          mylat = position.coords.latitude;
            mylong = position.coords.longitude;
            
            initialize()
            
          /*infoWindow.setPosition(pos);
          infoWindow.setContent("Your Location.");
          infoWindow.open(map);
          map.setCenter(pos);*/
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });
        
            
            
            
            
            
            
            
        }
        
        
        
                        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}
        
    </script>
   
   
   
   

   
<script>



function foo(elmnt){
        console.log(elmnt.id);
        parent.postMessage(elmnt.id, "*");
    }
    
    
  
    

</script>


</body>

</html>