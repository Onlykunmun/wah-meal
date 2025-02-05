<?php require 'header.php' ?>
     
  <?php 



    if(isset($_GET['delvendor']))
    {
      $del_id = $_GET['delvendor'];
      if(mysqli_query($conn, "UPDATE `vendors` SET `is_deleted` = '1' WHERE id = '$del_id' "))
      {
        echo "<script>md.showNotification('top', 'left', 'success', 'Vendor deleted successfully.');</script>";
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
                  <h4 class="card-title">All Vendors</h4>
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
                          <!--th>Wallet</th-->
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
                          <!--th>Wallet</th-->
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </tfoot>
                      <tbody>

                      <?php
                        $sql = "SELECT * FROM `vendors` WHERE `is_deleted` = '0' ";
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
                          <!--td>₹ <?php echo $row['wallet_balance']; ?></td-->
                          <td class="text-right">
                            <a title="Edit Vendor Profile" href="edit-vendor.php?editvendor=<?php echo $row['id']; ?>" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">create</i></a>
                            <a title="Edit Vendor Schedule" href="edit-schedule.php?editschedule=<?php echo $row['id']; ?>" class="btn btn-link btn-success btn-just-icon edit"><i class="material-icons">today</i></a>
                            <a title="View Orders" href="all-orders.php?fetchByVendor=<?php echo $row['id']; ?>" class="btn btn-link btn-info btn-just-icon edit"><i class="material-icons">list_alt</i></a>
                            <a title="Delete Vendor Account" href="?delvendor=<?php echo $row['id']; ?>" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>
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
