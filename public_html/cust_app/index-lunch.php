<?php

session_start();
session_unset();
session_destroy();

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

$search_by_city = 0;

if(isset($_POST['setlocation']))
{
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    
    $city = $_POST['city'];
    
    if($city != "")
    {
        $search_by_city = 1;
    }
    else
    {
            $sql = "UPDATE `customers` SET `lat` = '$lat', `lng` = '$lng' WHERE email = '$username' ";
            if($conn->query($sql))
            {
                $_SESSION["userdata_c"]["lat"] = $lat;
                $_SESSION["userdata_c"]["lng"] = $lng;
            }
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
    <script src="../vendor_app/assets/js/RdataTB.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
         th { 
    display: none;
	}
        	.modal-dialog {
                margin-top: 10vh;
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
            
            .Name__row{
                border:none !important;
            }
            
            #my-select{
                display:none;
            }
            
            #SearchControl{
                display:inline-block !important;
                width: 95% !important;
            }
            
            .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; margin:0 15px; width:100px !important; }
            .toggle.ios .toggle-handle { border-radius: 20px; }
            
            
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
            
            
            
            
            .topnav {
                overflow: hidden;
                background-color: #F5F5F5;
                -webkit-box-shadow: 0 4px 6px -6px #222;
                -moz-box-shadow: 0 4px 6px -6px #222;
                box-shadow: 0 4px 6px -6px #222;
            }

            .topnav a {
              float: left;
              display: block;
              color: #000;
              text-align: center;
              padding: 14px 16px;
              text-decoration: none;
              font-size: 17px;
              border-bottom: 3px solid transparent;
            }

            .topnav a:hover {
              border-bottom: 3px solid #FF8A00;
            }
            
            .topnav a.active {
              border-bottom: 3px solid #FF8A00;
              font-weight:bold;
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
   
   
   
   
        <div class="topnav fixed-top" style="margin-top: 4rem!important;">
            <a href="index.php?username=<?php echo $_GET['username']; ?>&servetime=false">Breakfast</a>
            <a class="active" href="index-lunch.php?username=<?php echo $_GET['username']; ?>">Lunch</a>
            <a href="index-dinner.php?username=<?php echo $_GET['username']; ?>">Dinner</a>
        </div>


    <div class="container" style="margin-top: 4rem!important;">
        
        <div class="most_popular py-5">
            <div class="d-flex align-items-center mb-4">
                <h3 class="font-weight-bold text-dark mb-0">Near You</h3>
            </div>

            <div class="row">


<?php


            $lat = $_SESSION["userdata_c"]["lat"];
            $lng = $_SESSION["userdata_c"]["lng"];
            $rad_dist = 5;

            if($search_by_city == 0)
            {
                $sql = "SELECT *, ((ACOS(SIN('$lat' * PI() / 180) * SIN(`lat` * PI() / 180) + COS('$lat' * PI() / 180) * COS(`lat` * PI() / 180) * COS(('$lng' - `lng`) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) as distance FROM `vendors` HAVING distance <= '$rad_dist' AND is_available = 1 ORDER BY distance ASC";
            }
            else
            {
                $sql = "SELECT * FROM vendors WHERE business_city LIKE '%$city%' AND is_available = 1 ";
            }
            
            
            $result = $conn->query($sql);

if ($result->num_rows > 0) {

   

?>

<div class="table-responsive">
<table id="example" class="table " style="width:100%">
        <thead class="d-none">
            <tr class="d-none">
                <th class="d-none">Name</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            
            
            
                while($row = $result->fetch_assoc()) { 
                    
                    if($row['lun_list'] == 1)
                    {
                
                    $day = strtolower(date('D', time()));
                    $hour = date('H');
                    $foodServe = ($hour > 17) ? "din" : (($hour > 11) ? "lun" : "bf");
                    $foodServe = 'lun';
                    $food_item = $row[$day.'_'.$foodServe];
                    
                    $sql = "SELECT food_items.*, food_images.food_img FROM food_items  LEFT JOIN food_images on food_items.id = food_images.food_id  WHERE food_items.id = '$food_item' ORDER BY food_items.id DESC LIMIT 1";

                    $food_img_result = $conn->query($sql);

                    $bf_7 = 0;
                    $lun_7 = 0;
                    $din_7 = 0;

                    $week = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
                    $serve_type = array("bf", "lun", "din");
                    foreach($week as $w)
                    {
                        foreach($serve_type as $st)
                        {
                            $w = strtolower($w);
                            $food_item_id = $row[$w.'_'.$st];
                            $sql = "SELECT * FROM food_items WHERE id = '$food_item_id'";
                            
                            $food_item_result = $conn->query($sql);
                            $food_item_row = $food_item_result->fetch_assoc();
                            if($st == "bf")
                            {
                                $bf_7 = $bf_7 + $food_item_row['food_price'];
                            }elseif($st == "lun")
                            {
                                $lun_7 = $lun_7 + $food_item_row['food_price'];
                            }
                            else{
                                $din_7 = $din_7 + $food_item_row['food_price'];
                            }
                            
                        }
                        

                    }
                    
                    $food_img_row = $food_img_result->fetch_assoc();
                    $food_item_name = $food_img_row['food_name']; 
    $food_item_price = $food_img_row['food_price']; 
    $food_item_type = $food_img_row['food_type'] == 1 ? 'veg' : 'non-veg';  
     $food_item_filter = $food_img_row['food_type'] == 1 ? 'veg only' : 'all';  
                    

            ?>

                

            <tr>
                <td>
                        
                            <div onclick="foo(this)" id="restaurant#<?php echo $row['id']; ?>" class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            

                            <div id="myCarousel" class="carousel slide lazy" data-bs-ride="carousel">
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner">

  <?php $fi_slider = 1; ?>
         
        
            <div class="carousel-item <?php if($fi_slider == 1) { echo 'active'; } ?>">
              <img class="d-block thumb-image" style="width:100%;height:196px !important;" <?php if($fi_slider > 1 ) { echo "src='../vendor_app/uploads/food/"; } else { echo "src='../vendor_app/uploads/food/"; } echo $food_img_row['food_img']."'"; ?>  style="width:100%;">
            </div>

      
  </div>
         

  </div>


                             <div class="list-card-image">
                                
                                <?php
                                
                                    if($search_by_city == 0){
                                
                                ?>
                                
                                    <div class="star position-absolute"><span class="badge badge-success"><i class="feather-map-pin"></i> <?php echo round($row['distance'],2); ?> Km Away</span></div>
                                
                                <!--div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div-->
                                

                                <?php } else { ?>
                                
                                    <div class="star position-absolute"><span class="badge badge-success"><i class="feather-map-pin"></i> Near <?php echo $row['business_city']; ?></span></div>

                                
                                <?php } ?>

                              





                            </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="<?php echo $food_item_type; ?>">·</div>
                                            </div>
                                            <div class="col-9">
                                                    <h6 class="mb-1"><b><a  class="text-black"> <?php echo $food_item_name; ?></a></b></h6>
                                            </div>
                                            <div class="col-2 text-right">
                                                ₹ <?php echo $food_item_price; ?>
                                            </div>
                                            <div class="col-md-12 ml-4 mt-2">
                                                <b style="font-size: 14px;"><?php echo $row['business_name']; ?></b>
                                            </div>
                                            <div class="col-md-12 ml-4">
                                                <?php echo $row['business_caption']; ?>
                                            </div>
                                        </div>
                                        
                                        <p style="display:none !important;"><?php echo $food_item_filter; ?></p>
                                        
                                        <!--p class="text-gray mb-3"><?php echo $row['business_caption']; ?></p>
                                        <p class="text-gray mb-3 time">
                                            <b>Breakfast : </b> <?php echo $bf_7 ; ?> FOR 7 DAYS<br/>
                                            <b>Lunch : </b> <?php echo $lun_7 ; ?> FOR 7 DAYS<br/>
                                            <b>Dinner : </b> <?php echo $din_7 ; ?>  FOR 7 DAYS<br/>
                                        </p-->
                                    </div>
                                    <!--div class="list-card-badge">
                                        <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                                    </div-->
                                </div>
                            </div>
                        
                </td>
            </tr>

            <?php } } ?>
        </tbody>    
</table>
</div>

                
                
<?php } else {  ?>

   <div class="osahan-text text-center">
            <div class="osahan-img px-5 pb-5">
                <svg xmlns="http://www.w3.org/2000/svg" id="bbc88faa-5a3b-49cf-bdbb-6c9ab11be594" data-name="Layer 1" width="w-100" viewBox="0 0 728 754.88525" class="injected-svg modal__media modal__mobile__media" data-src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/cooking_lyxy.svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                  <rect x="514.67011" y="302.6311" width="33" height="524" transform="translate(-458.65432 311.24592) rotate(-33.25976)" fill="#e6e6e6"></rect>
                  <path d="M335.58256,171.60615l63.84438,97.34271a8.5,8.5,0,0,1-14.21528,9.32341L311.81484,166.36508a60.62682,60.62682,0,0,0-29.14936,4.78729L362.63446,293.08a8.5,8.5,0,0,1-14.21528,9.3234l-79.969-121.92766A60.62685,60.62685,0,0,0,252.44516,205.304L325.842,317.2112a8.5,8.5,0,0,1-14.21528,9.3234l-63.84438-97.3427c-1.6398,27.14157,7.20944,59.3114,26.60329,88.881,36.04421,54.95614,94.83957,80.109,131.32307,56.18052s36.8396-87.87721.79539-142.83336C387.11022,201.85046,361.13005,180.91634,335.58256,171.60615Z" transform="translate(-236 -72.55738)" fill="#e6e6e6"></path>
                  <rect x="256" y="204" width="33" height="524" fill="#e6e6e6"></rect>
                  <ellipse cx="272" cy="119" rx="79" ry="119" fill="#e6e6e6"></ellipse>
                  <ellipse cx="272" cy="119" rx="65" ry="97.91139" fill="#ccc"></ellipse>
                  <ellipse cx="364" cy="734" rx="364" ry="20.88525" fill="#e6e6e6"></ellipse>
                  <path d="M815.26782,806.25045a1162.796,1162.796,0,0,0-412.53564,0A15.04906,15.04906,0,0,1,385,791.45826V604.55738H833V791.45826A15.04906,15.04906,0,0,1,815.26782,806.25045Z" transform="translate(-236 -72.55738)" fill="#e23744"></path>
                  <path d="M792,466.55738a92.85808,92.85808,0,0,0-30.39526,5.0863,179.055,179.055,0,0,0-324.4441-1.63928,93.00486,93.00486,0,1,0,12.16987,174.74988,179.02647,179.02647,0,0,0,300.7481-2.16382A93.00664,93.00664,0,1,0,792,466.55738Z" transform="translate(-236 -72.55738)" fill="#e23744"></path>
                  <path d="M421,546.55738h-2A178.40222,178.40222,0,0,1,436.24707,469.572l1.80762.85644A176.41047,176.41047,0,0,0,421,546.55738Z" transform="translate(-236 -72.55738)" fill="#3f3d56"></path>
                  <path d="M779,546.55738h-2a176.52632,176.52632,0,0,0-16.29395-74.501l1.81641-.83789A178.51046,178.51046,0,0,1,779,546.55738Z" transform="translate(-236 -72.55738)" fill="#3f3d56"></path>
                  <path d="M385.24121,691.52808l-.48242-1.94141c.56445-.13964,57.40332-14.09961,140.70019-21.02636,76.88086-6.39258,192.68653-7.93457,307.78516,21.02734l-.48828,1.93945C717.93945,662.63746,602.38672,664.17261,525.667,670.55054,442.519,677.46167,385.8042,691.38843,385.24121,691.52808Z" transform="translate(-236 -72.55738)" fill="#3f3d56"></path>
                  <path d="M385.24121,718.52808l-.48242-1.94141c.56445-.13964,57.40332-14.09961,140.70019-21.02636,76.88086-6.39258,192.68653-7.93457,307.78516,21.02734l-.48828,1.93945C717.93945,689.63746,602.38672,691.17456,525.667,697.55054,442.519,704.46167,385.8042,718.38843,385.24121,718.52808Z" transform="translate(-236 -72.55738)" fill="#3f3d56"></path>
                  <path d="M385.24121,745.52808l-.48242-1.94141c.56445-.13964,57.40332-14.09961,140.70019-21.02636,76.88086-6.39258,192.68653-7.93457,307.78516,21.02734l-.48828,1.93945C717.93945,716.63746,602.38672,718.17456,525.667,724.55054,442.519,731.46167,385.8042,745.38843,385.24121,745.52808Z" transform="translate(-236 -72.55738)" fill="#3f3d56"></path>
                  <path d="M753.26693,598.71334,729.03658,590.475l23.26113-118.72871-15.992-1.45382c-15.594,11.96435-36.35984,16.65481-62.99891,13.08438l42.64542,64.45274-21.745,15.34942-69.368-83.20523A20.866,20.866,0,0,1,620,466.61227v0a20.866,20.866,0,0,1,15.0905-20.05076L709.16769,425.224l86.74466,9.69214c13.11467,19.99417,13.62744,33.89954-6.33645,37.911Z" transform="translate(-236 -72.55738)" fill="#2f2e41"></path>
                  <path d="M728.46691,644.90106h0a15.95869,15.95869,0,0,1-13.86555-21.711l12.046-30.97551c6.11869-11.59112,14.5164-10.14011,24.43261,0l4.84611,14.21526a9.17534,9.17534,0,0,1-.53485,7.176L743.64973,636.306A15.95871,15.95871,0,0,1,728.46691,644.90106Z" transform="translate(-236 -72.55738)" fill="#2f2e41"></path>
                  <path d="M697.15218,604.33834h0a15.95869,15.95869,0,0,1-13.86555-21.711l12.046-30.97551c6.11869-11.59113,14.51641-10.14012,24.43261,0l4.84611,14.21525a9.17537,9.17537,0,0,1-.53485,7.176L712.335,595.74331A15.9587,15.9587,0,0,1,697.15218,604.33834Z" transform="translate(-236 -72.55738)" fill="#2f2e41"></path>
                  <circle cx="476.55994" cy="212.13062" r="27.13799" fill="#ffb9b9"></circle>
                  <polygon points="518.721 250.415 481.406 269.799 473.652 234.907 499.336 218.915 518.721 250.415" fill="#ffb9b9"></polygon>
                  <path d="M799.7892,439.76224c-37.23393-11.24605-71.01788-17.07317-95.46758-8.23832,8.42738-23.70818-7.12737-59.91146-24.23035-96.9214,7.37949-9.64677,19.14576-13.38347,32.46867-15.02282,14.5769,10.5844,24.74122,3.79091,32.46867-12.59978,16.85358-.67652,33.095,5.29186,48.94531,15.50743C781.58355,362.17339,783.814,401.25293,799.7892,439.76224Z" transform="translate(-236 -72.55738)" fill="#3f3d56"></path>
                  <path d="M703.837,437.33921c-5.87952,3.4656-11.3058,9.30325-16.47664,16.47664-8.73817-5.349-16.42816-11.439-22.48592-18.68294a40.01122,40.01122,0,0,1-7.33032-37.42892l16.56053-53.82173a23.60967,23.60967,0,0,1,7.67755-11.38054l2.18592-1.776,21.80731,41.19159-21.80731,40.707C686.73356,420.03892,694.88267,428.6031,703.837,437.33921Z" transform="translate(-236 -72.55738)" fill="#3f3d56"></path>
                  <path d="M711.343,478.37478h0a14.00455,14.00455,0,0,1-19.66674-10.71872L688.072,442.98155l12.59979-6.7845,15.9909,20.93355A14.00455,14.00455,0,0,1,711.343,478.37478Z" transform="translate(-236 -72.55738)" fill="#ffb9b9"></path>
                  <path d="M739.94024,283.50047l-4.63369.13763-12.853-18.20724c-16.46951,1.70257-29.96494,8.858-41.38524,19.81828l-1.15795-7.71966a29.10153,29.10153,0,0,1,22.90286-32.81892h.00006a29.10153,29.10153,0,0,1,34.57213,23.6573Z" transform="translate(-236 -72.55738)" fill="#2f2e41"></path>
                  <path d="M687.82806,453.82563v0a14.00456,14.00456,0,0,1,10.71872-19.66675l24.67452-3.60414,6.7845,12.59978L709.07224,459.1454A14.00455,14.00455,0,0,1,687.82806,453.82563Z" transform="translate(-236 -72.55738)" fill="#ffb9b9"></path>
                  <path d="M804.49034,431.38118c-23.4754,1.82279-49.10633,9.14326-75.93837,19.527a37.12074,37.12074,0,0,0-8.23832-21.80731c24.37008-6.41874,46.48406-13.95144,60.09127-25.68417L772.1666,341.387l17.93046-20.35349,3.09274,1.6136a20.65228,20.65228,0,0,1,10.4691,13.14326c7.57071,29.449,10.93351,57.66486,8.62195,84.21782A10.47079,10.47079,0,0,1,804.49034,431.38118Z" transform="translate(-236 -72.55738)" fill="#3f3d56"></path>
                  <path d="M331.88594,800.6692q-32.74851,20.483-65.49722-.01716a4.441,4.441,0,0,1-2.10125-4.0963l6.81241-88.56136h55.10049l7.78288,88.5302A4.44,4.44,0,0,1,331.88594,800.6692Z" transform="translate(-236 -72.55738)" fill="#3f3d56"></path>
                  <ellipse cx="62.39599" cy="636.43883" rx="27.80438" ry="10.01827" fill="#3f3d56"></ellipse>
                  <path d="M320.18941,705.61437q-21.73251,15.28772-42.07674,0V689.58514h42.07674Z" transform="translate(-236 -72.55738)" fill="#e23744"></path>
                  <ellipse cx="63.15104" cy="617.02776" rx="21.03837" ry="8.01462" fill="#e23744"></ellipse>
                  <ellipse cx="64.15287" cy="616.02594" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <ellipse cx="73.61397" cy="616.02594" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <ellipse cx="68.88342" cy="618.39121" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <ellipse cx="49.96121" cy="618.39121" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <ellipse cx="54.69176" cy="616.02594" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <ellipse cx="59.42232" cy="619.57385" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <path d="M936.88594,800.6692q-32.74851,20.483-65.49722-.01716a4.441,4.441,0,0,1-2.10125-4.0963l6.81241-88.56136h55.10049l7.78288,88.5302A4.44,4.44,0,0,1,936.88594,800.6692Z" transform="translate(-236 -72.55738)" fill="#3f3d56"></path>
                  <ellipse cx="667.39599" cy="636.43883" rx="27.80438" ry="10.01827" fill="#3f3d56"></ellipse>
                  <path d="M925.18941,705.61437q-21.73251,15.28772-42.07674,0V689.58514h42.07674Z" transform="translate(-236 -72.55738)" fill="#e23744"></path>
                  <ellipse cx="668.15104" cy="617.02776" rx="21.03837" ry="8.01462" fill="#e23744"></ellipse>
                  <ellipse cx="669.15287" cy="616.02594" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <ellipse cx="678.61397" cy="616.02594" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <ellipse cx="673.88342" cy="618.39121" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <ellipse cx="654.96121" cy="618.39121" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <ellipse cx="659.69176" cy="616.02594" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
                  <ellipse cx="664.42232" cy="619.57385" rx="2.00365" ry="1.00183" fill="#e6e6e6"></ellipse>
               </svg>
            </div>
            <h2 class="text-primary mb-3 font-weight-light">No restaurant <b>found</b></h2>
            <p class="lead small mb-0">Oops! Looks like no restaurant near you.</p>
            <p class="mb-5">If you think this is a problem with us, please <a onclick="foo(this)" id="help">tell us</a>.</p>
            <a data-toggle="modal" data-target="#locationModal" class="btn btn-primary text-white">Change Location</a>
        </div>





<?php } ?>


            </div>




    <!-- Modal -->
           <div class="modal fade" id="locationModal" role="dialog" style="background:#fff;">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content"  >
                    <form method="post" action="">
                        <!--div class="modal-header d-none" style="display:none;">
                          <h4  class="modal-title">Select Location</h4>
                           <span id="searchByCity" onclick="showSearchByCity();" style="display:none;" class="float-right pt-2">Search By City Name</span>
                        </div-->
                        <div class="modal-body">
                          <div id="byName" style="display:none;">
                               <img src="img/map.jpg" style="width:100%; height:250px;" >
                                <div class="input-group mt-5">
                                    <input type="text" class="form-control" name="city" placeholder="Search By City Name">
                                    <div class="input-group-btn">
                                      <button name="setlocation" class="btn btn-success" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" type="submit">
                                        Select
                                      </button>
                                    </div>
                                </div>
                                <div class="form-group m-3">
                                    <div class="text-center">OR</div>
                                </div>
                                <div class="form-group mb-5">
                                    <button onclick="showSearchByMap();" class="btn btn-success btn-block" type="button"><i class="feather-map-pin"></i> Use Location On Map</button>
                                </div>
                          </div>
                          <div id="byMap" >
                                <div id="googleMap" style="height: 500px;"></div>
                                <input type='hidden' name='lat' id='lat'>  
                                <input type='hidden' name='lng' id='lng'> 
                          </div>
                        </div>
                        <div class="modal-footer"  id="setlocation">
                          <button type="submit"   name="setlocation" class="btn btn-success btn-block" >Set Location</button>
                        </div>
                    </form>
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
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


    <?php

        if($_SESSION["userdata_c"]["lat"] == "" || $_SESSION["userdata_c"]["lng"] == "")
        {

    ?>

            <script>

                $(document).ready(function(){
                    $('#locationModal').modal({backdrop: 'static', keyboard: false});
                });

            </script>



    <?php

        }
    ?>
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
          mylat = position.coords.latitude ; 
          mylong = position.coords.longitude;
          
          /*
          if(distance(mylat, mylong, "<?php echo $_SESSION["userdata_c"]["lat"]; ?>", "<?php echo $_SESSION["userdata_c"]["lng"]; ?>", "K") > 2.5)
          {
              $('#locationModal').modal({backdrop: 'static', keyboard: false});
          }
          */
          
          
          
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

let x = new RdataTB('example',{
    //RenderJSON:[], // Convert Json to Table html 
    ShowSearch:true, // show search field,
    ShowPaginate:true, // show paginate ,
    ShowHighlight:false, // show Highlight if search
    fixedTable:true, // fixed table
    sortAnimate:false, // show animated if sorted
    ShowTfoot:false 
});


$(function() {
  return $(".carousel.lazy").on("slide.bs.carousel", function(ev) {
    var lazy;
    lazy = $(ev.relatedTarget).find("img[data-src]");
    lazy.attr("src", lazy.data('src'));
    lazy.removeAttr("data-src");
  });
});

function foo(elmnt){
        console.log(elmnt.id);
        parent.postMessage(elmnt.id, "*");
    }
    
    
     var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
			 var eventer = window[eventMethod];
			 var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
 
			 // Listen to message from child window
			 eventer(messageEvent,function(e) {
			   console.log('parent received message!:  ',e.data);
			   
			   switch (e.data) {
 
				 case "setlocation":
					 $('#locationModal').modal({backdrop: 'static', keyboard: false});
				   break;
				   
				   case "show_nonveg":
					 $(".non-veg").parent().closest('tr').show();
				   break;
				   
				   case "show_veg":
					 $(".non-veg").parent().closest('tr').hide();
				   break;
				   
				   
			   }
    
			 });
    
    
    function distance(lat1, lon1, lat2, lon2, unit) {
    if ((lat1 == lat2) && (lon1 == lon2)) {
        return 0;
    }
    else {
        var radlat1 = Math.PI * lat1/180;
        var radlat2 = Math.PI * lat2/180;
        var theta = lon1-lon2;
        var radtheta = Math.PI * theta/180;
        var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        if (dist > 1) {
            dist = 1;
        }
        dist = Math.acos(dist);
        dist = dist * 180/Math.PI;
        dist = dist * 60 * 1.1515;
        if (unit=="K") { dist = dist * 1.609344 }
        if (unit=="N") { dist = dist * 0.8684 }
        return dist;
    }
}

/*
$(document).ready(function(){
    $("#C tbody tr td").append('<input id="toggle-one" type="checkbox"  data-toggle="toggle" data-off="Non-Veg" data-on="Veg Only" data-style="ios" data-onstyle="success" data-offstyle="danger">');
    $('#toggle-one').bootstrapToggle();
    
    $('#toggle-one').change(function() {
      if($(this).prop('checked'))
      {
        $(".non-veg").parent().closest('tr').hide();
      }
      else
      {
         $(".non-veg").parent().closest('tr').show();
      }
              
    })
    
});
    */
    
    
        function showSearchByMap()
    {
        $('#setlocation').show();
        $('#byMap').show();
        $('#searchByCity').show();
        $('#byName').hide();
    }

    
    function showSearchByCity()
    {
        $('#setlocation').hide();
        $('#byMap').hide();
        $('#searchByCity').hide();
        $('#byName').show();
    }
    
    
    

</script>


</body>

</html>