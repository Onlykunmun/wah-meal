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
	<script src="assets/js/RdataTB.js"></script> 
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

    <style>
        th { 
    display: none;
}
    </style>

</head> 

<body class="app">   	

    
    <div class="app-wrapper">
	    
	    <div class="app-content mt-5">
		    <div class="container">
			    
			    <?php

                    $dinner = $lunch = $breakfast = $veg = $nonveg = 0; 

                    $sql = "SELECT * FROM food_items WHERE vendor_id = '".$_SESSION["userdata"]["id"]."' AND is_deleted = 0 ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        
                        while($row = $result->fetch_assoc()) {
                            
                            if($row['food_type'] == 1)
                            {
                                $veg++;
                            }

                            if($row['food_type'] == 2)
                            {
                                $nonveg++;
                            }

                            if($row['serve_time'] == 1)
                            {
                                $breakfast++;
                            }

                            if($row['serve_time'] == 2)
                            {
                                $lunch++;
                            }

                            if($row['serve_time'] == 3)
                            {
                                $dinner++;
                            }

                        }
                        
                    }
                ?>
			

			    <div class="row g-4 mb-4">
				    
                    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Breakfast Foods</h4>
							    <div class="stats-figure"><span class="badge bg-info"><?php echo $breakfast; ?></span></div>
				            </div>
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->

                    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Lunch Foods</h4>
							    <div class="stats-figure"><span class="badge bg-info"><?php echo $lunch; ?></span></div>
				            </div>
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->
				    
				    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
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
				    <div class="col-6 col-lg-6">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">🟩 Veg</h4>
							   
								<div class="stats-figure"><?php echo $veg; ?></div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->


				    <div class="col-6 col-lg-6">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">🟥 Non-Veg</h4>
								
							    <div class="stats-figure"><?php echo $nonveg; ?></div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->
			    </div><!--//row-->


                <div class="row g-4 mb-4">
			        <div class="col-12 col-lg-12">
				        <div class="app-card app-card-chart h-100 shadow-sm">
					        
					        <div class="app-card-body p-3 p-lg-4">
							   
						        <div class="chart-container">
								<div class="table-responsive">
				<table class="table app-table-hover" id="myTable" >
					<thead>
						<tr>
							<th></th>
						</tr>
					</thead>
					<tbody>
						
						
<?php

$result = $conn->query($sql);
if ($result->num_rows > 0) {

while($row = $result->fetch_array()) {
	




			$sql_food_img = "SELECT * FROM food_images WHERE food_id = '".$row['id']."' ";
			$result_food_img = $conn->query($sql_food_img);
			if ($result_food_img->num_rows > 0) {

				$row_food_img = $result_food_img->fetch_assoc();
				$food_img = $row_food_img['food_img'];
			}
			else
			{
				$food_img = 'test.jpg';
			}

?>

						<tr>
							<td>
                           
							<div class="app-card app-card-doc shadow-sm h-100">
						    <div class="app-card-thumb-holder p-3">
								<div class="app-card-thumb">
	                                <img class="thumb-image" src="uploads/food/<?php echo $food_img; ?>" alt="">
	                            </div>
	                            
						    </div>
						    <div class="app-card-body p-3 has-card-actions">
							    
							    <h4 class="app-doc-title truncate mb-0"><?php echo $row['food_name']; ?></h4>
							    <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
										<li><span class="text-muted">Price:</span> ₹ <?php echo $row['food_price']; ?></li>
										<li><span class="text-muted">Food Type:</span> <?php if($row['food_type'] == 1) { echo '🟩 Veg'; }  else { echo '🟥 Non-Veg'; } ?></li>
									    <li><span class="text-muted">Serve Time:</span> <?php if($row['serve_time'] == 1) { echo 'Breakfast'; } else if($row['serve_time'] == 2) { echo 'Lunch'; } else { echo 'Dinner'; } ?></li>
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

                                        <li class="px-3"><?php echo $row['food_details']; ?></li>
					
											
										</ul>
								    </div><!--//dropdown-->
						        </div><!--//app-card-actions-->
								    
						    </div><!--//app-card-body-->

						</div>


                        
                        </div>
                    
                    
           
							
						</tr>

<?php }  } else { ?>

<tr><td>No food found</td></tr>

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

	let x = new RdataTB('myTable',{
		//RenderJSON:[], // Convert Json to Table html 
		ShowSearch:true, // show search field,
		ShowPaginate:true, // show paginate ,
		ShowHighlight:false, // show Highlight if search
	    fixedTable:true, // fixed table
        sortAnimate:false, // show animated if sorted
		ShowTfoot:false 
	});

</script>

</body>
</html> 

