<?php require 'header.php' ?>



<?php




if(isset($_POST['add-schedule']))
		{
		    
		    
		    //List Breakfast, Lunch, Dinner
		    
		    $bf_list = 0;
		    $lun_list = 0;
		    $din_list = 0;
		    
		    if(isset($_POST["bf_list"]) && $_POST["bf_list"] > 0)
            {
              $bf_list = $_POST["bf_list"];
            }
            
             if(isset($_POST["lun_list"]) && $_POST["lun_list"] > 0)
            {
              $lun_list = $_POST["lun_list"];
            }
            
             if(isset($_POST["din_list"]) && $_POST["din_list"] > 0)
            {
              $din_list = $_POST["din_list"];
            }

      // Breakfast Schedule
      $mon_bf = 0;
      $tue_bf = 0;
      $wed_bf = 0;
      $thu_bf = 0;
      $fri_bf = 0;
      $sat_bf = 0;
      $sun_bf = 0;

      if(isset($_POST["mon_bf"]) && $_POST["mon_bf"] > 0)
      {
        $mon_bf = $_POST["mon_bf"];
      }

      if(isset($_POST["tue_bf"]) && $_POST["tue_bf"] > 0)
      {
        $tue_bf = $_POST["tue_bf"];
      }

      if(isset($_POST["wed_bf"]) && $_POST["wed_bf"] > 0)
      {
        $wed_bf = $_POST["wed_bf"];
      }

      if(isset($_POST["thu_bf"]) && $_POST["thu_bf"] > 0)
      {
        $thu_bf = $_POST["thu_bf"];
      }

      if(isset($_POST["fri_bf"]) && $_POST["fri_bf"] > 0)
      {
        $fri_bf = $_POST["fri_bf"];
      }

      if(isset($_POST["sat_bf"]) && $_POST["sat_bf"] > 0)
      {
        $sat_bf = $_POST["sat_bf"];
      }

      if(isset($_POST["sun_bf"]) && $_POST["sun_bf"] > 0)
      {
        $sun_bf = $_POST["sun_bf"];
      }


      // Lunch Schedule

      $mon_lun = 0;
      $tue_lun = 0;
      $wed_lun = 0;
      $thu_lun = 0;
      $fri_lun = 0;
      $sat_lun = 0;
      $sun_lun = 0;

      if(isset($_POST["mon_lun"]) && $_POST["mon_lun"] > 0)
      {
        $mon_lun = $_POST["mon_lun"];
      }

      if(isset($_POST["tue_lun"]) && $_POST["tue_lun"] > 0)
      {
        $tue_lun = $_POST["tue_lun"];
      }

      if(isset($_POST["wed_lun"]) && $_POST["wed_lun"] > 0)
      {
        $wed_lun = $_POST["wed_lun"];
      }

      if(isset($_POST["thu_lun"]) && $_POST["thu_lun"] > 0)
      {
        $thu_lun = $_POST["thu_lun"];
      }

      if(isset($_POST["fri_lun"]) && $_POST["fri_lun"] > 0)
      {
        $fri_lun = $_POST["fri_lun"];
      }

      if(isset($_POST["sat_lun"]) && $_POST["sat_lun"] > 0)
      {
        $sat_lun = $_POST["sat_lun"];
      }

      if(isset($_POST["sun_lun"]) && $_POST["sun_lun"] > 0)
      {
        $sun_lun = $_POST["sun_lun"];
      }


      //  Dinner Schedule

      $mon_din = 0;
      $tue_din = 0;
      $wed_din = 0;
      $thu_din = 0;
      $fri_din = 0;
      $sat_din = 0;
      $sun_din = 0;

      if(isset($_POST["mon_din"]) && $_POST["mon_din"] > 0)
      {
        $mon_din = $_POST["mon_din"];
      }

      if(isset($_POST["tue_din"]) && $_POST["tue_din"] > 0)
      {
        $tue_din = $_POST["tue_din"];
      }

      if(isset($_POST["wed_din"]) && $_POST["wed_din"] > 0)
      {
        $wed_din = $_POST["wed_din"];
      }

      if(isset($_POST["thu_din"]) && $_POST["thu_din"] > 0)
      {
        $thu_din = $_POST["thu_din"];
      }

      if(isset($_POST["fri_din"]) && $_POST["fri_din"] > 0)
      {
        $fri_din = $_POST["fri_din"];
      }

      if(isset($_POST["sat_din"]) && $_POST["sat_din"] > 0)
      {
        $sat_din = $_POST["sat_din"];
      }

      if(isset($_POST["sun_din"]) && $_POST["sun_din"] > 0)
      {
        $sun_din = $_POST["sun_din"];
      }


$save_sql = "UPDATE `vendors` SET `bf_list` = '$bf_list', `lun_list` = '$lun_list', `din_list` = '$din_list', `mon_bf` = '$mon_bf', `tue_bf` = '$tue_bf', `wed_bf` = '$wed_bf', `thu_bf` = '$thu_bf', `fri_bf` = '$fri_bf', `sat_bf` = '$sat_bf', `sun_bf` = '$sun_bf', `mon_lun` = '$mon_lun', `tue_lun` = '$tue_lun', `wed_lun` = '$wed_lun', `thu_lun` = '$thu_lun', `fri_lun` = '$fri_lun', `sat_lun` = '$sat_lun', `sun_lun` = '$sun_lun', `mon_din` = '$mon_din', `tue_din` = '$tue_din', `wed_din` = '$wed_din', `thu_din` = '$thu_din', `fri_din` = '$fri_din', `sat_din` = '$sat_din', `sun_din` = '$sun_din'  WHERE `id` = '$assoc_vendor_id' ";
      
    if($conn->query($save_sql) === TRUE)
    {
     
        $statusMsg = 'Schedule saved successfully'; 
        echo "<script>md.showNotification('top', 'left', 'success', '".$statusMsg."');</script>";
 
    }
    else
    {
          $statusMsg = 'User Already Exist'; 
          echo "<script>md.showNotification('top', 'left', 'danger', '".$statusMsg."');</script>";
    }
 



    }  


    $sql_vendor = "SELECT * FROM `vendors` WHERE `id` = '$assoc_vendor_id'";
    $result_vendor = $conn->query($sql_vendor);
    if ($result_vendor->num_rows > 0) {
      $row_vendor = $result_vendor->fetch_assoc();
    }


