<?php require 'header.php' ?>



<?php


if(isset($_GET['delpkgduration']))
{
  $del_id = $_GET['delpkgduration'];
  if(mysqli_query($conn, "DELETE FROM `package_duration`  WHERE id = '$del_id' "))
  {
    echo "<script>md.showNotification('top', 'left', 'success', 'Package duration deleted successfully.');</script>";
  }
  else
  {
    echo "<script>md.showNotification('top', 'left', 'danger', 'Something went wrong!!!');</script>";
  }
}




if(isset($_POST['add-duration']))
		{

      //Package Details
      $no_of_days = $_POST['no_ofdays'];   
      $pkg_info = $_POST['pkginfo'];   
      
  


      

$check_noday = "SELECT * FROM `package_duration` WHERE `no_of_days` = '$no_of_days' ";
$result_check = $conn->query($check_noday);
      
if($result_check->num_rows == 0)
{

     
      $sql = "INSERT INTO `package_duration` SET `no_of_days`= '$no_of_days', `pkg_info` = '$pkg_info'";

      if ($conn->query($sql) === TRUE) {

        
        
        $statusMsg = 'Package duration added successfully'; 
        echo "<script>md.showNotification('top', 'left', 'success', '".$statusMsg."');</script>";
        
      }
      else
      {


        $statusMsg = 'Something went wrong'; 
        echo "<script>md.showNotification('top', 'left', 'danger', '".$statusMsg."');</script>";

      }

 
  }
  else
  {
        $statusMsg = 'Package Duration Already Exist'; 
        echo "<script>md.showNotification('top', 'left', 'danger', '".$statusMsg."');</script>";
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



      <div class="content">
        <div class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data">

          <div class="row">
         



           


            <div class="col-md-4">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">more_time</i>
                  </div>
                  <h4 class="card-title">Package Duration Details <span style="color:red;">* All are required fields</span></h4>
                </div>
                <div class="card-body ">
                
                  

                   <div class="form-group">
                      <label for="">Number of Day(s) <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" value="" name="no_ofdays"   required   >
                    </div>
                 
                    
                    <div class="form-group">
                          <label>Package Information <span style="color:red;">*</span></label>
                          <div class="form-group">
                            <label class="bmd-label-floating">  </label>
                            <textarea name="pkginfo" class="form-control" rows="5" required></textarea>
                          </div>
                        </div>

                    <div class="card-footer">
                          <button id="add-duration" name="add-duration" type="submit" class="btn btn-fill btn-rose btn-block">Add Package</button>
                    </div>
                    
                </div>
                
              </div>
            </div>


            <div class="col-md-8">

              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">reorder</i>
                  </div>
                  <h4 class="card-title">Package Duration List </h4>
                </div>
                <div class="card-body ">
                    

                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>Sl. No.</th>
                          <th>Number of Day(s)</th>
                          <th>Package Information</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Sl. No.</th>
                          <th>Number of Day(s)</th>
                          <th>Package Information</th>
                          <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                      </tfoot>
                        <tbody>

                        <?php
                        $sql = "SELECT * FROM `package_duration`  ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $i=1;
                        while($row = $result->fetch_assoc()){
                        ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['no_of_days']; ?> Day(s)</td>
                                    <td><?php echo $row['pkg_info']; ?></td>
                                    <td class="text-right">
                                    <a href="?delpkgduration=<?php echo $row['id']; ?>" class="btn btn-link btn-danger btn-just-icon remove"><i class="material-icons">close</i></a>
                                    </td>
                                </tr>

                        <?php
                        $i++;
                        } } 
                        else{
                         echo "<tr>
                         <td colspan='4' class='text-center'>No Package Duration Found</td>
                         </tr>";
                        }
                        ?>   

                        
                        </tbody>
                    </table>
                </div>



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


      <?php require 'footer.php' ?>