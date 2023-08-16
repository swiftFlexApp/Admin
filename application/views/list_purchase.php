<!DOCTYPE html>
<html>
<head>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
  <title>List Purchase</title>
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
            <h1 class="m-0 text-dark">List Purchase</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="<?php echo base_url(); ?>Welcome/ad_purchase" class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i>&nbsp;Add Purchase</a>&nbsp;
              <a href="<?php echo base_url(); ?>Welcome/list_purchase" class="btn btn-sm btn-primary"><i class="fa fa-list"></i>&nbsp;List Purchase</a>
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
          <div class="card">
            <div class="card-header bg-secondary">
              <h3 class="card-title">List Purchase</h3>
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


              <table id="example11" class="table table-bordered table-striped">
         <thead>
          <tr>
           <th>Trx</th>
           <th>Supplier</th>
           <th>Amount</th>
           <th>Date</th>
           <th>Action</th>
         </tr>
       </thead>
       <tbody>
         <?php
         foreach ($result as $p) {
           ?>

           <tr>
           <td><?php echo $p['purchase_id']; ?></td>
           <td><strong><?php echo $p['supplier_name']; ?></strong><br>
            <?php echo $p['supplier_contact']; ?>
           </td>
           <td><?php echo number_format($p['purchase_amount']); ?></td>
           <td><?php echo $p['date']; ?></td>
           <td>
             <a href="<?php echo base_url();?>Welcome/purchase?purchase_id=<?php echo $p['purchase_id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> View Detail</a> 

            <a href="<?php echo base_url();?>Welcome/edit_purchase?purchase_id=<?php echo $p['purchase_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a> 

            <a href="<?php echo base_url();?>Welcome/delete_purchase?purchase_id=<?php echo $p['purchase_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a> 
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