?>




<?php


if(isset($_POST['add-food']))
		{

      //Food Details
      $food_name = $_POST['foodname'];   
      $food_type = $_POST['foodcategory'];   
      $food_details = $_POST['details'];   
      $food_price = $_POST['foodprice'];   
      $food_vendor = $row_vendor['id'];
      $food_serve_time = $_POST['servetime'];
     
  
   



   

      
     

     
      $sql = "INSERT INTO `food_items` SET `food_name`= '$food_name', `vendor_id` = '$food_vendor', `food_type` = '$food_type', 
      `serve_time` = '$food_serve_time', `food_details` = '$food_details', `food_price` = '$food_price', `created_by` = 'ADMIN', `modified_by` = 'ADMIN'";

      if ($conn->query($sql) === TRUE) {

        $food_id = $conn->insert_id;
        $targetDir = "../vendor_app/uploads/food/"; 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 

        $fileNames = array_filter($_FILES['files']['name']);

        if(!empty($fileNames))
        { 
            foreach($_FILES['files']['name'] as $key=>$val)
            { 
            // File upload path 
            $fileName = sha1(time()).'-' .basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
           
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
              // Upload file to server 



              if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                  // Image db insert sql 
                  $insertValuesSQL .= "('$food_id','".$fileName."'),"; 
              }else{ 
                  $errorUpload .= $_FILES['files']['name'][$key].' | '; 
              } 
            }else{ 
                  $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
            } 
        }
        
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
            $insert = $conn->query("INSERT INTO `food_images` (`food_id`,`food_img`) VALUES $insertValuesSQL"); 
            if($insert){ 
                $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
                $statusMsg = "Food listed successfully.".$errorMsg; 
                echo "<script>md.showNotification('top', 'left', 'success', '".$statusMsg."');</script>";
            }else{ 
                $statusMsg = "Sorry, something went wrong"; 
                echo "<script>md.showNotification('top', 'left', 'danger', '".$statusMsg."');</script>";
            } 
        } 
        
      }
      else
      {


        $statusMsg = 'Something went wrong'; 
        echo "<script>md.showNotification('top', 'left', 'danger', '".$statusMsg."');</script>";

      }

 

 



    }  

