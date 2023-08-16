<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice Print</title>
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
             Phone: <?php echo $cc['customer_contact']; ?> / <?php echo $cc['customer_contact2']; ?><br>
             Phone: <?php echo $cc['customer_contact3']; ?>
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
</section>
<!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>
