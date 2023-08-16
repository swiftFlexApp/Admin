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
<title>Add New Bill</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed" onload="myFunction()" style="margin:0;">
  <div class="loader" id="loader"></div>
  <div class="wrapper" id="wrapper">

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
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Bill</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Bills</li>
              <li class="breadcrumb-item active">Add New Bill</li>
            </ol>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add New Bill Form</h3>
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


              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/save_bill" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">

                   <div class="col-md-6 col-sm-6">
                    <label for="title">Supervisor <span class="strdngr"></span></label>
                    <select name="supervisor_id" class="form-control">
                      <option>Select Supervisor</option>
                      <?php 
                      foreach ($supervisors as $supervisor) {
                        ?>
                        <option value="<?php echo $supervisor['user_id']; ?>"><?php echo $supervisor['name']; ?></option>
                        <?php 
                      }

                      ?>  
                    </select>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Bill Date <span class="strdngr">*</span></label>
                    <input type="date" class="form-control" id="datePicker" name="date" required value="<?php echo $today; ?>">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Driver <span class="strdngr">*</span></label>
                    <select name="driver_id" class="form-control">
                      <option>Select Driver</option>
                      <?php 
                      foreach ($drivers as $driver) {
                        ?>
                        <option value="<?php echo $driver['user_id']; ?>"><?php echo $driver['name']; ?></option>
                        <?php 
                      }

                      ?>  
                    </select>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Car <span class="strdngr">*</span></label>
                    <select name="car_id" class="form-control">
                      <option>Select Car</option>
                      <?php 
                      foreach ($cars as $car) {
                        ?>
                        <option value="<?php echo $car['car_id']; ?>"><?php echo $car['car_name']; ?> - <?php echo $car['car_number']; ?></option>
                        <?php 
                      }

                      ?>  
                    </select>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Trip Start Time <span class="strdngr">*</span></label>
                    <input type="time" class="form-control" id="name" name="trip_strat_time" required>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Trip Start Location <span class="strdngr">*</span></label>
                    <input type="text" class="form-control" id="name" name="trip_start_location" placeholder="Start Location" required>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Trip End Time <span class="strdngr">*</span></label>
                    <input type="time" class="form-control" id="name" name="trip_end_time" required>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Trip End Location <span class="strdngr">*</span></label>
                    <input type="text" class="form-control" id="name" name="trip_end_location" placeholder="End Location" required>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Customer Name <span class="strdngr"></span></label>
                    <input type="text" class="form-control" id="name" name="customer_name" placeholder="Customer Name">
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <label for="title">Customer Mobile <span class="strdngr"></span></label>
                    <input type="number" class="form-control" id="number" name="customer_mobile" placeholder="Customer Mobile Number">
                  </div>
                  
                  <div class="col-md-6 col-sm-6">
                    <label for="title">Payment Mode <span class="strdngr">*</span></label>
                    <select name="payment_mode" class="form-control">
                      <option value="Cash">Cash</option>
                      <option value="Credit Card">Credit Card</option>
                      <option value="Room Charges">Room Charges</option>
                      <option value="Online Payment">Online Payment</option>
                    </select>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <label for="title">Amount <span class="strdngr">*</span></label>
                    <input type="text" class="form-control" id="number" name="amount" placeholder="Amount" required>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <label for="detail">Hotel</label>
                    <select name="hotel_id" class="form-control">
                      <option value="">Select Hotel</option>
                      <?php 
                      foreach ($hotels as $hotel) {
                        ?>
                        <option value="<?php echo $hotel['hotel_id']; ?>"><?php echo $hotel['hotel_name']; ?></option>
                        <?php 
                      }

                      ?>   
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="" align="center">
                <!-- <button type="submit" name="btnCancel" class="btn btn-danger">Cancel</button> -->
                <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                <button type="submit" name="btnSend" class="btn btn-primary ">Add Bill</button>
              </div>
              <br>
              <!-- /.card-footer -->
            </form>
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
