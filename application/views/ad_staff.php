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
<title>Add Staff</title>
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
            <h1 class="m-0 text-dark">Add Staff</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <?php $this->load->file('assets/includes/staff_bar.php'); ?>
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
                <h3 class="card-title">Add Staff Form</h3>
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


              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/save_staff" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label for="title">Employee Name <span class="strdngr">*</span></label>
                    <input type="text" class="form-control" name="staff_name" placeholder="Employee Name" required>
                  </div>

                  <div class="col-md-4 col-sm-4">
                    <label for="title">Phone <span class="strdngr">*</span></label>
                    <input type="number" class="form-control" name="staff_phone" placeholder="Phone Number" required>
                  </div>

                  <div class="col-md-4 col-sm-4">
                    <label for="title">Salary <span class="strdngr">*</span></label>
                    <input type="number" class="form-control" name="salary" placeholder="0" required>
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <label for="detail">Address</label>
                    <textarea class="form-control" rows="5" name="staff_address" placeholder="Address"></textarea>
                  </div>                
                </div>
                </div>
                <!-- /.card-body -->
                <div class="" align="center">
                  <!-- <button type="submit" name="btnCancel" class="btn btn-danger">Cancel</button> -->
                  <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                  <button type="submit" name="btnSend" class="btn btn-primary ">Add Employee</button>
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
