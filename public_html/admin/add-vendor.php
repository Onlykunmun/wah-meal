<?php require 'header.php' ?>



<?php




if(isset($_POST['add-vendor']))
		{

      //User Details
      $fullname = $_POST['fullname'];   
      $mobileno = $_POST['mobileno'];   
      $email = $_POST['email'];   
      $password = $_POST['password'];
      $password = md5($password);   
  
      //Location details
      $lat = $_POST['lat']; 
      $lng = $_POST['lng'];  

      //Business details
      $business_name = $_POST['businessname'];  
      $business_city =  $_POST['city']; 
      $business_pin =  $_POST['pin'];  
      $business_address =  $_POST['address'];
      $business_caption =  $_POST['caption'];  

      //Food Weekly Details
      //$food_day_type = array("tiffin", "lunch", "dinner");
      $food_day_type = array(1, 2, 3);
      $week_day = array(1, 2, 3, 4, 5, 6, 7);

$check_user = "SELECT * FROM `vendors` WHERE `email` = '$email' ";
$result_check = $conn->query($check_user);
      
if($result_check->num_rows == 0)
{
      //logo Details
      $config["image_allowed"] = array("jpeg", "jpg", "png", "gif");
      if($_FILES["profile-pic"]["name"]!=""){
        $ext = pathinfo($_FILES["profile-pic"]["name"],PATHINFO_EXTENSION);
        $uploadfile1 =  sha1(time()).".".$ext;
        $uploadfile =  "../vendor_app/uploads/logo/". $uploadfile1;
        $uploadtemp =  $_FILES["profile-pic"]["tmp_name"];
        $mimetype = getimagesize($uploadtemp);
        
          if (in_array(strtolower($ext),$config["image_allowed"])){
            if(preg_match("/image/",$mimetype["mime"])){
              move_uploaded_file($uploadtemp,dirname(__FILE__)."/" .$uploadfile);
              $data_image =  $uploadfile1;
            }
          }
        }

      
     

     
      $sql = "INSERT INTO `vendors` SET `fullname`= '$fullname', `email` = '$email', `phone` = '$mobileno', 
      `password` = '$password', `lat` = '$lat', `lng` = '$lng', `logo` = '$data_image', 
      `business_name` = '$business_name', `business_city` = '$business_city', `business_pin` = '$business_pin',
      `business_address` = '$business_address', `business_caption` = '$business_caption', 
      `created_by` = 'ADMIN', `is_active` = '1', `active_otp` = '1234' ";

      if ($conn->query($sql) === TRUE) {

        /*
        $vendor_id = $conn->insert_id;
        foreach($food_day_type as $fdt)
        {
          foreach($week_day as $wd)
          {
            $sql = "INSERT INTO `vendor_schedule` SET `vendor_id` = '$vendor_id',`week_day` = '$wd',`food_day_type` = '$fdt'";
            $conn->query($sql);
          }
        }
        */
        
        $statusMsg = 'Vendor added successfully'; 
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
          $statusMsg = 'User Already Exist'; 
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
         



            <div class="col-md-12">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">add_business</i>
                  </div>
                  <h4 class="card-title">Business Details <span style="color:red;">* All are required fields</span></h4>
                </div>
                <div class="card-body ">
                
                    <div class="form-group">
                      <label for="">Business Name <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" name="businessname" value="" required>
                    </div>
                    <div class="">
                    <label for="">Business Location - City <span style="color:red;">*</span></label>
                    
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
                       <option value='Andaman Island'> Andaman Island </option> 
<option value='Anderson Island'> Anderson Island </option> 
<option value='Arainj-Laka-Punga'> Arainj-Laka-Punga </option> 
<option value='Austinabad'> Austinabad </option> 
<option value='Bamboo Flat'> Bamboo Flat </option> 
<option value='Barren Island'> Barren Island </option> 
<option value='Beadonabad'> Beadonabad </option> 
<option value='Betapur'> Betapur </option> 
<option value='Bindraban'> Bindraban </option> 
<option value='Bonington'> Bonington </option> 
<option value='Brookesabad'> Brookesabad </option> 
<option value='Cadell Point'> Cadell Point </option> 
<option value='Calicut'> Calicut </option> 
<option value='Chetamale'> Chetamale </option> 
<option value='Cinque Islands'> Cinque Islands </option> 
<option value='Defence Island'> Defence Island </option> 
<option value='Digilpur'> Digilpur </option> 
<option value='Dolyganj'> Dolyganj </option> 
<option value='Flat Island'> Flat Island </option> 
<option value='Geinyale'> Geinyale </option> 
<option value='Great Coco Island'> Great Coco Island </option> 
<option value='Haddo'> Haddo </option> 
<option value='Havelock Island'> Havelock Island </option> 
<option value='Henry Lawrence Island'> Henry Lawrence Island </option> 
<option value='Herbertabad'> Herbertabad </option> 
<option value='Hobdaypur'> Hobdaypur </option> 
<option value='Ilichar'> Ilichar </option> 
<option value='Ingoie'> Ingoie </option> 
<option value='Inteview Island'> Inteview Island </option> 
<option value='Jangli Ghat'> Jangli Ghat </option> 
<option value='Jhon Lawrence Island'> Jhon Lawrence Island </option> 
<option value='Karen'> Karen </option> 
<option value='Kartara'> Kartara </option> 
<option value='KYD Islannd'> KYD Islannd </option> 
<option value='Landfall Island'> Landfall Island </option> 
<option value='Little Andmand'> Little Andmand </option> 
<option value='Little Coco Island'> Little Coco Island </option> 
<option value='Long Island'> Long Island </option> 
<option value='Maimyo'> Maimyo </option> 
<option value='Malappuram'> Malappuram </option> 
<option value='Manglutan'> Manglutan </option> 
<option value='Manpur'> Manpur </option> 
<option value='Mitha Khari'> Mitha Khari </option> 
<option value='Neill Island'> Neill Island </option> 
<option value='Nicobar Island'> Nicobar Island </option> 
<option value='North Brother Island'> North Brother Island </option> 
<option value='North Passage Island'> North Passage Island </option> 
<option value='North Sentinel Island'> North Sentinel Island </option> 
<option value='Nothen Reef Island'> Nothen Reef Island </option> 
<option value='Outram Island'> Outram Island </option> 
<option value='Pahlagaon'> Pahlagaon </option> 
<option value='Palalankwe'> Palalankwe </option> 
<option value='Passage Island'> Passage Island </option> 
<option value='Phaiapong'> Phaiapong </option> 
<option value='Phoenix Island'> Phoenix Island </option> 
<option value='Port Blair'> Port Blair </option> 
<option value='Preparis Island'> Preparis Island </option> 
<option value='Protheroepur'> Protheroepur </option> 
<option value='Rangachang'> Rangachang </option> 
<option value='Rongat'> Rongat </option> 
<option value='Rutland Island'> Rutland Island </option> 
<option value='Sabari'> Sabari </option> 
<option value='Saddle Peak'> Saddle Peak </option> 
<option value='Shadipur'> Shadipur </option> 
<option value='Smith Island'> Smith Island </option> 
<option value='Sound Island'> Sound Island </option> 
<option value='South Sentinel Island'> South Sentinel Island </option> 
<option value='Spike Island'> Spike Island </option> 
<option value='Tarmugli Island'> Tarmugli Island </option> 
<option value='Taylerabad'> Taylerabad </option> 
<option value='Titaije'> Titaije </option> 
<option value='Toibalawe'> Toibalawe </option> 
<option value='Tusonabad'> Tusonabad </option> 
<option value='West Island'> West Island </option> 
<option value='Wimberleyganj'> Wimberleyganj </option> 
<option value='Yadita Achampet'> Yadita Achampet </option> 
<option value='Adilabad'> Adilabad </option> 
<option value='Adoni'> Adoni </option> 
<option value='Alampur'> Alampur </option> 
<option value='Allagadda'> Allagadda </option> 
<option value='Alur'> Alur </option> 
<option value='Amalapuram'> Amalapuram </option> 
<option value='Amangallu'> Amangallu </option> 
<option value='Anakapalle'> Anakapalle </option> 
<option value='Anantapur'> Anantapur </option> 
<option value='Andole'> Andole </option> 
<option value='Araku'> Araku </option> 
<option value='Armoor'> Armoor </option> 
<option value='Asifabad'> Asifabad </option> 
<option value='Aswaraopet'> Aswaraopet </option> 
<option value='Atmakur'> Atmakur </option> 
<option value='B. Kothakota'> B. Kothakota </option> 
<option value='Badvel'> Badvel </option> 
<option value='Banaganapalle'> Banaganapalle </option> 
<option value='Bandar'> Bandar </option> 
<option value='Bangarupalem'> Bangarupalem </option> 
<option value='Banswada'> Banswada </option> 
<option value='Bapatla'> Bapatla </option> 
<option value='Bellampalli'> Bellampalli </option> 
<option value='Bhadrachalam'> Bhadrachalam </option> 
<option value='Bhainsa'> Bhainsa </option> 
<option value='Bheemunipatnam'> Bheemunipatnam </option> 
<option value='Bhimadole'> Bhimadole </option> 
<option value='Bhimavaram'> Bhimavaram </option> 
<option value='Bhongir'> Bhongir </option> 
<option value='Bhooragamphad'> Bhooragamphad </option> 
<option value='Boath'> Boath </option> 
<option value='Bobbili'> Bobbili </option> 
<option value='Bodhan'> Bodhan </option> 
<option value='Chandoor'> Chandoor </option> 
<option value='Chavitidibbalu'> Chavitidibbalu </option> 
<option value='Chejerla'> Chejerla </option> 
<option value='Chepurupalli'> Chepurupalli </option> 
<option value='Cherial'> Cherial </option> 
<option value='Chevella'> Chevella </option> 
<option value='Chinnor'> Chinnor </option> 
<option value='Chintalapudi'> Chintalapudi </option> 
<option value='Chintapalle'> Chintapalle </option> 
<option value='Chirala'> Chirala </option> 
<option value='Chittoor'> Chittoor </option> 
<option value='Chodavaram'> Chodavaram </option> 
<option value='Cuddapah'> Cuddapah </option> 
<option value='Cumbum'> Cumbum </option> 
<option value='Darsi'> Darsi </option> 
<option value='Devarakonda'> Devarakonda </option> 
<option value='Dharmavaram'> Dharmavaram </option> 
<option value='Dichpalli'> Dichpalli </option> 
<option value='Divi'> Divi </option> 
<option value='Donakonda'> Donakonda </option> 
<option value='Dronachalam'> Dronachalam </option> 
<option value='East Godavari'> East Godavari </option> 
<option value='Eluru'> Eluru </option> 
<option value='Eturnagaram'> Eturnagaram </option> 
<option value='Gadwal'> Gadwal </option> 
<option value='Gajapathinagaram'> Gajapathinagaram </option> 
<option value='Gajwel'> Gajwel </option> 
<option value='Garladinne'> Garladinne </option> 
<option value='Giddalur'> Giddalur </option> 
<option value='Godavari'> Godavari </option> 
<option value='Gooty'> Gooty </option> 
<option value='Gudivada'> Gudivada </option> 
<option value='Gudur'> Gudur </option> 
<option value='Guntur'> Guntur </option> 
<option value='Hindupur'> Hindupur </option> 
<option value='Hunsabad'> Hunsabad </option> 
<option value='Huzurabad'> Huzurabad </option> 
<option value='Huzurnagar'> Huzurnagar </option> 
<option value='Hyderabad'> Hyderabad </option> 
<option value='Ibrahimpatnam'> Ibrahimpatnam </option> 
<option value='Jaggayyapet'> Jaggayyapet </option> 
<option value='Jagtial'> Jagtial </option> 
<option value='Jammalamadugu'> Jammalamadugu </option> 
<option value='Jangaon'> Jangaon </option> 
<option value='Jangareddygudem'> Jangareddygudem </option> 
<option value='Jannaram'> Jannaram </option> 
<option value='Kadiri'> Kadiri </option> 
<option value='Kaikaluru'> Kaikaluru </option> 
<option value='Kakinada'> Kakinada </option> 
<option value='Kalwakurthy'> Kalwakurthy </option> 
<option value='Kalyandurg'> Kalyandurg </option> 
<option value='Kamalapuram'> Kamalapuram </option> 
<option value='Kamareddy'> Kamareddy </option> 
<option value='Kambadur'> Kambadur </option> 
<option value='Kanaganapalle'> Kanaganapalle </option> 
<option value='Kandukuru'> Kandukuru </option> 
<option value='Kanigiri'> Kanigiri </option> 
<option value='Karimnagar'> Karimnagar </option> 
<option value='Kavali'> Kavali </option> 
<option value='Khammam'> Khammam </option> 
<option value='Khanapur (AP)'> Khanapur (AP) </option> 
<option value='Kodangal'> Kodangal </option> 
<option value='Koduru'> Koduru </option> 
<option value='Koilkuntla'> Koilkuntla </option> 
<option value='Kollapur'> Kollapur </option> 
<option value='Kothagudem'> Kothagudem </option> 
<option value='Kovvur'> Kovvur </option> 
<option value='Krishna'> Krishna </option> 
<option value='Krosuru'> Krosuru </option> 
<option value='Kuppam'> Kuppam </option> 
<option value='Kurnool'> Kurnool </option> 
<option value='Lakkireddipalli'> Lakkireddipalli </option> 
<option value='Madakasira'> Madakasira </option> 
<option value='Madanapalli'> Madanapalli </option> 
<option value='Madhira'> Madhira </option> 
<option value='Madnur'> Madnur </option> 
<option value='Mahabubabad'> Mahabubabad </option> 
<option value='Mahabubnagar'> Mahabubnagar </option> 
<option value='Mahadevapur'> Mahadevapur </option> 
<option value='Makthal'> Makthal </option> 
<option value='Mancherial'> Mancherial </option> 
<option value='Mandapeta'> Mandapeta </option> 
<option value='Mangalagiri'> Mangalagiri </option> 
<option value='Manthani'> Manthani </option> 
<option value='Markapur'> Markapur </option> 
<option value='Marturu'> Marturu </option> 
<option value='Medachal'> Medachal </option> 
<option value='Medak'> Medak </option> 
<option value='Medarmetla'> Medarmetla </option> 
<option value='Metpalli'> Metpalli </option> 
<option value='Mriyalguda'> Mriyalguda </option> 
<option value='Mulug'> Mulug </option> 
<option value='Mylavaram'> Mylavaram </option> 
<option value='Nagarkurnool'> Nagarkurnool </option> 
<option value='Nalgonda'> Nalgonda </option> 
<option value='Nallacheruvu'> Nallacheruvu </option> 
<option value='Nampalle'> Nampalle </option> 
<option value='Nandigama'> Nandigama </option> 
<option value='Nandikotkur'> Nandikotkur </option> 
<option value='Nandyal'> Nandyal </option> 
<option value='Narasampet'> Narasampet </option> 
<option value='Narasaraopet'> Narasaraopet </option> 
<option value='Narayanakhed'> Narayanakhed </option> 
<option value='Narayanpet'> Narayanpet </option> 
<option value='Narsapur'> Narsapur </option> 
<option value='Narsipatnam'> Narsipatnam </option> 
<option value='Nazvidu'> Nazvidu </option> 
<option value='Nelloe'> Nelloe </option> 
<option value='Nellore'> Nellore </option> 
<option value='Nidamanur'> Nidamanur </option> 
<option value='Nirmal'> Nirmal </option> 
<option value='Nizamabad'> Nizamabad </option> 
<option value='Nuguru'> Nuguru </option> 
<option value='Ongole'> Ongole </option> 
<option value='Outsarangapalle'> Outsarangapalle </option> 
<option value='Paderu'> Paderu </option> 
<option value='Pakala'> Pakala </option> 
<option value='Palakonda'> Palakonda </option> 
<option value='Paland'> Paland </option> 
<option value='Palmaneru'> Palmaneru </option> 
<option value='Pamuru'> Pamuru </option> 
<option value='Pargi'> Pargi </option> 
<option value='Parkal'> Parkal </option> 
<option value='Parvathipuram'> Parvathipuram </option> 
<option value='Pathapatnam'> Pathapatnam </option> 
<option value='Pattikonda'> Pattikonda </option> 
<option value='Peapalle'> Peapalle </option> 
<option value='Peddapalli'> Peddapalli </option> 
<option value='Peddapuram'> Peddapuram </option> 
<option value='Penukonda'> Penukonda </option> 
<option value='Piduguralla'> Piduguralla </option> 
<option value='Piler'> Piler </option> 
<option value='Pithapuram'> Pithapuram </option> 
<option value='Podili'> Podili </option> 
<option value='Polavaram'> Polavaram </option> 
<option value='Prakasam'> Prakasam </option> 
<option value='Proddatur'> Proddatur </option> 
<option value='Pulivendla'> Pulivendla </option> 
<option value='Punganur'> Punganur </option> 
<option value='Putturu'> Putturu </option> 
<option value='Rajahmundri'> Rajahmundri </option> 
<option value='Rajampeta'> Rajampeta </option> 
<option value='Ramachandrapuram'> Ramachandrapuram </option> 
<option value='Ramannapet'> Ramannapet </option> 
<option value='Rampachodavaram'> Rampachodavaram </option> 
<option value='Rangareddy'> Rangareddy </option> 
<option value='Rapur'> Rapur </option> 
<option value='Rayachoti'> Rayachoti </option> 
<option value='Rayadurg'> Rayadurg </option> 
<option value='Razole'> Razole </option> 
<option value='Repalle'> Repalle </option> 
<option value='Saluru'> Saluru </option> 
<option value='Sangareddy'> Sangareddy </option> 
<option value='Sathupalli'> Sathupalli </option> 
<option value='Sattenapalle'> Sattenapalle </option> 
<option value='Satyavedu'> Satyavedu </option> 
<option value='Shadnagar'> Shadnagar </option> 
<option value='Siddavattam'> Siddavattam </option> 
<option value='Siddipet'> Siddipet </option> 
<option value='Sileru'> Sileru </option> 
<option value='Sircilla'> Sircilla </option> 
<option value='Sirpur Kagaznagar'> Sirpur Kagaznagar </option> 
<option value='Sodam'> Sodam </option> 
<option value='Sompeta'> Sompeta </option> 
<option value='Srikakulam'> Srikakulam </option> 
<option value='Srikalahasthi'> Srikalahasthi </option> 
<option value='Srisailam'> Srisailam </option> 
<option value='Srungavarapukota'> Srungavarapukota </option> 
<option value='Sudhimalla'> Sudhimalla </option> 
<option value='Sullarpet'> Sullarpet </option> 
<option value='Tadepalligudem'> Tadepalligudem </option> 
<option value='Tadipatri'> Tadipatri </option> 
<option value='Tanduru'> Tanduru </option> 
<option value='Tanuku'> Tanuku </option> 
<option value='Tekkali'> Tekkali </option> 
<option value='Tenali'> Tenali </option> 
<option value='Thungaturthy'> Thungaturthy </option> 
<option value='Tirivuru'> Tirivuru </option> 
<option value='Tirupathi'> Tirupathi </option> 
<option value='Tuni'> Tuni </option> 
<option value='Udaygiri'> Udaygiri </option> 
<option value='Ulvapadu'> Ulvapadu </option> 
<option value='Uravakonda'> Uravakonda </option> 
<option value='Utnor'> Utnor </option> 
<option value='V.R. Puram'> V.R. Puram </option> 
<option value='Vaimpalli'> Vaimpalli </option> 
<option value='Vayalpad'> Vayalpad </option> 
<option value='Venkatgiri'> Venkatgiri </option> 
<option value='Venkatgirikota'> Venkatgirikota </option> 
<option value='Vijayawada'> Vijayawada </option> 
<option value='Vikrabad'> Vikrabad </option> 
<option value='Vinjamuru'> Vinjamuru </option> 
<option value='Vinukonda'> Vinukonda </option> 
<option value='Visakhapatnam'> Visakhapatnam </option> 
<option value='Vizayanagaram'> Vizayanagaram </option> 
<option value='Vizianagaram'> Vizianagaram </option> 
<option value='Vuyyuru'> Vuyyuru </option> 
<option value='Wanaparthy'> Wanaparthy </option> 
<option value='Warangal'> Warangal </option> 
<option value='Wardhannapet'> Wardhannapet </option> 
<option value='Yelamanchili'> Yelamanchili </option> 
<option value='Yelavaram'> Yelavaram </option> 
<option value='Yeleswaram'> Yeleswaram </option> 
<option value='Yellandu'> Yellandu </option> 
<option value='Yellanuru'> Yellanuru </option> 
<option value='Yellareddy'> Yellareddy </option> 
<option value='Yerragondapalem'> Yerragondapalem </option> 
<option value='Zahirabad Along'> Zahirabad Along </option> 
<option value='Anini'> Anini </option> 
<option value='Anjaw'> Anjaw </option> 
<option value='Bameng'> Bameng </option> 
<option value='Basar'> Basar </option> 
<option value='Changlang'> Changlang </option> 
<option value='Chowkhem'> Chowkhem </option> 
<option value='Daporizo'> Daporizo </option> 
<option value='Dibang Valley'> Dibang Valley </option> 
<option value='Dirang'> Dirang </option> 
<option value='Hayuliang'> Hayuliang </option> 
<option value='Huri'> Huri </option> 
<option value='Itanagar'> Itanagar </option> 
<option value='Jairampur'> Jairampur </option> 
<option value='Kalaktung'> Kalaktung </option> 
<option value='Kameng'> Kameng </option> 
<option value='Khonsa'> Khonsa </option> 
<option value='Kolaring'> Kolaring </option> 
<option value='Kurung Kumey'> Kurung Kumey </option> 
<option value='Lohit'> Lohit </option> 
<option value='Lower Dibang Valley'> Lower Dibang Valley </option> 
<option value='Lower Subansiri'> Lower Subansiri </option> 
<option value='Mariyang'> Mariyang </option> 
<option value='Mechuka'> Mechuka </option> 
<option value='Miao'> Miao </option> 
<option value='Nefra'> Nefra </option> 
<option value='Pakkekesang'> Pakkekesang </option> 
<option value='Pangin'> Pangin </option> 
<option value='Papum Pare'> Papum Pare </option> 
<option value='Passighat'> Passighat </option> 
<option value='Roing'> Roing </option> 
<option value='Sagalee'> Sagalee </option> 
<option value='Seppa'> Seppa </option> 
<option value='Siang'> Siang </option> 
<option value='Tali'> Tali </option> 
<option value='Taliha'> Taliha </option> 
<option value='Tawang'> Tawang </option> 
<option value='Tezu'> Tezu </option> 
<option value='Tirap'> Tirap </option> 
<option value='Tuting'> Tuting </option> 
<option value='Upper Siang'> Upper Siang </option> 
<option value='Upper Subansiri'> Upper Subansiri </option> 
<option value='Yiang Kiag Abhayapuri'> Yiang Kiag Abhayapuri </option> 
<option value='Baithalangshu'> Baithalangshu </option> 
<option value='Barama'> Barama </option> 
<option value='Barpeta Road'> Barpeta Road </option> 
<option value='Bihupuria'> Bihupuria </option> 
<option value='Bijni'> Bijni </option> 
<option value='Bilasipara'> Bilasipara </option> 
<option value='Bokajan'> Bokajan </option> 
<option value='Bokakhat'> Bokakhat </option> 
<option value='Boko'> Boko </option> 
<option value='Bongaigaon'> Bongaigaon </option> 
<option value='Cachar'> Cachar </option> 
<option value='Cachar Hills'> Cachar Hills </option> 
<option value='Darrang'> Darrang </option> 
<option value='Dhakuakhana'> Dhakuakhana </option> 
<option value='Dhemaji'> Dhemaji </option> 
<option value='Dhubri'> Dhubri </option> 
<option value='Dibrugarh'> Dibrugarh </option> 
<option value='Digboi'> Digboi </option> 
<option value='Diphu'> Diphu </option> 
<option value='Goalpara'> Goalpara </option> 
<option value='Gohpur'> Gohpur </option> 
<option value='Golaghat'> Golaghat </option> 
<option value='Guwahati'> Guwahati </option> 
<option value='Hailakandi'> Hailakandi </option> 
<option value='Hajo'> Hajo </option> 
<option value='Halflong'> Halflong </option> 
<option value='Hojai'> Hojai </option> 
<option value='Howraghat'> Howraghat </option> 
<option value='Jorhat'> Jorhat </option> 
<option value='Kamrup'> Kamrup </option> 
<option value='Karbi Anglong'> Karbi Anglong </option> 
<option value='Karimganj'> Karimganj </option> 
<option value='Kokarajhar'> Kokarajhar </option> 
<option value='Kokrajhar'> Kokrajhar </option> 
<option value='Lakhimpur'> Lakhimpur </option> 
<option value='Maibong'> Maibong </option> 
<option value='Majuli'> Majuli </option> 
<option value='Mangaldoi'> Mangaldoi </option> 
<option value='Mariani'> Mariani </option> 
<option value='Marigaon'> Marigaon </option> 
<option value='Moranhat'> Moranhat </option> 
<option value='Morigaon'> Morigaon </option> 
<option value='Nagaon'> Nagaon </option> 
<option value='Nalbari'> Nalbari </option> 
<option value='Rangapara'> Rangapara </option> 
<option value='Sadiya'> Sadiya </option> 
<option value='Sibsagar'> Sibsagar </option> 
<option value='Silchar'> Silchar </option> 
<option value='Sivasagar'> Sivasagar </option> 
<option value='Sonitpur'> Sonitpur </option> 
<option value='Tarabarihat'> Tarabarihat </option> 
<option value='Tezpur'> Tezpur </option> 
<option value='Tinsukia'> Tinsukia </option> 
<option value='Udalgiri'> Udalgiri </option> 
<option value='Udalguri'> Udalguri </option> 
<option value='UdarbondhBarpeta Adhaura'> UdarbondhBarpeta Adhaura </option> 
<option value='Amarpur'> Amarpur </option> 
<option value='Araria'> Araria </option> 
<option value='Areraj'> Areraj </option> 
<option value='Arrah'> Arrah </option> 
<option value='Arwal'> Arwal </option> 
<option value='Aurangabad'> Aurangabad </option> 
<option value='Bagaha'> Bagaha </option> 
<option value='Banka'> Banka </option> 
<option value='Banmankhi'> Banmankhi </option> 
<option value='Barachakia'> Barachakia </option> 
<option value='Barauni'> Barauni </option> 
<option value='Barh'> Barh </option> 
<option value='Barosi'> Barosi </option> 
<option value='Begusarai'> Begusarai </option> 
<option value='Benipatti'> Benipatti </option> 
<option value='Benipur'> Benipur </option> 
<option value='Bettiah'> Bettiah </option> 
<option value='Bhabhua'> Bhabhua </option> 
<option value='Bhagalpur'> Bhagalpur </option> 
<option value='Bhojpur'> Bhojpur </option> 
<option value='Bidupur'> Bidupur </option> 
<option value='Biharsharif'> Biharsharif </option> 
<option value='Bikram'> Bikram </option> 
<option value='Bikramganj'> Bikramganj </option> 
<option value='Birpur'> Birpur </option> 
<option value='Buxar'> Buxar </option> 
<option value='Chakai'> Chakai </option> 
<option value='Champaran'> Champaran </option> 
<option value='Chapara'> Chapara </option> 
<option value='Dalsinghsarai'> Dalsinghsarai </option> 
<option value='Danapur'> Danapur </option> 
<option value='Darbhanga'> Darbhanga </option> 
<option value='Daudnagar'> Daudnagar </option> 
<option value='Dhaka'> Dhaka </option> 
<option value='Dhamdaha'> Dhamdaha </option> 
<option value='Dumraon'> Dumraon </option> 
<option value='Ekma'> Ekma </option> 
<option value='Forbesganj'> Forbesganj </option> 
<option value='Gaya'> Gaya </option> 
<option value='Gogri'> Gogri </option> 
<option value='Gopalganj'> Gopalganj </option> 
<option value='H.Kharagpur'> H.Kharagpur </option> 
<option value='Hajipur'> Hajipur </option> 
<option value='Hathua'> Hathua </option> 
<option value='Hilsa'> Hilsa </option> 
<option value='Imamganj'> Imamganj </option> 
<option value='Jahanabad'> Jahanabad </option> 
<option value='Jainagar'> Jainagar </option> 
<option value='Jamshedpur'> Jamshedpur </option> 
<option value='Jamui'> Jamui </option> 
<option value='Jehanabad'> Jehanabad </option> 
<option value='Jhajha'> Jhajha </option> 
<option value='Jhanjharpur'> Jhanjharpur </option> 
<option value='Kahalgaon'> Kahalgaon </option> 
<option value='Kaimur (Bhabua)'> Kaimur (Bhabua) </option> 
<option value='Katihar'> Katihar </option> 
<option value='Katoria'> Katoria </option> 
<option value='Khagaria'> Khagaria </option> 
<option value='Kishanganj'> Kishanganj </option> 
<option value='Korha'> Korha </option> 
<option value='Lakhisarai'> Lakhisarai </option> 
<option value='Madhepura'> Madhepura </option> 
<option value='Madhubani'> Madhubani </option> 
<option value='Maharajganj'> Maharajganj </option> 
<option value='Mahua'> Mahua </option> 
<option value='Mairwa'> Mairwa </option> 
<option value='Mallehpur'> Mallehpur </option> 
<option value='Masrakh'> Masrakh </option> 
<option value='Mohania'> Mohania </option> 
<option value='Monghyr'> Monghyr </option> 
<option value='Motihari'> Motihari </option> 
<option value='Motipur'> Motipur </option> 
<option value='Munger'> Munger </option> 
<option value='Muzaffarpur'> Muzaffarpur </option> 
<option value='Nabinagar'> Nabinagar </option> 
<option value='Nalanda'> Nalanda </option> 
<option value='Narkatiaganj'> Narkatiaganj </option> 
<option value='Naugachia'> Naugachia </option> 
<option value='Nawada'> Nawada </option> 
<option value='Pakribarwan'> Pakribarwan </option> 
<option value='Pakridayal'> Pakridayal </option> 
<option value='Patna'> Patna </option> 
<option value='Phulparas'> Phulparas </option> 
<option value='Piro'> Piro </option> 
<option value='Pupri'> Pupri </option> 
<option value='Purena'> Purena </option> 
<option value='Purnia'> Purnia </option> 
<option value='Rafiganj'> Rafiganj </option> 
<option value='Rajauli'> Rajauli </option> 
<option value='Ramnagar'> Ramnagar </option> 
<option value='Raniganj'> Raniganj </option> 
<option value='Raxaul'> Raxaul </option> 
<option value='Rohtas'> Rohtas </option> 
<option value='Rosera'> Rosera </option> 
<option value='S.Bakhtiarpur'> S.Bakhtiarpur </option> 
<option value='Saharsa'> Saharsa </option> 
<option value='Samastipur'> Samastipur </option> 
<option value='Saran'> Saran </option> 
<option value='Sasaram'> Sasaram </option> 
<option value='Seikhpura'> Seikhpura </option> 
<option value='Sheikhpura'> Sheikhpura </option> 
<option value='Sheohar'> Sheohar </option> 
<option value='Sherghati'> Sherghati </option> 
<option value='Sidhawalia'> Sidhawalia </option> 
<option value='Singhwara'> Singhwara </option> 
<option value='Sitamarhi'> Sitamarhi </option> 
<option value='Siwan'> Siwan </option> 
<option value='Sonepur'> Sonepur </option> 
<option value='Supaul'> Supaul </option> 
<option value='Thakurganj'> Thakurganj </option> 
<option value='Triveniganj'> Triveniganj </option> 
<option value='Udakishanganj'> Udakishanganj </option> 
<option value='Vaishali'> Vaishali </option> 
<option value='Wazirganj Chandigarh'> Wazirganj Chandigarh </option> 
<option value='Mani Marja Ambikapur'> Mani Marja Ambikapur </option> 
<option value='Antagarh'> Antagarh </option> 
<option value='Arang'> Arang </option> 
<option value='Bacheli'> Bacheli </option> 
<option value='Bagbahera'> Bagbahera </option> 
<option value='Bagicha'> Bagicha </option> 
<option value='Baikunthpur'> Baikunthpur </option> 
<option value='Balod'> Balod </option> 
<option value='Balodabazar'> Balodabazar </option> 
<option value='Balrampur'> Balrampur </option> 
<option value='Barpalli'> Barpalli </option> 
<option value='Basana'> Basana </option> 
<option value='Bastanar'> Bastanar </option> 
<option value='Bastar'> Bastar </option> 
<option value='Bderajpur'> Bderajpur </option> 
<option value='Bemetara'> Bemetara </option> 
<option value='Berla'> Berla </option> 
<option value='Bhairongarh'> Bhairongarh </option> 
<option value='Bhanupratappur'> Bhanupratappur </option> 
<option value='Bharathpur'> Bharathpur </option> 
<option value='Bhatapara'> Bhatapara </option> 
<option value='Bhilai'> Bhilai </option> 
<option value='Bhilaigarh'> Bhilaigarh </option> 
<option value='Bhopalpatnam'> Bhopalpatnam </option> 
<option value='Bijapur'> Bijapur </option> 
<option value='Bilaspur'> Bilaspur </option> 
<option value='Bodla'> Bodla </option> 
<option value='Bokaband'> Bokaband </option> 
<option value='Chandipara'> Chandipara </option> 
<option value='Chhinagarh'> Chhinagarh </option> 
<option value='Chhuriakala'> Chhuriakala </option> 
<option value='Chingmut'> Chingmut </option> 
<option value='Chuikhadan'> Chuikhadan </option> 
<option value='Dabhara'> Dabhara </option> 
<option value='Dallirajhara'> Dallirajhara </option> 
<option value='Dantewada'> Dantewada </option> 
<option value='Deobhog'> Deobhog </option> 
<option value='Dhamda'> Dhamda </option> 
<option value='Dhamtari'> Dhamtari </option> 
<option value='Dharamjaigarh'> Dharamjaigarh </option> 
<option value='Dongargarh'> Dongargarh </option> 
<option value='Durg'> Durg </option> 
<option value='Durgakondal'> Durgakondal </option> 
<option value='Fingeshwar'> Fingeshwar </option> 
<option value='Gariaband'> Gariaband </option> 
<option value='Garpa'> Garpa </option> 
<option value='Gharghoda'> Gharghoda </option> 
<option value='Gogunda'> Gogunda </option> 
<option value='Ilamidi'> Ilamidi </option> 
<option value='Jagdalpur'> Jagdalpur </option> 
<option value='Janjgir'> Janjgir </option> 
<option value='Janjgir-Champa'> Janjgir-Champa </option> 
<option value='Jarwa'> Jarwa </option> 
<option value='Jashpur'> Jashpur </option> 
<option value='Jashpurnagar'> Jashpurnagar </option> 
<option value='Kabirdham-Kawardha'> Kabirdham-Kawardha </option> 
<option value='Kanker'> Kanker </option> 
<option value='Kasdol'> Kasdol </option> 
<option value='Kathdol'> Kathdol </option> 
<option value='Kathghora'> Kathghora </option> 
<option value='Kawardha'> Kawardha </option> 
<option value='Keskal'> Keskal </option> 
<option value='Khairgarh'> Khairgarh </option> 
<option value='Kondagaon'> Kondagaon </option> 
<option value='Konta'> Konta </option> 
<option value='Korba'> Korba </option> 
<option value='Korea'> Korea </option> 
<option value='Kota'> Kota </option> 
<option value='Koyelibeda'> Koyelibeda </option> 
<option value='Kuakunda'> Kuakunda </option> 
<option value='Kunkuri'> Kunkuri </option> 
<option value='Kurud'> Kurud </option> 
<option value='Lohadigundah'> Lohadigundah </option> 
<option value='Lormi'> Lormi </option> 
<option value='Luckwada'> Luckwada </option> 
<option value='Mahasamund'> Mahasamund </option> 
<option value='Makodi'> Makodi </option> 
<option value='Manendragarh'> Manendragarh </option> 
<option value='Manpur'> Manpur </option> 
<option value='Marwahi'> Marwahi </option> 
<option value='Mohla'> Mohla </option> 
<option value='Mungeli'> Mungeli </option> 
<option value='Nagri'> Nagri </option> 
<option value='Narainpur'> Narainpur </option> 
<option value='Narayanpur'> Narayanpur </option> 
<option value='Neora'> Neora </option> 
<option value='Netanar'> Netanar </option> 
<option value='Odgi'> Odgi </option> 
<option value='Padamkot'> Padamkot </option> 
<option value='Pakhanjur'> Pakhanjur </option> 
<option value='Pali'> Pali </option> 
<option value='Pandaria'> Pandaria </option> 
<option value='Pandishankar'> Pandishankar </option> 
<option value='Parasgaon'> Parasgaon </option> 
<option value='Pasan'> Pasan </option> 
<option value='Patan'> Patan </option> 
<option value='Pathalgaon'> Pathalgaon </option> 
<option value='Pendra'> Pendra </option> 
<option value='Pratappur'> Pratappur </option> 
<option value='Premnagar'> Premnagar </option> 
<option value='Raigarh'> Raigarh </option> 
<option value='Raipur'> Raipur </option> 
<option value='Rajnandgaon'> Rajnandgaon </option> 
<option value='Rajpur'> Rajpur </option> 
<option value='Ramchandrapur'> Ramchandrapur </option> 
<option value='Saraipali'> Saraipali </option> 
<option value='Saranggarh'> Saranggarh </option> 
<option value='Sarona'> Sarona </option> 
<option value='Semaria'> Semaria </option> 
<option value='Shakti'> Shakti </option> 
<option value='Sitapur'> Sitapur </option> 
<option value='Sukma'> Sukma </option> 
<option value='Surajpur'> Surajpur </option> 
<option value='Surguja'> Surguja </option> 
<option value='Tapkara'> Tapkara </option> 
<option value='Toynar'> Toynar </option> 
<option value='Udaipur'> Udaipur </option> 
<option value='Uproda'> Uproda </option> 
<option value='Wadrainagar Amal'> Wadrainagar Amal </option> 
<option value='Amli'> Amli </option> 
<option value='Bedpa'> Bedpa </option> 
<option value='Chikhli'> Chikhli </option> 
<option value='Dadra & Nagar Haveli'> Dadra & Nagar Haveli </option> 
<option value='Dahikhed'> Dahikhed </option> 
<option value='Dolara'> Dolara </option> 
<option value='Galonda'> Galonda </option> 
<option value='Kanadi'> Kanadi </option> 
<option value='Karchond'> Karchond </option> 
<option value='Khadoli'> Khadoli </option> 
<option value='Kharadpada'> Kharadpada </option> 
<option value='Kherabari'> Kherabari </option> 
<option value='Kherdi'> Kherdi </option> 
<option value='Kothar'> Kothar </option> 
<option value='Luari'> Luari </option> 
<option value='Mashat'> Mashat </option> 
<option value='Rakholi'> Rakholi </option> 
<option value='Rudana'> Rudana </option> 
<option value='Saili'> Saili </option> 
<option value='Sili'> Sili </option> 
<option value='Silvassa'> Silvassa </option> 
<option value='Sindavni'> Sindavni </option> 
<option value='Udva'> Udva </option> 
<option value='Umbarkoi'> Umbarkoi </option> 
<option value='Vansda'> Vansda </option> 
<option value='Vasona'> Vasona </option> 
<option value='Velugam Brancavare'> Velugam Brancavare </option> 
<option value='Dagasi'> Dagasi </option> 
<option value='Daman'> Daman </option> 
<option value='Diu'> Diu </option> 
<option value='Magarvara'> Magarvara </option> 
<option value='Nagwa'> Nagwa </option> 
<option value='Pariali'> Pariali </option> 
<option value='Passo Covo Central Delhi'> Passo Covo Central Delhi </option> 
<option value='East Delhi'> East Delhi </option> 
<option value='New Delhi'> New Delhi </option> 
<option value='North Delhi'> North Delhi </option> 
<option value='North East Delhi'> North East Delhi </option> 
<option value='North West Delhi'> North West Delhi </option> 
<option value='South Delhi'> South Delhi </option> 
<option value='South West Delhi'> South West Delhi </option> 
<option value='West Delhi Canacona'> West Delhi Canacona </option> 
<option value='Candolim'> Candolim </option> 
<option value='Chinchinim'> Chinchinim </option> 
<option value='Cortalim'> Cortalim </option> 
<option value='Goa'> Goa </option> 
<option value='Jua'> Jua </option> 
<option value='Madgaon'> Madgaon </option> 
<option value='Mahem'> Mahem </option> 
<option value='Mapuca'> Mapuca </option> 
<option value='Marmagao'> Marmagao </option> 
<option value='Panji'> Panji </option> 
<option value='Ponda'> Ponda </option> 
<option value='Sanvordem'> Sanvordem </option> 
<option value='Terekhol Ahmedabad'> Terekhol Ahmedabad </option> 
<option value='Ahwa'> Ahwa </option> 
<option value='Amod'> Amod </option> 
<option value='Amreli'> Amreli </option> 
<option value='Anand'> Anand </option> 
<option value='Anjar'> Anjar </option> 
<option value='Ankaleshwar'> Ankaleshwar </option> 
<option value='Babra'> Babra </option> 
<option value='Balasinor'> Balasinor </option> 
<option value='Banaskantha'> Banaskantha </option> 
<option value='Bansada'> Bansada </option> 
<option value='Bardoli'> Bardoli </option> 
<option value='Bareja'> Bareja </option> 
<option value='Baroda'> Baroda </option> 
<option value='Barwala'> Barwala </option> 
<option value='Bayad'> Bayad </option> 
<option value='Bhachav'> Bhachav </option> 
<option value='Bhanvad'> Bhanvad </option> 
<option value='Bharuch'> Bharuch </option> 
<option value='Bhavnagar'> Bhavnagar </option> 
<option value='Bhiloda'> Bhiloda </option> 
<option value='Bhuj'> Bhuj </option> 
<option value='Billimora'> Billimora </option> 
<option value='Borsad'> Borsad </option> 
<option value='Botad'> Botad </option> 
<option value='Chanasma'> Chanasma </option> 
<option value='Chhota Udaipur'> Chhota Udaipur </option> 
<option value='Chotila'> Chotila </option> 
<option value='Dabhoi'> Dabhoi </option> 
<option value='Dahod'> Dahod </option> 
<option value='Damnagar'> Damnagar </option> 
<option value='Dang'> Dang </option> 
<option value='Danta'> Danta </option> 
<option value='Dasada'> Dasada </option> 
<option value='Dediapada'> Dediapada </option> 
<option value='Deesa'> Deesa </option> 
<option value='Dehgam'> Dehgam </option> 
<option value='Deodar'> Deodar </option> 
<option value='Devgadhbaria'> Devgadhbaria </option> 
<option value='Dhandhuka'> Dhandhuka </option> 
<option value='Dhanera'> Dhanera </option> 
<option value='Dharampur'> Dharampur </option> 
<option value='Dhari'> Dhari </option> 
<option value='Dholka'> Dholka </option> 
<option value='Dhoraji'> Dhoraji </option> 
<option value='Dhrangadhra'> Dhrangadhra </option> 
<option value='Dhrol'> Dhrol </option> 
<option value='Dwarka'> Dwarka </option> 
<option value='Fortsongadh'> Fortsongadh </option> 
<option value='Gadhada'> Gadhada </option> 
<option value='Gandhi Nagar'> Gandhi Nagar </option> 
<option value='Gariadhar'> Gariadhar </option> 
<option value='Godhra'> Godhra </option> 
<option value='Gogodar'> Gogodar </option> 
<option value='Gondal'> Gondal </option> 
<option value='Halol'> Halol </option> 
<option value='Halvad'> Halvad </option> 
<option value='Harij'> Harij </option> 
<option value='Himatnagar'> Himatnagar </option> 
<option value='Idar'> Idar </option> 
<option value='Jambusar'> Jambusar </option> 
<option value='Jamjodhpur'> Jamjodhpur </option> 
<option value='Jamkalyanpur'> Jamkalyanpur </option> 
<option value='Jamnagar'> Jamnagar </option> 
<option value='Jasdan'> Jasdan </option> 
<option value='Jetpur'> Jetpur </option> 
<option value='Jhagadia'> Jhagadia </option> 
<option value='Jhalod'> Jhalod </option> 
<option value='Jodia'> Jodia </option> 
<option value='Junagadh'> Junagadh </option> 
<option value='Junagarh'> Junagarh </option> 
<option value='Kalawad'> Kalawad </option> 
<option value='Kalol'> Kalol </option> 
<option value='Kapad Wanj'> Kapad Wanj </option> 
<option value='Keshod'> Keshod </option> 
<option value='Khambat'> Khambat </option> 
<option value='Khambhalia'> Khambhalia </option> 
<option value='Khavda'> Khavda </option> 
<option value='Kheda'> Kheda </option> 
<option value='Khedbrahma'> Khedbrahma </option> 
<option value='Kheralu'> Kheralu </option> 
<option value='Kodinar'> Kodinar </option> 
<option value='Kotdasanghani'> Kotdasanghani </option> 
<option value='Kunkawav'> Kunkawav </option> 
<option value='Kutch'> Kutch </option> 
<option value='Kutchmandvi'> Kutchmandvi </option> 
<option value='Kutiyana'> Kutiyana </option> 
<option value='Lakhpat'> Lakhpat </option> 
<option value='Lakhtar'> Lakhtar </option> 
<option value='Lalpur'> Lalpur </option> 
<option value='Limbdi'> Limbdi </option> 
<option value='Limkheda'> Limkheda </option> 
<option value='Lunavada'> Lunavada </option> 
<option value='M.M.Mangrol'> M.M.Mangrol </option> 
<option value='Mahuva'> Mahuva </option> 
<option value='Malia-Hatina'> Malia-Hatina </option> 
<option value='Maliya'> Maliya </option> 
<option value='Malpur'> Malpur </option> 
<option value='Manavadar'> Manavadar </option> 
<option value='Mandvi'> Mandvi </option> 
<option value='Mangrol'> Mangrol </option> 
<option value='Mehmedabad'> Mehmedabad </option> 
<option value='Mehsana'> Mehsana </option> 
<option value='Miyagam'> Miyagam </option> 
<option value='Modasa'> Modasa </option> 
<option value='Morvi'> Morvi </option> 
<option value='Muli'> Muli </option> 
<option value='Mundra'> Mundra </option> 
<option value='Nadiad'> Nadiad </option> 
<option value='Nakhatrana'> Nakhatrana </option> 
<option value='Nalia'> Nalia </option> 
<option value='Narmada'> Narmada </option> 
<option value='Naswadi'> Naswadi </option> 
<option value='Navasari'> Navasari </option> 
<option value='Nizar'> Nizar </option> 
<option value='Okha'> Okha </option> 
<option value='Paddhari'> Paddhari </option> 
<option value='Padra'> Padra </option> 
<option value='Palanpur'> Palanpur </option> 
<option value='Palitana'> Palitana </option> 
<option value='Panchmahals'> Panchmahals </option> 
<option value='Patan'> Patan </option> 
<option value='Pavijetpur'> Pavijetpur </option> 
<option value='Porbandar'> Porbandar </option> 
<option value='Prantij'> Prantij </option> 
<option value='Radhanpur'> Radhanpur </option> 
<option value='Rahpar'> Rahpar </option> 
<option value='Rajaula'> Rajaula </option> 
<option value='Rajkot'> Rajkot </option> 
<option value='Rajpipla'> Rajpipla </option> 
<option value='Ranavav'> Ranavav </option> 
<option value='Sabarkantha'> Sabarkantha </option> 
<option value='Sanand'> Sanand </option> 
<option value='Sankheda'> Sankheda </option> 
<option value='Santalpur'> Santalpur </option> 
<option value='Santrampur'> Santrampur </option> 
<option value='Savarkundla'> Savarkundla </option> 
<option value='Savli'> Savli </option> 
<option value='Sayan'> Sayan </option> 
<option value='Sayla'> Sayla </option> 
<option value='Shehra'> Shehra </option> 
<option value='Sidhpur'> Sidhpur </option> 
<option value='Sihor'> Sihor </option> 
<option value='Sojitra'> Sojitra </option> 
<option value='Sumrasar'> Sumrasar </option> 
<option value='Surat'> Surat </option> 
<option value='Surendranagar'> Surendranagar </option> 
<option value='Talaja'> Talaja </option> 
<option value='Thara'> Thara </option> 
<option value='Tharad'> Tharad </option> 
<option value='Thasra'> Thasra </option> 
<option value='Una-Diu'> Una-Diu </option> 
<option value='Upleta'> Upleta </option> 
<option value='Vadgam'> Vadgam </option> 
<option value='Vadodara'> Vadodara </option> 
<option value='Valia'> Valia </option> 
<option value='Vallabhipur'> Vallabhipur </option> 
<option value='Valod'> Valod </option> 
<option value='Valsad'> Valsad </option> 
<option value='Vanthali'> Vanthali </option> 
<option value='Vapi'> Vapi </option> 
<option value='Vav'> Vav </option> 
<option value='Veraval'> Veraval </option> 
<option value='Vijapur'> Vijapur </option> 
<option value='Viramgam'> Viramgam </option> 
<option value='Visavadar'> Visavadar </option> 
<option value='Visnagar'> Visnagar </option> 
<option value='Vyara'> Vyara </option> 
<option value='Waghodia'> Waghodia </option> 
<option value='Wankaner Adampur Mandi'> Wankaner Adampur Mandi </option> 
<option value='Ambala'> Ambala </option> 
<option value='Assandh'> Assandh </option> 
<option value='Bahadurgarh'> Bahadurgarh </option> 
<option value='Barara'> Barara </option> 
<option value='Barwala'> Barwala </option> 
<option value='Bawal'> Bawal </option> 
<option value='Bawanikhera'> Bawanikhera </option> 
<option value='Bhiwani'> Bhiwani </option> 
<option value='Charkhidadri'> Charkhidadri </option> 
<option value='Cheeka'> Cheeka </option> 
<option value='Chhachrauli'> Chhachrauli </option> 
<option value='Dabwali'> Dabwali </option> 
<option value='Ellenabad'> Ellenabad </option> 
<option value='Faridabad'> Faridabad </option> 
<option value='Fatehabad'> Fatehabad </option> 
<option value='Ferojpur Jhirka'> Ferojpur Jhirka </option> 
<option value='Gharaunda'> Gharaunda </option> 
<option value='Gohana'> Gohana </option> 
<option value='Gurgaon'> Gurgaon </option> 
<option value='Hansi'> Hansi </option> 
<option value='Hisar'> Hisar </option> 
<option value='Jagadhari'> Jagadhari </option> 
<option value='Jatusana'> Jatusana </option> 
<option value='Jhajjar'> Jhajjar </option> 
<option value='Jind'> Jind </option> 
<option value='Julana'> Julana </option> 
<option value='Kaithal'> Kaithal </option> 
<option value='Kalanaur'> Kalanaur </option> 
<option value='Kalanwali'> Kalanwali </option> 
<option value='Kalka'> Kalka </option> 
<option value='Karnal'> Karnal </option> 
<option value='Kosli'> Kosli </option> 
<option value='Kurukshetra'> Kurukshetra </option> 
<option value='Loharu'> Loharu </option> 
<option value='Mahendragarh'> Mahendragarh </option> 
<option value='Meham'> Meham </option> 
<option value='Mewat'> Mewat </option> 
<option value='Mohindergarh'> Mohindergarh </option> 
<option value='Naraingarh'> Naraingarh </option> 
<option value='Narnaul'> Narnaul </option> 
<option value='Narwana'> Narwana </option> 
<option value='Nilokheri'> Nilokheri </option> 
<option value='Nuh'> Nuh </option> 
<option value='Palwal'> Palwal </option> 
<option value='Panchkula'> Panchkula </option> 
<option value='Panipat'> Panipat </option> 
<option value='Pehowa'> Pehowa </option> 
<option value='Ratia'> Ratia </option> 
<option value='Rewari'> Rewari </option> 
<option value='Rohtak'> Rohtak </option> 
<option value='Safidon'> Safidon </option> 
<option value='Sirsa'> Sirsa </option> 
<option value='Siwani'> Siwani </option> 
<option value='Sonipat'> Sonipat </option> 
<option value='Tohana'> Tohana </option> 
<option value='Tohsam'> Tohsam </option> 
<option value='Yamunanagar Amb'> Yamunanagar Amb </option> 
<option value='Arki'> Arki </option> 
<option value='Banjar'> Banjar </option> 
<option value='Bharmour'> Bharmour </option> 
<option value='Bilaspur'> Bilaspur </option> 
<option value='Chamba'> Chamba </option> 
<option value='Churah'> Churah </option> 
<option value='Dalhousie'> Dalhousie </option> 
<option value='Dehra Gopipur'> Dehra Gopipur </option> 
<option value='Hamirpur'> Hamirpur </option> 
<option value='Jogindernagar'> Jogindernagar </option> 
<option value='Kalpa'> Kalpa </option> 
<option value='Kangra'> Kangra </option> 
<option value='Kinnaur'> Kinnaur </option> 
<option value='Kullu'> Kullu </option> 
<option value='Lahaul'> Lahaul </option> 
<option value='Mandi'> Mandi </option> 
<option value='Nahan'> Nahan </option> 
<option value='Nalagarh'> Nalagarh </option> 
<option value='Nirmand'> Nirmand </option> 
<option value='Nurpur'> Nurpur </option> 
<option value='Palampur'> Palampur </option> 
<option value='Pangi'> Pangi </option> 
<option value='Paonta'> Paonta </option> 
<option value='Pooh'> Pooh </option> 
<option value='Rajgarh'> Rajgarh </option> 
<option value='Rampur Bushahar'> Rampur Bushahar </option> 
<option value='Rohru'> Rohru </option> 
<option value='Shimla'> Shimla </option> 
<option value='Sirmaur'> Sirmaur </option> 
<option value='Solan'> Solan </option> 
<option value='Spiti'> Spiti </option> 
<option value='Sundernagar'> Sundernagar </option> 
<option value='Theog'> Theog </option> 
<option value='Udaipur'> Udaipur </option> 
<option value='Una Akhnoor'> Una Akhnoor </option> 
<option value='Anantnag'> Anantnag </option> 
<option value='Badgam'> Badgam </option> 
<option value='Bandipur'> Bandipur </option> 
<option value='Baramulla'> Baramulla </option> 
<option value='Basholi'> Basholi </option> 
<option value='Bedarwah'> Bedarwah </option> 
<option value='Budgam'> Budgam </option> 
<option value='Doda'> Doda </option> 
<option value='Gulmarg'> Gulmarg </option> 
<option value='Jammu'> Jammu </option> 
<option value='Kalakot'> Kalakot </option> 
<option value='Kargil'> Kargil </option> 
<option value='Karnah'> Karnah </option> 
<option value='Kathua'> Kathua </option> 
<option value='Kishtwar'> Kishtwar </option> 
<option value='Kulgam'> Kulgam </option> 
<option value='Kupwara'> Kupwara </option> 
<option value='Leh'> Leh </option> 
<option value='Mahore'> Mahore </option> 
<option value='Nagrota'> Nagrota </option> 
<option value='Nobra'> Nobra </option> 
<option value='Nowshera'> Nowshera </option> 
<option value='Nyoma'> Nyoma </option> 
<option value='Padam'> Padam </option> 
<option value='Pahalgam'> Pahalgam </option> 
<option value='Patnitop'> Patnitop </option> 
<option value='Poonch'> Poonch </option> 
<option value='Pulwama'> Pulwama </option> 
<option value='Rajouri'> Rajouri </option> 
<option value='Ramban'> Ramban </option> 
<option value='Ramnagar'> Ramnagar </option> 
<option value='Reasi'> Reasi </option> 
<option value='Samba'> Samba </option> 
<option value='Srinagar'> Srinagar </option> 
<option value='Udhampur'> Udhampur </option> 
<option value='Vaishno Devi Bagodar'> Vaishno Devi Bagodar </option> 
<option value='Baharagora'> Baharagora </option> 
<option value='Balumath'> Balumath </option> 
<option value='Barhi'> Barhi </option> 
<option value='Barkagaon'> Barkagaon </option> 
<option value='Barwadih'> Barwadih </option> 
<option value='Basia'> Basia </option> 
<option value='Bermo'> Bermo </option> 
<option value='Bhandaria'> Bhandaria </option> 
<option value='Bhawanathpur'> Bhawanathpur </option> 
<option value='Bishrampur'> Bishrampur </option> 
<option value='Bokaro'> Bokaro </option> 
<option value='Bolwa'> Bolwa </option> 
<option value='Bundu'> Bundu </option> 
<option value='Chaibasa'> Chaibasa </option> 
<option value='Chainpur'> Chainpur </option> 
<option value='Chakardharpur'> Chakardharpur </option> 
<option value='Chandil'> Chandil </option> 
<option value='Chatra'> Chatra </option> 
<option value='Chavparan'> Chavparan </option> 
<option value='Daltonganj'> Daltonganj </option> 
<option value='Deoghar'> Deoghar </option> 
<option value='Dhanbad'> Dhanbad </option> 
<option value='Dumka'> Dumka </option> 
<option value='Dumri'> Dumri </option> 
<option value='Garhwa'> Garhwa </option> 
<option value='Garu'> Garu </option> 
<option value='Ghaghra'> Ghaghra </option> 
<option value='Ghatsila'> Ghatsila </option> 
<option value='Giridih'> Giridih </option> 
<option value='Godda'> Godda </option> 
<option value='Gomia'> Gomia </option> 
<option value='Govindpur'> Govindpur </option> 
<option value='Gumla'> Gumla </option> 
<option value='Hazaribagh'> Hazaribagh </option> 
<option value='Hunterganj'> Hunterganj </option> 
<option value='Ichak'> Ichak </option> 
<option value='Itki'> Itki </option> 
<option value='Jagarnathpur'> Jagarnathpur </option> 
<option value='Jamshedpur'> Jamshedpur </option> 
<option value='Jamtara'> Jamtara </option> 
<option value='Japla'> Japla </option> 
<option value='Jharmundi'> Jharmundi </option> 
<option value='Jhinkpani'> Jhinkpani </option> 
<option value='Jhumaritalaiya'> Jhumaritalaiya </option> 
<option value='Kathikund'> Kathikund </option> 
<option value='Kharsawa'> Kharsawa </option> 
<option value='Khunti'> Khunti </option> 
<option value='Koderma'> Koderma </option> 
<option value='Kolebira'> Kolebira </option> 
<option value='Latehar'> Latehar </option> 
<option value='Lohardaga'> Lohardaga </option> 
<option value='Madhupur'> Madhupur </option> 
<option value='Mahagama'> Mahagama </option> 
<option value='Maheshpur Raj'> Maheshpur Raj </option> 
<option value='Mandar'> Mandar </option> 
<option value='Mandu'> Mandu </option> 
<option value='Manoharpur'> Manoharpur </option> 
<option value='Muri'> Muri </option> 
<option value='Nagarutatri'> Nagarutatri </option> 
<option value='Nala'> Nala </option> 
<option value='Noamundi'> Noamundi </option> 
<option value='Pakur'> Pakur </option> 
<option value='Palamu'> Palamu </option> 
<option value='Palkot'> Palkot </option> 
<option value='Patan'> Patan </option> 
<option value='Rajdhanwar'> Rajdhanwar </option> 
<option value='Rajmahal'> Rajmahal </option> 
<option value='Ramgarh'> Ramgarh </option> 
<option value='Ranchi'> Ranchi </option> 
<option value='Sahibganj'> Sahibganj </option> 
<option value='Saraikela'> Saraikela </option> 
<option value='Simaria'> Simaria </option> 
<option value='Simdega'> Simdega </option> 
<option value='Singhbhum'> Singhbhum </option> 
<option value='Tisri'> Tisri </option> 
<option value='Torpa Afzalpur'> Torpa Afzalpur </option> 
<option value='Ainapur'> Ainapur </option> 
<option value='Aland'> Aland </option> 
<option value='Alur'> Alur </option> 
<option value='Anekal'> Anekal </option> 
<option value='Ankola'> Ankola </option> 
<option value='Arsikere'> Arsikere </option> 
<option value='Athani'> Athani </option> 
<option value='Aurad'> Aurad </option> 
<option value='Bableshwar'> Bableshwar </option> 
<option value='Badami'> Badami </option> 
<option value='Bagalkot'> Bagalkot </option> 
<option value='Bagepalli'> Bagepalli </option> 
<option value='Bailhongal'> Bailhongal </option> 
<option value='Bangalore'> Bangalore </option> 
<option value='Bangalore Rural'> Bangalore Rural </option> 
<option value='Bangarpet'> Bangarpet </option> 
<option value='Bantwal'> Bantwal </option> 
<option value='Basavakalyan'> Basavakalyan </option> 
<option value='Basavanabagewadi'> Basavanabagewadi </option> 
<option value='Basavapatna'> Basavapatna </option> 
<option value='Belgaum'> Belgaum </option> 
<option value='Bellary'> Bellary </option> 
<option value='Belthangady'> Belthangady </option> 
<option value='Belur'> Belur </option> 
<option value='Bhadravati'> Bhadravati </option> 
<option value='Bhalki'> Bhalki </option> 
<option value='Bhatkal'> Bhatkal </option> 
<option value='Bidar'> Bidar </option> 
<option value='Bijapur'> Bijapur </option> 
<option value='Biligi'> Biligi </option> 
<option value='Chadchan'> Chadchan </option> 
<option value='Challakere'> Challakere </option> 
<option value='Chamrajnagar'> Chamrajnagar </option> 
<option value='Channagiri'> Channagiri </option> 
<option value='Channapatna'> Channapatna </option> 
<option value='Channarayapatna'> Channarayapatna </option> 
<option value='Chickmagalur'> Chickmagalur </option> 
<option value='Chikballapur'> Chikballapur </option> 
<option value='Chikkaballapur'> Chikkaballapur </option> 
<option value='Chikkanayakanahalli'> Chikkanayakanahalli </option> 
<option value='Chikkodi'> Chikkodi </option> 
<option value='Chikmagalur'> Chikmagalur </option> 
<option value='Chincholi'> Chincholi </option> 
<option value='Chintamani'> Chintamani </option> 
<option value='Chitradurga'> Chitradurga </option> 
<option value='Chittapur'> Chittapur </option> 
<option value='Cowdahalli'> Cowdahalli </option> 
<option value='Davanagere'> Davanagere </option> 
<option value='Deodurga'> Deodurga </option> 
<option value='Devangere'> Devangere </option> 
<option value='Devarahippargi'> Devarahippargi </option> 
<option value='Dharwad'> Dharwad </option> 
<option value='Doddaballapur'> Doddaballapur </option> 
<option value='Gadag'> Gadag </option> 
<option value='Gangavathi'> Gangavathi </option> 
<option value='Gokak'> Gokak </option> 
<option value='Gowribdanpur'> Gowribdanpur </option> 
<option value='Gubbi'> Gubbi </option> 
<option value='Gulbarga'> Gulbarga </option> 
<option value='Gundlupet'> Gundlupet </option> 
<option value='H.B.Halli'> H.B.Halli </option> 
<option value='H.D. Kote'> H.D. Kote </option> 
<option value='Haliyal'> Haliyal </option> 
<option value='Hampi'> Hampi </option> 
<option value='Hangal'> Hangal </option> 
<option value='Harapanahalli'> Harapanahalli </option> 
<option value='Hassan'> Hassan </option> 
<option value='Haveri'> Haveri </option> 
<option value='Hebri'> Hebri </option> 
<option value='Hirekerur'> Hirekerur </option> 
<option value='Hiriyur'> Hiriyur </option> 
<option value='Holalkere'> Holalkere </option> 
<option value='Holenarsipur'> Holenarsipur </option> 
<option value='Honnali'> Honnali </option> 
<option value='Honnavar'> Honnavar </option> 
<option value='Hosadurga'> Hosadurga </option> 
<option value='Hosakote'> Hosakote </option> 
<option value='Hosanagara'> Hosanagara </option> 
<option value='Hospet'> Hospet </option> 
<option value='Hubli'> Hubli </option> 
<option value='Hukkeri'> Hukkeri </option> 
<option value='Humnabad'> Humnabad </option> 
<option value='Hungund'> Hungund </option> 
<option value='Hunsagi'> Hunsagi </option> 
<option value='Hunsur'> Hunsur </option> 
<option value='Huvinahadagali'> Huvinahadagali </option> 
<option value='Indi'> Indi </option> 
<option value='Jagalur'> Jagalur </option> 
<option value='Jamkhandi'> Jamkhandi </option> 
<option value='Jewargi'> Jewargi </option> 
<option value='Joida'> Joida </option> 
<option value='K.R. Nagar'> K.R. Nagar </option> 
<option value='Kadur'> Kadur </option> 
<option value='Kalghatagi'> Kalghatagi </option> 
<option value='Kamalapur'> Kamalapur </option> 
<option value='Kanakapura'> Kanakapura </option> 
<option value='Kannada'> Kannada </option> 
<option value='Kargal'> Kargal </option> 
<option value='Karkala'> Karkala </option> 
<option value='Karwar'> Karwar </option> 
<option value='Khanapur'> Khanapur </option> 
<option value='Kodagu'> Kodagu </option> 
<option value='Kolar'> Kolar </option> 
<option value='Kollegal'> Kollegal </option> 
<option value='Koppa'> Koppa </option> 
<option value='Koppal'> Koppal </option> 
<option value='Koratageri'> Koratageri </option> 
<option value='Krishnarajapet'> Krishnarajapet </option> 
<option value='Kudligi'> Kudligi </option> 
<option value='Kumta'> Kumta </option> 
<option value='Kundapur'> Kundapur </option> 
<option value='Kundgol'> Kundgol </option> 
<option value='Kunigal'> Kunigal </option> 
<option value='Kurugodu'> Kurugodu </option> 
<option value='Kustagi'> Kustagi </option> 
<option value='Lingsugur'> Lingsugur </option> 
<option value='Madikeri'> Madikeri </option> 
<option value='Madugiri'> Madugiri </option> 
<option value='Malavalli'> Malavalli </option> 
<option value='Malur'> Malur </option> 
<option value='Mandya'> Mandya </option> 
<option value='Mangalore'> Mangalore </option> 
<option value='Manipal'> Manipal </option> 
<option value='Manvi'> Manvi </option> 
<option value='Mashal'> Mashal </option> 
<option value='Molkalmuru'> Molkalmuru </option> 
<option value='Mudalgi'> Mudalgi </option> 
<option value='Muddebihal'> Muddebihal </option> 
<option value='Mudhol'> Mudhol </option> 
<option value='Mudigere'> Mudigere </option> 
<option value='Mulbagal'> Mulbagal </option> 
<option value='Mundagod'> Mundagod </option> 
<option value='Mundargi'> Mundargi </option> 
<option value='Murugod'> Murugod </option> 
<option value='Mysore'> Mysore </option> 
<option value='Nagamangala'> Nagamangala </option> 
<option value='Nanjangud'> Nanjangud </option> 
<option value='Nargund'> Nargund </option> 
<option value='Narsimrajapur'> Narsimrajapur </option> 
<option value='Navalgund'> Navalgund </option> 
<option value='Nelamangala'> Nelamangala </option> 
<option value='Nimburga'> Nimburga </option> 
<option value='Pandavapura'> Pandavapura </option> 
<option value='Pavagada'> Pavagada </option> 
<option value='Puttur'> Puttur </option> 
<option value='Raibag'> Raibag </option> 
<option value='Raichur'> Raichur </option> 
<option value='Ramdurg'> Ramdurg </option> 
<option value='Ranebennur'> Ranebennur </option> 
<option value='Ron'> Ron </option> 
<option value='Sagar'> Sagar </option> 
<option value='Sakleshpur'> Sakleshpur </option> 
<option value='Salkani'> Salkani </option> 
<option value='Sandur'> Sandur </option> 
<option value='Saundatti'> Saundatti </option> 
<option value='Savanur'> Savanur </option> 
<option value='Sedam'> Sedam </option> 
<option value='Shahapur'> Shahapur </option> 
<option value='Shankarnarayana'> Shankarnarayana </option> 
<option value='Shikaripura'> Shikaripura </option> 
<option value='Shimoga'> Shimoga </option> 
<option value='Shirahatti'> Shirahatti </option> 
<option value='Shorapur'> Shorapur </option> 
<option value='Siddapur'> Siddapur </option> 
<option value='Sidlaghatta'> Sidlaghatta </option> 
<option value='Sindagi'> Sindagi </option> 
<option value='Sindhanur'> Sindhanur </option> 
<option value='Sira'> Sira </option> 
<option value='Sirsi'> Sirsi </option> 
<option value='Siruguppa'> Siruguppa </option> 
<option value='Somwarpet'> Somwarpet </option> 
<option value='Sorab'> Sorab </option> 
<option value='Sringeri'> Sringeri </option> 
<option value='Sriniwaspur'> Sriniwaspur </option> 
<option value='Srirangapatna'> Srirangapatna </option> 
<option value='Sullia'> Sullia </option> 
<option value='T. Narsipur'> T. Narsipur </option> 
<option value='Tallak'> Tallak </option> 
<option value='Tarikere'> Tarikere </option> 
<option value='Telgi'> Telgi </option> 
<option value='Thirthahalli'> Thirthahalli </option> 
<option value='Tiptur'> Tiptur </option> 
<option value='Tumkur'> Tumkur </option> 
<option value='Turuvekere'> Turuvekere </option> 
<option value='Udupi'> Udupi </option> 
<option value='Virajpet'> Virajpet </option> 
<option value='Wadi'> Wadi </option> 
<option value='Yadgiri'> Yadgiri </option> 
<option value='Yelburga'> Yelburga </option> 
<option value='Yellapur Adimaly'> Yellapur Adimaly </option> 
<option value='Adoor'> Adoor </option> 
<option value='Agathy'> Agathy </option> 
<option value='Alappuzha'> Alappuzha </option> 
<option value='Alathur'> Alathur </option> 
<option value='Alleppey'> Alleppey </option> 
<option value='Alwaye'> Alwaye </option> 
<option value='Amini'> Amini </option> 
<option value='Androth'> Androth </option> 
<option value='Attingal'> Attingal </option> 
<option value='Badagara'> Badagara </option> 
<option value='Bitra'> Bitra </option> 
<option value='Calicut'> Calicut </option> 
<option value='Cannanore'> Cannanore </option> 
<option value='Chetlet'> Chetlet </option> 
<option value='Ernakulam'> Ernakulam </option> 
<option value='Idukki'> Idukki </option> 
<option value='Irinjalakuda'> Irinjalakuda </option> 
<option value='Kadamath'> Kadamath </option> 
<option value='Kalpeni'> Kalpeni </option> 
<option value='Kalpetta'> Kalpetta </option> 
<option value='Kanhangad'> Kanhangad </option> 
<option value='Kanjirapally'> Kanjirapally </option> 
<option value='Kannur'> Kannur </option> 
<option value='Karungapally'> Karungapally </option> 
<option value='Kasargode'> Kasargode </option> 
<option value='Kavarathy'> Kavarathy </option> 
<option value='Kiltan'> Kiltan </option> 
<option value='Kochi'> Kochi </option> 
<option value='Koduvayur'> Koduvayur </option> 
<option value='Kollam'> Kollam </option> 
<option value='Kottayam'> Kottayam </option> 
<option value='Kovalam'> Kovalam </option> 
<option value='Kozhikode'> Kozhikode </option> 
<option value='Kunnamkulam'> Kunnamkulam </option> 
<option value='Malappuram'> Malappuram </option> 
<option value='Mananthodi'> Mananthodi </option> 
<option value='Manjeri'> Manjeri </option> 
<option value='Mannarghat'> Mannarghat </option> 
<option value='Mavelikkara'> Mavelikkara </option> 
<option value='Minicoy'> Minicoy </option> 
<option value='Munnar'> Munnar </option> 
<option value='Muvattupuzha'> Muvattupuzha </option> 
<option value='Nedumandad'> Nedumandad </option> 
<option value='Nedumgandam'> Nedumgandam </option> 
<option value='Nilambur'> Nilambur </option> 
<option value='Palai'> Palai </option> 
<option value='Palakkad'> Palakkad </option> 
<option value='Palghat'> Palghat </option> 
<option value='Pathaanamthitta'> Pathaanamthitta </option> 
<option value='Pathanamthitta'> Pathanamthitta </option> 
<option value='Payyanur'> Payyanur </option> 
<option value='Peermedu'> Peermedu </option> 
<option value='Perinthalmanna'> Perinthalmanna </option> 
<option value='Perumbavoor'> Perumbavoor </option> 
<option value='Punalur'> Punalur </option> 
<option value='Quilon'> Quilon </option> 
<option value='Ranni'> Ranni </option> 
<option value='Shertallai'> Shertallai </option> 
<option value='Shoranur'> Shoranur </option> 
<option value='Taliparamba'> Taliparamba </option> 
<option value='Tellicherry'> Tellicherry </option> 
<option value='Thiruvananthapuram'> Thiruvananthapuram </option> 
<option value='Thodupuzha'> Thodupuzha </option> 
<option value='Thrissur'> Thrissur </option> 
<option value='Tirur'> Tirur </option> 
<option value='Tiruvalla'> Tiruvalla </option> 
<option value='Trichur'> Trichur </option> 
<option value='Trivandrum'> Trivandrum </option> 
<option value='Uppala'> Uppala </option> 
<option value='Vadakkanchery'> Vadakkanchery </option> 
<option value='Vikom'> Vikom </option> 
<option value='Wayanad Agatti Island'> Wayanad Agatti Island </option> 
<option value='Bingaram Island'> Bingaram Island </option> 
<option value='Bitra Island'> Bitra Island </option> 
<option value='Chetlat Island'> Chetlat Island </option> 
<option value='Kadmat Island'> Kadmat Island </option> 
<option value='Kalpeni Island'> Kalpeni Island </option> 
<option value='Kavaratti Island'> Kavaratti Island </option> 
<option value='Kiltan Island'> Kiltan Island </option> 
<option value='Lakshadweep Sea'> Lakshadweep Sea </option> 
<option value='Minicoy Island'> Minicoy Island </option> 
<option value='North Island'> North Island </option> 
<option value='South Island Agar'> South Island Agar </option> 
<option value='Ajaigarh'> Ajaigarh </option> 
<option value='Alirajpur'> Alirajpur </option> 
<option value='Amarpatan'> Amarpatan </option> 
<option value='Amarwada'> Amarwada </option> 
<option value='Ambah'> Ambah </option> 
<option value='Anuppur'> Anuppur </option> 
<option value='Arone'> Arone </option> 
<option value='Ashoknagar'> Ashoknagar </option> 
<option value='Ashta'> Ashta </option> 
<option value='Atner'> Atner </option> 
<option value='Babaichichli'> Babaichichli </option> 
<option value='Badamalhera'> Badamalhera </option> 
<option value='Badarwsas'> Badarwsas </option> 
<option value='Badnagar'> Badnagar </option> 
<option value='Badnawar'> Badnawar </option> 
<option value='Badwani'> Badwani </option> 
<option value='Bagli'> Bagli </option> 
<option value='Baihar'> Baihar </option> 
<option value='Balaghat'> Balaghat </option> 
<option value='Baldeogarh'> Baldeogarh </option> 
<option value='Baldi'> Baldi </option> 
<option value='Bamori'> Bamori </option> 
<option value='Banda'> Banda </option> 
<option value='Bandhavgarh'> Bandhavgarh </option> 
<option value='Bareli'> Bareli </option> 
<option value='Baroda'> Baroda </option> 
<option value='Barwaha'> Barwaha </option> 
<option value='Barwani'> Barwani </option> 
<option value='Batkakhapa'> Batkakhapa </option> 
<option value='Begamganj'> Begamganj </option> 
<option value='Beohari'> Beohari </option> 
<option value='Berasia'> Berasia </option> 
<option value='Berchha'> Berchha </option> 
<option value='Betul'> Betul </option> 
<option value='Bhainsdehi'> Bhainsdehi </option> 
<option value='Bhander'> Bhander </option> 
<option value='Bhanpura'> Bhanpura </option> 
<option value='Bhikangaon'> Bhikangaon </option> 
<option value='Bhimpur'> Bhimpur </option> 
<option value='Bhind'> Bhind </option> 
<option value='Bhitarwar'> Bhitarwar </option> 
<option value='Bhopal'> Bhopal </option> 
<option value='Biaora'> Biaora </option> 
<option value='Bijadandi'> Bijadandi </option> 
<option value='Bijawar'> Bijawar </option> 
<option value='Bijaypur'> Bijaypur </option> 
<option value='Bina'> Bina </option> 
<option value='Birsa'> Birsa </option> 
<option value='Birsinghpur'> Birsinghpur </option> 
<option value='Budhni'> Budhni </option> 
<option value='Burhanpur'> Burhanpur </option> 
<option value='Buxwaha'> Buxwaha </option> 
<option value='Chachaura'> Chachaura </option> 
<option value='Chanderi'> Chanderi </option> 
<option value='Chaurai'> Chaurai </option> 
<option value='Chhapara'> Chhapara </option> 
<option value='Chhatarpur'> Chhatarpur </option> 
<option value='Chhindwara'> Chhindwara </option> 
<option value='Chicholi'> Chicholi </option> 
<option value='Chitrangi'> Chitrangi </option> 
<option value='Churhat'> Churhat </option> 
<option value='Dabra'> Dabra </option> 
<option value='Damoh'> Damoh </option> 
<option value='Datia'> Datia </option> 
<option value='Deori'> Deori </option> 
<option value='Deosar'> Deosar </option> 
<option value='Depalpur'> Depalpur </option> 
<option value='Dewas'> Dewas </option> 
<option value='Dhar'> Dhar </option> 
<option value='Dharampuri'> Dharampuri </option> 
<option value='Dindori'> Dindori </option> 
<option value='Gadarwara'> Gadarwara </option> 
<option value='Gairatganj'> Gairatganj </option> 
<option value='Ganjbasoda'> Ganjbasoda </option> 
<option value='Garoth'> Garoth </option> 
<option value='Ghansour'> Ghansour </option> 
<option value='Ghatia'> Ghatia </option> 
<option value='Ghatigaon'> Ghatigaon </option> 
<option value='Ghorandogri'> Ghorandogri </option> 
<option value='Ghughari'> Ghughari </option> 
<option value='Gogaon'> Gogaon </option> 
<option value='Gohad'> Gohad </option> 
<option value='Goharganj'> Goharganj </option> 
<option value='Gopalganj'> Gopalganj </option> 
<option value='Gotegaon'> Gotegaon </option> 
<option value='Gourihar'> Gourihar </option> 
<option value='Guna'> Guna </option> 
<option value='Gunnore'> Gunnore </option> 
<option value='Gwalior'> Gwalior </option> 
<option value='Gyraspur'> Gyraspur </option> 
<option value='Hanumana'> Hanumana </option> 
<option value='Harda'> Harda </option> 
<option value='Harrai'> Harrai </option> 
<option value='Harsud'> Harsud </option> 
<option value='Hatta'> Hatta </option> 
<option value='Hoshangabad'> Hoshangabad </option> 
<option value='Ichhawar'> Ichhawar </option> 
<option value='Indore'> Indore </option> 
<option value='Isagarh'> Isagarh </option> 
<option value='Itarsi'> Itarsi </option> 
<option value='Jabalpur'> Jabalpur </option> 
<option value='Jabera'> Jabera </option> 
<option value='Jagdalpur'> Jagdalpur </option> 
<option value='Jaisinghnagar'> Jaisinghnagar </option> 
<option value='Jaithari'> Jaithari </option> 
<option value='Jaitpur'> Jaitpur </option> 
<option value='Jaitwara'> Jaitwara </option> 
<option value='Jamai'> Jamai </option> 
<option value='Jaora'> Jaora </option> 
<option value='Jatara'> Jatara </option> 
<option value='Jawad'> Jawad </option> 
<option value='Jhabua'> Jhabua </option> 
<option value='Jobat'> Jobat </option> 
<option value='Jora'> Jora </option> 
<option value='Kakaiya'> Kakaiya </option> 
<option value='Kannod'> Kannod </option> 
<option value='Kannodi'> Kannodi </option> 
<option value='Karanjia'> Karanjia </option> 
<option value='Kareli'> Kareli </option> 
<option value='Karera'> Karera </option> 
<option value='Karhal'> Karhal </option> 
<option value='Karpa'> Karpa </option> 
<option value='Kasrawad'> Kasrawad </option> 
<option value='Katangi'> Katangi </option> 
<option value='Katni'> Katni </option> 
<option value='Keolari'> Keolari </option> 
<option value='Khachrod'> Khachrod </option> 
<option value='Khajuraho'> Khajuraho </option> 
<option value='Khakner'> Khakner </option> 
<option value='Khalwa'> Khalwa </option> 
<option value='Khandwa'> Khandwa </option> 
<option value='Khaniadhana'> Khaniadhana </option> 
<option value='Khargone'> Khargone </option> 
<option value='Khategaon'> Khategaon </option> 
<option value='Khetia'> Khetia </option> 
<option value='Khilchipur'> Khilchipur </option> 
<option value='Khirkiya'> Khirkiya </option> 
<option value='Khurai'> Khurai </option> 
<option value='Kolaras'> Kolaras </option> 
<option value='Kotma'> Kotma </option> 
<option value='Kukshi'> Kukshi </option> 
<option value='Kundam'> Kundam </option> 
<option value='Kurwai'> Kurwai </option> 
<option value='Kusmi'> Kusmi </option> 
<option value='Laher'> Laher </option> 
<option value='Lakhnadon'> Lakhnadon </option> 
<option value='Lamta'> Lamta </option> 
<option value='Lanji'> Lanji </option> 
<option value='Lateri'> Lateri </option> 
<option value='Laundi'> Laundi </option> 
<option value='Maheshwar'> Maheshwar </option> 
<option value='Mahidpurcity'> Mahidpurcity </option> 
<option value='Maihar'> Maihar </option> 
<option value='Majhagwan'> Majhagwan </option> 
<option value='Majholi'> Majholi </option> 
<option value='Malhargarh'> Malhargarh </option> 
<option value='Manasa'> Manasa </option> 
<option value='Manawar'> Manawar </option> 
<option value='Mandla'> Mandla </option> 
<option value='Mandsaur'> Mandsaur </option> 
<option value='Manpur'> Manpur </option> 
<option value='Mauganj'> Mauganj </option> 
<option value='Mawai'> Mawai </option> 
<option value='Mehgaon'> Mehgaon </option> 
<option value='Mhow'> Mhow </option> 
<option value='Morena'> Morena </option> 
<option value='Multai'> Multai </option> 
<option value='Mungaoli'> Mungaoli </option> 
<option value='Nagod'> Nagod </option> 
<option value='Nainpur'> Nainpur </option> 
<option value='Narsingarh'> Narsingarh </option> 
<option value='Narsinghpur'> Narsinghpur </option> 
<option value='Narwar'> Narwar </option> 
<option value='Nasrullaganj'> Nasrullaganj </option> 
<option value='Nateran'> Nateran </option> 
<option value='Neemuch'> Neemuch </option> 
<option value='Niwari'> Niwari </option> 
<option value='Niwas'> Niwas </option> 
<option value='Nowgaon'> Nowgaon </option> 
<option value='Pachmarhi'> Pachmarhi </option> 
<option value='Pandhana'> Pandhana </option> 
<option value='Pandhurna'> Pandhurna </option> 
<option value='Panna'> Panna </option> 
<option value='Parasia'> Parasia </option> 
<option value='Patan'> Patan </option> 
<option value='Patera'> Patera </option> 
<option value='Patharia'> Patharia </option> 
<option value='Pawai'> Pawai </option> 
<option value='Petlawad'> Petlawad </option> 
<option value='Pichhore'> Pichhore </option> 
<option value='Piparia'> Piparia </option> 
<option value='Pohari'> Pohari </option> 
<option value='Prabhapattan'> Prabhapattan </option> 
<option value='Punasa'> Punasa </option> 
<option value='Pushprajgarh'> Pushprajgarh </option> 
<option value='Raghogarh'> Raghogarh </option> 
<option value='Raghunathpur'> Raghunathpur </option> 
<option value='Rahatgarh'> Rahatgarh </option> 
<option value='Raisen'> Raisen </option> 
<option value='Rajgarh'> Rajgarh </option> 
<option value='Rajpur'> Rajpur </option> 
<option value='Ratlam'> Ratlam </option> 
<option value='Rehli'> Rehli </option> 
<option value='Rewa'> Rewa </option> 
<option value='Sabalgarh'> Sabalgarh </option> 
<option value='Sagar'> Sagar </option> 
<option value='Sailana'> Sailana </option> 
<option value='Sanwer'> Sanwer </option> 
<option value='Sarangpur'> Sarangpur </option> 
<option value='Sardarpur'> Sardarpur </option> 
<option value='Satna'> Satna </option> 
<option value='Saunsar'> Saunsar </option> 
<option value='Sehore'> Sehore </option> 
<option value='Sendhwa'> Sendhwa </option> 
<option value='Seondha'> Seondha </option> 
<option value='Seoni'> Seoni </option> 
<option value='Seonimalwa'> Seonimalwa </option> 
<option value='Shahdol'> Shahdol </option> 
<option value='Shahnagar'> Shahnagar </option> 
<option value='Shahpur'> Shahpur </option> 
<option value='Shajapur'> Shajapur </option> 
<option value='Sheopur'> Sheopur </option> 
<option value='Sheopurkalan'> Sheopurkalan </option> 
<option value='Shivpuri'> Shivpuri </option> 
<option value='Shujalpur'> Shujalpur </option> 
<option value='Sidhi'> Sidhi </option> 
<option value='Sihora'> Sihora </option> 
<option value='Silwani'> Silwani </option> 
<option value='Singrauli'> Singrauli </option> 
<option value='Sirmour'> Sirmour </option> 
<option value='Sironj'> Sironj </option> 
<option value='Sitamau'> Sitamau </option> 
<option value='Sohagpur'> Sohagpur </option> 
<option value='Sondhwa'> Sondhwa </option> 
<option value='Sonkatch'> Sonkatch </option> 
<option value='Susner'> Susner </option> 
<option value='Tamia'> Tamia </option> 
<option value='Tarana'> Tarana </option> 
<option value='Tendukheda'> Tendukheda </option> 
<option value='Teonthar'> Teonthar </option> 
<option value='Thandla'> Thandla </option> 
<option value='Tikamgarh'> Tikamgarh </option> 
<option value='Timarani'> Timarani </option> 
<option value='Udaipura'> Udaipura </option> 
<option value='Ujjain'> Ujjain </option> 
<option value='Umaria'> Umaria </option> 
<option value='Umariapan'> Umariapan </option> 
<option value='Vidisha'> Vidisha </option> 
<option value='Vijayraghogarh'> Vijayraghogarh </option> 
<option value='Waraseoni'> Waraseoni </option> 
<option value='Zhirnia Achalpur'> Zhirnia Achalpur </option> 
<option value='Aheri'> Aheri </option> 
<option value='Ahmednagar'> Ahmednagar </option> 
<option value='Ahmedpur'> Ahmedpur </option> 
<option value='Ajara'> Ajara </option> 
<option value='Akkalkot'> Akkalkot </option> 
<option value='Akola'> Akola </option> 
<option value='Akole'> Akole </option> 
<option value='Akot'> Akot </option> 
<option value='Alibagh'> Alibagh </option> 
<option value='Amagaon'> Amagaon </option> 
<option value='Amalner'> Amalner </option> 
<option value='Ambad'> Ambad </option> 
<option value='Ambejogai'> Ambejogai </option> 
<option value='Amravati'> Amravati </option> 
<option value='Arjuni Merogaon'> Arjuni Merogaon </option> 
<option value='Arvi'> Arvi </option> 
<option value='Ashti'> Ashti </option> 
<option value='Atpadi'> Atpadi </option> 
<option value='Aurangabad'> Aurangabad </option> 
<option value='Ausa'> Ausa </option> 
<option value='Babhulgaon'> Babhulgaon </option> 
<option value='Balapur'> Balapur </option> 
<option value='Baramati'> Baramati </option> 
<option value='Barshi Takli'> Barshi Takli </option> 
<option value='Barsi'> Barsi </option> 
<option value='Basmatnagar'> Basmatnagar </option> 
<option value='Bassein'> Bassein </option> 
<option value='Beed'> Beed </option> 
<option value='Bhadrawati'> Bhadrawati </option> 
<option value='Bhamregadh'> Bhamregadh </option> 
<option value='Bhandara'> Bhandara </option> 
<option value='Bhir'> Bhir </option> 
<option value='Bhiwandi'> Bhiwandi </option> 
<option value='Bhiwapur'> Bhiwapur </option> 
<option value='Bhokar'> Bhokar </option> 
<option value='Bhokardan'> Bhokardan </option> 
<option value='Bhoom'> Bhoom </option> 
<option value='Bhor'> Bhor </option> 
<option value='Bhudargad'> Bhudargad </option> 
<option value='Bhusawal'> Bhusawal </option> 
<option value='Billoli'> Billoli </option> 
<option value='Brahmapuri'> Brahmapuri </option> 
<option value='Buldhana'> Buldhana </option> 
<option value='Butibori'> Butibori </option> 
<option value='Chalisgaon'> Chalisgaon </option> 
<option value='Chamorshi'> Chamorshi </option> 
<option value='Chandgad'> Chandgad </option> 
<option value='Chandrapur'> Chandrapur </option> 
<option value='Chandur'> Chandur </option> 
<option value='Chanwad'> Chanwad </option> 
<option value='Chhikaldara'> Chhikaldara </option> 
<option value='Chikhali'> Chikhali </option> 
<option value='Chinchwad'> Chinchwad </option> 
<option value='Chiplun'> Chiplun </option> 
<option value='Chopda'> Chopda </option> 
<option value='Chumur'> Chumur </option> 
<option value='Dahanu'> Dahanu </option> 
<option value='Dapoli'> Dapoli </option> 
<option value='Darwaha'> Darwaha </option> 
<option value='Daryapur'> Daryapur </option> 
<option value='Daund'> Daund </option> 
<option value='Degloor'> Degloor </option> 
<option value='Delhi Tanda'> Delhi Tanda </option> 
<option value='Deogad'> Deogad </option> 
<option value='Deolgaonraja'> Deolgaonraja </option> 
<option value='Deori'> Deori </option> 
<option value='Desaiganj'> Desaiganj </option> 
<option value='Dhadgaon'> Dhadgaon </option> 
<option value='Dhanora'> Dhanora </option> 
<option value='Dharani'> Dharani </option> 
<option value='Dhiwadi'> Dhiwadi </option> 
<option value='Dhule'> Dhule </option> 
<option value='Dhulia'> Dhulia </option> 
<option value='Digras'> Digras </option> 
<option value='Dindori'> Dindori </option> 
<option value='Edalabad'> Edalabad </option> 
<option value='Erandul'> Erandul </option> 
<option value='Etapalli'> Etapalli </option> 
<option value='Gadhchiroli'> Gadhchiroli </option> 
<option value='Gadhinglaj'> Gadhinglaj </option> 
<option value='Gaganbavada'> Gaganbavada </option> 
<option value='Gangakhed'> Gangakhed </option> 
<option value='Gangapur'> Gangapur </option> 
<option value='Gevrai'> Gevrai </option> 
<option value='Ghatanji'> Ghatanji </option> 
<option value='Golegaon'> Golegaon </option> 
<option value='Gondia'> Gondia </option> 
<option value='Gondpipri'> Gondpipri </option> 
<option value='Goregaon'> Goregaon </option> 
<option value='Guhagar'> Guhagar </option> 
<option value='Hadgaon'> Hadgaon </option> 
<option value='Hatkangale'> Hatkangale </option> 
<option value='Hinganghat'> Hinganghat </option> 
<option value='Hingoli'> Hingoli </option> 
<option value='Hingua'> Hingua </option> 
<option value='Igatpuri'> Igatpuri </option> 
<option value='Indapur'> Indapur </option> 
<option value='Islampur'> Islampur </option> 
<option value='Jalgaon'> Jalgaon </option> 
<option value='Jalna'> Jalna </option> 
<option value='Jamkhed'> Jamkhed </option> 
<option value='Jamner'> Jamner </option> 
<option value='Jath'> Jath </option> 
<option value='Jawahar'> Jawahar </option> 
<option value='Jintdor'> Jintdor </option> 
<option value='Junnar'> Junnar </option> 
<option value='Kagal'> Kagal </option> 
<option value='Kaij'> Kaij </option> 
<option value='Kalamb'> Kalamb </option> 
<option value='Kalamnuri'> Kalamnuri </option> 
<option value='Kallam'> Kallam </option> 
<option value='Kalmeshwar'> Kalmeshwar </option> 
<option value='Kalwan'> Kalwan </option> 
<option value='Kalyan'> Kalyan </option> 
<option value='Kamptee'> Kamptee </option> 
<option value='Kandhar'> Kandhar </option> 
<option value='Kankavali'> Kankavali </option> 
<option value='Kannad'> Kannad </option> 
<option value='Karad'> Karad </option> 
<option value='Karjat'> Karjat </option> 
<option value='Karmala'> Karmala </option> 
<option value='Katol'> Katol </option> 
<option value='Kavathemankal'> Kavathemankal </option> 
<option value='Kedgaon'> Kedgaon </option> 
<option value='Khadakwasala'> Khadakwasala </option> 
<option value='Khamgaon'> Khamgaon </option> 
<option value='Khed'> Khed </option> 
<option value='Khopoli'> Khopoli </option> 
<option value='Khultabad'> Khultabad </option> 
<option value='Kinwat'> Kinwat </option> 
<option value='Kolhapur'> Kolhapur </option> 
<option value='Kopargaon'> Kopargaon </option> 
<option value='Koregaon'> Koregaon </option> 
<option value='Kudal'> Kudal </option> 
<option value='Kuhi'> Kuhi </option> 
<option value='Kurkheda'> Kurkheda </option> 
<option value='Kusumba'> Kusumba </option> 
<option value='Lakhandur'> Lakhandur </option> 
<option value='Langa'> Langa </option> 
<option value='Latur'> Latur </option> 
<option value='Lonar'> Lonar </option> 
<option value='Lonavala'> Lonavala </option> 
<option value='Madangad'> Madangad </option> 
<option value='Madha'> Madha </option> 
<option value='Mahabaleshwar'> Mahabaleshwar </option> 
<option value='Mahad'> Mahad </option> 
<option value='Mahagaon'> Mahagaon </option> 
<option value='Mahasala'> Mahasala </option> 
<option value='Mahaswad'> Mahaswad </option> 
<option value='Malegaon'> Malegaon </option> 
<option value='Malgaon'> Malgaon </option> 
<option value='Malgund'> Malgund </option> 
<option value='Malkapur'> Malkapur </option> 
<option value='Malsuras'> Malsuras </option> 
<option value='Malwan'> Malwan </option> 
<option value='Mancher'> Mancher </option> 
<option value='Mangalwedha'> Mangalwedha </option> 
<option value='Mangaon'> Mangaon </option> 
<option value='Mangrulpur'> Mangrulpur </option> 
<option value='Manjalegaon'> Manjalegaon </option> 
<option value='Manmad'> Manmad </option> 
<option value='Maregaon'> Maregaon </option> 
<option value='Mehda'> Mehda </option> 
<option value='Mekhar'> Mekhar </option> 
<option value='Mohadi'> Mohadi </option> 
<option value='Mohol'> Mohol </option> 
<option value='Mokhada'> Mokhada </option> 
<option value='Morshi'> Morshi </option> 
<option value='Mouda'> Mouda </option> 
<option value='Mukhed'> Mukhed </option> 
<option value='Mul'> Mul </option> 
<option value='Mumbai'> Mumbai </option> 
<option value='Murbad'> Murbad </option> 
<option value='Murtizapur'> Murtizapur </option> 
<option value='Murud'> Murud </option> 
<option value='Nagbhir'> Nagbhir </option> 
<option value='Nagpur'> Nagpur </option> 
<option value='Nahavara'> Nahavara </option> 
<option value='Nanded'> Nanded </option> 
<option value='Nandgaon'> Nandgaon </option> 
<option value='Nandnva'> Nandnva </option> 
<option value='Nandurbar'> Nandurbar </option> 
<option value='Narkhed'> Narkhed </option> 
<option value='Nashik'> Nashik </option> 
<option value='Navapur'> Navapur </option> 
<option value='Ner'> Ner </option> 
<option value='Newasa'> Newasa </option> 
<option value='Nilanga'> Nilanga </option> 
<option value='Niphad'> Niphad </option> 
<option value='Omerga'> Omerga </option> 
<option value='Osmanabad'> Osmanabad </option> 
<option value='Pachora'> Pachora </option> 
<option value='Paithan'> Paithan </option> 
<option value='Palghar'> Palghar </option> 
<option value='Pali'> Pali </option> 
<option value='Pandharkawada'> Pandharkawada </option> 
<option value='Pandharpur'> Pandharpur </option> 
<option value='Panhala'> Panhala </option> 
<option value='Paranda'> Paranda </option> 
<option value='Parbhani'> Parbhani </option> 
<option value='Parner'> Parner </option> 
<option value='Parola'> Parola </option> 
<option value='Parseoni'> Parseoni </option> 
<option value='Partur'> Partur </option> 
<option value='Patan'> Patan </option> 
<option value='Pathardi'> Pathardi </option> 
<option value='Pathari'> Pathari </option> 
<option value='Patoda'> Patoda </option> 
<option value='Pauni'> Pauni </option> 
<option value='Peint'> Peint </option> 
<option value='Pen'> Pen </option> 
<option value='Phaltan'> Phaltan </option> 
<option value='Pimpalner'> Pimpalner </option> 
<option value='Pirangut'> Pirangut </option> 
<option value='Poladpur'> Poladpur </option> 
<option value='Pune'> Pune </option> 
<option value='Pusad'> Pusad </option> 
<option value='Pusegaon'> Pusegaon </option> 
<option value='Radhanagar'> Radhanagar </option> 
<option value='Rahuri'> Rahuri </option> 
<option value='Raigad'> Raigad </option> 
<option value='Rajapur'> Rajapur </option> 
<option value='Rajgurunagar'> Rajgurunagar </option> 
<option value='Rajura'> Rajura </option> 
<option value='Ralegaon'> Ralegaon </option> 
<option value='Ramtek'> Ramtek </option> 
<option value='Ratnagiri'> Ratnagiri </option> 
<option value='Raver'> Raver </option> 
<option value='Risod'> Risod </option> 
<option value='Roha'> Roha </option> 
<option value='Sakarwadi'> Sakarwadi </option> 
<option value='Sakoli'> Sakoli </option> 
<option value='Sakri'> Sakri </option> 
<option value='Salekasa'> Salekasa </option> 
<option value='Samudrapur'> Samudrapur </option> 
<option value='Sangamner'> Sangamner </option> 
<option value='Sanganeshwar'> Sanganeshwar </option> 
<option value='Sangli'> Sangli </option> 
<option value='Sangola'> Sangola </option> 
<option value='Sanguem'> Sanguem </option> 
<option value='Saoner'> Saoner </option> 
<option value='Saswad'> Saswad </option> 
<option value='Satana'> Satana </option> 
<option value='Satara'> Satara </option> 
<option value='Sawantwadi'> Sawantwadi </option> 
<option value='Seloo'> Seloo </option> 
<option value='Shahada'> Shahada </option> 
<option value='Shahapur'> Shahapur </option> 
<option value='Shahuwadi'> Shahuwadi </option> 
<option value='Shevgaon'> Shevgaon </option> 
<option value='Shirala'> Shirala </option> 
<option value='Shirol'> Shirol </option> 
<option value='Shirpur'> Shirpur </option> 
<option value='Shirur'> Shirur </option> 
<option value='Shirwal'> Shirwal </option> 
<option value='Sholapur'> Sholapur </option> 
<option value='Shri Rampur'> Shri Rampur </option> 
<option value='Shrigonda'> Shrigonda </option> 
<option value='Shrivardhan'> Shrivardhan </option> 
<option value='Sillod'> Sillod </option> 
<option value='Sinderwahi'> Sinderwahi </option> 
<option value='Sindhudurg'> Sindhudurg </option> 
<option value='Sindkheda'> Sindkheda </option> 
<option value='Sindkhedaraja'> Sindkhedaraja </option> 
<option value='Sinnar'> Sinnar </option> 
<option value='Sironcha'> Sironcha </option> 
<option value='Soyegaon'> Soyegaon </option> 
<option value='Surgena'> Surgena </option> 
<option value='Talasari'> Talasari </option> 
<option value='Talegaon S.Ji Pant'> Talegaon S.Ji Pant </option> 
<option value='Taloda'> Taloda </option> 
<option value='Tasgaon'> Tasgaon </option> 
<option value='Thane'> Thane </option> 
<option value='Tirora'> Tirora </option> 
<option value='Tiwasa'> Tiwasa </option> 
<option value='Trimbak'> Trimbak </option> 
<option value='Tuljapur'> Tuljapur </option> 
<option value='Tumsar'> Tumsar </option> 
<option value='Udgir'> Udgir </option> 
<option value='Umarkhed'> Umarkhed </option> 
<option value='Umrane'> Umrane </option> 
<option value='Umrer'> Umrer </option> 
<option value='Urlikanchan'> Urlikanchan </option> 
<option value='Vaduj'> Vaduj </option> 
<option value='Velhe'> Velhe </option> 
<option value='Vengurla'> Vengurla </option> 
<option value='Vijapur'> Vijapur </option> 
<option value='Vita'> Vita </option> 
<option value='Wada'> Wada </option> 
<option value='Wai'> Wai </option> 
<option value='Walchandnagar'> Walchandnagar </option> 
<option value='Wani'> Wani </option> 
<option value='Wardha'> Wardha </option> 
<option value='Warlydwarud'> Warlydwarud </option> 
<option value='Warora'> Warora </option> 
<option value='Washim'> Washim </option> 
<option value='Wathar'> Wathar </option> 
<option value='Yavatmal'> Yavatmal </option> 
<option value='Yawal'> Yawal </option> 
<option value='Yeola'> Yeola </option> 
<option value='Yeotmal Bishnupur'> Yeotmal Bishnupur </option> 
<option value='Chakpikarong'> Chakpikarong </option> 
<option value='Chandel'> Chandel </option> 
<option value='Chattrik'> Chattrik </option> 
<option value='Churachandpur'> Churachandpur </option> 
<option value='Imphal'> Imphal </option> 
<option value='Jiribam'> Jiribam </option> 
<option value='Kakching'> Kakching </option> 
<option value='Kalapahar'> Kalapahar </option> 
<option value='Mao'> Mao </option> 
<option value='Mulam'> Mulam </option> 
<option value='Parbung'> Parbung </option> 
<option value='Sadarhills'> Sadarhills </option> 
<option value='Saibom'> Saibom </option> 
<option value='Sempang'> Sempang </option> 
<option value='Senapati'> Senapati </option> 
<option value='Sochumer'> Sochumer </option> 
<option value='Taloulong'> Taloulong </option> 
<option value='Tamenglong'> Tamenglong </option> 
<option value='Thinghat'> Thinghat </option> 
<option value='Thoubal'> Thoubal </option> 
<option value='Ukhrul Amlaren'> Ukhrul Amlaren </option> 
<option value='Baghmara'> Baghmara </option> 
<option value='Cherrapunjee'> Cherrapunjee </option> 
<option value='Dadengiri'> Dadengiri </option> 
<option value='Garo Hills'> Garo Hills </option> 
<option value='Jaintia Hills'> Jaintia Hills </option> 
<option value='Jowai'> Jowai </option> 
<option value='Khasi Hills'> Khasi Hills </option> 
<option value='Khliehriat'> Khliehriat </option> 
<option value='Mariang'> Mariang </option> 
<option value='Mawkyrwat'> Mawkyrwat </option> 
<option value='Nongpoh'> Nongpoh </option> 
<option value='Nongstoin'> Nongstoin </option> 
<option value='Resubelpara'> Resubelpara </option> 
<option value='Ri Bhoi'> Ri Bhoi </option> 
<option value='Shillong'> Shillong </option> 
<option value='Tura'> Tura </option> 
<option value='Williamnagar Aizawl'> Williamnagar Aizawl </option> 
<option value='Champhai'> Champhai </option> 
<option value='Demagiri'> Demagiri </option> 
<option value='Kolasib'> Kolasib </option> 
<option value='Lawngtlai'> Lawngtlai </option> 
<option value='Lunglei'> Lunglei </option> 
<option value='Mamit'> Mamit </option> 
<option value='Saiha'> Saiha </option> 
<option value='Serchhip Dimapur'> Serchhip Dimapur </option> 
<option value='Jalukie'> Jalukie </option> 
<option value='Kiphire'> Kiphire </option> 
<option value='Kohima'> Kohima </option> 
<option value='Mokokchung'> Mokokchung </option> 
<option value='Mon'> Mon </option> 
<option value='Phek'> Phek </option> 
<option value='Tuensang'> Tuensang </option> 
<option value='Wokha'> Wokha </option> 
<option value='Zunheboto Bahur'> Zunheboto Bahur </option> 
<option value='Karaikal'> Karaikal </option> 
<option value='Mahe'> Mahe </option> 
<option value='Pondicherry'> Pondicherry </option> 
<option value='Purnankuppam'> Purnankuppam </option> 
<option value='Valudavur'> Valudavur </option> 
<option value='Villianur'> Villianur </option> 
<option value='Yanam Abohar'> Yanam Abohar </option> 
<option value='Ajnala'> Ajnala </option> 
<option value='Amritsar'> Amritsar </option> 
<option value='Balachaur'> Balachaur </option> 
<option value='Barnala'> Barnala </option> 
<option value='Batala'> Batala </option> 
<option value='Bathinda'> Bathinda </option> 
<option value='Chandigarh'> Chandigarh </option> 
<option value='Dasua'> Dasua </option> 
<option value='Dinanagar'> Dinanagar </option> 
<option value='Faridkot'> Faridkot </option> 
<option value='Fatehgarh Sahib'> Fatehgarh Sahib </option> 
<option value='Fazilka'> Fazilka </option> 
<option value='Ferozepur'> Ferozepur </option> 
<option value='Garhashanker'> Garhashanker </option> 
<option value='Goindwal'> Goindwal </option> 
<option value='Gurdaspur'> Gurdaspur </option> 
<option value='Guruharsahai'> Guruharsahai </option> 
<option value='Hoshiarpur'> Hoshiarpur </option> 
<option value='Jagraon'> Jagraon </option> 
<option value='Jalandhar'> Jalandhar </option> 
<option value='Jugial'> Jugial </option> 
<option value='Kapurthala'> Kapurthala </option> 
<option value='Kharar'> Kharar </option> 
<option value='Kotkapura'> Kotkapura </option> 
<option value='Ludhiana'> Ludhiana </option> 
<option value='Malaut'> Malaut </option> 
<option value='Malerkotla'> Malerkotla </option> 
<option value='Mansa'> Mansa </option> 
<option value='Moga'> Moga </option> 
<option value='Muktasar'> Muktasar </option> 
<option value='Nabha'> Nabha </option> 
<option value='Nakodar'> Nakodar </option> 
<option value='Nangal'> Nangal </option> 
<option value='Nawanshahar'> Nawanshahar </option> 
<option value='Nawanshahr'> Nawanshahr </option> 
<option value='Pathankot'> Pathankot </option> 
<option value='Patiala'> Patiala </option> 
<option value='Patti'> Patti </option> 
<option value='Phagwara'> Phagwara </option> 
<option value='Phillaur'> Phillaur </option> 
<option value='Phulmandi'> Phulmandi </option> 
<option value='Quadian'> Quadian </option> 
<option value='Rajpura'> Rajpura </option> 
<option value='Raman'> Raman </option> 
<option value='Rayya'> Rayya </option> 
<option value='Ropar'> Ropar </option> 
<option value='Rupnagar'> Rupnagar </option> 
<option value='Samana'> Samana </option> 
<option value='Samrala'> Samrala </option> 
<option value='Sangrur'> Sangrur </option> 
<option value='Sardulgarh'> Sardulgarh </option> 
<option value='Sarhind'> Sarhind </option> 
<option value='SAS Nagar'> SAS Nagar </option> 
<option value='Sultanpur Lodhi'> Sultanpur Lodhi </option> 
<option value='Sunam'> Sunam </option> 
<option value='Tanda Urmar'> Tanda Urmar </option> 
<option value='Tarn Taran'> Tarn Taran </option> 
<option value='Zira Abu Road'> Zira Abu Road </option> 
<option value='Ahore'> Ahore </option> 
<option value='Ajmer'> Ajmer </option> 
<option value='Aklera'> Aklera </option> 
<option value='Alwar'> Alwar </option> 
<option value='Amber'> Amber </option> 
<option value='Amet'> Amet </option> 
<option value='Anupgarh'> Anupgarh </option> 
<option value='Asind'> Asind </option> 
<option value='Aspur'> Aspur </option> 
<option value='Atru'> Atru </option> 
<option value='Bagidora'> Bagidora </option> 
<option value='Bali'> Bali </option> 
<option value='Bamanwas'> Bamanwas </option> 
<option value='Banera'> Banera </option> 
<option value='Bansur'> Bansur </option> 
<option value='Banswara'> Banswara </option> 
<option value='Baran'> Baran </option> 
<option value='Bari'> Bari </option> 
<option value='Barisadri'> Barisadri </option> 
<option value='Barmer'> Barmer </option> 
<option value='Baseri'> Baseri </option> 
<option value='Bassi'> Bassi </option> 
<option value='Baswa'> Baswa </option> 
<option value='Bayana'> Bayana </option> 
<option value='Beawar'> Beawar </option> 
<option value='Begun'> Begun </option> 
<option value='Behror'> Behror </option> 
<option value='Bhadra'> Bhadra </option> 
<option value='Bharatpur'> Bharatpur </option> 
<option value='Bhilwara'> Bhilwara </option> 
<option value='Bhim'> Bhim </option> 
<option value='Bhinmal'> Bhinmal </option> 
<option value='Bikaner'> Bikaner </option> 
<option value='Bilara'> Bilara </option> 
<option value='Bundi'> Bundi </option> 
<option value='Chhabra'> Chhabra </option> 
<option value='Chhipaborad'> Chhipaborad </option> 
<option value='Chirawa'> Chirawa </option> 
<option value='Chittorgarh'> Chittorgarh </option> 
<option value='Chohtan'> Chohtan </option> 
<option value='Churu'> Churu </option> 
<option value='Dantaramgarh'> Dantaramgarh </option> 
<option value='Dausa'> Dausa </option> 
<option value='Deedwana'> Deedwana </option> 
<option value='Deeg'> Deeg </option> 
<option value='Degana'> Degana </option> 
<option value='Deogarh'> Deogarh </option> 
<option value='Deoli'> Deoli </option> 
<option value='Desuri'> Desuri </option> 
<option value='Dhariawad'> Dhariawad </option> 
<option value='Dholpur'> Dholpur </option> 
<option value='Digod'> Digod </option> 
<option value='Dudu'> Dudu </option> 
<option value='Dungarpur'> Dungarpur </option> 
<option value='Dungla'> Dungla </option> 
<option value='Fatehpur'> Fatehpur </option> 
<option value='Gangapur'> Gangapur </option> 
<option value='Gangdhar'> Gangdhar </option> 
<option value='Gerhi'> Gerhi </option> 
<option value='Ghatol'> Ghatol </option> 
<option value='Girwa'> Girwa </option> 
<option value='Gogunda'> Gogunda </option> 
<option value='Hanumangarh'> Hanumangarh </option> 
<option value='Hindaun'> Hindaun </option> 
<option value='Hindoli'> Hindoli </option> 
<option value='Hurda'> Hurda </option> 
<option value='Jahazpur'> Jahazpur </option> 
<option value='Jaipur'> Jaipur </option> 
<option value='Jaisalmer'> Jaisalmer </option> 
<option value='Jalore'> Jalore </option> 
<option value='Jhalawar'> Jhalawar </option> 
<option value='Jhunjhunu'> Jhunjhunu </option> 
<option value='Jodhpur'> Jodhpur </option> 
<option value='Kaman'> Kaman </option> 
<option value='Kapasan'> Kapasan </option> 
<option value='Karauli'> Karauli </option> 
<option value='Kekri'> Kekri </option> 
<option value='Keshoraipatan'> Keshoraipatan </option> 
<option value='Khandar'> Khandar </option> 
<option value='Kherwara'> Kherwara </option> 
<option value='Khetri'> Khetri </option> 
<option value='Kishanganj'> Kishanganj </option> 
<option value='Kishangarh'> Kishangarh </option> 
<option value='Kishangarhbas'> Kishangarhbas </option> 
<option value='Kolayat'> Kolayat </option> 
<option value='Kota'> Kota </option> 
<option value='Kotputli'> Kotputli </option> 
<option value='Kotra'> Kotra </option> 
<option value='Kotri'> Kotri </option> 
<option value='Kumbalgarh'> Kumbalgarh </option> 
<option value='Kushalgarh'> Kushalgarh </option> 
<option value='Ladnun'> Ladnun </option> 
<option value='Ladpura'> Ladpura </option> 
<option value='Lalsot'> Lalsot </option> 
<option value='Laxmangarh'> Laxmangarh </option> 
<option value='Lunkaransar'> Lunkaransar </option> 
<option value='Mahuwa'> Mahuwa </option> 
<option value='Malpura'> Malpura </option> 
<option value='Malvi'> Malvi </option> 
<option value='Mandal'> Mandal </option> 
<option value='Mandalgarh'> Mandalgarh </option> 
<option value='Mandawar'> Mandawar </option> 
<option value='Mangrol'> Mangrol </option> 
<option value='Marwar-Jn'> Marwar-Jn </option> 
<option value='Merta'> Merta </option> 
<option value='Nadbai'> Nadbai </option> 
<option value='Nagaur'> Nagaur </option> 
<option value='Nainwa'> Nainwa </option> 
<option value='Nasirabad'> Nasirabad </option> 
<option value='Nathdwara'> Nathdwara </option> 
<option value='Nawa'> Nawa </option> 
<option value='Neem Ka Thana'> Neem Ka Thana </option> 
<option value='Newai'> Newai </option> 
<option value='Nimbahera'> Nimbahera </option> 
<option value='Nohar'> Nohar </option> 
<option value='Nokha'> Nokha </option> 
<option value='Onli'> Onli </option> 
<option value='Osian'> Osian </option> 
<option value='Pachpadara'> Pachpadara </option> 
<option value='Pachpahar'> Pachpahar </option> 
<option value='Padampur'> Padampur </option> 
<option value='Pali'> Pali </option> 
<option value='Parbatsar'> Parbatsar </option> 
<option value='Phagi'> Phagi </option> 
<option value='Phalodi'> Phalodi </option> 
<option value='Pilani'> Pilani </option> 
<option value='Pindwara'> Pindwara </option> 
<option value='Pipalda'> Pipalda </option> 
<option value='Pirawa'> Pirawa </option> 
<option value='Pokaran'> Pokaran </option> 
<option value='Pratapgarh'> Pratapgarh </option> 
<option value='Raipur'> Raipur </option> 
<option value='Raisinghnagar'> Raisinghnagar </option> 
<option value='Rajgarh'> Rajgarh </option> 
<option value='Rajsamand'> Rajsamand </option> 
<option value='Ramganj Mandi'> Ramganj Mandi </option> 
<option value='Ramgarh'> Ramgarh </option> 
<option value='Rashmi'> Rashmi </option> 
<option value='Ratangarh'> Ratangarh </option> 
<option value='Reodar'> Reodar </option> 
<option value='Rupbas'> Rupbas </option> 
<option value='Sadulshahar'> Sadulshahar </option> 
<option value='Sagwara'> Sagwara </option> 
<option value='Sahabad'> Sahabad </option> 
<option value='Salumber'> Salumber </option> 
<option value='Sanchore'> Sanchore </option> 
<option value='Sangaria'> Sangaria </option> 
<option value='Sangod'> Sangod </option> 
<option value='Sapotra'> Sapotra </option> 
<option value='Sarada'> Sarada </option> 
<option value='Sardarshahar'> Sardarshahar </option> 
<option value='Sarwar'> Sarwar </option> 
<option value='Sawai Madhopur'> Sawai Madhopur </option> 
<option value='Shahapura'> Shahapura </option> 
<option value='Sheo'> Sheo </option> 
<option value='Sheoganj'> Sheoganj </option> 
<option value='Shergarh'> Shergarh </option> 
<option value='Sikar'> Sikar </option> 
<option value='Sirohi'> Sirohi </option> 
<option value='Siwana'> Siwana </option> 
<option value='Sojat'> Sojat </option> 
<option value='Sri Dungargarh'> Sri Dungargarh </option> 
<option value='Sri Ganganagar'> Sri Ganganagar </option> 
<option value='Sri Karanpur'> Sri Karanpur </option> 
<option value='Sri Madhopur'> Sri Madhopur </option> 
<option value='Sujangarh'> Sujangarh </option> 
<option value='Taranagar'> Taranagar </option> 
<option value='Thanaghazi'> Thanaghazi </option> 
<option value='Tibbi'> Tibbi </option> 
<option value='Tijara'> Tijara </option> 
<option value='Todaraisingh'> Todaraisingh </option> 
<option value='Tonk'> Tonk </option> 
<option value='Udaipur'> Udaipur </option> 
<option value='Udaipurwati'> Udaipurwati </option> 
<option value='Uniayara'> Uniayara </option> 
<option value='Vallabhnagar'> Vallabhnagar </option> 
<option value='Viratnagar Barmiak'> Viratnagar Barmiak </option> 
<option value='Be'> Be </option> 
<option value='Bhurtuk'> Bhurtuk </option> 
<option value='Chhubakha'> Chhubakha </option> 
<option value='Chidam'> Chidam </option> 
<option value='Chubha'> Chubha </option> 
<option value='Chumikteng'> Chumikteng </option> 
<option value='Dentam'> Dentam </option> 
<option value='Dikchu'> Dikchu </option> 
<option value='Dzongri'> Dzongri </option> 
<option value='Gangtok'> Gangtok </option> 
<option value='Gauzing'> Gauzing </option> 
<option value='Gyalshing'> Gyalshing </option> 
<option value='Hema'> Hema </option> 
<option value='Kerung'> Kerung </option> 
<option value='Lachen'> Lachen </option> 
<option value='Lachung'> Lachung </option> 
<option value='Lema'> Lema </option> 
<option value='Lingtam'> Lingtam </option> 
<option value='Lungthu'> Lungthu </option> 
<option value='Mangan'> Mangan </option> 
<option value='Namchi'> Namchi </option> 
<option value='Namthang'> Namthang </option> 
<option value='Nanga'> Nanga </option> 
<option value='Nantang'> Nantang </option> 
<option value='Naya Bazar'> Naya Bazar </option> 
<option value='Padamachen'> Padamachen </option> 
<option value='Pakhyong'> Pakhyong </option> 
<option value='Pemayangtse'> Pemayangtse </option> 
<option value='Phensang'> Phensang </option> 
<option value='Rangli'> Rangli </option> 
<option value='Rinchingpong'> Rinchingpong </option> 
<option value='Sakyong'> Sakyong </option> 
<option value='Samdong'> Samdong </option> 
<option value='Singtam'> Singtam </option> 
<option value='Siniolchu'> Siniolchu </option> 
<option value='Sombari'> Sombari </option> 
<option value='Soreng'> Soreng </option> 
<option value='Sosing'> Sosing </option> 
<option value='Tekhug'> Tekhug </option> 
<option value='Temi'> Temi </option> 
<option value='Tsetang'> Tsetang </option> 
<option value='Tsomgo'> Tsomgo </option> 
<option value='Tumlong'> Tumlong </option> 
<option value='Yangang'> Yangang </option> 
<option value='Yumtang Ambasamudram'> Yumtang Ambasamudram </option> 
<option value='Anamali'> Anamali </option> 
<option value='Arakandanallur'> Arakandanallur </option> 
<option value='Arantangi'> Arantangi </option> 
<option value='Aravakurichi'> Aravakurichi </option> 
<option value='Ariyalur'> Ariyalur </option> 
<option value='Arkonam'> Arkonam </option> 
<option value='Arni'> Arni </option> 
<option value='Aruppukottai'> Aruppukottai </option> 
<option value='Attur'> Attur </option> 
<option value='Avanashi'> Avanashi </option> 
<option value='Batlagundu'> Batlagundu </option> 
<option value='Bhavani'> Bhavani </option> 
<option value='Chengalpattu'> Chengalpattu </option> 
<option value='Chengam'> Chengam </option> 
<option value='Chennai'> Chennai </option> 
<option value='Chidambaram'> Chidambaram </option> 
<option value='Chingleput'> Chingleput </option> 
<option value='Coimbatore'> Coimbatore </option> 
<option value='Courtallam'> Courtallam </option> 
<option value='Cuddalore'> Cuddalore </option> 
<option value='Cumbum'> Cumbum </option> 
<option value='Denkanikoitah'> Denkanikoitah </option> 
<option value='Devakottai'> Devakottai </option> 
<option value='Dharampuram'> Dharampuram </option> 
<option value='Dharmapuri'> Dharmapuri </option> 
<option value='Dindigul'> Dindigul </option> 
<option value='Erode'> Erode </option> 
<option value='Gingee'> Gingee </option> 
<option value='Gobichettipalayam'> Gobichettipalayam </option> 
<option value='Gudalur'> Gudalur </option> 
<option value='Gudiyatham'> Gudiyatham </option> 
<option value='Harur'> Harur </option> 
<option value='Hosur'> Hosur </option> 
<option value='Jayamkondan'> Jayamkondan </option> 
<option value='Kallkurichi'> Kallkurichi </option> 
<option value='Kanchipuram'> Kanchipuram </option> 
<option value='Kangayam'> Kangayam </option> 
<option value='Kanyakumari'> Kanyakumari </option> 
<option value='Karaikal'> Karaikal </option> 
<option value='Karaikudi'> Karaikudi </option> 
<option value='Karur'> Karur </option> 
<option value='Keeranur'> Keeranur </option> 
<option value='Kodaikanal'> Kodaikanal </option> 
<option value='Kodumudi'> Kodumudi </option> 
<option value='Kotagiri'> Kotagiri </option> 
<option value='Kovilpatti'> Kovilpatti </option> 
<option value='Krishnagiri'> Krishnagiri </option> 
<option value='Kulithalai'> Kulithalai </option> 
<option value='Kumbakonam'> Kumbakonam </option> 
<option value='Kuzhithurai'> Kuzhithurai </option> 
<option value='Madurai'> Madurai </option> 
<option value='Madurantgam'> Madurantgam </option> 
<option value='Manamadurai'> Manamadurai </option> 
<option value='Manaparai'> Manaparai </option> 
<option value='Mannargudi'> Mannargudi </option> 
<option value='Mayiladuthurai'> Mayiladuthurai </option> 
<option value='Mayiladutjurai'> Mayiladutjurai </option> 
<option value='Mettupalayam'> Mettupalayam </option> 
<option value='Metturdam'> Metturdam </option> 
<option value='Mudukulathur'> Mudukulathur </option> 
<option value='Mulanur'> Mulanur </option> 
<option value='Musiri'> Musiri </option> 
<option value='Nagapattinam'> Nagapattinam </option> 
<option value='Nagarcoil'> Nagarcoil </option> 
<option value='Namakkal'> Namakkal </option> 
<option value='Nanguneri'> Nanguneri </option> 
<option value='Natham'> Natham </option> 
<option value='Neyveli'> Neyveli </option> 
<option value='Nilgiris'> Nilgiris </option> 
<option value='Oddanchatram'> Oddanchatram </option> 
<option value='Omalpur'> Omalpur </option> 
<option value='Ootacamund'> Ootacamund </option> 
<option value='Ooty'> Ooty </option> 
<option value='Orathanad'> Orathanad </option> 
<option value='Palacode'> Palacode </option> 
<option value='Palani'> Palani </option> 
<option value='Palladum'> Palladum </option> 
<option value='Papanasam'> Papanasam </option> 
<option value='Paramakudi'> Paramakudi </option> 
<option value='Pattukottai'> Pattukottai </option> 
<option value='Perambalur'> Perambalur </option> 
<option value='Perundurai'> Perundurai </option> 
<option value='Pollachi'> Pollachi </option> 
<option value='Polur'> Polur </option> 
<option value='Pondicherry'> Pondicherry </option> 
<option value='Ponnamaravathi'> Ponnamaravathi </option> 
<option value='Ponneri'> Ponneri </option> 
<option value='Pudukkottai'> Pudukkottai </option> 
<option value='Rajapalayam'> Rajapalayam </option> 
<option value='Ramanathapuram'> Ramanathapuram </option> 
<option value='Rameshwaram'> Rameshwaram </option> 
<option value='Ranipet'> Ranipet </option> 
<option value='Rasipuram'> Rasipuram </option> 
<option value='Salem'> Salem </option> 
<option value='Sankagiri'> Sankagiri </option> 
<option value='Sankaran'> Sankaran </option> 
<option value='Sathiyamangalam'> Sathiyamangalam </option> 
<option value='Sivaganga'> Sivaganga </option> 
<option value='Sivakasi'> Sivakasi </option> 
<option value='Sriperumpudur'> Sriperumpudur </option> 
<option value='Srivaikundam'> Srivaikundam </option> 
<option value='Tenkasi'> Tenkasi </option> 
<option value='Thanjavur'> Thanjavur </option> 
<option value='Theni'> Theni </option> 
<option value='Thirumanglam'> Thirumanglam </option> 
<option value='Thiruraipoondi'> Thiruraipoondi </option> 
<option value='Thoothukudi'> Thoothukudi </option> 
<option value='Thuraiyure'> Thuraiyure </option> 
<option value='Tindivanam'> Tindivanam </option> 
<option value='Tiruchendur'> Tiruchendur </option> 
<option value='Tiruchengode'> Tiruchengode </option> 
<option value='Tiruchirappalli'> Tiruchirappalli </option> 
<option value='Tirunelvelli'> Tirunelvelli </option> 
<option value='Tirupathur'> Tirupathur </option> 
<option value='Tirupur'> Tirupur </option> 
<option value='Tiruttani'> Tiruttani </option> 
<option value='Tiruvallur'> Tiruvallur </option> 
<option value='Tiruvannamalai'> Tiruvannamalai </option> 
<option value='Tiruvarur'> Tiruvarur </option> 
<option value='Tiruvellore'> Tiruvellore </option> 
<option value='Tiruvettipuram'> Tiruvettipuram </option> 
<option value='Trichy'> Trichy </option> 
<option value='Tuticorin'> Tuticorin </option> 
<option value='Udumalpet'> Udumalpet </option> 
<option value='Ulundurpet'> Ulundurpet </option> 
<option value='Usiliampatti'> Usiliampatti </option> 
<option value='Uthangarai'> Uthangarai </option> 
<option value='Valapady'> Valapady </option> 
<option value='Valliyoor'> Valliyoor </option> 
<option value='Vaniyambadi'> Vaniyambadi </option> 
<option value='Vedasandur'> Vedasandur </option> 
<option value='Vellore'> Vellore </option> 
<option value='Velur'> Velur </option> 
<option value='Vilathikulam'> Vilathikulam </option> 
<option value='Villupuram'> Villupuram </option> 
<option value='Virudhachalam'> Virudhachalam </option> 
<option value='Virudhunagar'> Virudhunagar </option> 
<option value='Wandiwash'> Wandiwash </option> 
<option value='Yercaud Agartala'> Yercaud Agartala </option> 
<option value='Ambasa'> Ambasa </option> 
<option value='Bampurbari'> Bampurbari </option> 
<option value='Belonia'> Belonia </option> 
<option value='Dhalai'> Dhalai </option> 
<option value='Dharam Nagar'> Dharam Nagar </option> 
<option value='Kailashahar'> Kailashahar </option> 
<option value='Kamal Krishnabari'> Kamal Krishnabari </option> 
<option value='Khopaiyapara'> Khopaiyapara </option> 
<option value='Khowai'> Khowai </option> 
<option value='Phuldungsei'> Phuldungsei </option> 
<option value='Radha Kishore Pur'> Radha Kishore Pur </option> 
<option value='Tripura Achhnera'> Tripura Achhnera </option> 
<option value='Agra'> Agra </option> 
<option value='Akbarpur'> Akbarpur </option> 
<option value='Aliganj'> Aliganj </option> 
<option value='Aligarh'> Aligarh </option> 
<option value='Allahabad'> Allahabad </option> 
<option value='Ambedkar Nagar'> Ambedkar Nagar </option> 
<option value='Amethi'> Amethi </option> 
<option value='Amiliya'> Amiliya </option> 
<option value='Amroha'> Amroha </option> 
<option value='Anola'> Anola </option> 
<option value='Atrauli'> Atrauli </option> 
<option value='Auraiya'> Auraiya </option> 
<option value='Azamgarh'> Azamgarh </option> 
<option value='Baberu'> Baberu </option> 
<option value='Badaun'> Badaun </option> 
<option value='Baghpat'> Baghpat </option> 
<option value='Bagpat'> Bagpat </option> 
<option value='Baheri'> Baheri </option> 
<option value='Bahraich'> Bahraich </option> 
<option value='Ballia'> Ballia </option> 
<option value='Balrampur'> Balrampur </option> 
<option value='Banda'> Banda </option> 
<option value='Bansdeeh'> Bansdeeh </option> 
<option value='Bansgaon'> Bansgaon </option> 
<option value='Bansi'> Bansi </option> 
<option value='Barabanki'> Barabanki </option> 
<option value='Bareilly'> Bareilly </option> 
<option value='Basti'> Basti </option> 
<option value='Bhadohi'> Bhadohi </option> 
<option value='Bharthana'> Bharthana </option> 
<option value='Bharwari'> Bharwari </option> 
<option value='Bhogaon'> Bhogaon </option> 
<option value='Bhognipur'> Bhognipur </option> 
<option value='Bidhuna'> Bidhuna </option> 
<option value='Bijnore'> Bijnore </option> 
<option value='Bikapur'> Bikapur </option> 
<option value='Bilari'> Bilari </option> 
<option value='Bilgram'> Bilgram </option> 
<option value='Bilhaur'> Bilhaur </option> 
<option value='Bindki'> Bindki </option> 
<option value='Bisalpur'> Bisalpur </option> 
<option value='Bisauli'> Bisauli </option> 
<option value='Biswan'> Biswan </option> 
<option value='Budaun'> Budaun </option> 
<option value='Budhana'> Budhana </option> 
<option value='Bulandshahar'> Bulandshahar </option> 
<option value='Bulandshahr'> Bulandshahr </option> 
<option value='Capianganj'> Capianganj </option> 
<option value='Chakia'> Chakia </option> 
<option value='Chandauli'> Chandauli </option> 
<option value='Charkhari'> Charkhari </option> 
<option value='Chhata'> Chhata </option> 
<option value='Chhibramau'> Chhibramau </option> 
<option value='Chirgaon'> Chirgaon </option> 
<option value='Chitrakoot'> Chitrakoot </option> 
<option value='Chunur'> Chunur </option> 
<option value='Dadri'> Dadri </option> 
<option value='Dalmau'> Dalmau </option> 
<option value='Dataganj'> Dataganj </option> 
<option value='Debai'> Debai </option> 
<option value='Deoband'> Deoband </option> 
<option value='Deoria'> Deoria </option> 
<option value='Derapur'> Derapur </option> 
<option value='Dhampur'> Dhampur </option> 
<option value='Domariyaganj'> Domariyaganj </option> 
<option value='Dudhi'> Dudhi </option> 
<option value='Etah'> Etah </option> 
<option value='Etawah'> Etawah </option> 
<option value='Faizabad'> Faizabad </option> 
<option value='Farrukhabad'> Farrukhabad </option> 
<option value='Fatehpur'> Fatehpur </option> 
<option value='Firozabad'> Firozabad </option> 
<option value='Garauth'> Garauth </option> 
<option value='Garhmukteshwar'> Garhmukteshwar </option> 
<option value='Gautam Buddha Nagar'> Gautam Buddha Nagar </option> 
<option value='Ghatampur'> Ghatampur </option> 
<option value='Ghaziabad'> Ghaziabad </option> 
<option value='Ghazipur'> Ghazipur </option> 
<option value='Ghosi'> Ghosi </option> 
<option value='Gonda'> Gonda </option> 
<option value='Gorakhpur'> Gorakhpur </option> 
<option value='Gunnaur'> Gunnaur </option> 
<option value='Haidergarh'> Haidergarh </option> 
<option value='Hamirpur'> Hamirpur </option> 
<option value='Hapur'> Hapur </option> 
<option value='Hardoi'> Hardoi </option> 
<option value='Harraiya'> Harraiya </option> 
<option value='Hasanganj'> Hasanganj </option> 
<option value='Hasanpur'> Hasanpur </option> 
<option value='Hathras'> Hathras </option> 
<option value='Jalalabad'> Jalalabad </option> 
<option value='Jalaun'> Jalaun </option> 
<option value='Jalesar'> Jalesar </option> 
<option value='Jansath'> Jansath </option> 
<option value='Jarar'> Jarar </option> 
<option value='Jasrana'> Jasrana </option> 
<option value='Jaunpur'> Jaunpur </option> 
<option value='Jhansi'> Jhansi </option> 
<option value='Jyotiba Phule Nagar'> Jyotiba Phule Nagar </option> 
<option value='Kadipur'> Kadipur </option> 
<option value='Kaimganj'> Kaimganj </option> 
<option value='Kairana'> Kairana </option> 
<option value='Kaisarganj'> Kaisarganj </option> 
<option value='Kalpi'> Kalpi </option> 
<option value='Kannauj'> Kannauj </option> 
<option value='Kanpur'> Kanpur </option> 
<option value='Karchhana'> Karchhana </option> 
<option value='Karhal'> Karhal </option> 
<option value='Karvi'> Karvi </option> 
<option value='Kasganj'> Kasganj </option> 
<option value='Kaushambi'> Kaushambi </option> 
<option value='Kerakat'> Kerakat </option> 
<option value='Khaga'> Khaga </option> 
<option value='Khair'> Khair </option> 
<option value='Khalilabad'> Khalilabad </option> 
<option value='Kheri'> Kheri </option> 
<option value='Konch'> Konch </option> 
<option value='Kumaon'> Kumaon </option> 
<option value='Kunda'> Kunda </option> 
<option value='Kushinagar'> Kushinagar </option> 
<option value='Lalganj'> Lalganj </option> 
<option value='Lalitpur'> Lalitpur </option> 
<option value='Lucknow'> Lucknow </option> 
<option value='Machlishahar'> Machlishahar </option> 
<option value='Maharajganj'> Maharajganj </option> 
<option value='Mahoba'> Mahoba </option> 
<option value='Mainpuri'> Mainpuri </option> 
<option value='Malihabad'> Malihabad </option> 
<option value='Mariyahu'> Mariyahu </option> 
<option value='Math'> Math </option> 
<option value='Mathura'> Mathura </option> 
<option value='Mau'> Mau </option> 
<option value='Maudaha'> Maudaha </option> 
<option value='Maunathbhanjan'> Maunathbhanjan </option> 
<option value='Mauranipur'> Mauranipur </option> 
<option value='Mawana'> Mawana </option> 
<option value='Meerut'> Meerut </option> 
<option value='Mehraun'> Mehraun </option> 
<option value='Meja'> Meja </option> 
<option value='Mirzapur'> Mirzapur </option> 
<option value='Misrikh'> Misrikh </option> 
<option value='Modinagar'> Modinagar </option> 
<option value='Mohamdabad'> Mohamdabad </option> 
<option value='Mohamdi'> Mohamdi </option> 
<option value='Moradabad'> Moradabad </option> 
<option value='Musafirkhana'> Musafirkhana </option> 
<option value='Muzaffarnagar'> Muzaffarnagar </option> 
<option value='Nagina'> Nagina </option> 
<option value='Najibabad'> Najibabad </option> 
<option value='Nakur'> Nakur </option> 
<option value='Nanpara'> Nanpara </option> 
<option value='Naraini'> Naraini </option> 
<option value='Naugarh'> Naugarh </option> 
<option value='Nawabganj'> Nawabganj </option> 
<option value='Nighasan'> Nighasan </option> 
<option value='Noida'> Noida </option> 
<option value='Orai'> Orai </option> 
<option value='Padrauna'> Padrauna </option> 
<option value='Pahasu'> Pahasu </option> 
<option value='Patti'> Patti </option> 
<option value='Pharenda'> Pharenda </option> 
<option value='Phoolpur'> Phoolpur </option> 
<option value='Phulpur'> Phulpur </option> 
<option value='Pilibhit'> Pilibhit </option> 
<option value='Pitamberpur'> Pitamberpur </option> 
<option value='Powayan'> Powayan </option> 
<option value='Pratapgarh'> Pratapgarh </option> 
<option value='Puranpur'> Puranpur </option> 
<option value='Purwa'> Purwa </option> 
<option value='Raibareli'> Raibareli </option> 
<option value='Rampur'> Rampur </option> 
<option value='Ramsanehi Ghat'> Ramsanehi Ghat </option> 
<option value='Rasara'> Rasara </option> 
<option value='Rath'> Rath </option> 
<option value='Robertsganj'> Robertsganj </option> 
<option value='Sadabad'> Sadabad </option> 
<option value='Safipur'> Safipur </option> 
<option value='Sagri'> Sagri </option> 
<option value='Saharanpur'> Saharanpur </option> 
<option value='Sahaswan'> Sahaswan </option> 
<option value='Sahjahanpur'> Sahjahanpur </option> 
<option value='Saidpur'> Saidpur </option> 
<option value='Salempur'> Salempur </option> 
<option value='Salon'> Salon </option> 
<option value='Sambhal'> Sambhal </option> 
<option value='Sandila'> Sandila </option> 
<option value='Sant Kabir Nagar'> Sant Kabir Nagar </option> 
<option value='Sant Ravidas Nagar'> Sant Ravidas Nagar </option> 
<option value='Sardhana'> Sardhana </option> 
<option value='Shahabad'> Shahabad </option> 
<option value='Shahganj'> Shahganj </option> 
<option value='Shahjahanpur'> Shahjahanpur </option> 
<option value='Shikohabad'> Shikohabad </option> 
<option value='Shravasti'> Shravasti </option> 
<option value='Siddharthnagar'> Siddharthnagar </option> 
<option value='Sidhauli'> Sidhauli </option> 
<option value='Sikandra Rao'> Sikandra Rao </option> 
<option value='Sikandrabad'> Sikandrabad </option> 
<option value='Sitapur'> Sitapur </option> 
<option value='Siyana'> Siyana </option> 
<option value='Sonbhadra'> Sonbhadra </option> 
<option value='Soraon'> Soraon </option> 
<option value='Sultanpur'> Sultanpur </option> 
<option value='Tanda'> Tanda </option> 
<option value='Tarabganj'> Tarabganj </option> 
<option value='Tilhar'> Tilhar </option> 
<option value='Unnao'> Unnao </option> 
<option value='Utraula'> Utraula </option> 
<option value='Varanasi'> Varanasi </option> 
<option value='Zamania Almora'> Zamania Almora </option> 
<option value='Bageshwar'> Bageshwar </option> 
<option value='Bhatwari'> Bhatwari </option> 
<option value='Chakrata'> Chakrata </option> 
<option value='Chamoli'> Chamoli </option> 
<option value='Champawat'> Champawat </option> 
<option value='Dehradun'> Dehradun </option> 
<option value='Deoprayag'> Deoprayag </option> 
<option value='Dharchula'> Dharchula </option> 
<option value='Dunda'> Dunda </option> 
<option value='Haldwani'> Haldwani </option> 
<option value='Haridwar'> Haridwar </option> 
<option value='Joshimath'> Joshimath </option> 
<option value='Karan Prayag'> Karan Prayag </option> 
<option value='Kashipur'> Kashipur </option> 
<option value='Khatima'> Khatima </option> 
<option value='Kichha'> Kichha </option> 
<option value='Lansdown'> Lansdown </option> 
<option value='Munsiari'> Munsiari </option> 
<option value='Mussoorie'> Mussoorie </option> 
<option value='Nainital'> Nainital </option> 
<option value='Pantnagar'> Pantnagar </option> 
<option value='Partapnagar'> Partapnagar </option> 
<option value='Pauri Garhwal'> Pauri Garhwal </option> 
<option value='Pithoragarh'> Pithoragarh </option> 
<option value='Purola'> Purola </option> 
<option value='Rajgarh'> Rajgarh </option> 
<option value='Ranikhet'> Ranikhet </option> 
<option value='Roorkee'> Roorkee </option> 
<option value='Rudraprayag'> Rudraprayag </option> 
<option value='Tehri Garhwal'> Tehri Garhwal </option> 
<option value='Udham Singh Nagar'> Udham Singh Nagar </option> 
<option value='Ukhimath'> Ukhimath </option> 
<option value='Uttarkashi Adra'> Uttarkashi Adra </option> 
<option value='Alipurduar'> Alipurduar </option> 
<option value='Amlagora'> Amlagora </option> 
<option value='Arambagh'> Arambagh </option> 
<option value='Asansol'> Asansol </option> 
<option value='Balurghat'> Balurghat </option> 
<option value='Bankura'> Bankura </option> 
<option value='Bardhaman'> Bardhaman </option> 
<option value='Basirhat'> Basirhat </option> 
<option value='Berhampur'> Berhampur </option> 
<option value='Bethuadahari'> Bethuadahari </option> 
<option value='Birbhum'> Birbhum </option> 
<option value='Birpara'> Birpara </option> 
<option value='Bishanpur'> Bishanpur </option> 
<option value='Bolpur'> Bolpur </option> 
<option value='Bongoan'> Bongoan </option> 
<option value='Bulbulchandi'> Bulbulchandi </option> 
<option value='Burdwan'> Burdwan </option> 
<option value='Calcutta'> Calcutta </option> 
<option value='Canning'> Canning </option> 
<option value='Champadanga'> Champadanga </option> 
<option value='Contai'> Contai </option> 
<option value='Cooch Behar'> Cooch Behar </option> 
<option value='Daimond Harbour'> Daimond Harbour </option> 
<option value='Dalkhola'> Dalkhola </option> 
<option value='Dantan'> Dantan </option> 
<option value='Darjeeling'> Darjeeling </option> 
<option value='Dhaniakhali'> Dhaniakhali </option> 
<option value='Dhuliyan'> Dhuliyan </option> 
<option value='Dinajpur'> Dinajpur </option> 
<option value='Dinhata'> Dinhata </option> 
<option value='Durgapur'> Durgapur </option> 
<option value='Gangajalghati'> Gangajalghati </option> 
<option value='Gangarampur'> Gangarampur </option> 
<option value='Ghatal'> Ghatal </option> 
<option value='Guskara'> Guskara </option> 
<option value='Habra'> Habra </option> 
<option value='Haldia'> Haldia </option> 
<option value='Harirampur'> Harirampur </option> 
<option value='Harishchandrapur'> Harishchandrapur </option> 
<option value='Hooghly'> Hooghly </option> 
<option value='Howrah'> Howrah </option> 
<option value='Islampur'> Islampur </option> 
<option value='Jagatballavpur'> Jagatballavpur </option> 
<option value='Jalpaiguri'> Jalpaiguri </option> 
<option value='Jhalda'> Jhalda </option> 
<option value='Jhargram'> Jhargram </option> 
<option value='Kakdwip'> Kakdwip </option> 
<option value='Kalchini'> Kalchini </option> 
<option value='Kalimpong'> Kalimpong </option> 
<option value='Kalna'> Kalna </option> 
<option value='Kandi'> Kandi </option> 
<option value='Karimpur'> Karimpur </option> 
<option value='Katwa'> Katwa </option> 
<option value='Kharagpur'> Kharagpur </option> 
<option value='Khatra'> Khatra </option> 
<option value='Krishnanagar'> Krishnanagar </option> 
<option value='Mal Bazar'> Mal Bazar </option> 
<option value='Malda'> Malda </option> 
<option value='Manbazar'> Manbazar </option> 
<option value='Mathabhanga'> Mathabhanga </option> 
<option value='Medinipur'> Medinipur </option> 
<option value='Mekhliganj'> Mekhliganj </option> 
<option value='Mirzapur'> Mirzapur </option> 
<option value='Murshidabad'> Murshidabad </option> 
<option value='Nadia'> Nadia </option> 
<option value='Nagarakata'> Nagarakata </option> 
<option value='Nalhati'> Nalhati </option> 
<option value='Nayagarh'> Nayagarh </option> 
<option value='Parganas'> Parganas </option> 
<option value='Purulia'> Purulia </option> 
<option value='Raiganj'> Raiganj </option> 
<option value='Rampur Hat'> Rampur Hat </option> 
<option value='Ranaghat'> Ranaghat </option> 
<option value='Seharabazar'> Seharabazar </option> 
<option value='Siliguri'> Siliguri </option> 
<option value='Suri'> Suri </option> 
<option value='Takipur'> Takipur </option> 
<option value='Tamluk'> Tamluk</option> 
<option value='undefined'>undefined</option> 
                     </select>
                   </div>
                   
                    
                     <div class="form-group">
                      <label for="">Business Location - PIN <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" value="" name="pin" pattern="[0-9]{6}"  required  title="Please enter your correct PIN" >
                    </div>
                 
                    
                    <div class="form-group">
                          <label>Business Complete Address <span style="color:red;">*</span></label>
                          <div class="form-group">
                            <label class="bmd-label-floating">  </label>
                            <textarea name="address" class="form-control" rows="5" required></textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <label>Business Caption <span style="color:red;">*</span></label>
                          <div class="form-group">
                            <label class="bmd-label-floating">  </label>
                            <textarea name="caption" class="form-control" rows="5" required></textarea>
                          </div>
                        </div>
                              
                </div>
                
              </div>
            </div>


            <div class="col-md-4">
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
                      <input type="text" class="form-control" name="fullname" value="" required>
                    </div>
                    <div class="form-group">
                      <label for="">Mobile Number <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" name="mobileno" value="" name="phone" pattern="[6789][0-9]{9}" title="Please enter a valid Mobile number" required>
                    </div>
                    <div class="form-group">
                      <label for="">Email <span style="color:red;">*</span></label>
                      <input type="email" class="form-control" name="email" value="" required>
                    </div>
                    <div class="form-group">
                      <label for="">Password <span style="color:red;">*</span></label>
                      <input type="password" class="form-control" name="password" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required>
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
                  <h4 class="card-title">Select Business Location <span style="color:red;">* Required</span></h4>
                </div>
                <div class="card-body ">
                    <div id="googleMap" style="height: 320px;"></div>
                    <input type='hidden' name='lat' id='lat'>  
                    <input type='hidden' name='lng' id='lng'> 
                    <div class="form-group mt-4">
                      <label for="">Latitude </label>
                      <input type="number" class="form-control" id="custom_latitude" value="" >
                    </div>
                    <div class="form-group">
                      <label for="">Longitude </label>
                      <input type="number" class="form-control" id="custom_longitude" value="" >
                    </div>
                    <button onclick="custom_initialize()"  type="button" class="btn btn-fill btn-rose btn-block">Point On Map</button>
                </div>
              </div>

            </div>


            <div class="col-md-4">
                <div class="card card-profile">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">add_a_photo</i>
                            </div>
                            <h4 class="card-title">Select Business Logo <span style="color:red;">* Required</span></h4>
                        </div>
                        <div class="card-body">
                 <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                       <div class="fileinput-new thumbnail">
                         <img src="uploads/blog/image.png" alt="...">
                       </div>
                       <div class="fileinput-preview fileinput-exists thumbnail"></div>
                       <div>
                      
                         <span class="btn btn-rose btn-round btn-file">
                           <span class="fileinput-new">Select image</span>
                           <span class="fileinput-exists">Change</span>
                           <input type="file" name="profile-pic" required />
                         </span>
                   
                       </div>
                     </div>
                 
               </div>
                </div>
            </div>
            

           


            </div>

            <div class="col-md-12">
                <div class="card ">
                    <div class="card-footer">
                          <button disabled id="add-vendor" name="add-vendor" type="submit" class="btn btn-fill btn-rose btn-block">Add Vendor</button>
                    </div>
                </div>
            </div>
         
          </div>

        </form>
        </div>
      </div>
      

      <script>
var mylat, mylong;
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    console.log("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  mylat = position.coords.latitude ; 
  mylong = position.coords.longitude;
  
initialize();
}



getLocation();

function initialize() {





var myLatlng = new google.maps.LatLng(mylat,mylong);
  var mapProp = {
    center:myLatlng,
    zoom:15,
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
    $('#add-vendor').removeAttr("disabled");
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



function custom_initialize() {


var c_mylat = document.getElementById('custom_latitude').value;
var c_mylong = document.getElementById('custom_longitude').value;

if(c_mylat == "" || c_mylong == "" || c_mylat.length == "" || c_mylong.length == "")
{
    alert("Please specify latitude and longitude");
    return;
}

var myLatlng = new google.maps.LatLng(c_mylat,c_mylong);
  var mapProp = {
    center:myLatlng,
    zoom:15,
    mapTypeId:google.maps.MapTypeId.ROADMAP
      
  };
  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'My Business Location',
      draggable:true  
  });
    document.getElementById('lat').value= c_mylat
    document.getElementById('lng').value= c_mylong
    $('#add-vendor').removeAttr("disabled");
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


</script>



      <?php require 'footer.php' ?>