?>



  <?php 



  if(isset($row_vendor['id']))
  {
    if($row_vendor['id']>0)
    {
        $fvid = $row_vendor['id'];
      $get_vendor_id = "=".$fvid;
    }
    else
    {
        $fvid = 0;
      $get_vendor_id = "> 0";
    }    
  }
  else
  {
      $fvid = 0;
    $get_vendor_id = "> 0";
  }


    if(isset($_GET['delfood']))
    {
      $del_id = $_GET['delfood'];
      if(mysqli_query($conn, "UPDATE `food_items` SET `is_deleted` = '1' WHERE id = '$del_id' "))
      {
        echo "<script>md.showNotification('top', 'left', 'success', 'Food deleted successfully.');</script>";
      }
      else
      {
        echo "<script>md.showNotification('top', 'left', 'danger', 'Something went wrong!!!');</script>";
      }
    }
  ?> 




      <!-- End Navbar -->

<style>

.fileinput-button {
  position: relative;
  overflow: hidden;
}

.fileinput-button input {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  opacity: 0;
  -ms-filter: "alpha(opacity=0)";
  font-size: 200px;
  direction: ltr;
  cursor: pointer;
}

.thumb {
  height: 80px;
  width: 100px;
  border: 1px solid #000;
}

ul.thumb-Images li {
  width: 120px;
  float: left;
  display: inline-block;
  vertical-align: top;
  height: 120px;
}

.img-wrap {
  position: relative;
  display: inline-block;
  font-size: 0;
}

.img-wrap .close, .del {
  position: absolute;
  top: 2px;
  right: 2px;
  z-index: 100;
  background-color: #d0e5f5;
  padding: 5px 2px 2px;
  color: #000;
  font-weight: bolder;
  cursor: pointer;
  opacity: 0.5;
  font-size: 23px;
  line-height: 10px;
  border-radius: 50%;
}

.img-wrap:hover .close, .del {
  opacity: 1;
  background-color: #ff0000;
}

.FileNameCaptionStyle {
  font-size: 12px;
}


</style>


      <!-- End Navbar -->

<style>

.fileinput-button {
  position: relative;
  overflow: hidden;
}

.fileinput-button input {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  opacity: 0;
  -ms-filter: "alpha(opacity=0)";
  font-size: 200px;
  direction: ltr;
  cursor: pointer;
}

.thumb {
  height: 80px;
  width: 100px;
  border: 1px solid #000;
}

ul.thumb-Images li {
  width: 120px;
  float: left;
  display: inline-block;
  vertical-align: top;
  height: 120px;
}

.img-wrap {
  position: relative;
  display: inline-block;
  font-size: 0;
}

.img-wrap .close, .del {
  position: absolute;
  top: 2px;
  right: 2px;
  z-index: 100;
  background-color: #d0e5f5;
  padding: 5px 2px 2px;
  color: #000;
  font-weight: bolder;
  cursor: pointer;
  opacity: 0.5;
  font-size: 23px;
  line-height: 10px;
  border-radius: 50%;
}

.img-wrap:hover .close, .del {
  opacity: 1;
  background-color: #ff0000;
}

.FileNameCaptionStyle {
  font-size: 12px;
}


