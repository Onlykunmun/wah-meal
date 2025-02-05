<?php require 'header.php' ?>
     
<?php
  
  if(isset($_POST['reject']))
{
    $odr_id = $_POST['odr_id'];
   $sql = " UPDATE `order_subscription` SET accept_reject = 2 WHERE id = '".$odr_id."' ";
   $result = $conn->query($sql);
}


  if(isset($_POST['accept']))
{
    $odr_id = $_POST['odr_id'];
   $sql = " UPDATE `order_subscription` SET accept_reject = 1 WHERE id = '".$odr_id."' ";
   $result = $conn->query($sql);
}
  
  

$start_dt = date('Y-m-d', strtotime('-7 days'));
$end_dt = date('Y-m-d');

if(isset($_POST['filter']))
{
    $start_dt = $_POST['from_date'];
    $end_dt = $_POST['to_date'];
}


  if(isset($_GET['fetchByVendor']))
  {
    if($_GET['fetchByVendor']>0)
    {
        $fvid = $_GET['fetchByVendor'];
      $get_vendor_id = " AND oc.vendor_id = ".$fvid."  ";
    }
    else
    {
        $fvid = 0;
      $get_vendor_id = "";
    }    
  }
  else
  {
      $fvid = 0;
    $get_vendor_id = "";
  }
  
  
  
if(isset($_GET['fetchByCustomer']))
  {
    if($_GET['fetchByCustomer']>0)
    {
        $fvid = $_GET['fetchByCustomer'];
      $get_customer_id = " AND oc.customer_id = ".$fvid."  ";
    }
    else
    {
        $fvid = 0;
      $get_customer_id = "";
    }    
  }
  else
  {
      $fvid = 0;
    $get_customer_id = "";
  }
  
  



?>







<style>
    table th{
        font-weight:600 !important;
    }
    .sorting:after, .sorting:before, .sorting_asc:after, .sorting_asc:before, .sorting_desc:after, .sorting_desc:before{
        content : "" !important;
    }
