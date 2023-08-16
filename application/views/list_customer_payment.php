<!DOCTYPE html>
<html>
<head>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
  <title>List Customer Payment</title>
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
            <h1 class="m-0 text-dark">List Customer Payment</h1>
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
            <div class="card">
              <div class="card-header bg-secondary">
                <h3 class="card-title">List Customer Payment</h3>
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
                   <th>Customer</th>           
                   <th>Amount</th>
                   <th>Detail</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                <?php
                foreach ($result as $p) { ?>

                  <tr>
                   <td><?php echo $p['payment_id']; ?></td>
                   <td><?php 
                   $date = date_create($p['date']);
                   echo date_format($date, "d-m-Y"); 
                   ?>                     
                   </td>
                   <td>
                    <?php echo $p['customer_name']; ?><br>
                    <?php echo $p['customer_contact']; ?>                     
                   </td>
                   <td><?php echo number_format($p['amount']); ?></td>
                   <td><?php echo $p['ref']; ?><br><?php echo $p['detail']; ?></td>
                   <td>
                    <a href="<?php echo base_url();?>Welcome/edit_customer_payment?payment_id=<?php echo $p['payment_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <a href="<?php echo base_url();?>Welcome/delete_customer_payment?payment_id=<?php echo $p['payment_id']; ?>" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i> Delete</a>
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
