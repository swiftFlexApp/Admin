<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase</title>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
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
      </nav>
      <!-- /.navbar -->
      <?php $this->load->file('assets/includes/sidebar.php'); ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Purchase</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <a href="<?php echo base_url(); ?>Welcome/ad_purchase" class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i>&nbsp;Add Purchase</a>&nbsp;
              <a href="<?php echo base_url(); ?>Welcome/list_purchase" class="btn btn-sm btn-primary"><i class="fa fa-list"></i>&nbsp;List Purchase</a>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="callout callout-info">
                  <h5><i class="fas fa-info"></i> Note:</h5>
                  This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                </div>


                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                  <!-- title row -->
                  <div class="row">
                    <div class="col-12">
                      <h2 align="center">
                        <img width="50" height="50" src="<?php echo base_url(); ?>assets/uploads/company/<?php echo $app[0]['logo']; ?>">
                        <?php echo $app[0]['app_name']; ?>
                      </h2>
                      <p align="center">
                        <?php echo $app[0]['app_address']; ?><br>
                        <?php echo $app[0]['app_phone']; ?> / 
                        <?php echo $app[0]['app_phone2']; ?> / 
                        <?php echo $app[0]['app_phone3']; ?><br>
                        Email: <?php echo $app[0]['app_email']; ?>
                      </p><hr>
                      <h4 align="center">Purchase Invoice</h4>
                      
                       <small class="float-right">Date: 
                        <?php echo $purchase[0]['date']; ?>
                     </small>
                   </h4>
                 </div>
                 <!-- /.col -->
               </div>
               <!-- info row -->
               <div class="row invoice-info">
                
               <div class="col-sm-8 invoice-col">
                From
                <address>

                  <?php

                  foreach($supplier as $cc)
                  {
                   ?>
                   <strong><?php echo $cc['supplier_name']; ?></strong><br>
                   <?php echo $cc['supplier_address']; ?><br>
                   Phone: <?php echo $cc['supplier_contact']; ?>
                   <?php
                 }
                 ?>

               </address>
             </div>
             <!-- /.col -->
             <div class="col-sm-4 invoice-col">
              <?php
              foreach ($purchase as $i) {
               ?>


               <b>Invoice #<?php echo $i['purchase_id']; ?></b><br>
               <br>
               <b>Amount:</b> <?php echo $i['purchase_amount']; ?><br>
               <b>Date:</b> <?php echo $i['date']; ?>
               <?php
             }
             ?>
           </div>
           <!-- /.col -->
         </div>
         <!-- /.row -->

         <!-- Table row -->
         <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>U.Price</th>
                  <th>Quantity</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $gtotal=0;
                $ggtotal=0;
                $tq=0;
                foreach ($product as $r) {
                  ?>

                  <tr>
                   <td><?php echo $r['product_name']; ?></td>
                   <td><?php echo number_format($r['purchase_price']); ?></td>
                   <td><?php $tq+=intval($r['qty']); echo $r['qty']; ?></td>           
                   <td><?php $gtotal+=intval($r['total']); echo number_format($r['total']); ?></td>          
                 </tr>
                 <?php
                 $ggtotal =+ intval($gtotal);
               } 

               ?>

             </tbody>
           </table>
         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->

       <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
          <!-- <p class="lead">Warrenty:</p>


          <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
            plugg
            dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
          </p> -->
        </div>
        <!-- /.col -->
        <div class="col-6">
          <!-- <p class="lead">Amount Due 2/22/2014</p> -->

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>Rs. <?php echo number_format($ggtotal); ?></td>
              </tr>
              <tr>
                <th>Tax:</th>
                <td>0</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td>0</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>Rs. <?php echo number_format($ggtotal); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-12">
          <form name="delForm" action="<?php echo base_url();?>Welcome/purchase_print" method="POST" enctype="multipart/form-data" target="_blank">
            <?php
              foreach ($purchase as $i) {
               ?>
              <input type="hidden" name="purchase_id" value="<?php echo $i['purchase_id']; ?>">
            <?php } ?>
              <button type="submit" name="btnDetail" class="btn btn-default">
                <i class="fas fa-print"></i> Print
                </button>
            </form>  
          <!-- <a href="<?php echo base_url(); ?>Welcome/invoice_print" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
                  <!-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button> -->
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
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
