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
<title>Add New Order</title>
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
            <h1 class="m-0 text-dark">Add New Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="<?php echo base_url(); ?>Welcome/ad_order" class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i>&nbsp;Add New Order</a>&nbsp;
              <a href="<?php echo base_url(); ?>Welcome/list_orders" class="btn btn-sm btn-primary"><i class="fa fa-list"></i>&nbsp;List Order</a>
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
              <div class="card-header bg-secondary">
                <h3 class="card-title">Add New Order</h3>
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


              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/save_order" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-3 col-sm-3">
                      <label for="title">Customer <span class="strdngr">*</span></label>
                      <select name="customer_id" id="customer_id" class="form-control select2" required="" style="width: 100%;">
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

                  <div class="col-md-3 col-sm-3">
                    <label for="title">Product <span class="strdngr">*</span></label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required>
                  </div>

                  <div class="col-md-2 col-sm-2">
                    <label for="title">Delivery Date</label>
                    <input type="date" class="form-control" id="d_date" name="d_date">
                  </div>

                  <div class="col-md-2 col-sm-2">
                    <label for="title">Committed Price <span class="strdngr">*</span></label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Price" required step="0.01">
                  </div>

                  <div class="col-md-2 col-sm-2">
                    <label for="title">Advance <span class="strdngr">*</span></label>
                    <input type="number" class="form-control" id="advance" name="advance" placeholder="Advance" required step="0.01">
                  </div>

                  
                 <div class="col-md-12 col-sm-12">
                  <label for="detail">Product Description</label>
                  <textarea class="form-control" rows="5" id="product_description" name="product_description" placeholder="Product Description"></textarea>
                </div>                

              </div>
            </div>
            <!-- /.card-body -->
            <div class="" align="center">
              <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
              <button type="submit" name="btnSend" class="btn btn-primary ">Save Order</button>
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
