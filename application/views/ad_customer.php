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
<title>Add Customer</title>
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
            <h1 class="m-0 text-dark">Add Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <?php $this->load->file('assets/includes/customer_bar.php'); ?>
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
                <h3 class="card-title">Add Customer Form</h3>
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


              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/save_customer" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                 
                  <div class="col-md-6 col-sm-6">
                    <label for="title">Customer Name <span class="strdngr">*</span></label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Customer Name" required>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Phone No 1 <span class="strdngr">*</span></label>
                    <input type="number" class="form-control" id="customer_contact" name="customer_contact" placeholder="Phone No 1" required minlength="11" maxlength="11">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Phone No 2</label>
                    <input type="number" class="form-control" id="customer_contact2" name="customer_contact2" placeholder="Phone No 2" minlength="11" maxlength="11">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Phone No 3</label>
                    <input type="number" class="form-control" id="customer_contact3" name="customer_contact3" placeholder="Phone No 3"  minlength="11" maxlength="11">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">WhatsApp No</label>
                    <input type="number" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="WhatsApp No"  minlength="11" maxlength="11">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Previous Balance <span class="strdngr">*</span></label>
                    <input type="text" class="form-control" id="previous_balance" name="previous_balance" placeholder="0" required="">
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <label for="detail">Customer Address</label>
                    <textarea class="form-control" rows="5" id="customer_address" name="customer_address" placeholder="Customer Address"></textarea>
                  </div>                
                </div>
                </div>
                <!-- /.card-body -->
                <div class="" align="center">
                  <!-- <button type="submit" name="btnCancel" class="btn btn-danger">Cancel</button> -->
                  <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                  <button type="submit" name="btnSend" class="btn btn-primary ">Add Customer</button>
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
