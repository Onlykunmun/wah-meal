<?php

session_start();

include ('../conn.php');

/*
if(!isset($_SESSION["userdata"]))
{
    if(!isset($_SESSION["userdata_c"]))
    {
			exit();		
    }
}
*/
if(!isset($_POST))
{
    exit();
}


if($_POST['ajax_type'] == "cust_data")
{
    
    
    $order_id = $_POST['order_id'];
    $sql = "SELECT os.*, c.fullname, c.phone FROM `order_subscription` as os LEFT JOIN customers as c ON os.customer_id = c.id WHERE os.id = '$order_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo '<div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
   
        <div class="app-card-body px-4 w-100">
            
            <div class="item border-bottom py-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <div class="item-label"><strong>Name</strong></div>
                        <div class="item-data">'.$row["fullname"].'</div>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//item-->

            <div class="item border-bottom py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="item-label"><strong>Mobile Number</strong></div>
                    <div class="item-data">+91-'.$row["phone"].'</div>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//item-->

            

        
            
        <div class="item border-bottom py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="item-label"><strong>Delivery Address</strong></div>
                    <div class="item-data">'.$row["delivery_address"].'</div>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//item-->
        
        <div class="item border-bottom py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="item-label"><strong>Delivery Landmark</strong></div>
                    <div class="item-data">'.$row["delivery_landmark"].'</div>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//item-->

       
        
        <div class="item border-bottom py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-12">
                    <div class="item-label"><strong>Address on Map</strong></div>
                    <div style="width: 100%">
                        <iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q='.$row["delivery_lat"].','.$row["delivery_lng"].'+('.$row["fullname"].')&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//item-->
        
        
            
        </div><!--//app-card-body-->
        
       
    </div>
    
    


    
    
    
    
    
    ';

    }
}


if($_POST['ajax_type'] == "cust_data_more")
{
    
    
    $order_id = $_POST['order_id'];
    $sql = "SELECT os.*, c.fullname, c.phone, c.email FROM `order_subscription` as os LEFT JOIN customers as c ON os.customer_id = c.id WHERE os.id = '$order_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo '<div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
   
        <div class="app-card-body px-4 w-100">
            
            <div class="item border-bottom py-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <div class="item-label"><strong>Name</strong></div>
                        <div class="item-data">'.$row["fullname"].'</div>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//item-->

            <div class="item border-bottom py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="item-label"><strong>Mobile Number</strong></div>
                    <div class="item-data">+91-'.$row["phone"].'</div>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//item-->

            <div class="item border-bottom py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="item-label"><strong>Email</strong></div>
                    <div class="item-data">'.$row["email"].'</div>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//item-->

        
            
        <div class="item border-bottom py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="item-label"><strong>Delivery Address</strong></div>
                    <div class="item-data">'.$row["delivery_address"].'</div>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//item-->
        
        <div class="item border-bottom py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="item-label"><strong>Delivery Landmark</strong></div>
                    <div class="item-data">'.$row["delivery_landmark"].'</div>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//item-->

       
        
        <div class="item border-bottom py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-12">
                    <div class="item-label"><strong>Address on Map</strong></div>
                    <div style="width: 100%">
                        <iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q='.$row["delivery_lat"].','.$row["delivery_lng"].'+('.$row["fullname"].')&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                </div><!--//col-->
            </div><!--//row-->
        </div><!--//item-->
        
        
            
        </div><!--//app-card-body-->
        
       
    </div>
    
    


    
    
    
    
    
    ';

    }
}



