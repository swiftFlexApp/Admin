<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Supplier Detail</title>
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
                <h1>Business Account Detail</h1>
              </div>
              <div class="col-sm-6">
                <?php $this->load->file('assets/includes/supplier_bar.php'); ?>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="callout callout-info">
                  <h3><?php echo $supplier[0]['supplier_name']; ?></h3>
                  <?php echo $supplier[0]['supplier_address']; ?><br>
                  <?php echo $supplier[0]['supplier_contact']; ?><br>
                  <?php echo $supplier[0]['company_name']; ?>&nbsp;&nbsp;&nbsp;
                  <?php echo $supplier[0]['company_phone']; ?>
                  <button class="btn btn-warning viewBtn float-right" data-toggle="modal" data-target="#modal-lg" value="<?php echo $supplier[0]['supplier_id']; ?>">
                    <i class="fa fa-edit"></i>&nbsp;&nbsp;Make Payment
                  </button>
                  
                </div>
                
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                  <!-- title row -->
                  <div class="row">
                    <div class="col-12">

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


                      <?php if(isset($report) && is_array($report)){ ?>
                       <table id="example1" class="table table-bordered table-striped">
                        <thead>                          
                          <tr style="font-size:20px; font-weight: bold; color: #2980B9;">
                            <th colspan="3" class="text-center">Purchase Details</th>
                            <th colspan="2" class="text-center">Payment Details</th>
                          </tr>
                          <tr>
                            <th>Date</th>
                            <th>Purchase#</th>                             
                            <th>Amount</th>
                            <th>Payment#</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $total = 0;
                          $paid = 0;

                          foreach ($report as $rp) {
                            ?>
                            <tr>
                              <td><?php 
                              $date=date_create($rp['date']);
                              echo date_format($date,"d-m-Y"); ?></td>   
                              <td><?php echo $rp['purchase_id']; ?></td>                           
                              <td>
                                <?php $total+=intval($rp['purchase_amount']); echo number_format($rp['purchase_amount']); ?>  
                              </td>

                              <td><?php echo $rp['payment_id']; ?></td>
                              <td><?php $paid+=intval($rp['paid_amount']); echo number_format($rp['paid_amount']); ?></td>
                            </tr>
                            <?php
                          } 
                          ?>

                        </tbody>
                        <tfoot>
                         <tr>
                           <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
                           <td style="text-align: left;"><strong style="color:#f00;"><?php echo number_format($total); ?></strong></td>
                           <td style="text-align: right;"><strong>Received</strong></td>
                           <td style="text-align: left;"><strong style="color:#229954;"><?php echo number_format($paid); ?></strong></td>
                         </tr>
                         <tr style="font-size:20px; font-weight: bold; color: #2980B9;">
                           <td colspan="4" class="text-right">Balance</td>
                           <td><?php $balance = $total-$paid; echo number_format($balance); ?></td>
                         </tr>
                       </tfoot>

                     </table>


                   <?php } ?>

                 </div><!-- /.col -->
               </div><!-- /.row -->
             </div><!-- /.container-fluid -->
           </section>
           <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->



         <div class="modal fade" id="modal-lg">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-warning">
                <h4 class="modal-title">Make Supplier Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?php echo base_url();?>Welcome/save_supplier_payment2" method="POST">

                <div class="modal-body">                
                  <input type="hidden" name="supplier_id" id="supplier_id" value="">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <label for="title">Amount <span class="strdngr">*</span></label>
                      <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" required>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <label for="title">Ref <span class="strdngr"></span></label>
                      <input type="text" class="form-control" id="ref" name="ref" placeholder="Reference">
                    </div>

                    <div class="col-md-12 col-sm-12">
                      <label for="detail">Detail</label>
                      <textarea class="form-control" rows="5" id="detail" name="detail" placeholder="Detail"></textarea>
                    </div>   
                  </div>        
                </div>
                <div class="modal-footer">
                  <button type="submit" name="btnSend" class="btn btn-primary">Save Payment</button>

                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>              
              </div>
            </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->



        <?php $this->load->file('assets/includes/footer.php'); ?>


      </div>
      <!-- ./wrapper -->
      <?php $this->load->file('assets/includes/footer_links.php'); ?>


      <script type="text/javascript">
        $(".viewBtn").click(function() {
          var button = $(this).val();
          $("#supplier_id").val(button);
        });
      </script>

    </body>
    </html>
