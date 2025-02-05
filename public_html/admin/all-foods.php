<?php require 'header.php' ?>
     
  <?php 



  if(isset($_POST['fetchByVendor']))
  {
    if($_POST['fetchByVendor']>0)
    {
        $fvid = $_POST['fetchByVendor'];
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
                      <form action="" method="POST">
                        <select onchange="this.form.submit()" class="selectpicker" name="fetchByVendor">
                          <option selected disabled>Filter By Vendor</option>
                          <option value="0" <?php if($fvid == 0){ echo 'selected'; } ?> >All Vendors</option>
                          <?php 
                            $sql_vendor = "SELECT * FROM `vendors`";
                            $result_vendor = $conn->query($sql_vendor);
                            if ($result_vendor->num_rows > 0) {
                                while($row_vendor = $result_vendor->fetch_assoc()) { ?>
                                    <option value="<?php echo $row_vendor['id']; ?>" <?php if($fvid == $row_vendor['id']){ echo 'selected'; } ?> ><?php echo $row_vendor['business_name']; ?></option>
                        <?php } } ?>
                        </select>
                      </form>
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
                            <a href="edit-food.php?editfood=<?php echo $row['id']; ?>" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">create</i></a>
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
<?php require 'footer.php' ?>
