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

    $view_date = date('Y-m-d');
    
    if(isset($_POST['view_date']))
    {
        $view_date = $_POST['view_date'];
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
    <title>Track My Orders</title>
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
            
            ::-webkit-calendar-picker-indicator {
  color: rgba(0, 0, 0, 0);
  opacity: 1;
  background-image: url('data:image/svg+xml;charset=utf8,%3Csvg fill="%23000" fill-opacity=".54" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/%3E%3Cpath d="M0 0h24v24H0z" fill="none"/%3E%3C/svg%3E');
  width: 14px;
  height: 15px;
  cursor: pointer;
  border-radius: 50%;
  margin-left: .5rem;

    </style>
</head>

<body class="fixed-bottom-bar">
   
   
      


    <div class="container" style="margin-top: 4rem!important;">
        <div class="most_popular py-5">
            

            <div class="row">
                
                <div class="card mb-2 w-100">
                    <div class="card-body">
                            <form action="" method="post">
                              <div class="form-group" style="margin-bottom: 0rem;">
                                <input required onchange="this.form.submit()" class="form-control" type="date" id="view_date" name="view_date" value="<?php echo $view_date; ?>"  >
                              </div>
                            </form>
                    </div>
                </div>


<?php



$sql = "SELECT fps.*, fi.food_name, fi.food_price , fi.food_type as f_type FROM order_subscription as os LEFT JOIN food_processing_status fps ON os.id = fps.food_order_id LEFT JOIN food_items fi ON fps.food_id = fi.id WHERE os.accept_reject = '1' AND fps.for_date = '".$view_date."' AND os.customer_id = ".$_SESSION["userdata_c"]["id"]." ";
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
                    
                  
                
                    $food_id = $row['food_id'];
                    
                    $sql_img = "SELECT * FROM food_images WHERE food_id = ".$food_id." ";
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
                    
                    
                    $sql_vendor = "SELECT * FROM vendors WHERE id = ".$row['vendor_id']." ";
                    $result_vendor = $conn->query($sql_vendor);
                    if($result_vendor->num_rows > 0)
                    {
                        $row_vendor = $result_vendor->fetch_assoc();
                        $vendor_name = $row_vendor['business_name'];
                    }
                    else
                    {
                        $vendor_name = 'Wah Meal';
                    }
                    
                    
                        if($row['processing_status'] == 0)
                          {
                              $status = "Ideal";
                              $badge = "secondary";
                          }

                          if($row['processing_status'] == 1)
                          {
                            $status = "Processing";
                            $badge = "info";
                          }

                          if($row['processing_status'] == 2)
                          {
                            $status = "Ready 2 Go";
                            $badge = "warning";
                          }

                          if($row['processing_status'] == 3)
                          {
                            $status = "In Transit";
                            $badge = "primary";
                          }

                          if($row['processing_status'] == 4)
                          {
                            $status = "Delivered";
                            $badge = "success";
                          }

                          if($row['processing_status'] == 5)
                          {
                            $status = "Cancelled";
                            $badge = "danger";
                          }
                          
                          $row['f_type'] = $row['f_type'] == 1 ? 'veg' : 'non-veg';
                    

            ?>

                

            <tr>
                <td>
                        
                            <div  class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            

                            <div id="myCarousel" class="carousel slide lazy" data-bs-ride="carousel">
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner">


         
        
            <div class="carousel-item active">
              <img class="d-block thumb-image" style="width:100%;height:196px !important;" src="../vendor_app/uploads/food/<?php echo $food_img; ?>"   style="width:100%;">
            </div>

       
  </div>
         

  </div>


                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge badge-<?php echo $badge;  ?>"><?php echo $status;  ?></span></div>
                      

                            </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1 d-flex"><div class="mr-2 <?php echo $row['f_type']; ?>">&middot;</div><a  class="text-black"> <?php echo $row['food_name'];   ?>
                                     </a>
                                   
                                        </h6>
                                        <p onclick="foo(this)" id="restaurant#<?php echo $row['vendor_id']; ?>" class="text-gray mb-3"><?php echo $vendor_name; ?> </p>
                                        <p class="text-gray mb-3 time">
                                            <b>Order Id : </b> WAHM<?php echo $row['food_order_id'] ; ?><br/>
                                            <b>For Date : </b><?php echo date("d/m/Y", strtotime($row['for_date'])); ?> <span class="badge badge-info"><?php echo date("l", strtotime($row['for_date'])); ?></span><br/>
                                            <b>Delivery Status : </b><?php echo $status; ?><br/>
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
    
    
    
    
    

    
    
    
    
</script>


</body>

</html>