</style>



     <div class="content">
        <div class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data">

          <div class="row">
         



            <div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">dinner_dining</i>
                  </div>
                  <h4 class="card-title">Food Details <span style="color:red;">* All are required fields</span></h4>
                </div>
                <div class="card-body ">
                
                    <div class="form-group">
                      <label for="">Food Name <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" name="foodname" value="" required>
                    </div>
                    
                    <div class="">
                    <label for="">Food Category <span style="color:red;">*</span></label>
                    
                     <select name="foodcategory" id="foodcategory" class="w-100 form-control" style="margin-bottom:2%;"   required>
                       <option value="" selected disabled >Select Food Category</option>                    
                       <option value="1">&#129001; Veg</option>
                       <option value="2">&#128997; Non-Veg</option>
                     </select>
                   </div>
                   
                    

                        <div class="form-group">
                          <label>Food Details <span style="color:red;">*</span></label>
                          <div class="form-group">
                            <label class="bmd-label-floating">  </label>
                            <textarea name="details" class="form-control" rows="5" required></textarea>
                          </div>
                        </div>

                        <div class="form-group">
                      <label for="">Food Price in ₹ <span style="color:red;">*</span></label>
                      <input type="number" class="form-control" name="foodprice" value="" required>
                    </div>
                              
                </div>
                
              </div>
            </div>


            <div class="col-md-6">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person_add</i>
                  </div>
                  <h4 class="card-title">Vendor Details <span style="color:red;">* All are required fields</span></h4>
                </div>
                <div class="card-body ">
                
                                 
             

                   <div class="">
                     <label for="">Vendor Serve Timing <span style="color:red;">*</span></label>
                    
                     <select name="servetime" id="servetime" class="w-100 form-control" style="margin-bottom:2%;"   required>
                       <option value="" selected disabled >Select Vendor Serve Timing</option>                    
                       <option value="1">Breakfast</option>
                       <option value="2">Lunch</option>
                       <option value="3">Dinner</option>
                     </select>
                   </div>    
         
                </div>
                
              </div>
            

                <div class="card card-profile">
                    <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">add_a_photo</i>
                            </div>
                            <h4 class="card-title">Select Food Photos <span style="color:red;">* Required</span></h4>
                        </div>
                        

                        <div class="card-body ">
                
               
                <span class="btn btn-fill btn-rose fileinput-button">
                <span>Select Food Images</span>
                <input required type="file" name="files[]" id="files" multiple accept="image/jpeg, image/jpg, image/png, image/gif,">
                <br />
                </span>
                <br/> <br/>
                <output id="Filelist"></output>                       


                </div>
    
              </div>


                    
                </div>
            

           


           

            <div class="col-md-12">
                <div class="card ">
                    <div class="card-footer">
                          <button id="add-food" name="add-food" type="submit" class="btn btn-fill btn-rose btn-block">Add Food</button>
                    </div>
                </div>
            </div>
         
          </div>

        </form>
        </div>
      </div>



<!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">reorder</i>
                  </div>
                  <h4 class="card-title">Food List</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                      
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Food Name</th>
                          <th>Food Category</th>
                          <th>Food Details</th>
                          <th>Food Price</th>
                          <th>Serve Time</th>
                          <th>Food Vendor</th>
                          <th>Available</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Image</th>
                          <th>Food Name</th>
                          <th>Food Category</th>
                          <th>Food Details</th>
                          <th>Food Price</th>
                          <th>Serve Time</th>
                          <th>Food Vendor</th>
                          <th>Available</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>

                      <?php
                        $sql = "SELECT * FROM `food_items` WHERE `is_deleted` = '0' AND `vendor_id`  ".$get_vendor_id." ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                          $food_id = $row['id'];
                          $sql_food_img = "SELECT * FROM `food_images` WHERE `food_id` = '$food_id' LIMIT 1 ";
                          $result_food_img = $conn->query($sql_food_img);
                          if($result_food_img->num_rows > 0)
                          {
                            $foodImg = $result_food_img->fetch_assoc();
                            $foodImg = $foodImg['food_img'];
                          }
                          else
                          {
                            $foodImg = "noimg.png";
                          }

                          $food_vendor = $row['vendor_id'];
                          $sql_vendor = "SELECT * FROM `vendors` WHERE `id` = '$food_vendor' LIMIT 1 ";
                          $result_vendor = $conn->query($sql_vendor);
                          if($result_vendor->num_rows > 0)
                          {
                            $foodVendor = $result_vendor->fetch_assoc();
                            $foodVendor = $foodVendor['business_name'];
                          }
                          else
                          {
                            $foodVendor = "";
                          }

                    ?>

                        <tr>
                          <td><img src="../vendor_app/uploads/food/<?php echo $foodImg; ?>" style="width:100px; height:100px;"/></td>
                          <td><?php echo $row['food_name']; ?></td>
                          <td class='text-center'><?php if($row['food_type'] == 1) { echo "&#129001;"; } else { echo "&#128997;"; } ?></td>
                          <td><?php echo $row['food_details']; ?></td>
                          <td>₹ <?php echo $row['food_price']; ?>/-</td>
                          <td><?php if($row['serve_time'] == 1) { echo "Breakfast"; } else if($row['serve_time'] == 2){ echo "Lunch"; } else { echo "Dinner"; } ?></td>
                          <td><?php echo $foodVendor; ?></td>
                          <td><?php if($row['is_available'] == 1){ echo "<span style='color:green; font-weight:bold;'>Available</span>"; }else{ echo "<span style='color:red; font-weight:bold;'>Unvailable</span>";} ?></td>
                          <td class="text-right">
                            <a href="edit-food.php?editfood=<?php echo $row['id']; ?>&hide=1" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">create</i></a>
                            <a href="?delfood=<?php echo $row['id']; ?>" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>
                          </td>
                        </tr>
                      <?php
                        } } 
                        else{
                         echo "<tr>
                         <td colspan='7' class='text-center'>No Food Found</td>
                         </tr>";
                        }
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
          <!-- end row -->
        </div>
      </div>






