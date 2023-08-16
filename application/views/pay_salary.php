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
<title>Pay Salary</title>
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
            <h1 class="m-0 text-dark">Pay Salary</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">

            <?php $this->load->file('assets/includes/payroll_bar.php'); ?>
            
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
                <h3 class="card-title">Pay Salary Form</h3>
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


              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/save_salary">              
                <div class="card-body tbl">
                  <div class="row prc"> 
                  
                  
                  <table class="table table-bordered tbl">
                    <thead class="text-center">
                      <th>Date</th>
                      <th>Name <span class="strdngr">*</span></th>
                      <th>Salary <span class="strdngr">*</span></th>
                      <th>Over Time</th>
                      <th>Deduction</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <tr>

                      </tr>
                      
                      <tr>
                        <td>
                          <input type="date" class="form-control" id="date" name="date" placeholder="Date" value="<?php echo date('Y-m-d'); ?>" readonly>                  </div>
                        </td>
                        <td>
                          <select name="staff_id" id="staff_id" class="form-control select2" required="" style="width: 100%;">
                           <option value="">Select Name</option>
                           <?php
                           foreach($result as $stf){
                            ?>
                            <option value="<?php echo $stf['staff_id']; ?>"><?php echo $stf['staff_name']; ?></option>
                            <?php
                          }
                          ?>  
                        </select>

                      </td>
                      <td>
                        <input type="number" name="salary" id="salary" placeholder="0" class="form-control salary" step="0.01" required=""> 
                      </td>
                      <td>
                        <input type="number" name="over_time" id="over_time" placeholder="0" class="form-control over_time" step="0.01" style="background-color: #E8F6F3;">
                      </td>
                      <td>
                        <input type="number" name="deduction" id="deduction" placeholder="0" class="form-control deduction" step="0.01" style="background-color: #FDEDEC;">
                      </td>
                      <td>
                        <input type="number" name="total_salary" id="total_salary" placeholder="0" class="form-control total_salary" required="" step="0.01">
                      </td>
                    </tr>
                  </tbody>                  
                </table>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="" align="center">

              <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
              <button type="submit" name="btnSend" class="btn btn-primary ">Pay Salary</button>

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
