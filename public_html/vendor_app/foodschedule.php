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

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

    <style>
        th { 
    display: none;
}
    </style>

</head> 

<body class="app">   	

    
    <div class="app-wrapper mt-5">
	    
	    <div class="app-content ">
		    <div class="container">
			    
			    <?php

                    $week = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

                    $dinner = $lunch = $breakfast = 0; 

                    $sql = "SELECT * FROM vendors WHERE id = '".$_SESSION["userdata"]["id"]."'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        
                        $dinner = $lunch = $breakfast = 7;
                        
                    }
                ?>
			

			    <div class="row g-4 mb-4">
				    
                    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div onclick="showBf();" class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Breakfast Foods</h4>
							    <div class="stats-figure"><span class="badge bg-info"><?php echo $breakfast; ?></span></div>
				            </div>
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->

                    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div onclick="showLu();" class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Lunch Foods</h4>
							    <div class="stats-figure"><span class="badge bg-info"><?php echo $lunch; ?></span></div>
				            </div>
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div onclick="showDn();" class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Dinner Foods</h4>
								<div class="stats-figure"><span class="badge bg-info"><?php echo $dinner; ?></span></div>
							    <div class="stats-meta text-success">
								    </div>
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->
                </div>


             


                <div class="row g-4 mb-4">
			        <div class="col-12 col-lg-12">
				        <div class="app-card app-card-chart h-100 shadow-sm">
					        
					        <div class="app-card-body p-3 p-lg-4">
							   
						        <div class="chart-container">
								<div class="table-responsive" id="scheduleTableBfCon">


                                    
				<table class="table app-table-hover" id="scheduleTableBf" >
					<thead>
						<tr>
							<th></th>
						</tr>
					</thead>
					<tbody id="tableBody">
						
						
<?php

$result = $conn->query($sql);
if ($result->num_rows > 0) {

    $row = $result->fetch_array();
	// Breakfast Foods

    $breakfastfoods_arr = array();

    $breakfastfoods_arr[] = $row['mon_bf'];
    $breakfastfoods_arr[] = $row['tue_bf'];
    $breakfastfoods_arr[] = $row['wed_bf'];
    $breakfastfoods_arr[] = $row['thu_bf'];
    $breakfastfoods_arr[] = $row['fri_bf'];
    $breakfastfoods_arr[] = $row['sat_bf'];
    $breakfastfoods_arr[] = $row['sun_bf'];


    for($i=0; $i<7; $i++)
    {
        $food_imgs = array();
        $food_id = $breakfastfoods_arr[$i];
        $sql_food = "SELECT * FROM food_items WHERE id = '".$food_id."'";
        $result_food = $conn->query($sql_food);
        $row_food = $result_food->fetch_assoc();

        $sql_imgs = "SELECT * FROM food_images WHERE food_id = '".$food_id."' ";
        $result_imgs = $conn->query($sql_imgs);
		if ($result_imgs->num_rows > 0) {

			while($row_imgs = $result_imgs->fetch_assoc())
			{
				array_push($food_imgs, $row_imgs['food_img']);
			}

		}
		else
		{
			array_push($food_imgs, 'test.jpg');
		}


?>

						<tr class="breakfast">
							<td>
                           
							<div class="app-card app-card-doc shadow-sm h-100">
						    <div class="app-card-thumb-holder p-3">
								<div class="app-card-thumb">


												<!-- Carousel -->
												<div class="carousel slide lazy" data-bs-ride="carousel">  
												  <!-- The slideshow/carousel -->
												  <div class="carousel-inner">


												  <?php $fi_slider = 1; foreach($food_imgs as $fi_url) { ?>

													<div class="carousel-item <?php if($fi_slider == 1) { echo 'active'; } ?>">
												      <img <?php if($fi_slider > 1 ) { echo "data-src='uploads/food/"; } else { echo "src='uploads/food/"; } echo $fi_url."'"; ?>  class="d-block thumb-image" style="width:100%">
												    </div>

												  <?php $fi_slider++; } ?>

												    

												   

												  </div>
												</div>






	                            </div>
	                            
						    </div>
						    <div class="app-card-body p-3 has-card-actions">
							    
							    <h4 class="app-doc-title truncate mb-0"><?php echo $week[$i]; ?></h4>
							    <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
                                        <li class="text-truncate"><span class="text-muted">Food Name:</span> <?php echo $row_food['food_name']; ?></li>
										<li><span class="text-muted">Price:</span> ₹ <?php echo $row_food['food_price']; ?></li>
										<li><span class="text-muted">Food Type:</span> <?php if($row_food['food_type'] == 1) { echo '🟩 Veg'; }  else { echo '🟥 Non-Veg'; } ?></li>
									    <li><span class="text-muted">Serve Time:</span> <?php if($row_food['serve_time'] == 1) { echo 'Breakfast'; } else if($row['serve_time'] == 2) { echo 'Lunch'; } else { echo 'Dinner'; } ?></li>
								    </ul>
							    </div><!--//app-doc-meta-->
							    
							    <div class="app-card-actions">
								    <div class="dropdown">
									    <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
										    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
			</svg>
									    </div><!--//dropdown-toggle-->
									    <ul class="dropdown-menu">

                                        <li class="px-3"><?php echo $row_food['food_details']; ?></li>
					
											
										</ul>
								    </div><!--//dropdown-->
						        </div><!--//app-card-actions-->
								    
						    </div><!--//app-card-body-->

						</div>


                        
                        </div>
                    
                    
           
							
						</tr>

<?php }  } else { ?>

    <tr><td>No schedule found</td></tr>

    <?php } ?>

					</tbody>
				  </table>




