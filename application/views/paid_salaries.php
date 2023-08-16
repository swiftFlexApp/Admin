<!DOCTYPE html>
<html>
<head>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
  <title>List Paid Salaries</title>
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
            <h1 class="m-0 text-dark">List Paid Salaries</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
              <?php $this->load->file('assets/includes/payroll_bar.php'); ?>
            
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
              <h3 class="card-title">Paid Salaries</h3>
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
           <th>Date</th>           
           <th>Name</th>
           <th>Salary</th>
           <th>Over Time</th>
           <th>Deduction</th>
           <th>Total</th>
           
         </tr>
       </thead>
        <tbody>
          <?php
          $counter=0;
          foreach ($salary as $r) {
            $counter=$counter+1;
            ?>
          <tr>
           <td><?php echo $counter; ?></td>
           <td><?php 
           $date = date_create($r['date']);
           echo date_format($date, "d-m-Y");
           ?>
           </td>
           <td><?php echo $r['staff_name']; ?></td>
           <td><?php echo number_format($r['paid_salary']); ?></td>
           <td><?php echo number_format($r['over_time']); ?></td>
           <td><?php echo number_format($r['deduction']); ?></td>
           <td><?php echo number_format($r['total_salary']); ?></td>
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
