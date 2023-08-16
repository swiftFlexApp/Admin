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
<title>Edit Sales</title>
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
            <h1 class="m-0 text-dark">Edit Sales</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="<?php echo base_url(); ?>Welcome/ad_sales" class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i>&nbsp;Add Sale</a>&nbsp;
              <a href="<?php echo base_url(); ?>Welcome/list_sales" class="btn btn-sm btn-primary"><i class="fa fa-list"></i>&nbsp;List Sale</a>  
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
              <h3 class="card-title">Edit Sales Form</h3>
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


            <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Welcome/update_sale" enctype="multipart/form-data">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-3 col-sm-3">
                    <label for="title">Date <span class="strdngr">*</span></label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Date" required value="<?php echo date('Y-m-d'); ?>" readonly>
                  </div>

                  <div class="col-md-3 col-sm-3">
                    <label for="title">Sale Type <span class="strdngr">*</span></label>
                    <select class="form-control" name="sale_type" required="">
                      <?php
                      foreach($sale as $s){
                        ?>
                        <option value="<?php echo $s['sale_type']; ?>"><?php echo $s['sale_type']; ?></option>
                        <?php
                      }
                      ?>
                      <option value="Local Sale">Local Sale</option>
                      <option value="Whole Sale">Whole Sale</option>
                    </select>
                  </div>

                  <div class="col-md-3 col-sm-3 cstmr">
                    <label for="title">Customer <span class="strdngr">*</span></label>
                    <select name="customer_id" id="customer_id" class="form-control select2" required="" style="width: 100%;">
                      <?php
                      foreach($customer as $c){
                        ?>
                        <option value="<?php echo $c['customer_id']; ?>"><?php echo $c['customer_name']; ?></option>
                      <?php } ?>
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
                  <div class="col-md-3 col-sm-3">
                    <label for="title">Pervious Balance</label>
                    <input type="text" name="previous_balance" id="previous_balance" placeholder="0" readonly="" class="form-control">                    
                  </div>

                  <div class="col-md-12">
                    <table name="invoice" id="tbl-items-append" class="table table-bordered tbl" style="background:#EBEDEF;">
                      <thead>                      
                        <tr>
                          <th>Product</th>
                          <th style="width:100px;">Price</th>
                          <th style="width:100px;">Stock</th>
                          <th style="width:100px;">Quantity</th>
                          <th style="width:100px;">Discount</th>
                          <th style="width:150px;">Total</th>
                          <th style="width:70px;">Action</th>
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
                            <td id="local_sale"><input type="number" name="l_price[]" id="l_price" class="form-control" required="" placeholder="Local Price" step="0.01" style="width:100px;" value="<?php echo $p['l_price']; ?>"></td>

                            <td id="whole_sale" style="display: none;"><input type="number" name="w_price[]" id="w_price" class="form-control" required="" placeholder="Whole Sale" step="0.01" style="width:100px;" value="<?php echo $p['w_price']; ?>"></td>

                            <td style="width:100px;"><input type="number" name="stock" id="stock" class="form-control" required="" placeholder="Stock" step="0.01" readonly=""></td>

                            <td><input type="number" class="form-control" name="qty[]" id="qty" placeholder="Quantity" style="width:100px;" value="<?php echo $p['qty']; ?>"></td>

                            <td><input type="number" class="form-control row_disc" name="discount[]" id="discount" placeholder="Discount" style="width:100px;" value="<?php echo $p['discount']; ?>"></td>

                            <td><input type="number" name="total[]" id="total" class="form-control prc row_total" required="" id="rate" placeholder="Total" step="0.01" value="<?php echo $p['total']; ?>"></td>
                            <td> 

                              <button type="button" class="btn btn-danger remove"><i class="fas fa-trash"></i></button></td>
                            </tr>
                            <?php
                          }
                          ?>
                        </tbody>
                        <tfoot>
                          <?php
                          foreach($sale as $st){
                            ?>
                            <tr>
                              <td colspan="4" style="text-align:right; font-weight: bold;">Total</td>
                              <td style="text-align:left; font-weight: bold;" id="total_dis">
                                <input type="text" name="total_discount" id="total_discount" class="form-control" readonly="" placeholder="Discount">
                              </td>
                              <td style="text-align:left; font-weight: bold;" id="sum"><input type="text" name="stotal" id="stotal" class="form-control" readonly="" placeholder="Total" value="<?php echo $st['sale_amount']; ?>"></td>                          
                            </tr>
                            <tr>
                              <td colspan="4" class="text-right"> <strong>Invoice Discount</strong></td>
                              <td><input type="text" name="invoice_discount" id="invoice_discount" class="form-control" placeholder="0" onblur="calcTotals()" value="<?php echo $st['inv_discount']; ?>"></td>
                              <td><input type="text" name="totals" id="totals" class="form-control" placeholder="Total" readonly="" value="<?php echo $st['sale_amount']-$st['inv_discount']; ?>"></td>
                            </tr>
                            <tr>
                              <td colspan="4" class="text-right"> <strong>Paid</strong></td>
                              <td colspan="2"><input type="text" name="paid" id="paid" class="form-control" placeholder="0" onblur="pay()" value="<?php echo $st['paid']; ?>"></td>
                            </tr>
                            <tr>
                              <td colspan="4" class="text-right"> <strong>Due</strong></td>
                              <td colspan="2"><input type="text" name="due" id="due" class="form-control" placeholder="0" readonly="" value="<?php echo $st['due']; ?>"></td>
                            </tr>

                            <tr>
                              <td colspan="4" class="text-right"> <strong>Total Due</strong></td>
                              <td colspan="2"><input type="text" name="total_due" id="total_due" class="form-control" placeholder="0" readonly=""></td>
                            </tr>
                            <input type="hidden" name="sale_id" value="<?php echo $st['sale_id']; ?>">
                            <?php
                          }
                          ?>
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
                  <button type="submit" name="btnSend" class="btn btn-primary">Update Sale</button>

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
    var full_total = 0;
    var full_discount = 0;

    $(".row_total").each(function(){
      full_total += parseFloat($(this).val());
    });

    $(".row_disc").each(function(){
      full_discount += parseFloat($(this).val());
    });

      $('#stotal').val(full_total);
    $('#total_dis').html(full_discount);     
  }

  function calcTotals(){
    var inv_disc = $('#invoice_discount').val();
    var total = $('#stotal').val(); 
    var t = 0; 
    var t = parseFloat(total)-parseFloat(inv_disc);
      //alert(t);   
      $('#totals').val(t);   
    }

    function pay(){
      var paid = $('#paid').val();
      var total = $('#totals').val();
      var previous = $('#previous_balance').val();  
      var due = parseFloat(total)-parseFloat(paid);
      $('#due').val(due);
      var tdue = parseFloat(previous)+parseFloat(due);
      $('#total_due').val(tdue); 
    }


    // function checkQty(){
    //   var stock = $('#stock').val();
    //   var qty = $('#qty').val(); 

    //   if (parseInt(qty) > parseInt(stock)) {
    //     alert('Stock is Low');
    //     }        
    // }

    // $(document).ready(function(){
    //   $("#qty").on("focusout", function() {
    //     //e.preventDefault();
    //     var stock = $('#stock').val();
    //     var qty = $('#qty').val();      
    //     if (parseInt(qty) > parseInt(stock)) {
    //       alert('Stock is Low');
    //     } 

    //   });
    // });  
  </script>
  <script>
      $(".tbl").on("change", "input", function (e) {  //use event delegation
    var tableRow = $(this).closest("tr");  //from input find row
    var qty = Number(tableRow.find("#qty").val());  //get qty textbox
    var lprice = Number(tableRow.find("#l_price").val());  //get price textbox
    var wprice = Number(tableRow.find("#w_price").val());
    var discount = Number(tableRow.find("#discount").val());  //get dicount textbox
    var type = $('#sale_type option:selected').val();
    if (type =='Whole Sale') {
      var total = (qty * wprice)-discount;  //calculate total
    }
    if (type =='Local Sale') {
      var total = (qty * lprice)-discount;  //calculate total
    }
    //var total = (qty * lprice)-discount;  //calculate total
    tableRow.find("#total").val(total);  //set value

    calcTotal();

  });

      $(".tbl").on("change", "input, select", function(e){
        e.preventDefault();
    var tableRow = $(this).closest("tr");  //from input find row
    var product_id = tableRow.find("#product").val();
    $.ajax({
      url:'<?=base_url()?>Welcome/getProductDetails/'+product_id,
      method: 'post',
      data: {product_id: product_id},
      dataType: 'json',
      success: function(response){
        tableRow.find("#l_price").val(response[0].l_price);
        tableRow.find("#w_price").val(response[0].w_price);
        var sale = response[0].sale;
        var purchase = response[0].purchase;
        var stock = purchase - sale;
        tableRow.find("#stock").val(stock);
      }
    });

  });

      $(".cstmr").on("change", "input, select", function(e){
        e.preventDefault();
        var customer_id = $("#customer_id").val();
        $.ajax({
          url:'<?=base_url()?>Welcome/getPreviousBalance/'+customer_id,
          method: 'post',
          data: {customer_id: customer_id},
          dataType: 'json',
          success: function(response){
            $("#previous_balance").val(response[0].previous);
          }
        });

      });
    </script>