</div>

                  <div class="table-responsive" style="display:none;" id="scheduleTableLunCon">

                  <table class="table app-table-hover"  id="scheduleTableLun" >
					<thead>
						<tr>
							<th></th>
						</tr>
					</thead>
					<tbody id="tableBody">
<?php

$result = $conn->query($sql);
if ($result->num_rows > 0) {

    $row_lun = $result->fetch_array();
	// Lunch Foods

    $lunchfoods_arr = array();

    $lunchfoods_arr[] = $row_lun['mon_lun'];
    $lunchfoods_arr[] = $row_lun['tue_lun'];
    $lunchfoods_arr[] = $row_lun['wed_lun'];
    $lunchfoods_arr[] = $row_lun['thu_lun'];
    $lunchfoods_arr[] = $row_lun['fri_lun'];
    $lunchfoods_arr[] = $row_lun['sat_lun'];
    $lunchfoods_arr[] = $row_lun['sun_lun'];


    for($i=0; $i<7; $i++)
    {
        $food_imgs_lun = array();
        $food_id = $lunchfoods_arr[$i];
        $sql_food = "SELECT * FROM food_items WHERE id = '".$food_id."'";
        $result_food_lun = $conn->query($sql_food);
        $row_food_lun = $result_food_lun->fetch_assoc();

        $sql_imgs_lun = "SELECT * FROM food_images WHERE food_id = '".$food_id."' ";
        $result_imgs_lun = $conn->query($sql_imgs);
		if ($result_imgs_lun->num_rows > 0) {

			while($row_imgs_lun = $result_imgs_lun->fetch_assoc())
			{
				array_push($food_imgs_lun, $row_imgs_lun['food_img']);
			}

		}
		else
		{
			array_push($food_imgs_lun, 'test.jpg');
		}


?>

						<tr>
							<td>
                           
							<div class="app-card app-card-doc shadow-sm h-100">
						    <div class="app-card-thumb-holder p-3">
								<div class="app-card-thumb">


												<!-- Carousel -->
												<div class="carousel slide lazy" data-bs-ride="carousel">  
												  <!-- The slideshow/carousel -->
												  <div class="carousel-inner">


												  <?php $fi_slider = 1; foreach($food_imgs_lun as $fi_url) { ?>

													<div class="carousel-item <?php if($fi_slider == 1) { echo 'active'; } ?>">
												      <img <?php if($fi_slider > 1 ) { echo "data-src='uploads/food/"; } else { echo "src='uploads/food/"; } echo $fi_url."'"; ?>  class="d-block thumb-image" style="width:100%">
												    </div>

												  <?php $fi_slider++; } ?>

												    

												   

												  </div>
												</div>






	                            </div>
	                            
						    </div>
						    <div class="app-card-body p-3 has-card-actions">
							    
                            <h4 class="app-doc-title truncate mb-0"><?php echo $week[$i]; ?></h4>
							    <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
                                    <li class="text-truncate"><span class="text-muted">Food Name:</span> <?php echo $row_food_lun['food_name']; ?></li>
										<li><span class="text-muted">Price:</span> ₹ <?php echo $row_food_lun['food_price']; ?></li>
										<li><span class="text-muted">Food Type:</span> <?php if($row_food_lun['food_type'] == 1) { echo '🟩 Veg'; }  else { echo '🟥 Non-Veg'; } ?></li>
									    <li><span class="text-muted">Serve Time:</span> Lunch</li>
								    </ul>
							    </div><!--//app-doc-meta-->
							    
							    <div class="app-card-actions">
								    <div class="dropdown">
									    <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
										    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
			</svg>
									    </div><!--//dropdown-toggle-->
									    <ul class="dropdown-menu">

                                        <li class="px-3"><?php echo $row_food_lun['food_details']; ?></li>
					
											
										</ul>
								    </div><!--//dropdown-->
						        </div><!--//app-card-actions-->
								    
						    </div><!--//app-card-body-->

						</div>


                        
                        </div>
                    
                    
           
							
						</tr>

<?php }  } else { ?>

    <tr><td>No schedule found</td></tr>

    <?php } ?>


    </tbody>
				  </table>

</div>

