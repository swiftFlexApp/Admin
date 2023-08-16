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
  <title>App Data</title>
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
            <h1 class="m-0 text-dark">App Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Settings</li>
              <li class="breadcrumb-item active">App Data</li>
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
                <h3 class="card-title">App Data Form</h3>
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

              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/save_settings" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 col-sm-4">
                      <div class="form-group">
                        <label>App Name</label>
                        <input type="text" class="form-control" name="app_name" value="<?=isset($result[0]['app_name'])?$result[0]['app_name']:''?>">
                        <input type="hidden" name="hidden_setting" value="<?=isset($result[0]['id'])?$result[0]['id']:''?>">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <div class="form-group">
                        <label>App Phone</label>
                        <input type="text" class="form-control" name="app_phone" value="<?=isset($result[0]['app_phone'])?$result[0]['app_phone']:''?>">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <div class="form-group">
                        <label>App Phone2</label>
                        <input type="text" class="form-control" name="app_phone2" value="<?=isset($result[0]['app_phone2'])?$result[0]['app_phone2']:''?>">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <div class="form-group">
                        <label>App Phone3</label>
                        <input type="text" class="form-control" name="app_phone3" value="<?=isset($result[0]['app_phone3'])?$result[0]['app_phone3']:''?>">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <div class="form-group">
                        <label>App Email</label>
                        <input type="email" class="form-control" name="app_email" value="<?=isset($result[0]['app_email'])?$result[0]['app_email']:''?>">
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="app_address"><?=isset($result[0]['app_address'])?$result[0]['app_address']:''?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <label>App Logo</label>
                        <input type="file" class="form-control" name="logo">
                        <br>
                        <img class="avatar-img rounded-circle" style="width: 250px;height: 250px;" src="<?php echo base_url(); ?>assets/uploads/company/<?=isset($result[0]['logo'])?$result[0]['logo']:''?>" alt="Logo"> 
                        <br>
                        <input type="hidden" name="hidden_website_logo" value="<?=isset($result[0]['logo'])?$result[0]['logo']:''?>">
                        <small class="text-secondary">Recommended image size is <b>150px x 150px</b></small>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group mb-0">
                        <label>Favicon</label>
                        <input type="file" class="form-control" name="favicon">
                        <img class="avatar-img rounded-circle" style="width: 250px;height: 250px;" src="<?php echo base_url(); ?>assets/uploads/company/<?=isset($result[0]['favicon'])?$result[0]['favicon']:''?>" alt="Favicon"> <br>
                        <input type="hidden" name="hidden_favicon_logo" value="<?=isset($result[0]['favicon'])?$result[0]['favicon']:''?>">
                        <small class="text-secondary">Recommended image size is <b>16px x 16px</b> or <b>32px x 32px</b></small><br>
                        <small class="text-secondary">Accepted formats : only png and ico</small>
                      </div>
                    </div>



                  </div>  
                </div>

                <div class="card-footer" align="center">
                  <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                  <button type="submit" name="btnSend" class="btn btn-primary ">Save Data</button>
                </div>
              </form>


            </div>
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
