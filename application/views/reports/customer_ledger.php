<?php 

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>
<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
  <title>Driver Ledger</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <?php $this->load->file('assets/includes/top_navbar.php'); ?>
      
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <?php $this->load->file('assets/includes/notification.php'); ?>
      </ul>
    </nav>
    <!-- /.navbar -->
    <?php $this->load->file('assets/includes/sidebar.php'); ?>

    <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1 class="m-0 text-dark">Driver Ledger</h1>
          </div><!-- /.col -->
          <div class="col-sm-9">
            <?php $this->load->file('assets/includes/reports_bar.php'); ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">          
        <!-- Main row -->
        <div class="row">

          <div class="col-md-12">

            <!-- Horizontal Form -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Driver Ledger</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <!-- Success Message -->
              <?php
              $this->load->helper( 'form' );
              $error = $this->session->flashdata( 'error' );
              if ( $error ) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $this->session->flashdata('error'); ?>
                </div>
              <?php } ?>
              <?php  
              $success = $this->session->flashdata('success');
              if($success)
              {
                ?>
                <div id="success-alert" class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $this->session->flashdata('success'); ?>
                </div>
              <?php } ?>

              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Reports/get_driver_ledger" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 col-sm-4">
                      <label for="title">Driver <span class="strdngr">*</span></label>
                      <select name="driver_id" class="form-control select2" required>
                        <option value="">Select Driver</option>
                        <?php foreach ($result as $driver) {?>
                          <option value="<?php echo $driver['user_id']; ?>">
                            <?php echo $driver['name']; ?>                        
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                    
                    <div class="col-md-4 col-sm-4">
                      <label for="from_date">From Date <span class="strdngr">*</span></label>
                      <input type="date" class="form-control" id="from_date" name="from_date" placeholder="From Date">
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <label for="title">To Date <span class="strdngr">*</span></label>
                      <input type="date" class="form-control" id="to_date" name="to_date" placeholder="To Date" value="<?php echo $today; ?>">
                    </div>


                  </div>
                </div>

                <!-- /.card-body -->
                <div class="" align="center">
                  <!-- <button type="submit" name="btnCancel" class="btn btn-danger">Cancel</button> -->
                  <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                  <button type="submit" name="btnSend" class="btn btn-primary ">Search Data</button>
                 
                </div>
                <br>
                <!-- /.card-footer -->
              </form>

              <?php if(isset($report) && is_array($report)){ ?>
                <span id="controlPanel" style="text-align: center;"></span>
                <table id="example" class="table table-bordered table-striped">
                 <thead class="thead-dark">
                  <tr>
                    <td colspan="6" style="text-align:center; font-weight:bold; color: #f00; font-size:20px;">
                      <?php echo $dd[0]['name']; ?>
                      <br>
                      <?php echo $dd[0]['phone']; ?>
                    </td>
                  </tr>
                  <tr>
                    <th>Date</th>
                    <th>Sale</th>
                    <th>Ref</th>
                    <th>Expense</th>
                    <th>Credit</th>
                    <th>Balance</th>
                  </tr>

                </thead>
                <tbody>
                  
                  <?php 
                  $total_sale = 0;
                  $total_exp = 0;
                  $total_credit = 0;
                  $total_balance = 0;
                  foreach ($report as $data) {

                    ?>
                    <tr>
                      <td><?php
                      $date = date_create($data['date']);
                      echo date_format($date, "d-m-Y"); 
                       ?></td>
                      <td>
                        <?php $total_sale+=$data['sale']; echo number_format($data['sale']); ?>
                      </td>
                      <td>
                        <?php
                        if ($data['ref']!='' AND $data['ref'] == 'Uber') {
                           echo 'Uber';
                         } 

                         if ($data['ref']!='' AND $data['ref'] == 'Creem') {
                           echo 'Creem';
                         } 

                        ?>
                      </td>
                      <td>
                        <?php $total_exp+=$data['expense']; echo number_format($data['expense']); ?>                      
                      </td>
                      <td>
                        <?php $total_credit+=$data['credit']; echo number_format($data['credit']); ?>                      
                      </td>

                     <td>
                        <?php 
                      $balance = $data['sale']+$data['credit']-$data['expense'];
                      $total_balance+=$balance;
                      echo number_format($balance); ?>
                    </td>                    
                  </tr>
                  <?php                  
                }
                ?>           

              </tbody>
              <tfoot>
                <tr style="font-weight: bold;">
                  <td class="text-right"><strong>Total</strong></td>
                  <td><?php echo $total_sale; ?></td>
                  <td></td>
                  <td><?php echo $total_exp; ?></td>
                  <td><?php echo $total_credit; ?></td>
                  <td colspan="2" class="text-left"><strong><?php echo number_format($total_balance); ?></strong></td>
                </tr> 
              </tfoot>          
            </table>
          <?php } ?>


        </div>
        <!-- /.card -->

      </div>

    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->file('assets/includes/footer.php'); ?>

</div>
<!-- ./wrapper -->

<?php $this->load->file('assets/includes/footer_links.php'); ?>
</body>
</html>
