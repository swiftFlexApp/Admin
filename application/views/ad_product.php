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
<title>Add Product</title>
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
            <h1 class="m-0 text-dark">Add Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="<?php echo base_url(); ?>Welcome/ad_product" class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i>&nbsp;Add Product</a>&nbsp;
              <a href="<?php echo base_url(); ?>Welcome/list_product" class="btn btn-sm btn-primary"><i class="fa fa-list"></i>&nbsp;List Product</a>
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
                <h3 class="card-title">Add Product Form</h3>
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


              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/save_product" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-4 col-sm-4">
                      <label for="title">Product Name <span class="strdngr">*</span></label>
                      <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required>
                    </div>

                    <div class="col-md-4 col-sm-4">
                      <label for="title">Sale Price <span class="strdngr">*</span></label>
                      <input type="number" class="form-control" id="price" name="price" placeholder="Price" required step="0.01">
                    </div>

                    <div class="col-md-4 col-sm-4">
                      <label for="title">Model </label>
                      <select name="product_model" id="product_model" class="form-control select2" style="width: 100%;">
                       <option value="2015">2015</option>
                       <option value="2016">2016</option>
                       <option value="2017">2017</option>
                       <option value="2018">2018</option>
                       <option value="2019">2019</option>
                       <option value="2020">2020</option>
                       <option value="2021">2021</option>
                       <option value="2022">2022</option>
                       <option value="2023">2023</option>
                       <option value="2024">2024</option>
                       <option value="2025">2025</option>                       
                     </select>
                   </div>

                   <div class="col-md-12 col-sm-12">
                    <label for="detail">Product Description</label>
                    <textarea class="form-control" rows="5" id="product_description" name="product_description" placeholder="Product Description"></textarea>
                  </div>                

                </div>
              </div>
              <!-- /.card-body -->
              <div class="" align="center">
                <!-- <button type="submit" name="btnCancel" class="btn btn-danger">Cancel</button> -->
                <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                <button type="submit" name="btnSend" class="btn btn-primary ">Add Product</button>
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
