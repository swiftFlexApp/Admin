<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <?php $this->load->file('assets/includes/top_links.php'); ?>
</head>
<body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
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
        <small class="float-right">Date: 
          <?php

          foreach($purchase as $d)
          {
           ?>
           <?php echo $d['date']; ?>

           <?php
         }
       ?></small>
     </h2>
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
      Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
      jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
    </p> -->
  </div>
  <!-- /.col -->
  <div class="col-6">
    

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
</section>
<!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>