if($_POST['ajax_type'] == "subFood_data")
{

    $food_order_id = $_POST['order_id'];
    $sql = "SELECT fps.*, fi.food_name, fi.food_price , fi.food_type as f_type FROM food_processing_status fps LEFT JOIN food_items fi ON fps.food_id = fi.id WHERE fps.food_order_id = '".$food_order_id."' ";
    $result = $conn->query($sql);

    echo '<div class="app-card app-card-stats-table h-100 shadow-sm"><div class="app-card-body p-3 p-lg-4"><div class="table-responsive"><table class="table table-borderless mb-0">
    <thead>
        <tr>
            <th class="meta">Day</th>
            <th class="meta">Food Name</th>
            <th class="meta stat-cell">Price</th>
        </tr>
    </thead>
    <tbody>';


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc())
        {
            $timestamp = strtotime($row["for_date"]);
            if($row["f_type"] == 1)
            {
                $food_type = "🟩";
            }
            else
            {
                $food_type = "";
            }

            echo '<tr>
                <td>'.date("l",$timestamp).'<br/><span class="badge bg-info text-white">'.date("d-m-Y", strtotime($row["for_date"])).'</span></td>
                <td>'.$food_type.' '.$row["food_name"].'</td>
                <td> ₹'.$row["food_price"].'</td>
            </tr>';
        }

    }
    else
    {
        echo '<tr><td colspan="3">Something went wrong</td></tr>';
        //echo $sql;
    }



echo '</tbody>
</table></div></div></div>';




}

if($_POST['ajax_type'] == "subFood_data_more")
{

    $food_order_id = $_POST['order_id'];
    $sql = "SELECT fps.*, fi.food_name, fi.food_price , fi.food_type as f_type FROM food_processing_status fps LEFT JOIN food_items fi ON fps.food_id = fi.id WHERE fps.food_order_id = '".$food_order_id."' ";
    $result = $conn->query($sql);

    echo '<div class="app-card app-card-stats-table h-100 shadow-sm"><div class="app-card-body p-3 p-lg-4"><div class="table-responsive"><table class="table table-borderless mb-0">
    <thead>
        <tr>
            <th class="meta text-center">Day</th>
            <th class="meta text-center">Food Name</th>
            <th class="meta text-center">Price</th>
            <th class="meta text-center">Delivery Status</th>
            <th class="meta text-center">Delivery Date & Time</th>
        </tr>
    </thead>
    <tbody>';


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc())
        {
            $delivery_date_time =  "";
            $timestamp = strtotime($row["for_date"]);
            if($row["f_type"] == 1)
            {
                $food_type = "🟩";
            }
            else
            {
                $food_type = "🟥";
            }
            
                        if($row['processing_status'] == 0)
                          {
                              $status = "<span style='color:#5D6778;'>Ideal</span>";
                                if($row['for_date'] < date('Y-m-d') )
							    {
								    $status = "<span style='color:#000;'>Not Strated</span>";
							    }
                          }

                          if($row['processing_status'] == 1)
                          {
                            $status = "<span style='color:#5B99EA;'>Processing</span>";
                          }

                          if($row['processing_status'] == 2)
                          {
                            $status = "<span style='color:#EEBF41;'>Ready 2 Go</span>";
                          }

                          if($row['processing_status'] == 3)
                          {
                            $status = "<span style='color:#0D6EFD;'>In Transit</span>";
                          }

                          if($row['processing_status'] == 4)
                          {
                            $status = "<span style='color:#5CB377;'>Delivered</span>";
                            $delivery_date_time = date('D, M j, Y \a\t g:ia', strtotime($row['updated_on']));
                          }

                          if($row['processing_status'] == 5)
                          {
                            $status = "<span style='color:#D26D69;'>Cancelled</span>";
                          }
                          
                          
                          	if($row['for_date'] > date('Y-m-d') )
							{
								$status = "<span style='color:#000;'>Not Strated</span>";
							}
                          
                          
            

            echo '<tr>
                <td class="text-center" >'.date("l",$timestamp).'<br/><span class="badge bg-info text-white">'.date("d-m-Y", strtotime($row["for_date"])).'</span></td>
                <td class="text-center" >'.$food_type.' '.$row["food_name"].'</td>
                <td class="text-center" > ₹'.$row["food_price"].'</td>
                <td class="text-center">'.$status.'</td>
                <td class="text-center">'.$delivery_date_time.'</td>
            </tr>';
        }

    }
    else
    {
        echo '<tr><td colspan="3">Something went wrong</td></tr>';
        //echo $sql;
    }



echo '</tbody>
</table></div></div></div>';




}

