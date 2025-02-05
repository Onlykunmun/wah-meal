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
    
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />



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
	
	.modal-dialog {
    margin-top: 10vh;
}
	
    </style>

</head> 

<body class="app">   	

    
    <div class="app-wrapper mt-5">
	    
	    <div class="app-content ">
		    <div class="container">
			    
			    <?php


                    if(isset($_POST['start_date']) && isset($_POST['end_date']) )
                    {
                        $start_date = date("Y-m-d", strtotime($_POST['start_date']));
                        $end_date = date("Y-m-d", strtotime($_POST['end_date']));
                    }
                    else
                    {
                        $start_date = date("Y-m-d", strtotime('-29 day'));
                        $end_date = date("Y-m-d");
                    }

                    $total_sales = $total_subs = $ongoing = $completed = 0; 

                    $sql = "SELECT * FROM order_subscription WHERE vendor_id = '".$_SESSION["userdata"]["id"]."' AND is_paid = 1 AND accept_reject = 1 AND subscription_date BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY subscription_date DESC ";
                    //echo $sql;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        
                        while($row = $result->fetch_assoc()) {
                            
                            
                            
                            $package_duration = $row['package_duration'];
							$odr_id = $row['id'];
							
							$sql_chk = "SELECT * FROM food_processing_status WHERE food_order_id = '$odr_id' AND processing_status = 4 ";
							$result_chk = $conn->query($sql_chk);

                            if ($result_chk->num_rows == $package_duration) {
                                	$completed++;
                            }
                            else
                            {
                                $ongoing++;
                            }
                            

                            $total_sales = $total_sales + $row['vendor_earning'];
                            $total_subs++;
                           

                        }
                        
                    }
                ?>
			

                <div class="row g-4 mb-4">                
				    <div class="col-12 col-lg-12">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							   
							   
								<div class="stats-figure">

                                <div class="row">
                                    <div class="col-10 px-1">
                                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 6px; border: 1px solid #ccc; width: 100%">
                                             <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span> 
                                        </div>
                                    </div>

                                    <div class="col-2 px-0">
                                            <form id="myForm" method="POST">
                                                <input id="start_date" name="start_date" type="hidden" value="">
                                                <input id="end_date" name="end_date" type="hidden" value="">
                                                <button type="submit" class="btn app-btn-secondary" style="height:39px;" ><i class="fa fa-search"></i></button>
                                            </form>
                                    </div>
                                </div>
                                        
                                

                                


                                </div>
							    
						    </div><!--//app-card-body-->
						   
					    </div><!--//app-card-->
				    </div><!--//col-->
                </div>


             <div class="row g-4 mb-4">                
				    <div class="col-6 col-lg-6">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Total Sales</h4>
							   
								<div class="stats-figure">₹ <?php echo $total_sales; ?></div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->


				    <div class="col-6 col-lg-6">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Total Subscriptions</h4>
								
							    <div class="stats-figure"><?php echo $total_subs; ?></div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->


				    <div class="col-6 col-lg-6">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Ongoing</h4>
								
								<div class="stats-figure"><span class="badge bg-info"><?php echo $ongoing; ?></span></div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->


                    <div class="col-6 col-lg-6">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Completed</h4>
								
							    <div class="stats-figure"><span class="badge bg-success"><?php echo $completed; ?></span></div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->


			    </div><!--//row-->


                <div class="row g-4 mb-4">
                    
                     <div class="col-12 col-lg-6">
				        <div class="app-card app-card-chart h-100 shadow-sm">
					        <div class="app-card-header p-3">
						        <div class="row justify-content-between align-items-center">
							        <div class="col-12 text-center">
						                <h4 class="app-card-title ">Sales Report <br/> <span style="font-size:14px;"><?php echo date('D, M j, Y', strtotime($start_date))." - ".date('D, M j, Y', strtotime($end_date)) ?></span></h4>
							        </div><!--//col-->
							        
						        </div><!--//row-->
					        </div><!--//app-card-header-->
					        <div class="app-card-body p-3 p-lg-4">
							   
						        <div class="chart-container">
				                    <canvas id="chart-line" ></canvas>
						        </div>
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
                    
                    
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
	

    
    
    
    
    
                               $package_duration = $row['package_duration'];
		$odr_id = $row['id'];
		
			$sql_chk = "SELECT * FROM food_processing_status WHERE food_order_id = '$odr_id' AND processing_status = 4 ";
												$result_chk = $conn->query($sql_chk);

                                               if ($result_chk->num_rows != $package_duration) {
                                                   
                                                   $ongoing_dt = 1;
                                                   
                                               }
                                               else
                                               {
                                                   $ongoing_dt = 0;
                                               }
    
    
    
    

    if($row['serve_time'] == 1)
	{
		$package_name = "Breakfast Package";
	}
	elseif($row['serve_time'] == 2)
	{
		$package_name = "Lunch Package";
	}
	else
	{
		$package_name = "Dinner Package";
	}


