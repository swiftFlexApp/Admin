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
<title>Edit Customer Payment</title>
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
            <h1 class="m-0 text-dark">Edit Customer Payment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <?php $this->load->file('assets/includes/payment_bar.php'); ?>
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
                <h3 class="card-title">Edit Customer Payment Form</h3>
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


              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/update_customer_payment" enctype="multipart/form-data">
                <input type="hidden" name="payment_id" value="<?php echo $payment[0]['payment_id']; ?>">
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <label for="title">Customer <span class="strdngr">*</span></label>
                    <select name="customer_id" id="customer_id" class="form-control select2" required="" style="width: 100%;">
                      <option value="<?php echo $payment[0]['customer_id']; ?>"><?php echo $payment[0]['customer_name']; ?></option>
                       <option value="">Select Customer</option>
                       <?php
                       foreach($customers as $customer){
                        ?>
                        <option value="<?php echo $customer['customer_id']; ?>"><?php echo $customer['customer_name']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label for="title">Amount <span class="strdngr">*</span></label>
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" required value="<?php echo $payment[0]['amount']; ?>">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label for="title">Ref <span class="strdngr"></span></label>
                    <input type="text" class="form-control" id="ref" name="ref" placeholder="Reference" value="<?php echo $payment[0]['ref']; ?>">
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <label for="detail">Customer Detail</label>
                    <textarea class="form-control" rows="5" id="detail" name="detail" placeholder="Customer Detail"><?php echo $payment[0]['detail']; ?></textarea>
                  </div>                
                </div>
                </div>
                <!-- /.card-body -->
                <div class="" align="center">
                  <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                  <button type="submit" name="btnSend" class="btn btn-primary">Update Payment</button>
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