<?php

 $sql_vendor = "SELECT * FROM `vendors` WHERE `id` = '$assoc_vendor_id'";
    $result_vendor = $conn->query($sql_vendor);
    if ($result_vendor->num_rows > 0) {
      $row_vendor = $result_vendor->fetch_assoc();
    }

?>







      <div class="content">
        <div class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data">

          <div class="row">
         



            <div class="col-md-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                  <i class="material-icons">today</i>
                  </div>
                  <h4 class="card-title"><?php echo $row_vendor["business_name"]; ?> Food Schedule <span style="color:red;"> * All are required fields</span></h4>
                </div>

                        <div class="card-body">

                        <div class="row">

                        <div class="col-md-4">
                            <div class="card ">
                                <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i>Breakfast</i>
                                </div>
                            </div>
                            <div class="card-body ">
                                
                                    <div class="p-4">
                                        <label class="form-check-label">
                                                <input style="margin-top:3px;" name="bf_list" id="bf_list" type="checkbox" class="form-check-input" value="1" <?php if($row_vendor["bf_list"] == 1){ echo "checked"; } ?> >List Breakfast
                                        </label>                                    
                                    </div>
                
                                    <div class="">
                                        <label for="">Monday<span style="color:red;"> *</span></label>
                                        <select name="mon_bf" id="mon_bf" class="w-100 form-control bf_shedule" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '1' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['mon_bf']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>
                                        </select>
                                    </div>  
                                    
                                    <div class="">
                                        <label for="">Tuesday<span style="color:red;"> *</span></label>
                                        <select name="tue_bf" id="tue_bf" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '1' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['tue_bf']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Wednesday<span style="color:red;"> *</span></label>
                                        <select name="wed_bf" id="wed_bf" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '1' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['wed_bf']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Thrusday<span style="color:red;"> *</span></label>
                                        <select name="thu_bf" id="thu_bf" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '1' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['thu_bf']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Friday<span style="color:red;"> *</span></label>
                                        <select name="fri_bf" id="fri_bf" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '1' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['fri_bf']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Saturday<span style="color:red;"> *</span></label>
                                        <select name="sat_bf" id="sat_bf" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '1' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['sat_bf']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Sunday<span style="color:red;"> *</span></label>
                                        <select name="sun_bf" id="sun_bf" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '1' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['sun_bf']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    
                            </div>
                
                         </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card ">
                                <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i>Lunch</i>
                                </div>
                            </div>
                           
                            <div class="card-body ">
                                
                                    <div class="p-4">
                                        <label class="form-check-label">
                                                <input style="margin-top:3px;" name="lun_list" id="lun_list" type="checkbox" class="form-check-input" value="1" <?php if($row_vendor["lun_list"] == 1){ echo "checked"; } ?> >List Lunch
                                        </label>                                    
                                    </div>
                
                                    <div class="">
                                        <label for="">Monday<span style="color:red;"> *</span></label>
                                        <select name="mon_lun" id="mon_lun" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '2' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['mon_lun']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  
                                    
                                    <div class="">
                                        <label for="">Tuesday<span style="color:red;"> *</span></label>
                                        <select name="tue_lun" id="tue_lun" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '2' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['tue_lun']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Wednesday<span style="color:red;"> *</span></label>
                                        <select name="wed_lun" id="wed_lun" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '2' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['wed_lun']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Thrusday<span style="color:red;"> *</span></label>
                                        <select name="thu_lun" id="thu_lun" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '2' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['thu_lun']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Friday<span style="color:red;"> *</span></label>
                                        <select name="fri_lun" id="fri_lun" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '2' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['fri_lun']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Saturday<span style="color:red;"> *</span></label>
                                        <select name="sat_lun" id="sat_lun" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '2' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['sat_lun']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Sunday<span style="color:red;"> *</span></label>
                                        <select name="sun_lun" id="sun_lun" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '2' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['sun_lun']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    
                            </div>
                
                         </div>
                        </div>


                        <div class="col-md-4">
                            <div class="card ">
                                <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i>Dinner</i>
                                </div>
                            </div>
                            
                            <div class="card-body ">
                                
                                    <div class="p-4">
                                        <label class="form-check-label">
                                                <input style="margin-top:3px;" name="din_list" id="din_list" type="checkbox" class="form-check-input" value="1" <?php if($row_vendor["din_list"] == 1){ echo "checked"; } ?> >List Dinner
                                        </label>                                    
                                    </div>
                
                                    <div class="">
                                        <label for="">Monday<span style="color:red;"> *</span></label>
                                        <select name="mon_din" id="mon_din" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '3' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['mon_din']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  
                                    
                                    <div class="">
                                        <label for="">Tuesday<span style="color:red;"> *</span></label>
                                        <select name="tue_din" id="tue_din" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '3' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['tue_din']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Wednesday<span style="color:red;"> *</span></label>
                                        <select name="wed_din" id="wed_din" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '3' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['wed_din']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Thrusday<span style="color:red;"> *</span></label>
                                        <select name="thu_din" id="thu_din" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '3' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['thu_din']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Friday<span style="color:red;"> *</span></label>
                                        <select name="fri_din" id="fri_din" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '3' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['fri_din']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Saturday<span style="color:red;"> *</span></label>
                                        <select name="sat_din" id="sat_din" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '3' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['sat_din']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    <div class="">
                                        <label for="">Sunday<span style="color:red;"> *</span></label>
                                        <select name="sun_din" id="sun_din" class="w-100 form-control" style="margin-bottom:2%;"   required>
                                                <option value="" selected disabled >Select Food</option>
                                                <?php 
                                                $sql_food = "SELECT * FROM `food_items` WHERE `serve_time` = '3' AND `vendor_id` = '$assoc_vendor_id' ";
                                                $result_food = $conn->query($sql_food);
                                                if ($result_food->num_rows > 0) {
                                                    while($row_food = $result_food->fetch_assoc()) { ?>
                                                        <option value="<?php echo $row_food['id']; ?>"  <?php if($row_food['id'] == $row_vendor['sun_din']){ echo "selected"; } ?>  ><?php echo $row_food['food_name']; ?></option>
                                                <?php } } ?>

                                        </select>
                                    </div>  

                                    
                            </div>
                
                         </div>
                        </div>

                        </div>

                        </div>

                        <div class="card-footer">
                          <button id="add-schedule" name="add-schedule" type="submit" class="btn btn-fill btn-rose btn-block">Save Schedule</button>
                    </div>
                
              </div>
            </div>


            


      
            

           


            </div>

            
         
          </div>

        </form>
        </div>
      </div>
      

      <script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }
      });

      var table = $('#datatable').DataTable();

      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });

      // Delete a record
      table.on('click', '.remove', function(e) {
        $tr = $(this).closest('tr');
        table.row($tr).remove().draw();
        e.preventDefault();
      });

      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
  </script>
  
   <script>
