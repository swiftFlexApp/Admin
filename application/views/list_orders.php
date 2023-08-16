<!DOCTYPE html>
<html>
<head>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
  <title>List Orders</title>
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
            <h1 class="m-0 text-dark">List Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="<?php echo base_url(); ?>Welcome/ad_order" class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i>&nbsp;Add New Order</a>&nbsp;
              <a href="<?php echo base_url(); ?>Welcome/list_orders" class="btn btn-sm btn-primary"><i class="fa fa-list"></i>&nbsp;List Order</a>
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
                <h3 class="card-title">List Orders</h3>
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
                   <th>Customer</th>
                   <th>Product</th>
                   <th>Pricing</th>
                   <th>Dates</th>
                   <th>Action</th>
                </tr>
              </thead>
               <tbody>
          <?php
          $counter=0;
          foreach ($result as $product) {
            $counter=$counter+1;
            ?>

          <tr>
           <td><?php echo $counter; ?></td>
           <td><?php echo $product['customer_name']; ?> <br> <?php echo $product['customer_contact']; ?></td>
           <td><?php echo $product['product_name']; ?><br><?php echo $product['detail']; ?></td>
           <td>Total: <?php echo number_format($product['committed_price']); ?><br>Advance: <?php echo number_format($product['advance']); ?></td>
           <td>Order: <?php 
           $order_date = date_create($product['order_date']);
           echo date_format($order_date, "d-m-Y"); ?><br>Delivery: <?php
           $delivery_date = date_create($product['delivery_date']); echo date_format($delivery_date, "d-m-Y"); ?></td>
           <td>
            <!-- <form name="delForm" action="<?php echo base_url();?>Welcome/edit_order" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="order_id" value="<?php echo $product['order_id']; ?>">
              <input type="submit" name="btnEdit" value="Complete" class="btn btn-primary btn-sm">
            </form> -->

              <form name="delForm" action="<?php echo base_url();?>Welcome/delete_order" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="order_id" value="<?php echo $product['order_id']; ?>">
              <input type="submit" name="btnDelete" value="Delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm">
            </form> 
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
