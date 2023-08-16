<!DOCTYPE html>
<html>
<head>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
  <title>List Business</title>
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
            <h1 class="m-0 text-dark">List Business</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <?php $this->load->file('assets/includes/supplier_bar.php'); ?>
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
            <div class="card">
              <div class="card-header bg-secondary">
                <h3 class="card-title">Business Accounts</h3>
                <span id="controlPanel" style="text-align: right;"></span>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

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


                <table id="example1" class="table table-bordered table-striped">
                 <thead>
                  <tr>
                   <th>Sr</th>
                   <th>Name</th>           
                   <th>Contact</th>
                   <th>Email</th>
                   <th>Balance</th>
                   <th>Address</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                <?php
                foreach ($result as $user) {
                  ?>

                  <tr>
                   <td><?php echo $user['user_id']; ?></td>
                   <td><?php echo $user['fname']." ".$user['lname']; ?></td> 
                   <td><?php echo $user['phone']; ?></td>  
                   <td><?php echo $user['email']; ?></td>  
                   <td><?php echo $user['balance']; ?></td>         
                   <td><?php echo $user['address']; ?></td>
                   <td>
                     
                    <a href="<?php echo base_url();?>Reports/detail_business/?id=<?php echo $user['user_id']; ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-eye"></i>
                      Detail
                    </a>

                    <a href="<?php echo base_url();?>Welcome/edit_business/?id=<?php echo $user['user_id']; ?>" class="btn btn-primary btn-xs">
                      <i class="fa fa-edit"></i>
                      Edit
                    </a>
                    <? if(intval($user['verify']) != 4){ ?>
                    <a href="<?php echo base_url();?>Welcome/lock_business?id=<?php echo $user['user_id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure you want to Lock?')">
                      <i class="fa fa-lock"></i>
                      lock
                    </a>  
                    <? } else { ?>
                    <a href="<?php echo base_url();?>Welcome/unlock_account?id=<?php echo $user['user_id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure you want to Lock?')">
                      <i class="fa fa-lock"></i>
                      unlock
                    </a>  
                    <? } ?>
                  </td>
                </tr>
                <?php
                
              } 

              ?>
            </tbody>
          </table>

          
        </div>
        <!-- /.card-body -->
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
