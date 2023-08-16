<!DOCTYPE html>
<html>
<head>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
  <title>List Staff</title>
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
            <h1 class="m-0 text-dark">List Staff</h1>
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
            <div class="card">
              <div class="card-header bg-secondary">
                <h3 class="card-title">List Staff</h3>
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
                     <th>Sr#</th>
                     <th>Name</th>
                     <th>Phone</th>           
                     <th>Address</th>
                     <th>Salary</th>
                     <th>Action</th>
                   </tr>

                 </thead>
                 <tbody>
                  <?php
                  $counter=0;
                  foreach ($result as $st) {
                    $counter=$counter+1;
                    ?>
                    <tr>
                     <td><?php echo $counter; ?></td>
                     <td><?php echo $st['staff_name']; ?></td>
                     <td><?php echo $st['staff_phone']; ?></td>           
                     <td><?php echo $st['staff_address']; ?></td>
                     <td><?php echo $st['salary']; ?></td>
                     <td>
                      <a target="_blank" href="<?php echo base_url();?>Welcome/detail_staff_payroll?staff_id=<?php echo $st['staff_id']; ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i>
                        Payroll
                      </a>

                      <a target="_blank" href="<?php echo base_url();?>Welcome/detail_staff_attendance?staff_id=<?php echo $st['staff_id']; ?>" class="btn btn-warning btn-sm">
                        <i class="fa fa-eye"></i>
                        Attendance
                      </a>

                      <a href="<?php echo base_url();?>Welcome/edit_staff?staff_id=<?php echo $st['staff_id']; ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-edit"></i>
                        Edit
                      </a>

                      <a href="<?php echo base_url();?>Welcome/delete_staff?staff_id=<?php echo $st['staff_id']; ?>" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete?')">
                        <i class="fa fa-trash"></i>
                        Delete
                      </a>   
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