//I added event handler for the file upload control to access the files properties.
document.addEventListener("DOMContentLoaded", init, false);

//To save an array of attachments
var AttachmentArray = [];

//counter for attachment array
var arrCounter = 0;

//to make sure the error message for number of files will be shown only one time.
var filesCounterAlertStatus = false;

//un ordered list to keep attachments thumbnails
var ul = document.createElement("ul");
ul.className = "thumb-Images";
ul.id = "imgList";

function init() {
  //add javascript handlers for the file upload event
  document
    .querySelector("#files")
    .addEventListener("change", handleFileSelect, false);
}

//the handler for file upload event
function handleFileSelect(e) {
  //to make sure the user select file/files
  if (!e.target.files) return;

  //To obtaine a File reference
  var files = e.target.files;

  // Loop through the FileList and then to render image files as thumbnails.
  for (var i = 0, f; (f = files[i]); i++) {
    //instantiate a FileReader object to read its contents into memory
    var fileReader = new FileReader();

    // Closure to capture the file information and apply validation.
    fileReader.onload = (function(readerEvt) {
      return function(e) {
        //Apply the validation rules for attachments upload
        ApplyFileValidationRules(readerEvt);

        //Render attachments thumbnails.
        RenderThumbnail(e, readerEvt);

        //Fill the array of attachment
        FillAttachmentArray(e, readerEvt);
      };
    })(f);

    // Read in the image file as a data URL.
    // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
    // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
    fileReader.readAsDataURL(f);
  }
  document
    .getElementById("files")
    .addEventListener("change", handleFileSelect, false);
}