</style>

      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">list_alt</i>
                  </div>
                  <h4 class="card-title">All Orders</h4>
                </div>
                <div class="card-body">
                    <hr/>
                   <div class="toolbar">
                      <form action="" method="POST">
                          
                          <div class="row">
                              <div class="col-md-5">
                                  <div class="form-group">
                                        <label for="start_date">From Date:</label>
                                        <input required  class="form-control" type="date" id="from_date" name="from_date" value="<?php echo $start_dt; ?>" >
                                  </div>
                              </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                        <label for="start_date">To Date:</label>
                                        <input required onchange="$('#from_date').val('');"  class="form-control" type="date" id="to_date" name="to_date" value="<?php echo $end_dt; ?>" >
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <button  name="filter" type="submit" class="btn btn-fill btn-rose btn-block">Filter</button>
                              </div>
                          </div>
                          
                        
                      </form>
                  </div>
                  <hr/>
                  <div class="material-datatables mt-4">
                    <table id="datatables" class="table table-striped  table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Or. Id</th>
                          <th>Vendor</th>
                          <th>Customer</th>
                          <th>Package</th>
                          <th>Duration</th>
                          <th>Starts</th>
                          <th>Ends</th>
                          <th>Accept/Reject</th>
                          <th>Status</th>
                          <th>Total</th>
                          <th>Vendor Earning</th>
                          <th>Admin Earning</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Or. Id</th>
                          <th>Vendor</th>
                          <th>Customer</th>
                          <th>Package</th>
                          <th>Duration</th>
                          <th>Starts</th>
                          <th>Ends</th>
                          <th>Accept/Reject</th>
                          <th>Status</th>
                          <th>Total</th>
                          <th>Vendor Earning</th>
                          <th>Admin Earning</th>
                        </tr>
                      </tfoot>
                      <tbody>

                          <?php
                            $sql = " SELECT oc.*, v.business_name FROM `order_subscription` as oc LEFT JOIN vendors as v on oc.vendor_id = v.id WHERE    oc.subscription_date BETWEEN '$start_dt' AND '$end_dt'    ".$get_vendor_id."  ".$get_customer_id."   ORDER BY oc.id DESC ";
                            
                            
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    
                                   $package_duration = $row['package_duration'];
		                            $odr_id = $row['id'];
		
			$sql_chk = "SELECT * FROM food_processing_status WHERE food_order_id = '$odr_id' AND processing_status = 4 ";
												$result_chk = $conn->query($sql_chk);

                                               if ($result_chk->num_rows != $package_duration) {
                                                   
                                                   $ongoing_dt = 1;
                                                   if($result_chk->num_rows == 0)
                                                   {
                                                       $ongoing_dt = 2;
                                                     	if(date("d/m/Y", strtotime($row['start_date'])) >= date("d/m/Y"))
                                                        {
                                                          $ongoing_dt = 1;
                                                        }
                                                   }
                                                   
                                                   
                                               }
                                               else
                                               {
                                                   $ongoing_dt = 0;
                                               }
                                    
                                    
                          ?>
                          
                          <tr>
                                <td>WAHM<?php echo $row['id']; ?></td>
                                <td><?php echo $row['business_name']; ?></td>
                                <td>
                                    
                                    <span style="color:#EA2C6D; font-weight:bold; cursor:pointer;" data-toggle="tooltip" title="Click to View Customer Details"   onclick="customerAddress('<?php echo $row['id'] ; ?>')" >Customer Details</span>
                                    
                                </td>
                                <td><span style="color:#9C27B0; font-weight:bold; cursor:pointer;" data-toggle="tooltip" title="Click to View Subscription Details"   onclick="subFood('<?php echo $row['id'] ; ?>')" ><?php if($row['serve_time'] == 1) { echo "Breakfast"; } else if($row['serve_time'] == 2) { echo "Lunch"; } else { echo "Dinner"; }  ?> Details</span></td>
                                <td><?php echo $row['package_duration'] ; ?> Days</td>
                                <td><?php echo date("d/m/Y", strtotime($row['start_date'])); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($row['end_date'])); ?></td>
                                <td>
                                  <?php if($row['accept_reject'] == 0) 
                          			{ echo '<b style="color:blue;">PENDING</b><br>
                                    		<div class="row">
                                            	<div class="col-12 mt-1">
                                                	<form method="post">
                                                    	<input name="odr_id" type="hidden" value="'.$row['id'].'" />
                                                    	<input type="submit" name="accept" value="ACCEPT" style="background:green;" class="btn btn-sm app-btn-success" />
                                                    </form>
                                                </div>
                                                <div class="col-12 mt-1">
                                                	<form method="post">
                                                    	<input name="odr_id" type="hidden" value="'.$row['id'].'" />
                                                    	<input type="submit" name="reject" value="REJECT" style="background:red;" class="btn btn-sm app-btn-danger" />
                                                    </form>
                                                </div>
                                            </div>
                                    
                                    '; } 
                                  else if($row['accept_reject'] == 1) 
                                  { echo '<b style="color:green;">ACCEPTED</b>'; } 
                                  else { echo "REJECTED"; }  ?>
                            	</td>
                                <td>
                                  <?php if($ongoing_dt == 1) { echo '<b style="color:blue;">Ongoing</b>'; }  
                                  else if($ongoing_dt == 0) { echo '<b style="color:green;">Completed</b>'; } 
                                  else { echo '<b style="color:grey;">Not Started</b>'; } ?></td>
                                <td>₹ <?php echo $row['subscription_price']; ?></td>
                                <td>₹ <?php echo $row['vendor_earning']; ?></td>
                                <td>₹ <?php echo $row['admin_earning']; ?></td>
                          </tr>
                          
                          <?php
                          
                            } }
                            
                          ?>
                          
                          
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
          </div>
          
          <!-- Modal -->
            <div class="modal fade" id="subFoodDetailsModal" role="dialog">
              <div class="modal-dialog modal-lg">

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
          
          		<div class="modal fade" id="customerDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" id="waitDialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
				
                   
				Customer Details
				</h5>
               <button type="button" class="btn btn-danger" data-dismiss="modal" >X</button>
                </div>
                <div class="modal-body" id="customerDetailsModalBody">
                   
                </div>
                
            </div>
            </div>
        </div>  

          
          <!-- end row -->
        </div>
      </div>
      <script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        scrollX: true,
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
      
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }
      });

      var table = $('#datatable').DataTable();

   
    });
    
    
    function subFood(oid)
	{
		$('#subFoodDetailsModalBody').html();
		$('#subFoodDetailsModal').modal('show'); 
		$.ajax({
        url: '../vendor_app/ajax.php',
        type: 'post',
        data: {ajax_type: 'subFood_data_more', order_id : oid},
        success: function(response) {
           if (response) {
			$("#subFoodDetailsModalBody").html(response);
           }else {
               $("#subFoodDetailsModalBody").html("Something went wrong!!!");
           }
         }
    	});
	}
	
	
	
	function customerAddress(cid)
	{
		$('#customerDetailsModalBody').html("");
		$('#customerDetailsModal').modal('show'); 
		$.ajax({
        url: '../vendor_app/ajax.php',
        type: 'post',
        data: {ajax_type: 'cust_data_more', order_id : cid},
        success: function(response) {
           if (response) {
			$("#customerDetailsModalBody").html(response);
           }else {
               $("#customerDetailsModalBody").html("Something went wrong!!!");
           }
         }
    	});
	}
	
	
    
    $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
    
  </script>
<?php require 'footer.php' ?>
