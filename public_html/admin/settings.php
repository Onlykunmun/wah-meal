<?php require 'header.php' ?>



<?php




if(isset($_POST['update_settings']))
		{

      //Contact Details
      $phone = $_POST['phone']; 
      $conn->query("UPDATE settings SET value = '$phone' WHERE key_id = 'phone' ");
      
      $email = $_POST['email']; 
      $conn->query("UPDATE settings SET value = '$email' WHERE key_id = 'email' ");
      
      $address = $_POST['address'];  
      $conn->query("UPDATE settings SET value = '$address' WHERE key_id = 'address' ");
       
  
      //Commission details
      $commission = $_POST['commission']; 
      $conn->query("UPDATE settings SET value = '$commission' WHERE key_id = 'commission' ");
 

      //Page details
      $about = $_POST['about'];  
      if($conn->query("UPDATE settings SET value = '$about' WHERE key_id = 'about' "))
      {
          echo("Error description: " . $conn -> error);
      }
      
      $terms =  $_POST['terms'];
      $conn->query("UPDATE settings SET value = '$terms' WHERE key_id = 'terms' ");
      
      $privacy =  $_POST['privacy'];
      $conn->query("UPDATE settings SET value = '$privacy' WHERE key_id = 'privacy' ");
      
      $refund =  $_POST['refund'];
      $conn->query("UPDATE settings SET value = '$refund' WHERE key_id = 'refund' ");
 

     
        $statusMsg = 'Settings updated successfully'; 
        echo "<script>md.showNotification('top', 'left', 'success', '".$statusMsg."');</script>";
      

    }  
    
    
    
    
    
    function getSettings($conn, $key)
	{
	    	$sql = "SELECT * FROM settings WHERE key_id = '$key' ";
			$result =  $conn->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				
			    return $row['value'];
				
			}
			else
			{
				return 0;
			}
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
                    <i class="material-icons">settings</i>
                  </div>
                  <h4 class="card-title">Wah Meal Settings <span style="color:red;">* All are required fields</span></h4>
                </div>
                <div class="card-body ">
                
                    <div class="form-group">
                      <label for="">Admin Commission %<span style="color:red;">*</span></label>
                      <input type="number" class="form-control" name="commission" value="<?php echo getSettings($conn, 'commission'); ?>" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="">Phone <span style="color:red;">*</span></label>
                      <input type="number" class="form-control" name="phone" value="<?php echo getSettings($conn, 'phone'); ?>" required>
                    </div>
                   
                   
                    
                     <div class="form-group">
                      <label for="">Email <span style="color:red;">*</span></label>
                      <input type="email" class="form-control" value="<?php echo getSettings($conn, 'email'); ?>" name="email"   required   >
                    </div>
                 
                    
                    <div class="form-group">
                          <label>Address <span style="color:red;">*</span></label>
                          <div class="form-group">
                            <label class="bmd-label-floating">  </label>
                            <textarea name="address" class="form-control" rows="5" required><?php echo getSettings($conn, 'address'); ?></textarea>
                          </div>
                    </div>

                        <div class="form-group">
                          <label>About Us <span style="color:red;">*</span></label>
                          <div class="form-group">
                            <label class="bmd-label-floating">  </label>
                            <textarea name="about" class="form-control editor" rows="5" required><?php echo getSettings($conn, 'about'); ?></textarea>
                          </div>
                        </div>
                        
                         <div class="form-group">
                          <label>Terms of Service <span style="color:red;">*</span></label>
                          <div class="form-group">
                            <label class="bmd-label-floating">  </label>
                            <textarea name="terms" class="form-control editor" rows="5" required><?php echo getSettings($conn, 'terms'); ?></textarea>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label>Privacy Policy <span style="color:red;">*</span></label>
                          <div class="form-group">
                            <label class="bmd-label-floating">  </label>
                            <textarea name="privacy" class="form-control editor" rows="5" required><?php echo getSettings($conn, 'privacy'); ?></textarea>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label>Refund Policy <span style="color:red;">*</span></label>
                          <div class="form-group">
                            <label class="bmd-label-floating">  </label>
                            <textarea name="refund" class="form-control editor" rows="5" required><?php echo getSettings($conn, 'refund'); ?></textarea>
                          </div>
                        </div>
                              
                </div>
                
              </div>
            </div>


      
            

           


            </div>

            <div class="col-md-12">
                <div class="card ">
                    <div class="card-footer">
                          <button onclick="tinymce.triggerSave(true,true);"  name="update_settings" type="submit" class="btn btn-fill btn-rose btn-block">Update</button>
                    </div>
                </div>
            </div>
         
          </div>

        </form>
        </div>
      </div>
      
      <script src="https://cdn.tiny.cloud/1/n9no4p439hc4n87hczji2dfzifzjjg7v0kb26czekiqxj4wi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
      <script>
  tinymce.init({
    selector: 'textarea.editor',
    menubar: false
  });
</script>





      <?php require 'footer.php' ?>