<div class="table-responsive" style="display:none;" id="scheduleTableDinCon">

                  <table class="table app-table-hover"  id="scheduleTableDin" >
					<thead>
						<tr>
							<th></th>
						</tr>
					</thead>
					<tbody id="tableBody">

<?php

$result = $conn->query($sql);
if ($result->num_rows > 0) {

    $row_dinner = $result->fetch_array();
	// Dinner Foods

    $dinnerfoods_arr = array();

    $dinnerfoods_arr[] = $row_dinner['mon_din'];
    $dinnerfoods_arr[] = $row_dinner['tue_din'];
    $dinnerfoods_arr[] = $row_dinner['wed_din'];
    $dinnerfoods_arr[] = $row_dinner['thu_din'];
    $dinnerfoods_arr[] = $row_dinner['fri_din'];
    $dinnerfoods_arr[] = $row_dinner['sat_din'];
    $dinnerfoods_arr[] = $row_dinner['sun_din'];


    for($i=0; $i<7; $i++)
    {
        $food_imgs_din = array();
        $food_id = $dinnerfoods_arr[$i];
        $sql_food = "SELECT * FROM food_items WHERE id = '".$food_id."'";
        $result_food = $conn->query($sql_food);
        $row_food_din = $result_food->fetch_assoc();

        $sql_imgs = "SELECT * FROM food_images WHERE food_id = '".$food_id."' ";
        $result_imgs = $conn->query($sql_imgs);
		if ($result_imgs->num_rows > 0) {

			while($row_imgs_din = $result_imgs->fetch_assoc())
			{
				array_push($food_imgs_din, $row_imgs_din['food_img']);
			}

		}
		else
		{
			array_push($food_imgs_din, 'test.jpg');
		}


?>

						<tr >
							<td>
                           
							<div class="app-card app-card-doc shadow-sm h-100">
						    <div class="app-card-thumb-holder p-3">
								<div class="app-card-thumb">


												<!-- Carousel -->
												<div class="carousel slide lazy" data-bs-ride="carousel">  
												  <!-- The slideshow/carousel -->
												  <div class="carousel-inner">


												  <?php $fi_slider = 1; foreach($food_imgs_din as $fi_url) { ?>

													<div class="carousel-item <?php if($fi_slider == 1) { echo 'active'; } ?>">
												      <img <?php if($fi_slider > 1 ) { echo "data-src='uploads/food/"; } else { echo "src='uploads/food/"; } echo $fi_url."'"; ?>  class="d-block thumb-image" style="width:100%">
												    </div>

												  <?php $fi_slider++; } ?>

												    

												   

												  </div>
												</div>






	                            </div>
	                            
						    </div>
						    <div class="app-card-body p-3 has-card-actions">
							    
                            <h4 class="app-doc-title truncate mb-0"><?php echo $week[$i]; ?></h4>
							    <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
                                    <li class="text-truncate"><span class="text-muted">Food Name:</span> <?php echo $row_food_din['food_name']; ?></li>
										<li><span class="text-muted">Price:</span> ₹ <?php echo $row_food_din['food_price']; ?></li>
										<li><span class="text-muted">Food Type:</span> <?php if($row_food_din['food_type'] == 1) { echo '🟩 Veg'; }  else { echo '🟥 Non-Veg'; } ?></li>
									    <li><span class="text-muted">Serve Time:</span> Dinner</li>
								    </ul>
							    </div><!--//app-doc-meta-->
							    
							    <div class="app-card-actions">
								    <div class="dropdown">
									    <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
										    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
			</svg>
									    </div><!--//dropdown-toggle-->
									    <ul class="dropdown-menu">

                                        <li class="px-3"><?php echo $row_food_din['food_details']; ?></li>
					
											
										</ul>
								    </div><!--//dropdown-->
						        </div><!--//app-card-actions-->
								    
						    </div><!--//app-card-body-->

						</div>


                        
                        </div>
                    
                    
           
							
						</tr>

<?php }  } else { ?>

    <tr><td>No schedule found</td></tr>

    <?php } ?>

    </tbody>
				  </table>













			</div>
						        </div>
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
			       
			        
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

	<script>



   


    function showBf()
    {
        $("#scheduleTableBfCon").show();
        $("#scheduleTableLunCon").hide();
        $("#scheduleTableDinCon").hide();

    }

    function showLu()
    {
        $("#scheduleTableBfCon").hide();
        $("#scheduleTableLunCon").show();
        $("#scheduleTableDinCon").hide();
        
    }

    function showDn()
    {
        $("#scheduleTableBfCon").hide();
        $("#scheduleTableLunCon").hide();
        $("#scheduleTableDinCon").show();
    }

    $(function() {
  return $(".carousel.lazy").on("slide.bs.carousel", function(ev) {
    var lazy;
    lazy = $(ev.relatedTarget).find("img[data-src]");
    lazy.attr("src", lazy.data('src'));
    lazy.removeAttr("data-src");
  });
});


</script>

</body>
</html> 