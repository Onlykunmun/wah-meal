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
else
{
	$_SESSION["welcome"] = 0;
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

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <style>
        th { 
    display: none;
	}

	.btn-link-green {
    padding: .25rem;
    border-radius: 0;
    border: none;
    box-shadow: none;
    background: none;
    font-size: 1rem;
    text-decoration: none;
    color: #15a362;
	width:40%;
	}


    </style>
</head> 

<body class="app">   	

    
<?php


if(isset($_POST['accept']))
{
	$sub_id = $_POST['accept'];
	$sql_accept = "UPDATE order_subscription SET accept_reject = 1 WHERE id = '$sub_id'";
	if($conn->query($sql_accept))
	{
		echo "<script>alert('Accepted successfully');</script>";
	} 
}

if(isset($_POST['reject']))
{
	$sub_id = $_POST['reject'];
	$sql_reject = "UPDATE order_subscription SET accept_reject = 2, reject_by = 2 WHERE id = '$sub_id'";
	if($conn->query($sql_reject))
	{
		echo "<script>alert('Declined successfully');</script>";
	} 
}


?>


    <div class="app-wrapper mt-5">
	    
	    <div class="app-content ">
		    <div class="container">
			    
			    <?php

									$total_subscription = 0;
									$pending_subscription = 0;
									$ongoing_subscription = 0;
									$completed_subscription = 0;
									$cancled_subscription = 0;

									$sql_subscription = "SELECT * FROM order_subscription WHERE vendor_id = '".$_SESSION["userdata"]["id"]."' AND is_paid = 1  ";
									
									if($result_subscription = $conn->query($sql_subscription))
									{
										while($row_subscription = $result_subscription->fetch_assoc()) {
												if($row_subscription['accept_reject'] == 0 && $row_subscription['end_date'] > date('Y-m-d') )
												{
													$pending_subscription++;
												}
												if($row_subscription['accept_reject'] == 1)
												{
													$total_subscription++;
												}
												
												if($row_subscription['accept_reject'] == 2  )
												{
													$cancled_subscription++;
												}
											
												
												$package_duration = $row_subscription['package_duration'];
												$odr_id = $row_subscription['id'];
												
												$sql_chk = "SELECT * FROM food_processing_status WHERE food_order_id = '$odr_id' AND processing_status = 4 ";
												$result_chk = $conn->query($sql_chk);

                                                if ($result_chk->num_rows == $package_duration) {
                                                    	$completed_subscription++;
                                                }
                                                else
                                                {
                                                    if($row_subscription['accept_reject'] == 1)
												    {
												        $ongoing_subscription++;
												    }
                                                    
                                                }
										}
									}
									else
									{
										$total_subscription = 0;
									    $pending_subscription = 0;
									    $ongoing_subscription = 0;
									    $completed_subscription = 0;
									    $cancled_subscription = 0;
									}
								?>
			    
			
			    <div class="row g-4 mb-4">
				  
				    
				  
				    <div class="col-6">
				        <a href="totalsubs.php">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Pending Subscription</h4>
							    
							    
							   
								<div class="stats-figure"><span class="badge bg-warning"><?php echo $pending_subscription; ?></span></div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
					    </a>
				    </div><!--//col-->
				    
				     <div class="col-6">
				          <a href="ongoing_sub.php">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Ongoing Subscription</h4>
							    
							    
							   
								<div class="stats-figure"><span class="badge bg-info"><?php echo $ongoing_subscription; ?></span></div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
					    </a>
				    </div><!--//col-->
				    
				     <div class="col-6">
				          <a href="completed_sub.php">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Completed Subscription</h4>
							    
							    
							   
								<div class="stats-figure"><span class="badge bg-success"><?php echo $completed_subscription; ?></span></div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
					    </a>
				    </div><!--//col-->
				    
				      <div class="col-6">
				           <a href="cancled_sub.php">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Cancled Subscription</h4>
							    
							    
							   
								<div class="stats-figure"><span class="badge bg-danger"><?php echo $cancled_subscription; ?></span></div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
					    </a>
				    </div><!--//col-->
					
				  

					


			    </div><!--//row-->




			    <div class="row g-4 mb-4">
			        <div class="col-12">
				        <div class="app-card app-card-chart h-100 shadow-sm">
					        <div class="app-card-header p-3">
						        <div class="row justify-content-between align-items-center">
							        <div class="col-auto">
						                <h4 class="app-card-title"><span class="badge bg-info">Ongoing Subscription <span class="badge bg-danger"><?php echo $ongoing_subscription; ?></span></span> </h4> 
							        </div><!--//col-->
							        
						        </div><!--//row-->
					        </div><!--//app-card-header-->
					        <div class="app-card-body p-3 p-lg-4">
							   
						        <div class="chart-container">
								<div class="table-responsive">
				<table class="table app-table-hover" id="myTable" >
					<thead>
						<tr>
							<th class="cell"></th>
						</tr>
					</thead>
					<tbody>
						
						
<?php
			$date_of_today = date('Y-m-d');						
$sql_subscription = "SELECT * FROM order_subscription WHERE vendor_id = '".$_SESSION["userdata"]["id"]."' AND is_paid = 1 AND accept_reject = 1  ORDER BY subscription_date DESC ";
if($result_subscription = $conn->query($sql_subscription))
{
while($row_subscription = $result_subscription->fetch_assoc()) {
    
    $package_duration = $row_subscription['package_duration'];
		$odr_id = $row_subscription['id'];
		
			$sql_chk = "SELECT * FROM food_processing_status WHERE food_order_id = '$odr_id' AND processing_status = 4 ";
												$result_chk = $conn->query($sql_chk);

                                               if ($result_chk->num_rows != $package_duration) {
    
	
	if($row_subscription['serve_time'] == 1)
	{
		$package_name = "Breakfast Package";
	}
	elseif($row_subscription['serve_time'] == 2)
	{
		$package_name = "Lunch Package";
	}
	else
	{
		$package_name = "Dinner Package";
	}

	
		$food_imgs = array();
		$sql_food = "SELECT DISTINCT fi.food_img FROM food_processing_status fps LEFT JOIN food_images fi on fps.food_id = fi.food_id WHERE food_order_id = '".$row_subscription['id']."'  ";
		$result_food = $conn->query($sql_food);
		if ($result_food->num_rows > 0) {

			while($row_food = $result_food->fetch_assoc())
			{
				array_push($food_imgs, $row_food['food_img']);
			}

		}
		else
		{
			array_push($food_imgs, 'test.jpg');
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


												  <?php $fi_slider = 1; foreach($food_imgs as $fi_url) { ?>

													<div class="carousel-item <?php if($fi_slider == 1) { echo 'active'; } ?>">
												      <img <?php if($fi_slider > 1 ) { echo "data-src='uploads/food/"; } else { echo "src='uploads/food/"; } echo $fi_url."'"; ?>  class="d-block thumb-image" style="width:100%">
												    </div>

												  <?php $fi_slider++; } ?>

												    

												   

												  </div>
												</div>






	                            </div>
	                            <span class="badge bg-success">NEW</span>
						    </div>
						    <div class="app-card-body p-3 has-card-actions">
							    
							    <h4 class="app-doc-title truncate mb-0"><?php echo $package_name; ?></h4>
							    <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
										<li><span class="text-muted">Order Id:</span> <?php echo "WAHM".$row_subscription['id']; ?></li>
										<li><span class="text-muted">Price:</span>  <?php echo $row_subscription['subscription_price']; ?></li>
									    <li><span class="text-muted">Subscription Duration:</span> <?php echo $row_subscription['package_duration']; ?> Days</li>
										
									    <li><span class="text-muted">Serve Time:</span> <?php if($row_subscription['serve_time'] == 1) { echo 'Breakfast'; } else if($row_subscription['serve_time'] == 2) { echo 'Lunch'; } else { echo 'Dinner'; } ?></li>
									    <li><span class="text-muted">Subscription Date:</span> <?php echo date("d/m/Y", strtotime($row_subscription['subscription_date'])); ?></li>
										<li><span class="text-muted">Start From:</span> <?php echo date("d/m/Y", strtotime($row_subscription['start_date'])); ?></li>
										<li><span class="text-muted">Ends On:</span> <?php echo date("d/m/Y", strtotime($row_subscription['end_date'])); ?></li>
										<li><hr class="dropdown-divider"></li>
										<li>

										<button onclick="customerAddress(<?php echo $row_subscription['id']; ?>);" class="btn btn-link btn-link-green" type="button" >
							        		Customer Details
							      		</button>

										<button onclick="subFood(<?php echo $row_subscription['id']; ?>);" class="btn btn-link btn-link-green float-end" type="button" >
							        		Subscription Details
							      		</button>

										</li>
								    </ul>
							    </div><!--//app-doc-meta-->
							    
							  <!--//app-card-actions-->
								    
						    </div><!--//app-card-body-->

						</div>
							</td>
							
						</tr>

<?php } } }  ?>

					</tbody>
				  </table>
			</div>
						        </div>
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
			      
			        
			    </div><!--//row-->

			  <style>
.modal-dialog {
    margin-top: 10vh;
}

</style>


		<div class="modal fade" id="customerDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" id="waitDialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
				
                   
				Customer Details
				</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="customerDetailsModalBody">
                   
                </div>
                
            </div>
            </div>
        </div>  


		<div class="modal fade" id="subFoodDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" id="waitDialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
				
                   
				Subscription Details
				</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="subFoodDetailsModalBody">
                   
                </div>
                
            </div>
            </div>
        </div>  




			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    
	    
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script> 
    <script>


						<?php

							$back_dates = array();
							$my_earning = array();
							for($i=6; $i>=0; $i--)
							{
								$date = date("Y-m-d", strtotime("-".$i." day"));
								

								$sql_earning_graph = "SELECT vendor_earning FROM order_subscription WHERE subscription_date = '".$date."' AND is_paid = 1 AND vendor_id = '".$_SESSION["userdata"]["id"]."' ";
								$result = $conn->query($sql_earning_graph);
								if ($result->num_rows > 0) 
									{
										$row = $result->fetch_assoc();
										$earning = $row['vendor_earning'];
									}
									else
									{
										$earning = 0;
									}
								$my_earning[] = $earning;	

								$back_dates[] = date('d/m/Y', strtotime($date));
							}

							

				
						?>



		window.chartColors = {
				green: '#75c181', // rgba(117,193,129, 1)
				blue: '#5b99ea', // rgba(91,153,234, 1)
				gray: '#a9b5c9',
				text: '#252930',
				border: '#e7e9ed'
			};

			var lineChartConfig = {
	type: 'line',

	data: {
		labels: <?php echo json_encode($back_dates); ?>,
		
		datasets: [{
			label: 'My Earnings',
			backgroundColor: "rgba(117,193,129,0.2)", 
			borderColor: "rgba(117,193,129, 0.8)", 
			data: <?php echo json_encode($my_earning); ?>,
		}]
	},
	options: {
		responsive: true,		
		
		legend: {
			display: true,
			position: 'bottom',
			align: 'end',
		},

		tooltips: {
			mode: 'index',
			intersect: false,
			titleMarginBottom: 10,
			bodySpacing: 10,
			xPadding: 16,
			yPadding: 16,
			borderColor: window.chartColors.border,
			borderWidth: 1,
			backgroundColor: '#fff',
			bodyFontColor: window.chartColors.text,
			titleFontColor: window.chartColors.text,
            callbacks: {
                label: function(tooltipItem, data) {	                 
	                return " ₹ "+tooltipItem.value;   
                }
            },
            

		},
		hover: {
			mode: 'nearest',
			intersect: true
		},
		scales: {
			xAxes: [{
				display: true,
				gridLines: {
					drawBorder: false,
					color: window.chartColors.border,
				},
				scaleLabel: {
					display: false,
				
				}
			}],
			yAxes: [{
				display: true,
				gridLines: {
					drawBorder: false,
					color: window.chartColors.border,
				},
				scaleLabel: {
					display: false,
				},
				ticks: {
		            beginAtZero: true,
		            userCallback: function(value, index, values) {
		                return " "+value.toLocaleString();  
		            }
		        },
			}]
		}
	}
};

window.addEventListener('load', function(){
	var lineChart = document.getElementById('chart-line').getContext('2d');
	window.myLine = new Chart(lineChart, lineChartConfig);
});	

	</script>
    
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

<script>

	function customerAddress(cid)
	{
		$('#customerDetailsModalBody').html("");
		$('#customerDetailsModal').modal('show'); 
		$.ajax({
        url: 'ajax.php',
        type: 'post',
        data: {ajax_type: 'cust_data', order_id : cid},
        success: function(response) {
           if (response) {
			$("#customerDetailsModalBody").html(response);
           }else {
               $("#customerDetailsModalBody").html("Something went wrong!!!");
           }
         }
    	});
	}


	function subFood(oid)
	{
		$('#subFoodDetailsModalBody').html();
		$('#subFoodDetailsModal').modal('show'); 
		$.ajax({
        url: 'ajax.php',
        type: 'post',
        data: {ajax_type: 'subFood_data', order_id : oid},
        success: function(response) {
           if (response) {
			$("#subFoodDetailsModalBody").html(response);
           }else {
               $("#subFoodDetailsModalBody").html("Something went wrong!!!");
           }
         }
    	});
	}


	

</script>


<script>

$(function() {
  return $(".carousel.lazy").on("slide.bs.carousel", function(ev) {
    var lazy;
    lazy = $(ev.relatedTarget).find("img[data-src]");
    lazy.attr("src", lazy.data('src'));
    lazy.removeAttr("data-src");
  });
});

 function foo(elmnt){
        console.log(elmnt.rel);
        parent.postMessage(elmnt.rel, "*");
    }

</script>


</body>
</html> 

