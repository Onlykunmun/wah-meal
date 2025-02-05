<?php require 'header.php' ?>



<?php




if(isset($_POST['edit-customer']))
		{

      //User Details
      $fullname = $_POST['fullname'];   
      $mobileno = $_POST['mobileno'];   
      $email = $_POST['email'];   
      
      if(strlen($_POST['password'])>0)
      {
        $password = $_POST['password'];
        $password = md5($password);   
      }
  
      //Location details
      $lat = $_POST['lat']; 
      $lng = $_POST['lng'];  

      //Business details
      $city =  $_POST['city']; 
      $pin =  $_POST['pin'];  
      $address =  $_POST['address'];

      



  if(strlen($_POST['password']) > 0)
  {
      $sql = "UPDATE `customers` SET `fullname`= '$fullname', `email` = '$email', `phone` = '$mobileno', 
      `password` = '$password', `lat` = '$lat', `lng` = '$lng', `city` = '$city', `pin` = '$pin',
      `address` = '$address', `created_by` = 'MOD_ADMIN' WHERE id = '$customer_edit' ";
  }
  else
  {
    $sql = "UPDATE `customers` SET `fullname`= '$fullname', `email` = '$email', `phone` = '$mobileno', 
    `lat` = '$lat', `lng` = '$lng', `city` = '$city', `pin` = '$pin',
    `address` = '$address', `created_by` = 'MOD_ADMIN' WHERE id = '$customer_edit' ";
  }


      if ($conn->query($sql) === TRUE) {

        
        
        $statusMsg = 'Customer updated successfully'; 
        echo "<script>md.showNotification('top', 'left', 'success', '".$statusMsg."');</script>";
        
      }
      else
      {


        $statusMsg = 'Something went wrong'; 
        echo "<script>md.showNotification('top', 'left', 'danger', '".$statusMsg."');</script>";

      }

 
 
 



    }  

    $sql = "SELECT * FROM `customers` WHERE `id` = '$customer_edit'";
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
         



           


            <div class="col-md-8">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person_add</i>
                  </div>
                  <h4 class="card-title">User Details <span style="color:red;">* All are required fields</span></h4>
                </div>
                <div class="card-body ">
                
                    <div class="form-group">
                      <label for="">Full Name <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" name="fullname" value="<?php echo $row['fullname']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="">Mobile Number <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" name="mobileno" value="<?php echo $row['phone']; ?>" name="phone" pattern="[6789][0-9]{9}" title="Please enter a valid Mobile number" required>
                    </div>
                    <div class="form-group">
                      <label for="">Email <span style="color:red;">*</span></label>
                      <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="">Password <span style="color:red;">*</span></label>
                      <input type="password" class="form-control" name="password" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                    </div>   
                    
                    <div class="">
                    <label for="">City <span style="color:red;">*</span></label>
                    
                     <select name="city" id="city" class="w-100 form-control" style="margin-bottom:2%;"   required>
                       <option value="" selected disabled >Select Business Location - City</option>
                       <option value="Agastinuagan">Agastinuagan</option>
                       <option value="Anandpur">Anandpur</option>
                       <option value="Anjira">Anjira</option>
                       <option value="Anugul (Angul)">Anugul (Angul)</option>
                       <option value="Arjyapalli">Arjyapalli</option>
                       <option value="Asika">Asika</option>
                       <option value="Athagad">Athagad</option>
                       <option value="Athmallik">Athmallik</option>
                       <option value="Badagada">Badagada</option>
                       <option value="Badakodanda">Badakodanda</option>
                       <option value="Badamba (Nizigarh)">Badamba (Nizigarh)</option>
                       <option value="Badmal">Badmal</option>
                       <option value="Balagoda (Bolani)">Balagoda (Bolani)</option>
                       <option value="Balangir">Balangir</option>
                       <option value="Baleshwar (Balasore)">Baleshwar (Balasore)</option>
                       <option value="Baliguda">Baliguda</option>
                       <option value="Balimela">Balimela</option>
                       <option value="Balipatapur">Balipatapur</option>
                       <option value="Balugaon">Balugaon</option>
                       <option value="Banaigarh">Banaigarh</option>
                       <option value="Banapur">Banapur</option>
                       <option value="Bandhbahal">Bandhbahal</option>
                       <option value="Bangomunda">Bangomunda</option>
                       <option value="Banki">Banki</option>
                       <option value="Barapali">Barapali</option>
                       <option value="Barbil">Barbil</option>
                       <option value="Bardol">Bardol</option>
                       <option value="Bargarh">Bargarh</option>
                       <option value="Baripada">Baripada</option>
                       <option value="Basudebpur">Basudebpur</option>
                       <option value="Baudhgarh (Boudh)">Baudhgarh (Boudh)</option>
                       <option value="Belagachhia">Belagachhia</option>
                       <option value="Bellaguntha (Belaguntha)">Bellaguntha (Belaguntha)</option>
                       <option value="Belpahar">Belpahar</option>
                       <option value="Bhabinipur">Bhabinipur</option>
                       <option value="Bhadrak">Bhadrak</option>
                       <option value="Bhakarsahi">Bhakarsahi</option>
                       <option value="Bhanjanagar">Bhanjanagar</option>
                       <option value="Bhapur">Bhapur</option>
                       <option value="Bhatli">Bhatli</option>
                       <option value="Bhawanipatna">Bhawanipatna</option>
                       <option value="Bhuban">Bhuban</option>
                       <option value="Bhubaneswar">Bhubaneswar</option>
                       <option value="Bijepur">Bijepur</option>
                       <option value="Binika">Binika</option>
                       <option value="Biramitrapur">Biramitrapur</option>
                       <option value="Birapratappur">Birapratappur</option>
                       <option value="Bishamakatak (Bissam Cuttack)">Bishamakatak (Bissam Cuttack)</option>
                       <option value="Borigam">Borigam</option>
                       <option value="Boriguma (Borigumma)">Boriguma (Borigumma)</option>
                       <option value="Brahmabarada">Brahmabarada</option>
                       <option value="Brahmapur (Berhampur)">Brahmapur (Berhampur)</option>
                       <option value="Brajarajnagar">Brajarajnagar</option>
                       <option value="Budhapanka">Budhapanka</option>
                       <option value="Buguda">Buguda</option>
                       <option value="Bundia">Bundia</option>
                       <option value="Burla">Burla</option>
                       <option value="Byasanagar">Byasanagar</option>
                       <option value="Champua">Champua</option>
                       <option value="Chandapur">Chandapur</option>
                       <option value="Chandili">Chandili</option>
                       <option value="Charibatia">Charibatia</option>
                       <option value="Chhatrapur">Chhatrapur</option>
                       <option value="Chikiti">Chikiti</option>
                       <option value="Chitrakonda">Chitrakonda</option>
                       <option value="Choudwar">Choudwar</option>
                       <option value="Cuttack">Cuttack</option>
                       <option value="Dadhapatna">Dadhapatna</option>
                       <option value="Daitari">Daitari</option>
                       <option value="Damanjodi">Damanjodi</option>
                       <option value="Danara">Danara</option>
                       <option value="Daringbadi">Daringbadi</option>
                       <option value="Debagarh">Debagarh</option>
                       <option value="Dera Colliery Township">Dera Colliery Township</option>
                       <option value="Dhamanagar">Dhamanagar</option>
                       <option value="Dhenkanal">Dhenkanal</option>
                       <option value="Digapahandi">Digapahandi</option>
                       <option value="Dungamal">Dungamal</option>
                       <option value="Erei">Erei</option>
                       <option value="Ganjam">Ganjam</option>
                       <option value="Ghantapada">Ghantapada</option>
                       <option value="Godiputamatiapara">Godiputamatiapara</option>
                       <option value="Golabandha">Golabandha</option>
                       <option value="Gopalpur">Gopalpur</option>
                       <option value="Gotamara">Gotamara</option>
                       <option value="Gudari">Gudari</option>
                       <option value="G. Udayagiri">G. Udayagiri</option>
                       <option value="Gunupur">Gunupur</option>
                       <option value="Hatibandha">Hatibandha</option>
                       <option value="Hinjilicut">Hinjilicut</option>
                       <option value="Hirakud">Hirakud</option>
                       <option value="Indipur">Indipur</option>
                       <option value="Itamati">Itamati</option>
                       <option value="Jagatsinghapur (Jagatsinghpur)">Jagatsinghapur (Jagatsinghpur)</option>
                       <option value="Jajanga">Jajanga</option>
                       <option value="Jajapur (Jajpur)">Jajapur (Jajpur)</option>
                       <option value="Jalda">Jalda</option>
                       <option value="Jaleshwar (Jaleswar)">Jaleshwar (Jaleswar)</option>
                       <option value="Jashipur">Jashipur</option>
                       <option value="Jatani">Jatani</option>
                       <option value="Jeypur (Jeypore)">Jeypur (Jeypore)</option>
                       <option value="Jharsuguda">Jharsuguda</option>
                       <option value="Jhumpura">Jhumpura</option>
                       <option value="Joda">Joda</option>
                       <option value="Jorada (Bada)">Jorada (Bada)</option>
                       <option value="Junagarh">Junagarh</option>
                       <option value="Kabatabandha">Kabatabandha</option>
                       <option value="Kabisurjyanagar (Kabisuryanagar)">Kabisurjyanagar (Kabisuryanagar)</option>
                       <option value="Kaipadar">Kaipadar</option>
                       <option value="Kalarangiata">Kalarangiata</option>
                       <option value="Kaliapani">Kaliapani</option>
                       <option value="Kalyanasingpur">Kalyanasingpur</option>
                       <option value="Kamakshyanagar">Kamakshyanagar</option>
                       <option value="Kandasar">Kandasar</option>
                       <option value="Kanheipur">Kanheipur</option>
                       <option value="Kantabanji (Kantabanjhi)">Kantabanji (Kantabanjhi)</option>
                       <option value="Kantilo">Kantilo</option>
                       <option value="Karanjia">Karanjia</option>
                       <option value="Kashinagar">Kashinagar</option>
                       <option value="Kendrapara">Kendrapara</option>
                       <option value="Kendujhar">Kendujhar</option>
                       <option value="Kesinga">Kesinga</option>
                       <option value="Khaliapali">Khaliapali</option>
                       <option value="Khalikote (Khallikote)">Khalikote (Khallikote)</option>
                       <option value="Khandapada">Khandapada</option>
                       <option value="Khariar">Khariar</option>
                       <option value="Khariar Road">Khariar Road</option>
                       <option value="Khatiguda">Khatiguda</option>
                       <option value="Khordha">Khordha</option>
                       <option value="Kochinda (Kuchinda)">Kochinda (Kuchinda)</option>
                       <option value="Kodala">Kodala</option>
                       <option value="Koida">Koida</option>
                       <option value="Konark">Konark</option>
                       <option value="Koraput">Koraput</option>
                       <option value="Kotpad">Kotpad</option>
                       <option value="Krushnanandapur">Krushnanandapur</option>
                       <option value="Kuanrmunda">Kuanrmunda</option>
                       <option value="Kukudakhandi">Kukudakhandi</option>
                       <option value="Kulad">Kulad</option>
                       <option value="Kullada">Kullada</option>
                       <option value="Kunjabangarh">Kunjabangarh</option>
                       <option value="Kurumuli">Kurumuli</option>
                       <option value="Lalsingi">Lalsingi</option>
                       <option value="Lathikata">Lathikata</option>
                       <option value="Lochapada">Lochapada</option>
                       <option value="Loisinga">Loisinga</option>
                       <option value="Madanpur Rampur">Madanpur Rampur</option>
                       <option value="Majhihara">Majhihara</option>
                       <option value="Makundapur">Makundapur</option>
                       <option value="Malkangiri">Malkangiri</option>
                       <option value="Mohana">Mohana</option>
                       <option value="Mukhiguda">Mukhiguda</option>
                       <option value="Mundamarai">Mundamarai</option>
                       <option value="Nabarangapur (Nabarangpur)">Nabarangapur (Nabarangpur)</option>
                       <option value="Nalco">Nalco</option>
                       <option value="Nayagarh">Nayagarh</option>
                       <option value="Nilagiri">Nilagiri</option>
                       <option value="Nimapada">Nimapada</option>
                       <option value="Nuahata">Nuahata</option>
                       <option value="Nuapatna">Nuapatna</option>
                       <option value="Odagaon">Odagaon</option>
                       <option value="Padmapur">Padmapur</option>
                       <option value="Palalahada">Palalahada</option>
                       <option value="Palurgada">Palurgada</option>
                       <option value="Panposh">Panposh</option>
                       <option value="Papadahandi">Papadahandi</option>
                       <option value="Paradip">Paradip</option>
                       <option value="Paradipgarh">Paradipgarh</option>
                       <option value="Paralakhemundi">Paralakhemundi</option>
                       <option value="Pathar">Pathar</option>
                       <option value="Patnagarh">Patnagarh</option>
                       <option value="Patrapur">Patrapur</option>
                       <option value="Pattamundai">Pattamundai</option>
                       <option value="Phulabani (Phulbani)">Phulabani (Phulbani)</option>
                       <option value="Pipili">Pipili</option>
                       <option value="Pitala">Pitala</option>
                       <option value="Polasara">Polasara</option>
                       <option value="Pratapsasan">Pratapsasan</option>
                       <option value="Puri">Puri</option>
                       <option value="Purusottampur">Purusottampur</option>
                       <option value="Raighar">Raighar</option>
                       <option value="Rairangpur">Rairangpur</option>
                       <option value="Rajagangapur (Rajgangpur)">Rajagangapur (Rajgangpur)</option>
                       <option value="Rajasunakhala">Rajasunakhala</option>
                       <option value="Rambha">Rambha</option>
                       <option value="Ramgarh">Ramgarh</option>
                       <option value="Ranapurgada">Ranapurgada</option>
                       <option value="Raurkela (Rourkela)">Raurkela (Rourkela)</option>
                       <option value="Raurkela Industrial Township">Raurkela Industrial Township</option>
                       <option value="Rayagada">Rayagada</option>
                       <option value="Rayagada">Rayagada</option>
                       <option value="Redhakhol (Rairakhol)">Redhakhol (Rairakhol)</option>
                       <option value="Remuna">Remuna</option>
                       <option value="Rengali">Rengali</option>
                       <option value="Rengali Dam Project Township">Rengali Dam Project Township</option>
                       <option value="R. Udayagiri">R. Udayagiri</option>
                       <option value="Sambalpur">Sambalpur</option>
                       <option value="Saranga">Saranga</option>
                       <option value="Sayadpur">Sayadpur</option>
                       <option value="Sheragada">Sheragada</option>
                       <option value="Sohela">Sohela</option>
                       <option value="Sonapur (Subarnapur, Sonepur)">Sonapur (Subarnapur, Sonepur)</option>
                       <option value="Soro">Soro</option>
                       <option value="Subalaya">Subalaya</option>
                       <option value="Sunabeda">Sunabeda</option>
                       <option value="Sundargarh (Sundergarh)">Sundargarh (Sundergarh)</option>
                       <option value="Surada">Surada</option>
                       <option value="Surala">Surala</option>
                       <option value="Suvani">Suvani</option>
                       <option value="Talcher">Talcher</option>
                       <option value="Tangi">Tangi</option>
                       <option value="Tarbha">Tarbha</option>
                       <option value="Tensa">Tensa</option>
                       <option value="Tikarpada">Tikarpada</option>
                       <option value="Tipo">Tipo</option>
                       <option value="Titlagarh">Titlagarh</option>
                       <option value="Tushura">Tushura</option>
                       <option value="Udala">Udala</option>
                       <option value="Umarkote (Umerkote)">Umarkote (Umerkote)</option>
                       <option value="Venkatraipur">Venkatraipur</option>
                     </select>
                   </div>


                   <div class="form-group">
                      <label for="">PIN <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" value="<?php echo $row['pin']; ?>" name="pin" pattern="[0-9]{6}"  required  title="Please enter your correct PIN" >
                    </div>
                 
                    
                    <div class="form-group">
                          <label>Complete Address <span style="color:red;">*</span></label>
                          <div class="form-group">
                            <label class="bmd-label-floating">  </label>
                            <textarea name="address" class="form-control" rows="5" required><?php echo $row['address']; ?></textarea>
                          </div>
                        </div>
                    
                </div>
                
              </div>
            </div>


            <div class="col-md-4">

              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">place</i>
                  </div>
                  <h4 class="card-title">Select Location <span style="color:red;">* Required</span></h4>
                </div>
                <div class="card-body ">
                    <div id="googleMap" style="height: 520px;"></div>
                    <input type='hidden' name='lat' id='lat'>  
                    <input type='hidden' name='lng' id='lng'> 
                </div>
              </div>

            </div>


            

           


            </div>

            <div class="col-md-12">
                <div class="card ">
                    <div class="card-footer">
                          <button disabled id="edit-customer" name="edit-customer" type="submit" class="btn btn-fill btn-rose btn-block">Update Customer</button>
                    </div>
                </div>
            </div>
         
          </div>

        </form>
        </div>
      </div>
      

      <script>

document.querySelector('#city').value="<?php echo $row['city']; ?>";

var mylat, mylong;

mylat = "<?php echo $row['lat']; ?>";
mylong = "<?php echo $row['lng']; ?>";

function initialize() {

var myLatlng = new google.maps.LatLng(mylat,mylong);
  var mapProp = {
    center:myLatlng,
    zoom:10,
    mapTypeId:google.maps.MapTypeId.ROADMAP
      
  };
  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'My Business Location',
      draggable:true  
  });
    document.getElementById('lat').value= mylat
    document.getElementById('lng').value= mylong  
    $('#edit-customer').removeAttr("disabled");
    // marker drag event
    google.maps.event.addListener(marker,'drag',function(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
    });

    //marker drag event end
    google.maps.event.addListener(marker,'dragend',function(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('lng').value = event.latLng.lng();
        
    });
}

initialize();



</script>


      <?php require 'footer.php' ?>