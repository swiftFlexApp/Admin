<?php
$user_id=$this->session->userdata('user_id');
$name=$this->session->userdata('name');
$phone=$this->session->userdata('phone');
$email=$this->session->userdata('email');
$password=$this->session->userdata('password');
$type=$this->session->userdata('user_type');
$pic=$this->session->userdata('pic');
$detail=$this->session->userdata('detail');
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
<title>Profile</title>
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
            <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
                <h3 class="card-title">Profile</h3>
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


              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/update_profile" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="text-center">
                        <img src="<?php echo base_url(); ?>assets/uploads/profile/<?php echo $pic; ?>" width="170" height="170" style="border-radius: 50px;">
                      </div>
                    </div>

                    <div class="col-md-3 col-sm-3">
                      <label for="name">Name <span class="strdngr">*</span></label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required value="<?=isset($name)?$name:''?>">
                        <input type="hidden" name="user_id" value="<?=isset($user_id)?$user_id:''?>">
                    </div>
                    <div class="col-md-3 col-sm-3">
                      <label for="email">Email <span class="strdngr">*</span></label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email" required  value="<?=isset($email)?$email:''?>" >
                    </div>

                    <div class="col-md-3 col-sm-3">
                      <label for="email">Profile Image <span class="strdngr">*</span></label>
                      <input type="file" class="form-control" name="pic">
                      <input type="hidden" name="hidden_pic" value="<?=isset($pic)?$pic:''?>">
                    </div>
                  </div>

                     

                </div>
                <!-- /.card-body -->
                <div class="col-md-12 col-sm-12" align="center">

                  <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                  <button type="submit" name="btnSend" class="btn btn-primary ">Update Profile</button>
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
