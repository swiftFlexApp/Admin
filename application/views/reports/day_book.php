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
  <title>Day Book</title>
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
            <h1 class="m-0 text-dark">Day Book</h1>
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
              <h3 class="card-title">Day Book</h3>
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

              <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Reports/get_day_book" enctype="multipart/form-data">
                <div class="row">
                  
                <div class="col-md-4 col-sm-4" >
                 <label for="from">From <span class="strdngr">*</span></label>
                 <input type="date" class="form-control" id="from_date" name="from_date" placeholder="Date" required>
               </div>
               <div class="col-md-4 col-sm-4" >
                 <label for="to">To <span class="strdngr">*</span></label>
                 <input type="date" class="form-control" id="to_date" name="to_date" placeholder="Date" required value="<?php echo $today; ?>">
               </div>

               <div class="col-md-4" >
                <label for="to"><span class="strdngr"><br><br></span></label>
              <button  type="submit" name="btnSend" class="btn btn-primary ">Get Record</button>
            </div>

             </div>
             <br>
             
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
                  <th colspan="7">
                    <h6 align="center">
                      <?php
                      $from_date = date_create($this->input->post('from_date'));
                      $to_date = date_create($this->input->post('to_date'));
                      echo date_format($from_date, "d-m-Y");?>
                      <strong>to</strong> 
                      <?php echo date_format($to_date, "d-m-Y"); ?>                        
                    </h6>            
                  </th>
                </tr>
                <tr style="font-size:20px; font-weight: bold; color: #2980B9;">
                  <th colspan="4" class="text-center">Income</th>
                  <th colspan="3" class="text-center">Expense</th>
                </tr>
                <tr>
                  <th>Date</th>
                  <th>Inc#</th>                             
                  <th>Title</th>
                  <th>Amount</th>                  
                  <th>Exp#</th>                             
                  <th>Title</th>
                  <th>Amount</th>                  
                </tr>
              </thead>
              <tbody>
                <?php
                $total_income = 0;
                $total_exp = 0;
                
                foreach ($report as $rp) {
                  ?>
                  <tr>
                    <td><?php 
                    $date=date_create($rp['date']);
                    echo date_format($date,"d-m-Y"); ?></td>   
                    <td><?php echo $rp['inc_id']; ?></td> 
                    <td><?php echo $rp['inc_heading']; ?></td>
                    <td>
                      <?php $total_income+=$rp['inc_amount']; echo number_format($rp['inc_amount']); ?>  
                    </td>
                    <td><?php echo $rp['exp_id']; ?></td>
                    <td><?php echo $rp['exp_heading']; ?></td>
                    <td>
                      <?php $total_exp+=$rp['exp_amount']; echo number_format($rp['exp_amount']); ?>  
                    </td>
                </tr>
                <?php
              } 
              ?>

            </tbody>
            <tfoot>
             <tr>
               <td colspan="3" style="text-align: right;"><strong>Total Income</strong></td>
               <td style="text-align: left;"><strong style="color:green;"><?php echo number_format($total_income); ?></strong></td>
               <td colspan="2" style="text-align: right;"><strong>Total Expense</strong></td>
               <td style="text-align: left;"><strong style="color:red;"><?php echo number_format($total_exp); ?></strong></td>
             </tr>
             <tr style="font-size:20px; font-weight: bold; color: #2980B9;">
               <td colspan="6" class="text-right">Balance</td>
               <td><?php $balance = $total_income-$total_exp; echo number_format($balance); ?></td>
             </tr>
           </tfoot>

         </table>

       </div>
       <?php } ?>


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
