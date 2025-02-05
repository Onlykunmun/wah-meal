<?php require 'header.php' ?>



<?php



if(isset($_POST['del_img']))
{
    $del_id = $_POST['del_img'];
    if(mysqli_query($conn, "DELETE FROM `food_images` WHERE id = '$del_id'"))
    {
      echo 1;
      exit();
    }
    else
    {
      echo 0;
      exit();
    }
}




if(isset($_POST['edit-food']))
		{

      //Food Details
      $food_name = $_POST['foodname'];   
      $food_type = $_POST['foodcategory'];   
      $food_details = $_POST['details'];   
      $food_price = $_POST['foodprice'];   
      $food_vendor = $_POST['vendor'];
      $food_serve_time = $_POST['servetime'];
     

      $sql = "UPDATE `food_items` SET `food_name`= '$food_name', `vendor_id` = '$food_vendor', `food_type` = '$food_type', 
      `serve_time` = '$food_serve_time', `food_details` = '$food_details', `food_price` = '$food_price', `modified_by` = 'ADMIN' WHERE id = '$food_edit' ";

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
                  $insertValuesSQL .= "('$food_edit','".$fileName."'),"; 
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
                $statusMsg = "Food updated successfully.".$errorMsg; 
                $statusType = "success";
                //echo "<script>md.showNotification('top', 'left', 'success', '".$statusMsg."');</script>";
            }else{ 
                $statusMsg = "Sorry, something went wrong"; 
                $statusType = "danger";
               // echo "<script>md.showNotification('top', 'left', 'danger', '".$statusMsg."');</script>";
            } 
        } 

        echo "<script>md.showNotification('top', 'left', '".$statusType."', '".$statusMsg."');</script>";
        
      }
      else
      {


        $statusMsg = 'Something went wrong'; 
        echo "<script>md.showNotification('top', 'left', 'danger', '".$statusMsg."');</script>";

      }

 

 



    }  


    $sql = "SELECT * FROM `food_items` WHERE `id` = '$food_edit'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
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
                      <input type="text" class="form-control" name="foodname" value="<?php echo $row['food_name']; ?>" required>
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
                            <textarea name="details" class="form-control" rows="5" required><?php echo $row['food_details']; ?></textarea>
                          </div>
                        </div>

                        <div class="form-group">
                      <label for="">Food Price in ₹ <span style="color:red;">*</span></label>
                      <input type="number" class="form-control" name="foodprice" value="<?php echo $row['food_price']; ?>" required>
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
                
                <?php if(isset($_GET['hide']) && $_GET['hide'] == 1){ ?>
                   <div class="d-none">
                     <label for="">Select Vendor <span style="color:red;">*</span></label>
                    
                     <select name="vendor" id="vendor" class="w-100 form-control" style="margin-bottom:2%;"   required>
                       <option value="" selected disabled >Select Vendor</option>  
                       <?php 
                            $sql_vendor = "SELECT * FROM `vendors`";
                            $result_vendor = $conn->query($sql_vendor);
                            if ($result_vendor->num_rows > 0) {
                                while($row_vendor = $result_vendor->fetch_assoc()) { ?>
                                    <option value="<?php echo $row_vendor['id']; ?>"><?php echo $row_vendor['business_name']; ?></option>
                        <?php } } ?>
                     </select>
                   </div>                    
             
                    <?php } else { ?>
                    
                    <div class="">
                     <label for="">Select Vendor <span style="color:red;">*</span></label>
                    
                     <select name="vendor" id="vendor" class="w-100 form-control" style="margin-bottom:2%;"   required>
                       <option value="" selected disabled >Select Vendor</option>  
                       <?php 
                            $sql_vendor = "SELECT * FROM `vendors`";
                            $result_vendor = $conn->query($sql_vendor);
                            if ($result_vendor->num_rows > 0) {
                                while($row_vendor = $result_vendor->fetch_assoc()) { ?>
                                    <option value="<?php echo $row_vendor['id']; ?>"><?php echo $row_vendor['business_name']; ?></option>
                        <?php } } ?>
                     </select>
                   </div>       
                    
                    
                    <?php } ?>
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
                

                  <ul class="thumb-Images" style="margin-bottom:25%;" >
                    <?php
                        $p_images_sql = "SELECT * FROM `food_images` WHERE `food_id` = '$food_edit' ";
                        $p_images_result = $conn->query($p_images_sql);
                        if ($p_images_result->num_rows > 0) {
                            while($p_images_row = $p_images_result->fetch_assoc()) {
                    ?>            

                <li>
                <div class="img-wrap"> 
                <button type="button" onclick="deleteImg(this);" value="<?php echo $p_images_row['id']; ?>" class="del">×</button>
                <img class="thumb" src="../vendor_app/uploads/food/<?php echo $p_images_row['food_img']; ?>">
                </div>
                </li>
                <?php } } else { echo "No images"; } ?>
                </ul>
               
                <span class="btn btn-fill btn-rose fileinput-button btn-block">
                <span>Select Food Images</span>
                <input type="file" name="files[]" id="files" multiple accept="image/jpeg, image/jpg, image/png, image/gif,">
                <br />
                </span>
                <br/> <br/>
                <output id="Filelist"></output>                       


                </div>
    
              </div>


                    </div>
                </div>
            

           


            </div>

            <div class="col-md-12">
                <div class="card ">
                    <div class="card-footer">
                          <button id="edit-food" name="edit-food" type="submit" class="btn btn-fill btn-rose btn-block">Update Food</button>
                    </div>
                </div>
            </div>
         
          </div>

        </form>
        </div>
      </div>
      

      <script>

document.querySelector('#foodcategory').value="<?php echo $row['food_type']; ?>";
document.querySelector('#vendor').value="<?php echo $row['vendor_id']; ?>";
document.querySelector('#servetime').value="<?php echo $row['serve_time']; ?>";



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

<script>

function deleteImg(d)
{
  $.ajax({
				url: "ajax.php", // point to server-side PHP script 
				data: {del_img: d.value},
				type: "POST",
				success: function(result) {

					if(result > 0)
					{
						$(d).parent().parent('li').remove(); 
						md.showNotification('top', 'left', 'success', 'Food image deleted successfully.');
					}
          else
          {
            md.showNotification('top', 'left', 'danger', 'Something went wrong.');
          }

				}
			});
}


</script>



      <?php require 'footer.php' ?>