<?php require 'header.php' ?>




      <!-- End Navbar -->
      <div class="content">
        <div class="content">
          <div class="container-fluid">
          
            <h3>Sales</h3>
            
            <br>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-icon card-header-info">
                    <div class="card-icon">
                      <i class="material-icons">timeline</i>
                     
                    </div>
                    
                    <div class="row">
                      <div class="col-2">
                        <h4 class="card-title">Sales
                      <small> </small>
                    </h4>
                      </div>
                      <div class="col-10 mt-2">
                                            <form id="myForm" method="POST">
                                              <div class="row">
                                                <div class="col-5">
                                                                                                  <input class="form-control" id="start_date" name="start_date" type="date" value="">

                                                </div>
                                                <div class="col-5">
                                                                                                  <input class="form-control" id="end_date" name="end_date" type="date" value="">

                                                </div>
                                                <div class="col-2">
                                                                                                  <button type="submit" class="btn app-btn-secondary" style="height:39px;" ><i class="fa fa-search"></i></button>

                                                </div>
                                              </div>
                                            </form>
                      </div>
            </div>
                  </div>
                  <div class="card-body">
                    <div id="colouredRoundedLineChart" class="ct-chart"></div>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
      
      
      
      <?php
      
        $back_dates = array();
    $my_earning = array();
      
            $start_date = date("Y-m-d", strtotime('-29 day'));
            $end_date = date("Y-m-d");


                    if(isset($_POST['start_date']) && isset($_POST['end_date']) )
                    {
                        $start_date = date("Y-m-d", strtotime($_POST['start_date']));
                        $end_date = date("Y-m-d", strtotime($_POST['end_date']));
                    }
                   
            
           
      
            $sql = "SELECT DATE(subscription_date) AS subscription_date FROM `order_subscription` WHERE accept_reject = 1 AND is_paid = 1 AND DATE(subscription_date) BETWEEN DATE('".$start_date."') AND DATE('".$end_date."') GROUP BY DATE(subscription_date) ";
      
            $result = $conn->query($sql);
            
if ($result->num_rows > 0) {

   while( $row = $result->fetch_assoc())
   {

        $back_dates[] = date('d/m/Y', strtotime($row['subscription_date']));
        
        $dt = $row['subscription_date'];
        $sql_t = "SELECT SUM(subscription_price) as subscription_price FROM order_subscription WHERE accept_reject = 1 AND is_paid = 1  AND DATE(subscription_date) = DATE('$dt') ";
        $result_t = $conn->query($sql_t);
        if ($result_t->num_rows > 0) {
            $row_t = $result_t->fetch_assoc();

            $earning = $row_t['subscription_price'];


        }
        else
        {
            $earning = 0;

        }

        $my_earning[] = $earning;

   }
   

    }
      
      
      ?>
      
      
      
      <script>
          
          
          
           function salesChart() {
    if ($('#colouredRoundedLineChart').length != 0 ) {
      


      dataColouredRoundedLineChart = {
        labels: <?php echo json_encode($back_dates); ?>,
        series: [<?php echo json_encode($my_earning); ?>]
      };

      optionsColouredRoundedLineChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 10
        }),
        axisY: {
          showGrid: true,
          offset: 40
        },
        axisX: {
          showGrid: true,
        },
        low: 0,
        high: 25000,
        showPoint: true,
        height: '500px'
      };


      var colouredRoundedLineChart = new Chartist.Line('#colouredRoundedLineChart', dataColouredRoundedLineChart, optionsColouredRoundedLineChart);

      md.startAnimationForLineChart(colouredRoundedLineChart);


    


     

    }

  }
  
  
  $(document).ready(function() {
     salesChart();
    });
  
  
      </script>
 
      <?php require 'footer.php' ?>