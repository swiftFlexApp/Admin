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
  <title>Reports</title>
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
          <div class="col-sm-3">
            <h1 class="m-0 text-dark">Reports</h1>
          </div><!-- /.col -->
          <div class="col-sm-9">
            <?php $this->load->file('assets/includes/reports_bar.php'); ?>
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
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Reports</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body" style="background-image: url('../assets/images/reports.png'); background-size: 100% 100%; background-repeat: no-repeat;">                
                <ol class="card-title">

                  <li><a href="<?php echo base_url(); ?>Reports/sale_report"><i class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;Product Sales Report</a></li>

                  <li><a href="<?php echo base_url(); ?>Reports/sale_summary"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Sales Summary</a></li>

                  <!-- <li><a href="<?php echo base_url(); ?>Reports/stock_report"><i class="fa fa-file"></i>&nbsp;&nbsp;Stock Report</a></li> -->

                  <li><a href="<?php echo base_url(); ?>Reports/sale_model_wise"><i class="fa fa-tasks"></i>&nbsp;&nbsp;Sales Model Wise</a></li>

                  <li><a href="<?php echo base_url(); ?>Reports/customer_balance"><i class="fa fa-user"></i>&nbsp;&nbsp;Customer Transactions</a></li>

                  <li><a href="<?php echo base_url(); ?>Reports/due_summary"><i class="fa fa-edit"></i>&nbsp;&nbsp;Due Summary</a></li>

                  <li><a href="<?php echo base_url(); ?>Reports/supplier_balance"><i class="fa fa-industry"></i>&nbsp;&nbsp;Supplier Transactions</a></li>

                  <li><a href="<?php echo base_url(); ?>Reports/attendance"><i class="fa fa-clock"></i>&nbsp;&nbsp;Attendance</a></li>

                  <li><a href="<?php echo base_url(); ?>Reports/day_book"><i class="fa fa-book"></i>&nbsp;&nbsp;Day Book</a></li>

                </ol> 

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
