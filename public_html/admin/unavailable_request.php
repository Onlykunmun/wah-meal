<?php require 'header.php' ?>
     
  <?php 



    if(isset($_GET['accept_vendor_request']))
    {
      $vur_id = $_GET['accept_vendor_request'];
      
            $sql = "SELECT * FROM `vendor_unavailable_request` WHERE `id` = '$vur_id' ";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          
          
          $vendor_id = $row['vendor_id'];
      
      if(mysqli_query($conn, "UPDATE `vendors` SET `is_available` = '0' WHERE id = '$vendor_id' "))
      {
            if(mysqli_query($conn, "UPDATE `vendor_unavailable_request` SET `status` = '1' WHERE id = '$vur_id' "))
            {
              echo "<script>md.showNotification('top', 'left', 'success', 'Vendor successfully unavailabled.');</script>";
            }
            else
            {
              echo "<script>md.showNotification('top', 'left', 'danger', 'Something went wrong!!!');</script>";
            }
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
                    <i class="material-icons">public_off</i>
                  </div>
                  <h4 class="card-title">Unavilable Requests</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Logo</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Business Name</th>
                          <th>City - PIN</th>
                          <th>Address</th>
                          <th>Available Status</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                        <th>Logo</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Business Name</th>
                          <th>City - PIN</th>
                          <th>Address</th>
                          <th>Available Status</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>

                      <?php
                        $sql = "SELECT v.*, vur.status as avl_unavl, vur.id as vur_id  FROM `vendor_unavailable_request` as vur LEFT JOIN vendors as v ON vur.vendor_id = v.id WHERE v.is_deleted = '0'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                    ?>

                        <tr>
                          <td><img src="../vendor_app/uploads/logo/<?php echo $row['logo']; ?>" style="width:100px; height:100px;"/></td>
                          <td><?php echo $row['fullname']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <td><?php echo $row['business_name']; ?></td>
                          <td><?php echo $row['business_city'] .' - '. $row['business_pin']; ?></td>
                          <td><?php echo $row['business_address']; ?></td>
                          <td><?php if($row['is_available'] == 1) { echo "<span style='color:green;' >Available</span>"; } else { echo "<span style='color:red;' >Unavailable</span>"; } ?></td>
                          <td class="text-right">
                              <?php if($row['avl_unavl'] == 0) { ?>
                                    <a title="Accept Unavailability Request" href="?accept_vendor_request=<?php echo $row['vur_id']; ?>" class="btn btn-sm  btn-success">Accept</a>
                              <?php } ?>
                          </td>
                        </tr>
                      <?php
                        } } 
                        else{
                         echo "<tr>
                         <td colspan='9' class='text-center'>No Vendor Found</td>
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
