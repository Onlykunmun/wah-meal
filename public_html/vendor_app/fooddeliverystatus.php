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
    padding-left: 25%;
	padding-right: 25%;
    font-size: 1rem;
    text-decoration: none;
    color: #15a362;
	width:100%;
	}
	
	.modal-dialog {
    margin-top: 10vh;
}
	
    </style>

</head> 

<body class="app">   	


<?php

if(isset($_POST['change_status']))
{
	$change_status = $_POST['change_status'];
    $food_processing_id = $_POST['food_processing_id'];
	$sql_accept = "UPDATE food_processing_status SET processing_status = '".$change_status."' WHERE id = '$food_processing_id'";
	if($conn->query($sql_accept))
	{
		echo "<script>alert('Status updated successfully');</script>";
	} 
}

?>


    
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
                        $start_date = date("Y-m-d", strtotime('-7 day'));
                        $end_date = date("Y-m-d");
                    }
			    
			    
			    

                                        /*
											ideal = 0
											processing = 1
											ready 2 go = 2
											out for delivery/in transit = 3
											delivered = 4
											cancelled = 5
										*/

                   $for_date = date("Y-m-d");

                    $ideal = $processing = $ready = $out = $delivered = $cancelled = 0; 
$sql = "SELECT fps.*, fi.food_name, fi.food_price , fi.food_type as f_type FROM order_subscription as os LEFT JOIN food_processing_status fps ON os.id = fps.food_order_id LEFT JOIN food_items fi ON fps.food_id = fi.id WHERE os.accept_reject = '1' AND os.vendor_id = ".$_SESSION["userdata"]["id"]." AND fps.for_date BETWEEN '".$start_date."' AND '".$end_date."'  ORDER BY os.serve_time ASC ";
                    //$sql = "SELECT * FROM food_processing_status WHERE for_date = '".$for_date."' ORDER BY serve_time ASC ";
                    //echo $sql;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        
                        while($row = $result->fetch_assoc()) {
                            
                          if($row['processing_status'] == 0)
                          {
                              $ideal++;
                          }

                          if($row['processing_status'] == 1)
                          {
                              $processing++;
                          }

                          if($row['processing_status'] == 2)
                          {
                              $ready++;
                          }

                          if($row['processing_status'] == 3)
                          {
                              $out++;
                          }

                          if($row['processing_status'] == 4)
                          {
                            $delivered++;
                          }

                          if($row['processing_status'] == 5)
                          {
                            $cancelled++;
                          }
                           

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

				    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Ideal</h4>
							   
								<div class="stats-figure">
                                <span class="badge bg-secondary"><?php echo $ideal; ?></span>    
                                </div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->


				    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1">Processing</h4>
								
							    
                                <div class="stats-figure">
                                <span class="badge bg-info"><?php echo $processing; ?></span>    
                                </div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->


				    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" >Ready 2 Go</h4>
								

                                <div class="stats-figure">
                                <span class="badge bg-warning text-dark"><?php echo $ready; ?></span>    
                                </div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->


                    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" >In Transit</h4>
								

                                <div class="stats-figure">
                                <span class="badge bg-primary" style="background:#0D6EFD !important;"><?php echo $out; ?></span>    
                                </div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->

                    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" >Delivered</h4>
								

                                <div class="stats-figure">
                                <span class="badge bg-success"><?php echo $delivered; ?></span>    
                                </div>
							    
						    </div><!--//app-card-body-->
						    <!--a class="app-card-link-mask" href="#"></a-->
					    </div><!--//app-card-->
				    </div><!--//col-->

                    <div class="col-4 col-lg-4">
					    <div class="app-card app-card-stat shadow-sm h-100">
						    <div class="app-card-body p-3 p-lg-4">
							    <h4 class="stats-type mb-1" >Cancelled</h4>
								

                                <div class="stats-figure">
                                <span class="badge bg-danger"><?php echo $cancelled; ?></span>    
                                </div>
							    
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
	



    $sql_food = "SELECT * FROM food_items WHERE id = '".$row['food_id']."' AND is_deleted = 0 ";
    $result_food = $conn->query($sql_food);
    if ($result_food->num_rows > 0) {
        $row_food = $result_food->fetch_assoc();

        $sql_food_img = "SELECT * FROM food_images WHERE food_id = '".$row_food['id']."' ";
        $result_food_img = $conn->query($sql_food_img);
        if ($result_food_img->num_rows > 0) {

            $row_food_img = $result_food_img->fetch_assoc();
            $food_img = $row_food_img['food_img'];
        }
        else
        {
            $food_img = 'test.jpg';
        }


                        if($row['processing_status'] == 0)
                          {
                              $status = "Ideal";
                          }

                          if($row['processing_status'] == 1)
                          {
                            $status = "Processing";
                          }

                          if($row['processing_status'] == 2)
                          {
                            $status = "Ready 2 Go";
                          }

                          if($row['processing_status'] == 3)
                          {
                            $status = "In Transit";
                          }

                          if($row['processing_status'] == 4)
                          {
                            $status = "Delivered";
                          }

                          if($row['processing_status'] == 5)
                          {
                            $status = "Cancelled";
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
							    
							    
                                
								    <div class="row align-items-center mb-2">

									    <div class="col-11">
										    <div class="progress">

<?php if($row['processing_status'] == 5) { ?>
    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo ($row['processing_status']*25); ?>%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>

    <?php } else { ?>
        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo ($row['processing_status']*25); ?>%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>

        <?php } ?>

											</div>
									    </div><!--//col-->
									   
								    </div><!--//row-->
							   
                                
                                <div class="app-doc-meta">
								    <ul class="list-unstyled mb-0">
                                        <li class="text-truncate"><span class="text-muted">Food Name:</span> <?php echo $row_food['food_name']; ?></li>
                                        <li><span class="text-muted">Order Id:</span> <?php echo "WAHM".$row['food_order_id']; ?></li>
										<li><span class="text-muted">Food Type:</span> <?php if($row_food['food_type'] == 1) { echo '🟩 Veg'; }  else { echo '🟥 Non-Veg'; } ?></li>
									    <li><span class="text-muted">Serve Time:</span> <?php if($row['serve_time'] == 1) { echo 'Breakfast'; } else if($row['serve_time'] == 2) { echo 'Lunch'; } else { echo 'Dinner'; } ?></li>

<?php if($row['processing_status'] == 0) { ?>
								        <li><span class="text-muted">**Order Amount to be collected before/while accepting this order/chaniging order status.</span></li>
<?php } ?>

										<li><hr class="dropdown-divider"></li>

										<li>

										<button onclick="customerAddress(<?php echo $row['food_order_id']; ?>);" class="btn btn-link btn-link-green" type="button" >
							        		Customer Details
							      		</button>

										</li>



                                        
								    </ul>
							    </div><!--//app-doc-meta-->

                                <div class="app-card-actions">
								    <div class="dropdown">
									    <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
										    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
			</svg>
									    </div><!--//dropdown-toggle-->
									    <ul class="dropdown-menu" style="background: transparent; border: none;">
					
											<li>
												<form method="post" >
                                                    <input type="hidden" name="food_processing_id" value="<?php echo $row['id']; ?>" />
												    <button type="submit" name="change_status" value="0" class="dropdown-item text-white" style="background:#5D6778;"  >
                                                        Ideal
                                                    </button>
	                                            </form>
                                            </li>


                                            <li>
												<form method="post" >
                                                    <input type="hidden" name="food_processing_id" value="<?php echo $row['id']; ?>" />
												    <button type="submit" name="change_status" value="1" class="dropdown-item text-white" style="background:#5B99EA;"  >
                                                        Processing
                                                    </button>
	                                            </form>
                                            </li>


                                            <li>
												<form method="post" >
                                                    <input type="hidden" name="food_processing_id" value="<?php echo $row['id']; ?>" />
												    <button type="submit" name="change_status" value="2" class="dropdown-item text-white" style="background:#EEBF41;"  >
                                                        Ready 2 Go
                                                    </button>
	                                            </form>
                                            </li>


                                            <li>
												<form method="post" >
                                                    <input type="hidden" name="food_processing_id" value="<?php echo $row['id']; ?>" />
												    <button type="submit" name="change_status" value="3" class="dropdown-item text-white" style="background:#0D6EFD;"  >
                                                        In Transit
                                                    </button>
	                                            </form>
                                            </li>

                                            <li>
												<form method="post" >
                                                    <input type="hidden" name="food_processing_id" value="<?php echo $row['id']; ?>" />
												    <button type="submit" name="change_status" value="4" class="dropdown-item text-white" style="background:#5CB377;"  >
                                                        Delivered
                                                    </button>
	                                            </form>
                                            </li>


                                            <li>
												<form method="post" >
                                                    <input type="hidden" name="food_processing_id" value="<?php echo $row['id']; ?>" />
												    <button type="submit" name="change_status" value="5" class="dropdown-item text-white" style="background:#D26D69;"  >
                                                        Cancelled
                                                    </button>
	                                            </form>
                                            </li>

											
										</ul>
								    </div><!--//dropdown-->
						        </div><!--//app-card-actions-->
							    
								    
						    </div><!--//app-card-body-->

						</div>
							</td>
							
						</tr>
           
							
						

<?php } } } else { ?>

            <tr>
                <td>No Order Found</td>
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



