<?php 
require '../conn.php'; 

session_start();
$me = $_SESSION["admin-login"];
if(!isset($me))
{
  header("location: index.php");
}






if(basename($_SERVER['PHP_SELF']) == "edit-vendor.php")
{
    if($_GET["editvendor"])
    {
      $vendor_edit =  $_GET["editvendor"];
    }
    else
    {
      header("Location: all-vendors.php");
    }
}





if(basename($_SERVER['PHP_SELF']) == "edit-food.php")
{
    if($_GET["editfood"])
    {
      $food_edit =  $_GET["editfood"];
    }
    else
    {
      header("Location: all-foods.php");
    }
}



if(basename($_SERVER['PHP_SELF']) == "edit-customer.php")
{
    if($_GET["editcustomer"])
    {
      $customer_edit =  $_GET["editcustomer"];
    }
    else
    {
      header("Location: all-customers.php");
    }
}



if(basename($_SERVER['PHP_SELF']) == "edit-schedule.php")
{
    if($_GET["editschedule"])
    {
      $assoc_vendor_id =  $_GET["editschedule"];
    }
    else
    {
      header("Location: all-vendors.php");
    }
}


$get_dir = explode("/", $_SERVER["PHP_SELF"]);
unset($get_dir[count($get_dir)-1]);
$main_url = "http://" . $_SERVER["HTTP_HOST"] ;
$full_url = $main_url . implode("/",$get_dir);
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Wah Meal Admin
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap-material-design.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="assets/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="assets/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="assets/js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="assets/js/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="assets/js/plugins/jquery-jvectormap.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="assets/js/plugins/arrive.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtUmkoqsmGSa-k15hhbr75lEj1r-ItKzE&v=3"></script>
<!-- Chartist JS -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/demo/demo.js"></script>
<script>
$(document).ready(function() {
  $().ready(function() {
    $sidebar = $('.sidebar');

    $sidebar_img_container = $sidebar.find('.sidebar-background');

    $full_page = $('.full-page');

    $sidebar_responsive = $('body > .navbar-collapse');

    window_width = $(window).width();

    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

    if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
      if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
        $('.fixed-plugin .dropdown').addClass('open');
      }

    }

    $('.fixed-plugin a').click(function(event) {
      // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
      if ($(this).hasClass('switch-trigger')) {
        if (event.stopPropagation) {
          event.stopPropagation();
        } else if (window.event) {
          window.event.cancelBubble = true;
        }
      }
    });

    $('.fixed-plugin .active-color span').click(function() {
      $full_page_background = $('.full-page-background');

      $(this).siblings().removeClass('active');
      $(this).addClass('active');

      var new_color = $(this).data('color');

      if ($sidebar.length != 0) {
        $sidebar.attr('data-color', new_color);
      }

      if ($full_page.length != 0) {
        $full_page.attr('filter-color', new_color);
      }

      if ($sidebar_responsive.length != 0) {
        $sidebar_responsive.attr('data-color', new_color);
      }
    });

    $('.fixed-plugin .background-color .badge').click(function() {
      $(this).siblings().removeClass('active');
      $(this).addClass('active');

      var new_color = $(this).data('background-color');

      if ($sidebar.length != 0) {
        $sidebar.attr('data-background-color', new_color);
      }
    });

    $('.fixed-plugin .img-holder').click(function() {
      $full_page_background = $('.full-page-background');

      $(this).parent('li').siblings().removeClass('active');
      $(this).parent('li').addClass('active');


      var new_image = $(this).find("img").attr('src');

      if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
        $sidebar_img_container.fadeOut('fast', function() {
          $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
          $sidebar_img_container.fadeIn('fast');
        });
      }

      if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

        $full_page_background.fadeOut('fast', function() {
          $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          $full_page_background.fadeIn('fast');
        });
      }

      if ($('.switch-sidebar-image input:checked').length == 0) {
        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
      }

      if ($sidebar_responsive.length != 0) {
        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
      }
    });

    $('.switch-sidebar-image input').change(function() {
      $full_page_background = $('.full-page-background');

      $input = $(this);

      if ($input.is(':checked')) {
        if ($sidebar_img_container.length != 0) {
          $sidebar_img_container.fadeIn('fast');
          $sidebar.attr('data-image', '#');
        }

        if ($full_page_background.length != 0) {
          $full_page_background.fadeIn('fast');
          $full_page.attr('data-image', '#');
        }

        background_image = true;
      } else {
        if ($sidebar_img_container.length != 0) {
          $sidebar.removeAttr('data-image');
          $sidebar_img_container.fadeOut('fast');
        }

        if ($full_page_background.length != 0) {
          $full_page.removeAttr('data-image', '#');
          $full_page_background.fadeOut('fast');
        }

        background_image = false;
      }
    });

    $('.switch-sidebar-mini input').change(function() {
      $body = $('body');

      $input = $(this);

      if (md.misc.sidebar_mini_active == true) {
        $('body').removeClass('sidebar-mini');
        md.misc.sidebar_mini_active = false;

        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

      } else {

        $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

        setTimeout(function() {
          $('body').addClass('sidebar-mini');

          md.misc.sidebar_mini_active = true;
        }, 300);
      }

      // we simulate the window Resize so the charts will get updated in realtime.
      var simulateWindowResize = setInterval(function() {
        window.dispatchEvent(new Event('resize'));
      }, 180);

      // we stop the simulation of Window Resize after the animations are completed
      setTimeout(function() {
        clearInterval(simulateWindowResize);
      }, 1000);

    });
  });
});
</script>
<script>
$(document).ready(function() {
  // Javascript method's body can be found in assets/js/demos.js
  md.initDashboardPageCharts();

  md.initVectorMap();

});
</script>
<script>
    $(document).ready(function() {
      md.checkFullPageBackgroundImage();
    });
  </script>




