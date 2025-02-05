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
else
{
	$_SESSION["welcome"] = 0;
}


if(!isset($_GET['restaurant']))
		{
			exit();
		}
		else
		{
			$restaurant = $_GET['restaurant'];
			$sql = "SELECT * FROM vendors WHERE id = '$restaurant'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				
				$restaurant_data = $row;
				
			}
			else
			{
				exit();
			}
		}
		
		
		
		function distance($lat1, $lon1, $lat2, $lon2, $unit) {

            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
    
            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
        
        
        $tommorow = date('Y-m-d', strtotime("+1 day"));
        $nxt_one = date('Y-m-d', strtotime("+2 day"));
        $nxt_seven = date('Y-m-d', strtotime("+7 day"));
        $nxt_fifteen = date('Y-m-d', strtotime("+15 day"));
        $nxt_thirty = date('Y-m-d', strtotime("+30 day"));
        
        
        
    $breakfastfoods_arr = array();

    $breakfastfoods_arr[] = $restaurant_data['mon_bf'];
    $breakfastfoods_arr[] = $restaurant_data['tue_bf'];
    $breakfastfoods_arr[] = $restaurant_data['wed_bf'];
    $breakfastfoods_arr[] = $restaurant_data['thu_bf'];
    $breakfastfoods_arr[] = $restaurant_data['fri_bf'];
    $breakfastfoods_arr[] = $restaurant_data['sat_bf'];
    $breakfastfoods_arr[] = $restaurant_data['sun_bf'];
    
    
    $lunchfoods_arr = array();

    $lunchfoods_arr[] = $restaurant_data['mon_lun'];
    $lunchfoods_arr[] = $restaurant_data['tue_lun'];
    $lunchfoods_arr[] = $restaurant_data['wed_lun'];
    $lunchfoods_arr[] = $restaurant_data['thu_lun'];
    $lunchfoods_arr[] = $restaurant_data['fri_lun'];
    $lunchfoods_arr[] = $restaurant_data['sat_lun'];
    $lunchfoods_arr[] = $restaurant_data['sun_lun'];
    
    
    $dinnerfoods_arr = array();

    $dinnerfoods_arr[] = $restaurant_data['mon_din'];
    $dinnerfoods_arr[] = $restaurant_data['tue_din'];
    $dinnerfoods_arr[] = $restaurant_data['wed_din'];
    $dinnerfoods_arr[] = $restaurant_data['thu_din'];
    $dinnerfoods_arr[] = $restaurant_data['fri_din'];
    $dinnerfoods_arr[] = $restaurant_data['sat_din'];
    $dinnerfoods_arr[] = $restaurant_data['sun_din'];
    
    $breakfast_food_data = array();
    $lunch_food_data = array();
    $dinner_food_data = array();
    
    
    $breakfast_food = array();
    $lunch_food = array();
    $dinner_food = array();
    
   // $week = array("Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday", "Sunday");
   //$date = "2022-01-05";
    $week = array();
    for ($i=0; $i<7; $i++)
    {
       $week[] = date('D, M j, Y', strtotime("+ ".$i." day"));
       //$week[] = date('D, M j, Y', strtotime("+ ".$i." day", strtotime($date)));
    }
    
    
    for($i=0; $i<7; $i++)
    {
        //Breakfast
        $food_id = $breakfastfoods_arr[$i];
        $sql_food = "SELECT * FROM food_items WHERE id = '".$food_id."'";
        $result_food = $conn->query($sql_food);
        $row_food = $result_food->fetch_assoc();
        
        $breakfast_food_data['name'] = $row_food['food_name'];
        $breakfast_food_data['desc'] = $row_food['food_details'];
        $breakfast_food_data['serve'] = $row_food['serve_time'];
        $breakfast_food_data['price'] = $row_food['food_price'];
        $breakfast_food_data['type'] = $row_food['food_type'] == 1 ? 'veg' : 'non-veg';
        

        $sql_imgs = "SELECT * FROM food_images WHERE food_id = '".$food_id."' LIMIT 1 ";
        $result_imgs = $conn->query($sql_imgs);
		if ($result_imgs->num_rows > 0) {

			$row_imgs = $result_imgs->fetch_assoc();
			
			$breakfast_food_data['img'] = $row_imgs['food_img'];
			

		}
		else
		{
			$breakfast_food_data['img'] = 'test.jpg';
		}
		
		
		$breakfast_food[$week[$i]] = $breakfast_food_data;
		
		
		
		//Lunch
		$food_id = $lunchfoods_arr[$i];
        $sql_food = "SELECT * FROM food_items WHERE id = '".$food_id."'";
        $result_food = $conn->query($sql_food);
        $row_food = $result_food->fetch_assoc();
        
        $lunch_food_data['name'] = $row_food['food_name'];
        $lunch_food_data['desc'] = $row_food['food_details'];
        $lunch_food_data['serve'] = $row_food['serve_time'];
        $lunch_food_data['price'] = $row_food['food_price'];
        $lunch_food_data['type'] = $row_food['food_type'] == 1 ? 'veg' : 'non-veg';
        

        $sql_imgs = "SELECT * FROM food_images WHERE food_id = '".$food_id."' LIMIT 1 ";
        $result_imgs = $conn->query($sql_imgs);
		if ($result_imgs->num_rows > 0) {

			$row_imgs = $result_imgs->fetch_assoc();
			
			$lunch_food_data['img'] = $row_imgs['food_img'];
			

		}
		else
		{
			$lunch_food_data['img'] = 'test.jpg';
		}
		
		
		$lunch_food[$week[$i]] = $lunch_food_data;
		
		
		
		//Dinner
		$food_id = $dinnerfoods_arr[$i];
        $sql_food = "SELECT * FROM food_items WHERE id = '".$food_id."'";
        $result_food = $conn->query($sql_food);
        $row_food = $result_food->fetch_assoc();
        
        $dinner_food_data['name'] = $row_food['food_name'];
        $dinner_food_data['desc'] = $row_food['food_details'];
        $dinner_food_data['serve'] = $row_food['serve_time'];
        $dinner_food_data['price'] = $row_food['food_price'];
        $dinner_food_data['type'] = $row_food['food_type'] == 1 ? 'veg' : 'non-veg';
        

        $sql_imgs = "SELECT * FROM food_images WHERE food_id = '".$food_id."' LIMIT 1 ";
        $result_imgs = $conn->query($sql_imgs);
		if ($result_imgs->num_rows > 0) {

			$row_imgs = $result_imgs->fetch_assoc();
			
			$dinner_food_data['img'] = $row_imgs['food_img'];
			

		}
		else
		{
			$dinner_food_data['img'] = 'test.jpg';
		}
		
		
		$dinner_food[$week[$i]] = $dinner_food_data;
		
		
		
		
		
    }
    
    
    //print_r($breakfast_food);



$date = new DateTime();

global $day_s;

if ($date->format('l') == "Monday"){
    $day_s = "0";//slide 0
}else if ($date->format('l') == "Tuesday"){
    $day_s = "1";//slide 1
}else if ($date->format('l') == "Wednesday"){
    $day_s = "2";//slide 2
}else if ($date->format('l') == "Thursday"){
    $day_s = "3";//slide 3
}else if ($date->format('l') == "Friday"){
    $day_s = "4";//slide 4
}else if ($date->format('l') == "Saturday"){
    $day_s = "5";//slide 5
}else{
    $day_s = "6";//slide 6
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

$order_placed = 0;

if(isset($_POST['order_package']))
{
    
    $vendor_id =  $restaurant_data['id'];
    $customer_id = $_SESSION["userdata_c"]['id'];
    
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $package_duration = $_POST['total_days'];
    
    
    $serve_time = $_POST['package'];
    if($serve_time == 1)
    {
        $st = 'bf';
    }
    else if($serve_time == 2)
    {
        $st = 'lun';
    }
    else
    {
        $st = 'din';
    }
    
    
    
    $begin = new DateTime( $start_date );
    $end   = new DateTime( $end_date );

    $food_ids_arr = array();
    $sub_dates_arr = array();
    
    for($i = $begin; $i <= $end; $i->modify('+1 day'))
    {

	    $food_ids_arr[] = $restaurant_data[substr(strtolower($i->format('l')), 0, 3)."_".$st];
	    $sub_dates_arr[] = $i->format("Y-m-d"); 
    
    }
    
    $food_ids = json_encode($food_ids_arr);
    
    
    
    $subscription_price = floatval($_POST['order_total']);
    $commision = getSettings($conn, 'commission');
    $admin_earning = ($subscription_price * $commision)/100;
    $vendor_earning = $subscription_price - $admin_earning;
    
    $delivery_lat = $_POST['lat'];
    $delivery_lng = $_POST['lng'];
    $delivery_address = $_POST['delivery_address'];
    $delivery_landmark = $_POST['delivery_landmark'];
    
    $subscription_date = date('Y-m-d');
    
    $sql_order = "INSERT INTO order_subscription SET customer_id = '$customer_id', vendor_id = '$vendor_id', food_id = '$food_ids', serve_time = '$serve_time', package_duration = '$package_duration', subscription_price = '$subscription_price', vendor_earning = '$vendor_earning', admin_earning = '$admin_earning', start_date = '$start_date', end_date = '$end_date', subscription_date = '$subscription_date', delivery_lat = '$delivery_lat', delivery_lng = '$delivery_lng', delivery_address = '$delivery_address', delivery_landmark = '$delivery_landmark' , is_paid = '1' ";
    
    
    if($conn->query($sql_order))
    {
        $last_id = $conn->insert_id;
        $d = 0;
        foreach($food_ids_arr as $food_id)
        {
            $for_date = $sub_dates_arr[$d];
            $conn->query("INSERT INTO food_processing_status SET food_order_id = '$last_id', food_id = '$food_id', customer_id = '$customer_id', vendor_id = '$vendor_id', serve_time = '$serve_time', for_date = '$for_date'  ");
            $d++;
        }
        $order_placed = 1;
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
    <title>Wah Meal</title>
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
   
    <style>
        .tab-content>.tab-pane{ display: block; height: 0px; overflow: hidden; }
        .tab-content>.active{ height: auto;}

        .img-border{
            border: 3px solid lightskyblue;
            border-radius: 50%;
        }

        .modal-dialog {
                margin:0;
                margin-top: 9vh;
            }
            
        .modal-content{
            border-radius:0;
        }   
        
        .modal{
            background:#fff;
        }

            .veg{
                color: green !important;
                border: 1px solid;
                width: 15px;
                height: 15px;
                text-align: center;
                border-radius: 3px;
                font-size: 35px;
                line-height: 7px;
            }

            .non-veg{
                color: red !important;
                border: 1px solid;
                width: 15px;
                height: 15px;
                text-align: center;
                border-radius: 3px;
                font-size: 35px;
                line-height: 7px;
            }
            
            .restaurant-pic {
                position: absolute;
                right: 10px;
                height: 100px;
                border-radius: 4px;
                margin: 9px 0;
                top: 58px;
            }
            
            
            /* stepper form */
            
            .stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}


     


    </style>
    
</head>

<body class="fixed-bottom-bar">
   
   
    <div class="offer-section py-4 " style="margin-top: 3.8rem!important;">
        <div class="container position-relative">
            <img style="width: 130px; display:block;" src="../vendor_app/uploads/logo/<?php echo $restaurant_data['logo']; ?>" class="restaurant-pic img-thumbnail">
            <div class="pt-3 text-white">
                <h2 class="font-weight-bold"><?php echo $restaurant_data['business_name']; ?></h2>
                <p class="text-white m-0"><?php echo substr($restaurant_data['business_caption'], 0 ,31); ?>...</p>
                <div class="rating-wrap d-flex align-items-center mt-4">
                    <ul class="rating-stars list-unstyled">
                        <li>
                          <span style="background: limegreen; color: #fff; padding: 2px 5px; text-shadow: 0px 0px 1px #d2b128; border-radius: 5px;">
                              <?php echo round(distance($_SESSION["userdata_c"]["lat"], $_SESSION["userdata_c"]["lng"], $restaurant_data['lat'], $restaurant_data['lng'], "K"),2); ?> Km Away
                          </span>
                        </li>
                    </ul>
                </div>
                <p class="text-white m-0"><i class="feather-map-pin mr-2"></i> <?php echo $restaurant_data['business_address'].", ".$restaurant_data['business_city']; ?></p>
            </div>
            
        </div>
    </div>
    
    <div class="container">
        <div class="p-3 bg-primary bg-primary mt-n3 rounded position-relative">
            <div class="d-flex align-items-center">
                <div class="feather_icon" style="display:none;">
                    <a onclick="showMenuTab('#breakfast', 'bf_img')" class="text-decoration-none text-dark"><img id="bf_img" src="img/icons/morning.png" style="width:15%;" /></a>
                    <a onclick="showMenuTab('#lunch', 'lun_img')" class="text-decoration-none text-dark mx-2"><img id="lun_img" src="img/icons/noon.png" style="width:15%;" /></a>
                    <a onclick="showMenuTab('#dinner', 'din_img')" class="text-decoration-none text-dark"><img id="din_img" src="img/icons/night.png" style="width:15%;" /></a>
                </div>
                <b class="text-white"><?php echo ucfirst($_GET['serve']); ?> Package</b>
                <button onclick="serveDetail('<?php echo $_GET['serve']; ?>')" class="btn btn-sm btn-default ml-auto bg-white text-danger"> View All</button>
            </div>
        </div>
    </div>

    <section class="py-4 osahan-main-body">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3" style="display:none;">
                    <ul class="nav nav-tabsa custom-tabsa border-0 flex-column bg-white rounded overflow-hidden shadow-sm p-2 c-t-order" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link border-0 text-dark py-3 active" id="bf-tab" data-toggle="tab" href="#breakfast" role="tab" aria-controls="breakfast" aria-selected="true">
                                <div class="mr-2 text-success mb-0"><img src="img/icons/morning.png" style="width:30%;" /></div> Breakfast Items</a>
                        </li>
                        <li class="nav-item border-top" role="presentation">
                            <a class="nav-link border-0 text-dark py-3" id="lun-tab" data-toggle="tab" href="#lunch" role="tab" aria-controls="lunch" aria-selected="false">
                                <div class="mr-2 text-success mb-0"><img src="img/icons/noon.png" style="width:30%;" /></div> Lunch Items</a>
                        </li>
                        <li class="nav-item border-top" role="presentation">
                            <a class="nav-link border-0 text-dark py-3" id="din-tab" data-toggle="tab" href="#dinner" role="tab" aria-controls="dinner" aria-selected="false">
                                <div class="mr-2 text-success mb-0"><img src="img/icons/night.png" style="width:30%;" /></div> Dinner Items</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content col-md-9 bg-white rounded px-2 pb-2" style="width: 96%; margin-left: 6px;" id="myTabContent">

                    <div class="tab-pane fade show active" id="breakfast" role="tabpanel" aria-labelledby="bf-tab">
                        <div class="order-body">
                            <div class="pb-3">
                                <div class="container">
                                    <div class="">
                                        <p style="display:none;" class="font-weight-bold py-3 m-0">BREAKFAST ITEMS <span class="float-right text-danger" onclick="serveDetail('breakfast')">View All</span></p>
                                        <!-- slider -->
                                        <div class="weekly-slider rounded" style="display:none;">
                                            
                                        <?php
                                            $bf_package_tot = 0;
                                            foreach($breakfast_food as $day => $fi)
                                            { 
                                                $bf_package_tot = $bf_package_tot + $fi['price'];
                                        ?>

                                            <div class="osahan-slider-item"  onclick="foodDetail(this);">
                                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                                    <div class="list-card-image">
                                                        
                                                            <img  src="../vendor_app/uploads/food/<?php echo $fi['img']; ?>" class="img-fluid item-img w-100" style="height:125px !important;">
                                                        
                                                    </div>
                                                    <div class="p-3 position-relative">
                                                        <div class="list-card-body">
                                                            <h6 class="mb-1"><a  class="text-black item-day"><?php echo $day; ?></a>
                                                            </h6>
                                                            <p class="text-gray mb-3">
                                                                <div class="media align-items-center">
                                                                    <div class="mr-2 <?php echo $fi['type']; ?>">·</div>
                                                                    <div class="media-body">
                                                                        <p class="m-0 item-name">
                                                                            <?php echo $fi['name']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </p>
                                                            <span class="item-desc" style="display:none;"><?php echo $fi['desc']; ?></span> 
                                                            <p class="text-gray m-0"> <span class="text-black-50 item-price"> ₹ <?php echo $fi['price']; ?></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php 
                                            } 
                                        ?>
                                           
                                        </div>
                                    </div>

                                    <div class="bg-white mt-3 pb-3 clearfix border-bottom" style="display:none;">
                                        <p class="mb-1">Item Total For 7 Days <span class="float-right text-dark item-total" data-value="<?php echo $bf_package_tot/7; ?>" >₹ <?php echo $bf_package_tot/7; ?></span></p>
                                        <hr>
                                        <h6 class="font-weight-bold mb-0">TO PAY <span class="float-right"> <?php echo $bf_package_tot/7; ?></span></h6>
                                    </div>
                                    <div class="mt-3">
                                        <div class="row">
                                            
                                            <div class="col-md-12 p-2 my-2 border">
                                                <div class="row">
                                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                                        <div>
                                                            <b>7 Meals</b>
                                                            <br/>
                                                             <?php echo round($bf_package_tot/7,2); ?>/Meal
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <button onclick="foodOrder('breakfast', '<?php echo $nxt_seven; ?>', '7')" class="btn btn-success btn-block btn-lg text-white" >SUBSCRIBE <i class="feather-arrow-right ml-2"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 p-2 my-2 border">
                                                <div class="row">
                                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                                        <div>
                                                            <b>15 Meals</b>
                                                            <br/>
                                                            ₹ <?php echo round($bf_package_tot/7,2); ?>/Meal
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <button onclick="foodOrder('breakfast', '<?php echo $nxt_fifteen; ?>', '15')" class="btn btn-success btn-block btn-lg text-white" >SUBSCRIBE <i class="feather-arrow-right ml-2"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 p-2 my-2 border">
                                                <div class="row">
                                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                                        <div>
                                                            <b>30 Meals</b>
                                                            <br/>
                                                            ₹ <?php echo round($bf_package_tot/7,2); ?>/Meal
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <button onclick="foodOrder('breakfast', '<?php echo $nxt_thirty; ?>', '30')" class="btn btn-success btn-block btn-lg text-white" >SUBSCRIBE <i class="feather-arrow-right ml-2"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="lunch" role="tabpanel" aria-labelledby="lun-tab">
                        <div class="order-body">
                            <div class="pb-3">
                                <div class="container">
                                    <div class="">
                                        <p style="display:none;" class="font-weight-bold py-3 m-0">LUNCH ITEMS <span class="float-right text-danger" onclick="serveDetail('lunch')">View All</span></p>
                                        <!-- slider -->
                                        <div class="weekly-slider rounded" style="display:none;">

                                            <?php
                                            $lun_package_tot = 0;
                                            foreach($lunch_food as $day => $fi)
                                            { 
                                                $lun_package_tot = $lun_package_tot + $fi['price'];
                                        ?>

                                            <div class="osahan-slider-item"  onclick="foodDetail(this);">
                                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                                    <div class="list-card-image">
                                                        
                                                            <img  src="../vendor_app/uploads/food/<?php echo $fi['img']; ?>" class="img-fluid item-img w-100" style="height:125px !important;">
                                                        
                                                    </div>
                                                    <div class="p-3 position-relative">
                                                        <div class="list-card-body">
                                                            <h6 class="mb-1"><a  class="text-black item-day"><?php echo $day; ?></a>
                                                            </h6>
                                                            <p class="text-gray mb-3">
                                                                <div class="media align-items-center">
                                                                    <div class="mr-2 <?php echo $fi['type']; ?>">·</div>
                                                                    <div class="media-body">
                                                                        <p class="m-0 item-name">
                                                                            <?php echo $fi['name']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </p>
                                                            <span class="item-desc" style="display:none;"><?php echo $fi['desc']; ?></span> 
                                                            <p class="text-gray m-0"> <span class="text-black-50 item-price"> ₹ <?php echo $fi['price']; ?></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php 
                                            } 
                                        ?>
                                           
                                        </div>
                                    </div>

                                    <div class="bg-white mt-3 pb-3 clearfix border-bottom" style="display:none;">
                                        <p class="mb-1">Item Total For 7 Days <span class="float-right text-dark item-total" data-value="<?php echo $lun_package_tot/7; ?>">₹ <?php echo $lun_package_tot/7; ?></span></p>
                                        <hr>
                                        <h6 class="font-weight-bold mb-0">TO PAY <span class="float-right"> <?php echo $lun_package_tot/7; ?></span></h6>
                                    </div>
                                    <div class="mt-3">
                                        <div class="row">
                                            
                                            <div class="col-md-12 p-2 my-2 border">
                                                <div class="row">
                                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                                        <div>
                                                            <b>7 Meals</b>
                                                            <br/>
                                                            ₹ <?php echo round($lun_package_tot/7,2); ?>/Meal
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <button onclick="foodOrder('lunch', '<?php echo $nxt_seven; ?>', '7')" class="btn btn-success btn-block btn-lg text-white" >SUBSCRIBE <i class="feather-arrow-right ml-2"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 p-2 my-2 border">
                                                <div class="row">
                                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                                        <div>
                                                            <b>15 Meals</b>
                                                            <br/>
                                                             <?php echo round($lun_package_tot/7,2); ?>/Meal
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <button onclick="foodOrder('lunch', '<?php echo $nxt_fifteen; ?>', '15')" class="btn btn-success btn-block btn-lg text-white" >SUBSCRIBE <i class="feather-arrow-right ml-2"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 p-2 my-2 border">
                                                <div class="row">
                                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                                        <div>
                                                            <b>30 Meals</b>
                                                            <br/>
                                                            ₹ <?php echo round($lun_package_tot/7,2); ?>/Meal
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <button onclick="foodOrder('lunch', '<?php echo $nxt_thirty; ?>', '30')" class="btn btn-success btn-block btn-lg text-white" >SUBSCRIBE <i class="feather-arrow-right ml-2"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="dinner" role="tabpanel" aria-labelledby="din-tab">
                        <div class="order-body">
                            <div class="pb-3">
                                <div class="container">
                                    <div class="">
                                        <p style="display:none;" class="font-weight-bold py-3 m-0">DINNER ITEMS <span class="float-right text-danger" onclick="serveDetail('dinner')">View All</span></p>
                                        <!-- slider -->
                                        <div class="weekly-slider rounded" style="display:none;">

                                            <?php
                                            $din_package_tot = 0;
                                            foreach($dinner_food as $day => $fi)
                                            { 
                                                $din_package_tot = $din_package_tot + $fi['price'];
                                        ?>

                                            <div class="osahan-slider-item"  onclick="foodDetail(this);">
                                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                                    <div class="list-card-image">
                                                        
                                                            <img  src="../vendor_app/uploads/food/<?php echo $fi['img']; ?>" class="img-fluid item-img w-100" style="height:125px !important;">
                                                        
                                                    </div>
                                                    <div class="p-3 position-relative">
                                                        <div class="list-card-body">
                                                            <h6 class="mb-1"><a  class="text-black item-day"><?php echo $day; ?></a>
                                                            </h6>
                                                            <p class="text-gray mb-3">
                                                                <div class="media align-items-center">
                                                                    <div class="mr-2 <?php echo $fi['type']; ?>">·</div>
                                                                    <div class="media-body">
                                                                        <p class="m-0 item-name">
                                                                            <?php echo $fi['name']; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </p>
                                                            <span class="item-desc" style="display:none;"><?php echo $fi['desc']; ?></span> 
                                                            <p class="text-gray m-0"> <span class="text-black-50 item-price">  <?php echo $fi['price']; ?></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php 
                                            } 
                                        ?>
                                           
                                        </div>
                                    </div>

                                    <div class="bg-white mt-3 pb-3 clearfix border-bottom" style="display:none;">
                                        <p class="mb-1">Item Total For 7 Days <span class="float-right text-dark item-total" data-value="<?php echo $din_package_tot/7; ?>" >₹ <?php echo $din_package_tot/7; ?></span></p>
                                        <hr>
                                        <h6 class="font-weight-bold mb-0">TO PAY <span class="float-right">₹ <?php echo $din_package_tot/7; ?></span></h6>
                                    </div>
                                    <div class="mt-3">
                                        <div class="row">
                                            
                                            <div class="col-md-12 p-2 my-2 border">
                                                <div class="row">
                                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                                        <div>
                                                            <b>7 Meals</b>
                                                            <br/>
                                                            ₹ <?php echo round($din_package_tot/7,2); ?>/Meal
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <button onclick="foodOrder('dinner', '<?php echo $nxt_seven; ?>', '7')" class="btn btn-success btn-block btn-lg text-white" >SUBSCRIBE <i class="feather-arrow-right ml-2"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 p-2 my-2 border">
                                                <div class="row">
                                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                                        <div>
                                                            <b>15 Meals</b>
                                                            <br/>
                                                            ₹ <?php echo round($din_package_tot/7,2); ?>/Meal
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <button onclick="foodOrder('dinner', '<?php echo $nxt_fifteen; ?>', '15')" class="btn btn-success btn-block btn-lg text-white" >SUBSCRIBE <i class="feather-arrow-right ml-2"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 p-2 my-2 border">
                                                <div class="row">
                                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                                        <div>
                                                            <b>30 Meals</b>
                                                            <br/>
                                                             <?php echo round($din_package_tot/7,2); ?>/Meal
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <button onclick="foodOrder('dinner', '<?php echo $nxt_thirty; ?>', '30')" class="btn btn-success btn-block btn-lg text-white" >SUBSCRIBE <i class="feather-arrow-right ml-2"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>




            </div>
        </div>
    </section>
    

    <!-- Modal -->
    <div class="modal fade" id="locationModal" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="px-4 pt-4 pb-2" style="width: 100%">
                <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=<?php echo $restaurant_data['lat'].",".$restaurant_data['lng']; ?>+(<?php echo $restaurant_data['business_name']; ?>)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            </div>
            <div class="col-md-5 px-4 py-1">

                <small>Address</small>
                <h6 class="mb-1 mt-0 mb-2">
                    <a style="color: #18BA70;" class="text-black">
                        <i class="feather-map-pin"></i> 
                        <?php echo $restaurant_data['business_address'].", ".$restaurant_data['business_city']; ?>
                    </a>
                </h6>

                <small>Contact</small>
                <h6 class="mb-1 mt-2 mb-2">
                    <a style="color: #18BA70;" class="text-black">
                        <i class="feather-phone"></i> 
                        +91-<?php echo $restaurant_data['phone']; ?>
                    </a>
                </h6>
                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
              </div>

          </div>

        </div>
    </div>
    
    <div class="modal fade" id="foodModal" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable">

          <!-- Modal content-->
          <div class="modal-content">
            
            <div class="bg-white text-center p-4 shadow-sm">
                <img id="food_img_detail" alt="#" src="" class="img-fluid item-img w-100 mb-4">
                <h6 class="font-weight-bold mb-2" id="food_name_detail" ></h6>
                <p class="small text-muted" id="food_desc_detail" ></p>
            </div>


            <div class="bg-white mt-3 pb-3 px-4 clearfix border-bottom">
                <p class="mb-1">Item Price <span class="float-right text-dark" id="food_price_detail"></span></span></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
              </div>

          </div>

        </div>
    </div>
    
    <div class="modal fade" id="serveModal" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable">

          <!-- Modal content-->
          <div class="modal-content">
            
            <div id="breakfast_all" class="osahan-cart-item overflow-hidden bg-white sticky_sidebar" style="display:none;" >
                <div class="d-flex border-bottom osahan-cart-item-profile bg-white p-3">
                    <div class="d-flex flex-column">
                        <h6 class="mb-1 font-weight-bold">Breakfast Items</h6>
                    </div>
                </div>
                <div class="bg-white border-bottom py-2">
                    
                    <?php 
                        foreach($breakfast_food as $day => $fi)
                        {
                    ?>
                    
                    <div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                        <div class="media align-items-center">
                            <div class="mr-2 <?php echo $fi['type']; ?>">&middot;</div>
                            <div class="media-body">
                                <p class="m-0"><?php echo $fi['name']; ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="count-number float-right"><a class="btn-sm right inc btn btn-outline-secondary"> <?php echo $day; ?></a></span>
                            <p class="text-gray mb-0 float-right ml-2 text-muted small"> <?php echo $fi['price']; ?></p>
                        </div>
                    </div>
                
                    <?php
                        }
                    ?>
                
                </div>
                
                <div class="bg-white p-3 clearfix border-bottom">
                    <p class="mb-1">Item Total For 7 Days <span class="float-right text-dark"> <?php echo $bf_package_tot; ?></span></p>
                </div>
               
            </div>

            <div id="lunch_all" class="osahan-cart-item overflow-hidden bg-white sticky_sidebar" style="display:none;" >
                <div class="d-flex border-bottom osahan-cart-item-profile bg-white p-3">
                    <div class="d-flex flex-column">
                        <h6 class="mb-1 font-weight-bold">Lunch Items</h6>
                    </div>
                </div>
                <div class="bg-white border-bottom py-2">
                    
                    <?php 
                        foreach($lunch_food as $day => $fi)
                        {
                    ?>
                    
                    <div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                        <div class="media align-items-center">
                            <div class="mr-2 <?php echo $fi['type']; ?>">&middot;</div>
                            <div class="media-body">
                                <p class="m-0"><?php echo $fi['name']; ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="count-number float-right"><a class="btn-sm right inc btn btn-outline-secondary"> <?php echo $day; ?></a></span>
                            <p class="text-gray mb-0 float-right ml-2 text-muted small"> <?php echo $fi['price']; ?></p>
                        </div>
                    </div>
                
                    <?php
                        }
                    ?>
                    
                    
                </div>
                
                <div class="bg-white p-3 clearfix border-bottom">
                    <p class="mb-1">Item Total For 7 Days <span class="float-right text-dark">₹ <?php echo $lun_package_tot; ?></span></p>
                </div>
               
            </div>

            <div id="dinner_all" class="osahan-cart-item overflow-hidden bg-white sticky_sidebar" style="display:none;" >
                <div class="d-flex border-bottom osahan-cart-item-profile bg-white p-3">
                    <div class="d-flex flex-column">
                        <h6 class="mb-1 font-weight-bold">Dinner Items</h6>
                    </div>
                </div>
                <div class="bg-white border-bottom py-2">
                    
                    
                    <?php 
                        foreach($dinner_food as $day => $fi)
                        {
                    ?>
                    
                    <div class="gold-members d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                        <div class="media align-items-center">
                            <div class="mr-2 <?php echo $fi['type']; ?>">&middot;</div>
                            <div class="media-body">
                                <p class="m-0"><?php echo $fi['name']; ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="count-number float-right"><a class="btn-sm right inc btn btn-outline-secondary"> <?php echo $day; ?></a></span>
                            <p class="text-gray mb-0 float-right ml-2 text-muted small"> <?php echo $fi['price']; ?></p>
                        </div>
                    </div>
                
                    <?php
                        }
                    ?>
                    
                    
                </div>
                
                <div class="bg-white p-3 clearfix border-bottom">
                    <p class="mb-1">Item Total For 7 Days <span class="float-right text-dark"> <?php echo $din_package_tot; ?></span></p>
                </div>
               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
              </div>

          </div>

        </div>
    </div>
    
    
    
    <div class="modal fade" id="orderModal" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable">

          <!-- Modal content-->
          <div class="modal-content">
              
              
              
              
              <div class="stepwizard col-md-offset-3 m-1" style="display:none;">
                    <div class="stepwizard-row setup-panel">
                      <div class="stepwizard-step">
                        <a href="#step-1" type="button"  class="btn btn-success btn-circle">1</a>
                        <p>Address</p>
                      </div>
                      <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p>Order Summary</p>
                      </div>
                      <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p>Payment</p>
                      </div>
                    </div>
             </div>
              
              
              
              
            
            <form action="" method="post" id="orderForm" >
                
                
                
                <div class="row setup-content" id="step-1">
                    
                    <div class="col-12">
                        
                         <input type="hidden" name="order_package" />
                        
                         <div  class="overflow-hidden bg-white sticky_sidebar"  >
                             
                             
                                                 <div class="bg-white p-3 py-3  clearfix">

                                                    <div class="form-group" style="display:none;">
                                                        <label for="package">Select Package:</label>
                                                        <select class="form-control" id="package" name="package">
                                                          <option value="1" >Breakfast</option>
                                                          <option value="2" >Lunch</option>
                                                          <option value="3" >Dinner</option>
                                                        </select>
                                                        <input type="hidden" id="order_total" name="order_total" />
                                                        <input type="hidden" id="order_total_calc" name="order_total_calc" />
                                                        
                                                        
                                                        <input type="hidden" id="bf_food_ids" name="bf_food_ids" value='<?php echo json_encode($breakfastfoods_arr); ?>' />
                                                        <input type="hidden" id="lun_food_ids" name="lun_food_ids" value='<?php echo json_encode($lunchfoods_arr); ?>' />
                                                        <input type="hidden" id="din_food_ids" name="din_food_ids" value='<?php echo json_encode($dinnerfoods_arr); ?>' />
                                                        
                                                        <input type="hidden" id="total_days" name="total_days" />
                                                      </div>

                                                      <div class="row">
                                                          <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="start_date">Start Date:</label>
                                                                <input required onchange="dateDiff();" class="form-control" type="date" id="start_date" name="start_date" min="<?php echo $tommorow; ?>" >
                                                              </div>
                                                          </div>
                                                          <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="end_date">End Date:</label>
                                                                <input required readonly onchange="dateDiff();" class="form-control" type="date" id="end_date" name="end_date" min="<?php echo $nxt_one; ?>" >
                                                              </div>
                                                          </div>
                                                      </div>

                                                      

                                                      

                                                      <div class="mt-1 mb-0 input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="feather-map"></i></span></div>
                                                        <textarea required placeholder="Enter Full Delivery Address" id="delivery_address" name="delivery_address" aria-label="With textarea" class="form-control"></textarea>
                                                      </div>
                                                      
                                                      <div class="mt-3 mb-0 input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="feather-map-pin"></i></span></div>
                                                        <textarea required placeholder="Enter Delivery Address Landmark" id="delivery_landmark" name="delivery_landmark" aria-label="With textarea" class="form-control"></textarea>
                                                      </div>
                                                      
                                                      <div id="googleMap" style="height: 320px; margin-top:10px;"></div>
                                                      <input type='hidden' name='lat' id='lat'>  
                                                      <input type='hidden' name='lng' id='lng'> 
                                                      
                                                      
                                                      <div class="row mt-3">
                                                        <div class="col-6">
                                                            <button type="button" data-dismiss="modal" class="btn btn-basic btn-block"  style="background:#E6E6E6; height:40px;">Previous</button>
                                                        </div>
                                                        
                                                        <div class="col-6">
                                                            <button type="button" onclick="gotosummary(this)" class="btn btn-success  btn-block" style="height:40px;" >Next</button>
                                                        </div>
                                                       </div>
                                                      
                                                      
                                                    
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                             
                         </div>
                        
                        
                        
                        
                    </div>
                    
                </div>
                
                <div class="row setup-content" id="step-2">
                    
                     <div class="col-12">
                         
                          <div  class="overflow-hidden bg-white sticky_sidebar"  >
                             
                             
                                                 <div class="bg-white p-3 py-3  clearfix">
                         
                          <table class="table">
                                <thead>
                                  <tr>
                                    <th class="text-center" colspan="2">Order Summary</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><b>Order Package:</b></td>
                                    <td id="summary_package" class="text-right"></td>
                                  </tr>
                                  <tr>
                                    <td><b>Total Days:</b></td>
                                    <td id="summary_totaldays" class="text-right"></td>
                                  </tr>
                                  <tr>
                                    <td><b>Start Date:</b></td>
                                   <td id="summary_startdt" class="text-right"></td>
                                  </tr>
                                  <tr>
                                    <td><b>End Date:</b></td>
                                    <td id="summary_enddt" class="text-right"></td>
                                  </tr>
                                  <tr>
                                    <td><b>Delivery Address:</b></td>
                                    <td id="summary_address" class="text-right"></td>
                                  </tr>
                                  <tr>
                                    <td><b>Delivery Landmark:</b></td>
                                    <td id="summary_landmark" class="text-right"></td>
                                  </tr>
                                  <tr>
                                    <td><b>Order Total:</b></td>
                                    <td id="summary_total" class="text-right"></td>
                                  </tr>
                                </tbody>
                          </table>
                          
                                        <div class="row mt-3">
                                                        <div class="col-6">
                                                            <button type="button"  class="btn btn-basic prevBtn btn-block"  style="background:#E6E6E6; height:40px;">Previous</button>
                                                        </div>
                                                        
                                                        <div class="col-6">
                                                            <button type="button" class="btn btn-success nextBtn btn-block" style="height:40px;" >Next</button>
                                                        </div>
                                        </div>
                          
                          
                          </div>
                          
                          
                          
                          </div>
                         
                     </div>
                    
                </div>
                
                <div class="row setup-content" id="step-3">
                    
                    <div class="col-12">
                         
                         
                        <div  class="overflow-hidden bg-white sticky_sidebar"  >
                             
                             
                                                 <div class="bg-white p-3 py-3  clearfix">
                                                     
                                                     
                                                     
                                                     
                                                     <div class="card bg-light text-dark">
                                                         <div class="card-body p-3">
                                                                <div class="form-check">
                                                                       <label class="form-check-label">
                                                                           <input type="radio" class="form-check-input" name="paymode" checked>Cash On Delivery
                                                                       </label>
                                                                </div>
                                                    
                                                                <div class="form-check">
                                                                  <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="paymode" disabled>Pay with Paytm
                                                                  </label>
                                                                </div>
                                                        </div>
                                                    </div>

                                                     
                                                     
                                                     
                                                     
                                                     
                                                     
             
                            <div class="bg-white p-3 clearfix border-bottom">
                                <h6 class="font-weight-bold mb-0">TOTAL FOR <span id="tot_days">7</span> DAYS <span class="float-right order-total">₹ </span></h6>
                            </div>
                
                            <button type="submit" id="order_btn"   class="btn btn-success btn-lg btn-block">ORDER</button>

               
                        </div>
                        </div>
                         
                         
                     </div>
                    
                </div>
                
                
                
                
                
                
                                   

                


                  
               
            
            </form> 

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
    function foo(elmnt){
        console.log(elmnt.id);
        parent.postMessage(elmnt.id, "*");
    }
</script>


    <script>
        function showMenuTab(t, img)
        {
            $('a[href="'+t+'"]').click();
            $('#'+img).toggleClass("img-border");
            if(img == 'bf_img')
            {
                $('#lun_img').removeClass("img-border");
                $('#din_img').removeClass("img-border");
            }
            else if(img == 'lun_img')
            {
                $('#bf_img').removeClass("img-border");
                $('#din_img').removeClass("img-border");
            }
            else
            {
                $('#bf_img').removeClass("img-border");
                $('#lun_img').removeClass("img-border");
            }
        }

    $( document ).ready(function() {
        $('.weekly-slider').slick({
        //   centerMode: true,
        //   centerPadding: '30px',
        slidesToShow: 3,
        arrows: true,
       // initialSlide: <?php echo $day_s; ?>,
        responsive: [{
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
        });
    });



    function foodDetail(e)
    {
        
        var img = $(e).find(".item-img").attr("src").trim();
        var name = $(e).find(".item-name").html().trim();
        var desc = $(e).find(".item-desc").html().trim();
        var price = $(e).find(".item-price").html().trim();
        
        $("#food_img_detail").attr('src', img);
        $("#food_name_detail").html(name);
        $("#food_desc_detail").html(desc);
        $("#food_price_detail").html(price);

        $("#foodModal").modal("show");

    }


    function serveDetail(e)
    {
        
        $('.osahan-cart-item').css({"display" : "none"});
        $("#"+e+"_all").show();
        $("#serveModal").modal("show");

    }


    function foodOrder(p, enddate, totaldays)
    {
        $("#start_date").val("<?php echo $tommorow; ?>");
        $("#end_date").val(enddate);
        $("#end_date").attr('min',"<?php echo $nxt_one; ?>");
        $("#tot_days").html(totaldays);
        $("#total_days").val(totaldays);

        var total = $("#"+p).find(".item-total").attr("data-value")*totaldays;

        

        if(p == "breakfast")
        {
            $("#package").val(1);
        }
        else if(p == "lunch")
        {
            $("#package").val(2);
        }
        else 
        {
            $("#package").val(3);
        }

        

        $("#order_total").val(total);
        $("#order_total_calc").val(total);
        $('.order-total').html("₹ "+total);
        
        $("#order_btn").attr("disabled", false);
        $("#order_btn").html("ORDER");
        
        var capP = `${p[0].toUpperCase()}${p.slice(1)}`;
        $("#summary_package").html(capP);
        $("#summary_total").html(" "+total);
        $("#summary_startdt").html("<?php echo $tommorow; ?>");
        $("#summary_enddt").html(enddate);
        $("#summary_totaldays").html(totaldays+" Days");
        $("#summary_address").html("");
        $("#summary_landmark").html("");

        $("#orderModal").modal("show");
    }


    function dateDiff()
    {
        $("#order_btn").attr("disabled", false);
        var date1 = new Date($("#start_date").val());
        var total_days =  $("#total_days").val();
        var date2 = date1.setDate(date1.getDate() + (total_days-1));
        $("#end_date").val(formatDate(date2));
        
        $("#summary_startdt").html($("#start_date").val());
        $("#summary_enddt").html(formatDate(date2));
    
    }
    
    function formatDate(date) 
    {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
    
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
    
        return [year, month, day].join('-');
    }
    

$( '#orderForm' ).submit( function( event ) {
       

        $("#order_btn").attr("disabled", true);
        $("#order_btn").html("...");
        //$("#orderForm").submit();
       


});





$(function () {
    var src_adrs = $('#delivery_address'),
        dst_adrs = $('#summary_address');
    src_adrs.on('input', function () {
        dst_adrs.html(src_adrs.val());
    });
    
    
     var src_lmrk = $('#delivery_landmark'),
        dst_lmrk = $('#summary_landmark');
    src_lmrk.on('input', function () {
        dst_lmrk.html(src_lmrk.val());
    });
});





    </script>

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
      mylat = position.coords.latitude ; 
      mylong = position.coords.longitude;
       
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
    }
</script>

<?php if($order_placed == 1) { ?>
    <script>
        alert("Order placed successfully.");
        parent.postMessage('orders', "*");
    </script>
<?php } ?>



<script>
    <?php
        if($_GET['serve'] == 'lunch')
        {
    ?>        
            showMenuTab('#lunch', 'lun_img');
    <?php    
        } else if($_GET['serve'] == 'dinner') {
    ?>
            showMenuTab('#dinner', 'din_img');
    <?php
        } else {
    ?>        
            showMenuTab('#breakfast', 'bf_img');
    <?php
        }
    ?>
</script>


<script>
    
    
    $(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn'),
  		  allPrevBtn = $('.prevBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-success').addClass('btn-default');
          $item.addClass('btn-success');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });
  
  allPrevBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
          prevStepWizard.removeAttr('disabled').trigger('click');
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-success').trigger('click');
});
    
    
    function gotosummary(b)
    {
        
        if($('#delivery_address').val() != "" && $('#delivery_landmark').val() != "")
        {
             var curStep = $(b).closest(".setup-content"),
             curStepBtn = curStep.attr("id"),
             nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

            $(".form-group").removeClass("has-error");
            for(var i=0; i<curInputs.length; i++){
                if (!curInputs[i].validity.valid){
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }
            nextStepWizard.removeAttr('disabled').trigger('click');
        }
        
        if($('#delivery_address').val() === "" )
        {
             document.getElementById("delivery_address").focus();
        }
        
        if($('#delivery_landmark').val() === "" )
        {
             document.getElementById("delivery_landmark").focus();
        }
        
       
    }
    
    
    
    
</script>




</body>

</html>