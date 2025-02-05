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



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <link rel="icon" type="image/png" href="img/fav.png">
    <title>My Orders</title>
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
                margin-top: 9vh;
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
            
            .modal-body{
    height: 450px;
    overflow-y: auto;
}

@media (min-height: 500px) {
    .modal-body { height: 500px; }
}

@media (min-height: 800px) {
    .modal-body { height: 600px; }
}

    </style>
</head>

<body class="fixed-bottom-bar">
   
   
      


    <div class="container" style="margin-top: 4rem!important;">
        <div class="most_popular py-5">
            <div class="d-flex align-items-center mb-4">
                <h3 class="font-weight-bold text-dark mb-0">My Orders</h3>
            </div>

            <div class="row">


<?php



$sql = " SELECT oc.*, v.business_name FROM `order_subscription` as oc LEFT JOIN vendors as v on oc.vendor_id = v.id WHERE oc.customer_id = ".$_SESSION["userdata_c"]["id"]." ORDER BY oc.id DESC ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

   

?>
<div class="card">
  <div class="card-body">
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
                    
                    if(date("d/m/Y", strtotime($row['end_date'])) >= date("d/m/Y"))
                    {
                        $ongoing_dt = 1;
                    }
                    else
                    {
                        $ongoing_dt = 0;
                    }
                    
                    if(date("d/m/Y", strtotime($row['start_date'])) > date("d/m/Y"))
                    {
                                        $ongoing_dt = 2;
                    }
                
                    $food_ids = json_decode($row['food_id']);
                    
                    $sql_img = "SELECT * FROM food_images WHERE food_id = ".$food_ids[0]." ";
                    $result_img = $conn->query($sql_img);
                    if($result_img->num_rows > 0)
                    {
                        $row_img = $result_img->fetch_assoc();
                        $food_img = $row_img['food_img'];
                    }
                    else
                    {
                        $food_img = 'test.jpg';
                    }
                    
                    

                    

            ?>

                

            <tr>
                <td>
                        
                            <div   class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            

                            <div id="myCarousel" class="carousel slide lazy" data-bs-ride="carousel">
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner">


         
        
            <div class="carousel-item active">
              <img class="d-block thumb-image" style="width:100%;height:196px !important;" src="../vendor_app/uploads/food/<?php echo $food_img; ?>"   style="width:100%;">
            </div>

       
  </div>
         

  </div>


                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge badge-<?php if($row['accept_reject'] == 0) { echo "info"; } else if($row['accept_reject'] == 1) { echo "success"; } else { echo "danger"; }  ?>">
                                    <?php if($row['accept_reject'] == 0) { echo "PENDING"; } else if($row['accept_reject'] == 1) { echo "ACCEPTED"; } else { echo "REJECTED"; }  ?>
                                    </span></div>
                      

                            </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1"><a  class="text-black"> <?php if($row['serve_time'] == 1) { echo "Breakfast Package"; } else if($row['serve_time'] == 2) { echo "Lunch Package"; } else { echo "Dinner Package"; }  ?>
                                     </a>
                                     <span class="float-right text-danger" onclick="subFood('<?php echo $row['id'] ; ?>')">View Details</span>
                                        </h6>
                                        <p onclick="foo(this)" id="restaurant#<?php echo $row['vendor_id']; ?>" class="text-gray mb-3"><?php echo $row['business_name']; ?> </p>
                                        <p class="text-gray mb-3 time">
                                            <b>Order Id : </b> WAHM<?php echo $row['id'] ; ?><br/>
                                            <b>Price : </b>₹ <?php echo $row['subscription_price'] ; ?><br/>
                                            <b>Duration : </b><?php echo $row['package_duration'] ; ?> Days<br/>
                                            <b>Subscription Date : </b><?php echo date("d/m/Y", strtotime($row['subscription_date'])); ?><br/>
                                            <b>Start From : </b><?php echo date("d/m/Y", strtotime($row['start_date'])); ?><br/>
                                            <b>End On : </b><?php echo date("d/m/Y", strtotime($row['end_date'])); ?><br/>
                                            <b>Status : </b><?php if($ongoing_dt == 1) { echo '<b style="color:blue;">Ongoing</b>'; }  else if($ongoing_dt == 0) { echo '<b style="color:green;">Completed</b>'; } else { echo '<b style="color:grey;">Not Started</b>'; } ?><br/>
                                        </p>
                                    </div>
                                    <!--div class="list-card-badge">
                                        <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                                    </div-->
                                </div>
                            </div>
                        
                </td>
            </tr>

            <?php } ?>
        </tbody>    
</table>
</div>
</div>
</div>
                
                
<?php } else {  ?>

<div class="w-100 card bg-light text-dark">
    <div class="card-body">No order found!!!</div>
  </div>
  
  <?php } ?>


            </div>





     

<!-- Modal -->
            <div class="modal fade" id="subFoodDetailsModal" role="dialog">
              <div class="modal-dialog modal-dialog-scrollable">

                <!-- Modal content-->
                <div class="modal-content">
                    <form method="post" action="">
                        <div class="modal-header">
                          <h4 class="modal-title">Subscription Details</h4>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" >X</button>
                        </div>
                        <div class="modal-body" id="subFoodDetailsModalBody">
                          
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



function foo(elmnt){
        console.log(elmnt.id);
        parent.postMessage(elmnt.id, "*");
    }
    
    
    
    
    
    function subFood(oid)
	{
		$('#subFoodDetailsModalBody').html();
		$('#subFoodDetailsModal').modal('show'); 
		$.ajax({
        url: '../vendor_app/ajax.php',
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


</body>

</html>