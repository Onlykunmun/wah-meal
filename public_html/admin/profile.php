<?php require 'header.php' ?>

<?php



    

   



      if(isset($_POST['update-password']))
      {
          $password = md5($_POST['password']);
          $pass1 = $_POST['pass1'];
          $pass2 = $_POST['pass2'];
         
  
          $sql = "SELECT * FROM `admin` WHERE `email` = '$me' ";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
  
          if($password == $row['password'])
          {
            if($pass1 == $pass2)
            {
              $pass_change = md5($pass1);
              mysqli_query($conn, "UPDATE `admin` SET `password`='".$pass_change."' WHERE `email`='".$me."';");
              echo "<script>md.showNotification('top', 'left', 'success', 'Password changed successfully.');</script>";
            }
            else
            {
              echo "<script>md.showNotification('top', 'left', 'danger', 'Password does not matched.');</script>";
            }
            
  
          }
          else{
  
            echo "<script>md.showNotification('top', 'left', 'danger', 'Please provide correct current password.');</script>";
  
          }
  
          
      }






?>

      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">perm_identity</i>
                  </div>
                  <h4 class="card-title">Edit Profile</h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating"></label>
                          <input value="<?php echo $me; ?>" type="text" class="form-control" disabled>
                        </div>
                      </div>
                    </div>

           
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
            

              <div class="card card-profile">
               
                <div class="card-body">
                    
          <form action="" method="post">
                  <div class="col-md-12">
                        <div class="form-group">
                          <label >Current Password</label>
                          <input type="password" class="form-control" value="" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>
                  </div>

                  <div class="col-md-12">
                        <div class="form-group">
                          <label >New Password</label>
                          <input type="password" class="form-control" value="" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>
                  </div>
                  <div class="col-md-12">
                        <div class="form-group">
                          <label >Re-enter Password</label>
                          <input type="password" class="form-control" value="" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>
                  </div>
                
                  <button name="update-password" type="submit" class="btn btn-rose pull-right">Update Password</button>
                    <div class="clearfix"></div>
                  </form>

              </div>
            </div>




            
          </div>
        </div>
      </div>
      <?php require 'footer.php' ?>