//To remove attachment once user click on x button
jQuery(function($) {
  $("div").on("click", ".img-wrap .close", function() {
    var id = $(this)
      .closest(".img-wrap")
      .find("img")
      .data("id");

    //to remove the deleted item from array
    var elementPos = AttachmentArray.map(function(x) {
      return x.FileName;
    }).indexOf(id);
    if (elementPos !== -1) {
      AttachmentArray.splice(elementPos, 1);
    }

    //to remove image tag
    $(this)
      .parent()
      .find("img")
      .not()
      .remove();

    //to remove div tag that contain the image
    $(this)
      .parent()
      .find("div")
      .not()
      .remove();

    //to remove div tag that contain caption name
    $(this)
      .parent()
      .parent()
      .find("div")
      .not()
      .remove();

    //to remove li tag
    var lis = document.querySelectorAll("#imgList li");
    for (var i = 0; (li = lis[i]); i++) {
      if (li.innerHTML == "") {
        li.parentNode.removeChild(li);
      }
    }
  });
});

//Apply the validation rules for attachments upload
function ApplyFileValidationRules(readerEvt) {
  //To check file type according to upload conditions
  if (CheckFileType(readerEvt.type) == false) {
  
    md.showNotification('top', 'left', 'danger', 'The file (' +readerEvt.name +') does not match the upload conditions, You can only upload jpg/png/gif files');


    e.preventDefault();
    return;
  }

  //To check file Size according to upload conditions
  if (CheckFileSize(readerEvt.size) == false) {


    md.showNotification('top', 'left', 'danger', 'The file (' +readerEvt.name +') does not match the upload conditions, The maximum file size for uploads should not exceed 300 KB');


    e.preventDefault();
    return;
  }

  //To check files count according to upload conditions
  if (CheckFilesCount(AttachmentArray) == false) {
    if (!filesCounterAlertStatus) {
      filesCounterAlertStatus = true;
     
      md.showNotification('top', 'left', 'danger', 'You have added more than 8 files. According to upload conditions you can upload 8 files maximum');
    }
    e.preventDefault();
    return;
  }
}

//To check file type according to upload conditions
function CheckFileType(fileType) {
  if (fileType == "image/jpeg") {
    return true;
  } else if (fileType == "image/png") {
    return true;
  }
  
  else if (fileType == "image/jpg") {
    return true;
  }
  
  else if (fileType == "image/gif") {
    return true;
  } else {
    return false;
  }
  return true;
}

//To check file Size according to upload conditions
function CheckFileSize(fileSize) {
  if (fileSize < 5000000) {
    return true;
  } else {
    return false;
  }
  return true;
}

//To check files count according to upload conditions
function CheckFilesCount(AttachmentArray) {
  //Since AttachmentArray.length return the next available index in the array,
  //I have used the loop to get the real length
  var len = 0;
  for (var i = 0; i < AttachmentArray.length; i++) {
    if (AttachmentArray[i] !== undefined) {
      len++;
    }
  }
  //To check the length does not exceed 10 files maximum
  if (len > 7) {
    return false;
  } 
  else {
    return true;
  }
}

//Render attachments thumbnails.
function RenderThumbnail(e, readerEvt) {
  var li = document.createElement("li");
  ul.appendChild(li);
  li.innerHTML = [
    '<div class="img-wrap"> <span class="close">&times;</span>' +
      '<img class="thumb" src="',
    e.target.result,
    '" title="',
    escape(readerEvt.name),
    '" data-id="',
    readerEvt.name,
    '"/>' + "</div>"
  ].join("");

  var div = document.createElement("div");
  div.className = "FileNameCaptionStyle";
  li.appendChild(div);
  //div.innerHTML = [readerEvt.name].join("");
  document.getElementById("Filelist").insertBefore(ul, null);
}

//Fill the array of attachment
function FillAttachmentArray(e, readerEvt) {
  AttachmentArray[arrCounter] = {
    AttachmentType: 1,
    ObjectType: 1,
    FileName: readerEvt.name,
    FileDescription: "Attachment",
    NoteText: "",
    MimeType: readerEvt.type,
    Content: e.target.result.split("base64,")[1],
    FileSizeInBytes: readerEvt.size
  };
  arrCounter = arrCounter + 1;
}



</script>


      <?php require 'footer.php' ?>