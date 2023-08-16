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
<title>Attendance</title>
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
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Attendance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <?php $this->load->file('assets/includes/attendance_bar.php'); ?>
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
              <div class="card-header bg-secondary">
                <h3 class="card-title">Attendance Form</h3>
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


              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/save_attendance">              
                <div class="card-body tbl">
                  <div class="row prc"> 
                  <!-- <div class="col-md-3 col-sm-3">
                    <label for="title">Date<span class="strdngr">*</span></label>
                    <input type="date" class="form-control" id="date" name="date[]" placeholder="Date" required value="<?php echo date('Y-m-d'); ?>">
                  </div> -->
                  <!-- <div class="col-md-9 col-sm-9"></div> -->
                  
                  <table class="table table-bordered tbl">
                    <thead class="text-center">
                      <th>Date</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Present</th>
                      <th>Absent</th>
                      <th>Leave</th>
                      
                    </thead>
                    <tbody>
                      <?php
                    foreach($result as $row){
                      ?>
                      <tr>
                        <td>
                          <input type="date" class="form-control" id="date" name="date[]" placeholder="Date" required value="<?php echo date('Y-m-d'); ?>" readonly>
                        </td>
                        <td>
                          <input type="hidden" name="staff_id[]" id="staff_id" value="<?php echo $row['staff_id']; ?>">
                          <input type="text" name="staff_name" id="staff_name" placeholder="Name" class="form-control" required="" readonly="" value="<?php echo $row['staff_name']; ?>">
                        </td>
                        <td>
                          <input type="text" name="staff_phone" id="staff_phone" placeholder="Phone" class="form-control" required="" readonly="" value="<?php echo $row['staff_phone']; ?>">
                        </td>
                        <td class="text-center" style="background-color:#E8F6F3;">
                          <input type="checkbox" value="P" name="presence[]">
                        </td>
                        <td class="text-center" style="background-color:#F8F9F9;">
                          <input type="checkbox" value="A" name="presence[]">
                        </td>
                        <td class="text-center" style="background-color:#FDEDEC;">
                          <input type="checkbox" value="L" name="presence[]">
                        </td>
                        
                      </tr>
                       <?php
                    }
                    ?>
                    </tbody>
                   
                  </table>
                  
                    
                </div>
                </div>
                <!-- /.card-body -->
                <div class="" align="center">
                  
                  <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                  <button type="submit" name="btnSend" class="btn btn-primary ">Save Attendance</button>
                 
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
<script type="text/javascript">
  var totalsum=0;
        //$('.over_time').keyup(function() {
          $(document).on("change", ".deduction, .over_time", function() {
           var sum = 0;

           var salary = parseFloat($(this).closest('tr').find('.salary').val());
           var bonus = parseFloat($(this).closest('tr').find('.over_time').val()) || 0;
           var deduction = parseFloat($(this).closest('tr').find('.deduction').val()) || 0;
           sum = (salary + bonus)-deduction;
           totalsum+=sum;

           $(this).closest('tr').find('.total_salary').val(sum);
           var netpay = 0;
           netpay += totalsum;
           $('.ttotal').text('Rs. ' + netpay);
         });
</script>
</body>
</html>
