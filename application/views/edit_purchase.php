<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
<?php $this->load->file('assets/includes/top_links.php'); ?>

<title>Edit Purchase</title>
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
            <h1 class="m-0 text-dark">Edit Purchase</h1>
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
    <style>
    table{
      width: 100%;
      margin: 20px 0;
      border-collapse: collapse;
    }
    table, th, td{
      border: 1px solid #cdcdcd;
    }
    table th, table td{
      padding: 5px;
      text-align: left;
    }
  </style>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">          
      <!-- Main row -->
      <div class="row">

        <div class="col-md-12">

          <!-- Horizontal Form -->
          <div class="card">
            <div class="card-header bg-secondary">
              <h3 class="card-title">Edit Purchase Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

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


            <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Welcome/update_purchase" enctype="multipart/form-data">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Date <span class="strdngr">*</span></label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Date" required value="<?php echo date('Y-m-d'); ?>" readonly>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Supplier <span class="strdngr">*</span></label>
                    <select name="supplier_id" class="form-control" required="">
                      <?php
                      foreach($supplier as $s){
                        ?>
                        <option value="<?php echo $s['supplier_id']; ?>"><?php echo $s['supplier_name']; ?></option>
                      <?php } ?>

                      <option>Select Supplier</option>
                      <?php
                      foreach($suppliers as $supplier){
                        ?>
                        <option value="<?php echo $supplier['supplier_id']; ?>"><?php echo $supplier['supplier_name']; ?></option>
                        <?php
                      }
                      ?>

                    </select>
                  </div>
                  

                  
                  <div class="col-md-12">
                    <table name="invoice" id="tbl-items-append" class="table table-bordered tbl" style="background:#EBEDEF;">
                      <thead>                      
                        <tr>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Total</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach($product as $p)
                        {
                          ?>
                          <tr name="line_items">
                            <td><select class="form-control" name="product_id[]" required="" id="product">
                              <option value="<?php echo $p['product_id']; ?>"><?php echo $p['product_name']; ?></option>
                              <option value="" disabled="">Select Product</option>
                              <?php
                              foreach($products as $pr){
                                ?>
                                <option value="<?php echo $pr['product_id']; ?>"><?php echo $pr['product_name']; ?></option>
                                <?php
                              }
                              ?>
                            </select></td>
                            <td><input type="number" name="purchase_price[]" id="purchase_price" class="form-control" required="" placeholder="Purchase Price" step="0.01" value="<?php echo $p['purchase_price']; ?>"></td>
                            <td><input type="number" class="form-control" name="qty[]" id="qty" placeholder="Quantity" value="<?php echo $p['qty']; ?>"></td>
                            <td><input type="number" name="total[]" id="total" class="form-control prc row_total" required="" id="rate" placeholder="Total" step="0.01" value="<?php echo $p['total']; ?>"></td>
                            <td> <button type="button" class="btn btn-danger remove"><i class="fas fa-trash"></i></button></td>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="3" style="text-align:right; font-weight: bold;">Grand Total</td>
                          <?php
                          foreach($purchase as $ps){
                            ?>
                            <td style="text-align:left; font-weight: bold;" id="sum"><input type="text" name="total" id="total" class="form-control" readonly="" placeholder="Total" value="<?php echo number_format($ps['purchase_amount']); ?>"></td>
                            <input type="hidden" name="purchase_id" value="<?php echo $ps['purchase_id']; ?>">
                            <?php
                          }
                          ?>


                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <div class="row my-2">
                    <div class="col-md-12 text-center">
                      <button type="button" class="btn btn-success add" id="btn-add-more-products"><i class="fas fa-plus-circle mx-2"></i>Add More Product(s) </button>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.card-body -->
              <div class="" align="center">
                <!-- <button type="submit" name="btnCancel" class="btn btn-danger">Cancel</button> -->
                <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                <button type="submit" name="btnSend" class="btn btn-primary">Update Purchase</button>

              </div>
              <br>
              <!-- /.card-footer -->
            </form>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>


<script>
  $(document).ready(function(){
    $(".add").on("click", function(e) {
      e.preventDefault();
      var tbody = $(".tbl tbody");
      tbody.find("tr:eq(0)").clone().appendTo(tbody).find("input").val("");
    });
        // Find and remove selected table rows
        $(".tbl").on("click", "button", ".remove", function (e) {
          var tableRow = $(this).closest("tr");
          tableRow.remove();
          calcTotal();   
        });
      });  

  function calcTotal(){
    var grand_total = 0;
    $(".row_total").each(function(){
      grand_total += parseFloat($(this).val());
    });
    $('#sum').html(grand_total);
  }
</script>
<script>
      $(".tbl").on("change", "input", function (e) {  //use event delegation
    var tableRow = $(this).closest("tr");  //from input find row
    var one = Number(tableRow.find("#qty").val());  //get first textbox
    var two = Number(tableRow.find("#purchase_price").val());  //get second textbox
    var total = one * two;  //calculate total
    tableRow.find("#total").val(total);  //set value
    calcTotal();
  });
</script>

</body>
</html>
