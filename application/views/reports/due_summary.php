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
  <title>Due Summary</title>
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
            <h1 class="m-0 text-dark">Due Summary</h1>
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
              <h3 class="card-title">Due Summary</h3>
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

              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Reports/get_due_summary" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-4 col-sm-4 ">
                    <label>Customer</label>
                    <select name="customer_id" id="customer_id" class="form-control select2" style="width: 100%;">
                     <option value="">Select Customer</option>
                     <?php
                     foreach($customers as $customer){
                      ?>
                      <option value="<?php echo $customer['customer_id']; ?>"><?php echo $customer['customer_name']; ?></option>
                      <?php
                    }
                    ?>
                  </select>     
                </div>
                <div class="col-md-4 col-sm-4" >
                 <label for="from">From <span class="strdngr">*</span></label>
                 <input type="date" class="form-control" id="date" name="from_date" placeholder="Date" required>
               </div>
               <div class="col-md-4 col-sm-4" >
                 <label for="to">To <span class="strdngr">*</span></label>
                 <input type="date" class="form-control" id="date" name="to_date" placeholder="Date" required value="<?php echo $today; ?>">
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
                  <th>Bill#</th>
                  <th>Customer</th>      
                  <th>Due</th>
                </tr>

              </thead>
              <tbody>
                <?php
                $total = 0;
                foreach ($report as $rp) {
                  ?>
                  <tr>
                   <td><?php echo $rp['sale_id']; ?></td>
                   <td><strong><?php echo $rp['customer_name']; ?></strong> (<?php echo $rp['customer_contact']; ?>)</td> 
                   <td><?php
                  $total += intval($rp['due']); 
                  echo number_format($rp['due']); ?></td>
                </td>
              </tr>
              <?php
            } 
            ?>

          </tbody>
          <tfoot>
           <tr>
             <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
             <td style="text-align: left;"><strong style="color:#f00;"><?php echo number_format($total); ?></strong></td>
           </tr>
         </tfoot>

       </table>

     </div>
     <?php

   } 

   ?>


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