?>

					
                    
<tr>
							<td>
							<div class="app-card app-card-doc shadow-sm h-100">
						    <div class="app-card-thumb-holder p-3">
                                <span class="icon-holder">
	                                <i class="fas fa-file-alt text-file"></i>
	                            </span>
	                           
	                            
						    </div>
						    <div class="app-card-body p-3 has-card-actions">
							    
							    <h4 class="app-doc-title truncate mb-0"><?php echo $package_name; ?></h4>
							    <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
                                        <li><span class="text-muted">Order Id:</span> <?php echo "WAHM".$row['id']; ?></li>
										<li><span class="text-muted">Price:</span> ₹ <?php echo $row['subscription_price']; ?></li>
									    <li><span class="text-muted">Subscription Duration:</span> <?php echo $row['package_duration']; ?> Days</li>
										<li><span class="text-muted">Food Type:</span> <?php if($row['food_type'] == 1) { echo '🟩 Veg'; }  else { echo ' Non-Veg'; } ?></li>
									    <li><span class="text-muted">Serve Time:</span> <?php if($row['serve_time'] == 1) { echo 'Breakfast'; } else if($row['serve_time'] == 2) { echo 'Lunch'; } else { echo 'Dinner'; } ?></li>
									    <li><span class="text-muted">Subscription Date:</span> <?php echo date("d/m/Y", strtotime($row['subscription_date'])); ?></li>
										<li><span class="text-muted">Start From:</span> <?php echo date("d/m/Y", strtotime($row['start_date'])); ?></li>
										<li><span class="text-muted">Ends On:</span> <?php echo date("d/m/Y", strtotime($row['end_date'])); ?></li>
                                        <li><span class="text-muted">Status:</span> <?php if($ongoing_dt == 1) { echo '<b style="color:blue;">Ongoing</b>'; }  if($ongoing_dt == 0) { echo '<b style="color:green;">Completed</b>'; }  ?></li>

										<li><hr class="dropdown-divider"></li>
										<li>

										<button onclick="customerAddress(<?php echo $row['id']; ?>);" class="btn btn-link btn-link-green" type="button" >
							        		Customer Details
							      		</button>

										<button onclick="subFood(<?php echo $row['id']; ?>);" class="btn btn-link btn-link-green float-end" type="button" >
							        		Subscription Details
							      		</button>

										</li>
								    </ul>
							    </div><!--//app-doc-meta-->
							    
								    
						    </div><!--//app-card-body-->

						</div>
							</td>
							
						</tr>
           
							
						

<?php  } } else { ?>

            <tr>
                <td>No Subscription Found</td>
            </tr>

    <?php } ?>

					</tbody>
				  </table>
			</div>
						        </div>
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
			       
			        
			    </div><!--//row-->

			  
                <div class="modal fade" id="customerDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" id="waitDialog">
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
            <div class="modal-dialog" id="waitDialog">
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

    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script> 
    <script>


						<?php

							$back_dates = array();
    $my_earning = array();
    
$sql = "SELECT DATE(subscription_date) AS subscription_date FROM `order_subscription` WHERE accept_reject = 1 AND is_paid = 1 AND vendor_id = '".$_SESSION["userdata"]["id"]."' AND DATE(subscription_date) BETWEEN DATE('".$start_date."') AND DATE('".$end_date."') GROUP BY DATE(subscription_date) ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

   while( $row = $result->fetch_assoc())
   {

        $back_dates[] = date('d/m/Y', strtotime($row['subscription_date']));
        
        $dt = $row['subscription_date'];
        $sql_t = "SELECT SUM(vendor_earning) as vendor_earning FROM order_subscription WHERE accept_reject = 1 AND is_paid = 1 AND vendor_id = '".$_SESSION["userdata"]["id"]."' AND DATE(subscription_date) = DATE('$dt') ";
        $result_t = $conn->query($sql_t);
        if ($result_t->num_rows > 0) {
            $row_t = $result_t->fetch_assoc();

            $earning = $row_t['vendor_earning'];


        }
        else
        {
            $earning = 0;

        }

        $my_earning[] = $earning;

   }
   

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

    function customerAddress(cid)
	{
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


<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        var start_date = start.format('YYYY-MM-DD');
        var end_date = end.format('YYYY-MM-DD');
       
        $("#start_date").val(start_date);
        $("#end_date").val(end_date);
       // document.getElementById("myForm").submit();	



    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
    }, cb);

    cb(start, end);

});
</script>




</body>
</html> 