</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="assets/img/sidebar-1.jpg">
     
      <div class="logo"><a href="" class="simple-text logo-mini">
         WA
        </a>
        <a href="../" class="simple-text logo-normal">
          Wah Meal Admin
        </a></div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="uploads/profile-image/admin.jpg" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
              My Profile
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                
                <li class="nav-item">
                  <a class="nav-link" href="profile.php">
                    <span class="sidebar-mini"> P </span>
                    <span class="sidebar-normal"> Edit Profile </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="logout.php">
                    <span class="sidebar-mini"> L </span>
                    <span class="sidebar-normal"> Log Out </span>
                  </a>
                </li>
               
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p> Dashboard </p>
            </a>
          </li>


          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#pagesVendor">
              <i class="material-icons">add_business</i>
              <p> Vendors
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="pagesVendor">
              <ul class="nav">
              <li class="nav-item ">
                  <a class="nav-link" href="add-vendor.php">
                  <i class="material-icons">playlist_add</i>
                    <span class="sidebar-normal"> Add Vendor </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="all-vendors.php">
                  <i class="material-icons">reorder</i>
                    <span class="sidebar-normal"> List Vendors </span>
                  </a>
                </li>
               
           
              </ul>
            </div>
          </li>


          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#pagesFoods">
              <i class="material-icons">brunch_dining</i>
              <p> Food Items
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="pagesFoods">
              <ul class="nav">
              <li class="nav-item ">
                  <a class="nav-link" href="add-food.php">
                  <i class="material-icons">playlist_add</i>
                    <span class="sidebar-normal"> Add Food </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="all-foods.php">
                  <i class="material-icons">reorder</i>
                    <span class="sidebar-normal"> List Foods </span>
                  </a>
                </li>
               
           
              </ul>
            </div>
          </li>


          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#pagesCustomer">
              <i class="material-icons">people_alt</i>
              <p> Customers
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="pagesCustomer">
              <ul class="nav">
              <li class="nav-item ">
                  <a class="nav-link" href="add-customer.php">
                  <i class="material-icons">playlist_add</i>
                    <span class="sidebar-normal"> Add Customer </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="all-customers.php">
                  <i class="material-icons">reorder</i>
                    <span class="sidebar-normal"> List Customers </span>
                  </a>
                </li>
               
           
              </ul>
            </div>
          </li>



          <li class="nav-item d-none ">
            <a class="nav-link" data-toggle="collapse" href="#pagesSubscription">
              <i class="material-icons">paid</i>
              <p> Subscription
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="pagesSubscription">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="subscription-package.php">
                  <i class="material-icons">more_time</i>
                    <span class="sidebar-normal"> Subscription Package </span>
                  </a>
                </li>

               
               
           
              </ul>
            </div>
          </li>



              <li class="nav-item ">
                  <a class="nav-link" href="all-orders.php">
                  <i class="material-icons">list_alt</i>
                    <p> Orders </p>
                  </a>
                </li>
                
                
                 <li class="nav-item ">
                  <a class="nav-link" href="unavailable_request.php">
                  <i class="material-icons">public_off</i>
                    <p> Unavailable Request </p>
                  </a>
                </li>


          <li class="nav-item ">
                  <a class="nav-link" href="settings.php">
                  <i class="material-icons">settings</i>
                    <p> Settings </p>
                  </a>
                </li>
         



      



    


        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Wah Meal Admin</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
         
        </div>
      </nav>