<!-- <script type="text/javascript">
  function changeFunc() {
    var selectBox = document.getElementById("payment_method");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    if (selectedValue=="Bank"){
      $('#bankk').show();
    }
    else {
      $('#bankk').hide();
    }
  }
</script> -->

<script type="text/javascript">
  function changeSale() {
    var saleType = document.getElementById("sale_type");
    var selectedValue = saleType.options[saleType.selectedIndex].value;
    if (selectedValue=="Whole Sale"){
      $('#whole_sale').show();
      $('#local_sale').hide();
    }
    else {
      $('#local_sale').show();
      $('#whole_sale').hide();
    }
  }
</script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    var full_total = 0;
    var full_discount = 0;

    $(".row_total").each(function(){
      full_total += parseFloat($(this).val());
    });

    $(".row_disc").each(function(){
      full_discount += parseFloat($(this).val());
    });

    $('#sum').html(full_total);
     $('#total_dis').html(full_discount);     
  }
</script>
<script>
      $(".tbl").on("change", "input", function (e) {  //use event delegation
    var tableRow = $(this).closest("tr");  //from input find row
    var qty = Number(tableRow.find("#qty").val());  //get qty textbox
    var price = Number(tableRow.find("#selling_price").val());  //get price textbox
    var discount = Number(tableRow.find("#discount").val());  //get dicount textbox
    var total = (qty * price)-discount;  //calculate total
    tableRow.find("#total").val(total);  //set value

    calcTotal();

  });

      $(".tbl").on("change", "input, select", function(e){
        e.preventDefault();
    var tableRow = $(this).closest("tr");  //from input find row
    var product_id = tableRow.find("#product").val();
    $.ajax({
      url:'<?=base_url()?>Welcome/getProductDetails/'+product_id,
      method: 'post',
      data: {product_id: product_id},
      dataType: 'json',
      success: function(response){
        tableRow.find("#selling_price").val(response[0].selling_price);
        tableRow.find("#selling_price").val(response[0].selling_price);
      }
    });

  });
</script> -->


</body>
</html>
