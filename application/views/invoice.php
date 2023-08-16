<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice</title>
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
                <h1>Invoice</h1>
              </div>
              <div class="col-sm-6">
                <?php $this->load->file('assets/includes/sale_bar.php'); ?>
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
                      <h4 align="center">Sale Invoice</h4>
                      <small class="float-right">
                        <i>Print Date: <?php echo date('d-m-Y'); ?></i>
                      </small>

                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- info row -->
                  <div class="row invoice-info">
                   <div class="col-sm-8 invoice-col">
                    To
                    <address>

                      <?php

                      foreach($customer as $cc)
                      {
                       ?>
                       <strong><?php echo $cc['customer_name']; ?></strong><br>
                       <?php echo $cc['customer_address']; ?><br>
                       Phone: <?php echo $cc['customer_contact']; ?> / 
                       <?php echo $cc['customer_contact2']; ?> / 
                       <?php echo $cc['customer_contact3']; ?>
                       <?php
                     }
                     ?>

                   </address>
                 </div>
                 <!-- /.col -->
                 <div class="col-sm-4 invoice-col">
                  <?php
                  foreach ($sale as $i) {
                   ?>
                   <b>Invoice #<?php echo $i['sale_id']; ?></b>
                   <br>
                   <b>Date:</b> <?php 
                   $date = date_create($i['date']);
                   echo date_format($date, "d-m-Y");
                   ?>
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
                      <th>Discount</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $gtotal=0;
                    $ggtotal=0;
                    $tq=0;
                    $td=0;
                    foreach ($product as $r) {
                      ?>
                      <tr>
                       <td><?php echo $r['product_name']; ?></td>
                       <td><?php echo number_format($r['selling_price']); ?></td>
                       <td><?php $tq+=intval($r['qty']); echo $r['qty']; ?></td> 
                       <td><?php $td+=intval($r['discount']); echo $r['discount']; ?></td>
                       <td><?php $gtotal+=intval($r['total']); echo number_format($r['total']); ?></td>
                     </tr>
                     <?php
                     $ggtotal =+ intval($gtotal);
                     $ttd =+ intval($td);
                     $inv_discount = $r['inv_discount'];
                     $paid = $r['paid'];
                     $due = $r['due'];
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
              <p class="lead"><strong>Note:</strong></p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                <?php echo $sale[0]['invoice_note'];?>
               </p>
              <p class="lead"><strong>Warrenty:</strong></p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
               No warrenty on imported items.
               غیر مُلکی آئیٹمز کی کوئی وارنٹی نہیں ہے
             </p>
           </div>
           <!-- /.col -->
           <div class="col-6">
            <!--<p class="lead">Amount Due 2/22/2014</p>-->

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>Rs. <?php echo number_format($ggtotal); ?></td>
                </tr>
                <tr>
                  <th>Inv Discount:</th>
                  <td>Rs. <?php echo number_format($inv_discount); ?></td>
                </tr>
                <tr>
                  <th>Grand Total:</th>
                  <td><strong>Rs. <?php echo number_format($ggtotal - $inv_discount); ?></strong></td>
                </tr>
                <tr>
                  <th>Paid:</th>
                  <td>Rs. <?php echo number_format($paid); ?></td>
                </tr>
                <tr>
                  <th>Due:</th>
                  <td>Rs. <?php echo number_format($due); ?></td>
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
            <form name="delForm" action="<?php echo base_url();?>Welcome/invoice_print" method="POST" enctype="multipart/form-data" target="_blank">
              <?php
              foreach ($sale as $i) {
               ?>
               <input type="hidden" name="sale_id" value="<?php echo $i['sale_id']; ?>">
             <?php } ?>
             <button type="submit" name="btnDetail" class="btn btn-default">
              <i class="fas fa-print"></i> Print
            </button>
          </form>  

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
