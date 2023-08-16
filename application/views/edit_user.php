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
<title>Edit User</title>
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
            <h1 class="m-0 text-dark">Edit User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item active">Edit User</li>
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
                <h3 class="card-title">Edit User Form</h3>
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
              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/update_User" enctype="multipart/form-data">
                <div class="card-body">                 
                          <?php foreach ($user as $usr) {?>
          <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $usr['memberID']; ?>">

          <div class="row">
            <div class="col-md-6 col-sm-6">
              <label for="name">User Type <span class="strdngr">*</span></label>
              <select class="form-control" name="type" required>
                <option value="1">User</option>
                <option value="0">Admin</option>
              </select>                  
            </div>
            
              <div class="col-md-6 col-sm-6">
                <label for="name">Name <span class="strdngr">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required value="<?php echo $usr['username']; ?>">
              </div>

              <div class="col-md-6 col-sm-6">
                <label for="telephone">Phone Number <span class="strdngr">*</span></label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone" required value="<?php echo $usr['phone']; ?>">
              </div>

              <div class="col-md-6 col-sm-6">
                <label for="email">Email <span class="strdngr">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="User Email" required value="<?php echo $usr['email']; ?>">
              </div>
              <div class="col-md-6 col-sm-6">
                <label for="password">Password <span class="strdngr">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="User Password" required value="<?php echo $usr['password']; ?>">
              </div>
              
              <div class="col-md-1 col-sm-1">
                <br>
                <img src="<?php echo base_url(); ?>assets/uploads/profile/<?php echo $usr['pic'];; ?>" width="50" height="40">
              </div>
              <div class="col-md-5 col-sm-5">
                <label for="pic">User Photo <span class="strdngr"></span></label>
                <input type="file" class="form-control" id="pic" name="pic">
              </div>
              <div class="col-md-12 col-sm-12">
                <label for="Message">Additional Details</label>
                <textarea class="form-control" rows="5" id="detail" name="detail" placeholder="Details"><?php echo $usr['detail']; ?></textarea>
            </div>
            
          <?php } ?>

                  

                                  
                </div>
                </div>
                <br>
                <!-- /.card-body -->
                <div class="" align="center">
                  <!-- <button type="submit" name="btnCancel" class="btn btn-danger">Cancel</button> -->
                  <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                  <button type="submit" name="btnSend" class="btn btn-primary ">Update User</button>
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
