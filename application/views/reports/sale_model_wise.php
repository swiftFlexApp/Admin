<?php 

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>
<!DOCTYPE html>
<html>
<head>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
  <title>Sale Model Wise</title>
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
            <h1 class="m-0 text-dark">Sale Model Wise</h1>
          </div><!-- /.col -->
          <div class="col-sm-9">
            <ol class="breadcrumb float-sm-right">
             <?php $this->load->file('assets/includes/reports_bar.php'); ?>
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
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Sale Model Wise</h3>
              
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

              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Reports/get_sale_model_wise" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-3 col-sm-3" >
                    <label for="product">Product <span class="strdngr">*</span></label>
                    <select name="product_id" id="product_id" class="form-control select2" style="width: 100%;" required="">
                     <option value="">Select Product</option>
                     <?php
                     foreach($products as $product){
                      ?>
                      <option value="<?php echo $product['product_id']; ?>"><?php echo $product['product_name']; ?></option>
                      <?php
                    }
                    ?>  
                  </select>
                  </div>
                  <div class="col-md-3 col-sm-3">
                      <label for="title">Model <span class="strdngr">*</span></label>
                      <select name="product_model" id="product_model" class="form-control select2" required="" style="width: 100%;">
                       <option value="2015">2015</option>
                       <option value="2016">2016</option>
                       <option value="2017">2017</option>
                       <option value="2018">2018</option>
                       <option value="2019">2019</option>
                       <option value="2020">2020</option>
                       <option value="2021">2021</option>
                       <option value="2022">2022</option>
                       <option value="2023">2023</option>
                       <option value="2024">2024</option>
                       <option value="2025">2025</option>                       
                     </select>
                   </div>
                  <div class="col-md-3 col-sm-3" >
                   <label for="from">From</label>
                   <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Date">
                 </div>
                 <div class="col-md-3 col-sm-3" >
                   <label for="to">To</label>
                   <input type="date" class="form-control" id="to_date" name="to_date" placeholder="Date" value="<?php echo $today; ?>">
                 </div>
                 
               </div>
               <br>
               <div class="col-md-12" >
                <button  type="submit" name="btnSend" style="float: right;" class="btn btn-primary ">Get Record</button>
              </div>
            </form>
          </div>

          <?php if(isset($report) && is_array($report)){ ?>
          <div class="card-footer text-muted" id="pp">
            <div class="col-md-12 col-sm-12">
              <span id="controlPanel" style="text-align: center;"></span>
            </div>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                
                <tr>
                  <th>Date</th>
                  <th>Product</th>
                  <th>Model</th>
                  <th>Customer</th>      
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>

              </thead>
              <tbody>
                <?php
                $total = 0;
                foreach ($report as $rp) {
                  ?>
                  <tr>
                   <td><?php 
                   $date = date_create($rp['date']);
                   echo date_format($date, "d-m-Y"); ?></td>
                   <td><?php echo $rp['product_name']; ?><br><?php echo $rp['product_description']; ?></td>
                   <td><?php echo $rp['product_model']; ?></td>
                   <td><?php echo $rp['customer_name']; ?></td> 
                   <td><?php
                  $total += intval($rp['qty']); 
                  echo number_format($rp['qty']); ?></td>
                </td>
                <td><a target="_blank" href="<?php echo base_url();?>Reports/detail_customer/?customer_id=<?php echo $rp['customer_id']; ?>" class="btn btn-warning btn-xs">
                      <i class="fa fa-eye"></i>
                      Customer Detail
                    </a></td>
              </tr>
              <?php
            } 
            ?>

          </tbody>
          <tfoot>
           <tr>
             <td colspan="4" style="text-align: right;"><strong>Total</strong></td>
             <td style="text-align: left;"><strong style="color:#f00;"><?php echo number_format($total); ?></strong></td>
           </tr>
         </tfoot>

       </table>

     </div>
     <?php

   } 

   ?>


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
