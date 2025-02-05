<?php

session_start();


include ('../conn.php');





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
                <div class="col-md-4 mb-3">
                    <div class="bg-white rounded shadow-sm sticky_sidebar overflow-hidden">
                       
                        <div class="osahan-credits d-flex align-items-center p-3 bg-light">
                            <img src="img/icons/app-logo.png" />
                        </div>
                        <!-- profile-details -->
                        <div class="bg-white profile-details">
                            
                            <a  class="d-flex w-100 align-items-center border-bottom p-3">
                                <div class="left mr-3">
                                    <h6 class="font-weight-bold mb-1 text-dark">Email</h6>
                                    <p class="small text-muted m-0"><?php echo getSettings($conn, 'email'); ?></p>
                                </div>
                                <div class="right ml-auto">
                                    <h6 class="font-weight-bold m-0"></h6>
                                </div>
                                
                            </a>
                            <a  class="d-flex w-100 align-items-center border-bottom p-3">
                                <div class="left mr-3">
                                    <h6 class="font-weight-bold mb-1 text-dark">Phone</h6>
                                    <p class="small text-muted m-0"><?php echo getSettings($conn, 'phone'); ?></p>
                                </div>
                                <div class="right ml-auto">
                                    <h6 class="font-weight-bold m-0"></h6>
                                </div>
                                
                            </a>
                            <a  class="d-flex w-100 align-items-center border-bottom p-3">
                                <div class="left mr-3">
                                    <h6 class="font-weight-bold mb-1 text-dark">Address</h6>
                                    <p class="small text-muted m-0"><?php echo getSettings($conn, 'address'); ?></p>
                                </div>
                                <div class="right ml-auto">
                                    <h6 class="font-weight-bold m-0"></h6>
                                </div>
                                
                            </a>
                            
                            <a id="about" onclick="foo(this)" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                                <div class="left mr-3">
                                    <h6 class="font-weight-bold m-0 text-dark"><i class="feather-info bg-success text-white p-2 rounded-circle mr-2"></i> About Us</h6>
                                </div>
                                <div class="right ml-auto">
                                    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                                </div>
                            </a>
                            <a id="terms" onclick="foo(this)" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                                <div class="left mr-3">
                                    <h6 class="font-weight-bold m-0 text-dark"><i class="feather-info bg-success text-white p-2 rounded-circle mr-2"></i> Term of use</h6>
                                </div>
                                <div class="right ml-auto">
                                    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                                </div>
                            </a>
                            <a id="refund" onclick="foo(this)" class="d-flex w-100 align-items-center border-bottom px-3 py-4">
                                <div class="left mr-3">
                                    <h6 class="font-weight-bold m-0 text-dark"><i class="feather-info bg-success text-white p-2 rounded-circle mr-2"></i> Refund policy</h6>
                                </div>
                                <div class="right ml-auto">
                                    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                                </div>
                            </a>
                            <a id="privacy" onclick="foo(this)" class="d-flex w-100 align-items-center px-3 py-4">
                                <div class="left mr-3">
                                    <h6 class="font-weight-bold m-0 text-dark"><i class="feather-info bg-success text-white p-2 rounded-circle mr-2"></i> Privacy policy</h6>
                                </div>
                                <div class="right ml-auto">
                                    <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                                </div>
                            </a>
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