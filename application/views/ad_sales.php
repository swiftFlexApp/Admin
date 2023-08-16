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
<title>Add Sales</title>
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
            <h1 class="m-0 text-dark">Add Sales</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <?php $this->load->file('assets/includes/sale_bar.php'); ?>
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
              <h3 class="card-title">Add Sales Form</h3>
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


            <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>Welcome/save_sale" enctype="multipart/form-data">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-4 col-sm-4">
                    <label for="title">Date <span class="strdngr">*</span></label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="Date" required value="<?php echo date('Y-m-d'); ?>">
                  </div>

                  <div class="col-md-4 col-sm-4 cstmr">
                    <label for="title">Customer <span class="strdngr">*</span></label>
                    <select name="customer_id" id="customer_id" class="form-control select2" required="" style="width: 100%;">
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

                <div class="col-md-4 col-sm-4">
                  <label for="title">Pervious Balance</label>
                  <input type="text" name="previous_balance" id="previous_balance" placeholder="Balance" readonly="" class="form-control">
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
                      <tr name="line_items">
                        <td class="abs"><select class="form-control  product select2" name="product_id[]" required="" id="product">
                          <option value="">Select Product</option>
                          <?php
                          foreach($products as $pr){
                            ?>
                            <option value="<?php echo $pr['product_id']; ?>"><?php echo $pr['product_name']; ?></option>
                            <?php
                          }
                          ?>
                        </select></td>
                        <td id="p_price"><input type="number" name="price[]" id="price" class="form-control" required="" placeholder="Price" step="0.01" style="width:100px;"></td>

                        <td style="width:100px;"><input type="number" name="stock" id="stock" class="form-control" required="" placeholder="Stock" step="0.01" readonly=""></td>

                        <td><input type="number" class="form-control" name="qty[]" id="qty" placeholder="Quantity" style="width:100px;"></td>

                        <td><input type="number" class="form-control row_disc" name="discount[]" id="discount" placeholder="Discount" style="width:100px;"></td>

                        <td><input type="number" name="total[]" id="total" class="form-control prc row_total" required="" id="rate" placeholder="Total" step="0.01"></td>
                        <td> 

                          <button type="button" class="btn btn-danger remove"><i class="fas fa-trash"></i></button></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td rowspan="5">
                            <textarea class="form-control" name="invoice_note" rows="5" placeholder="Note for Customer"></textarea><br>
                            <strong>Due Promise</strong>
                            <input type="date" name="due_promise"class="form-control">
                          </td>

                          <td colspan="3" style="text-align:right; font-weight: bold;">Total</td>
                          <td style="text-align:left; font-weight: bold;" id="total_dis">
                            <input type="text" name="total_discount" id="total_discount" class="form-control" readonly="" placeholder="Discount">
                          </td>
                          <td style="text-align:left; font-weight: bold;" id="sum"><input type="text" name="stotal" id="stotal" class="form-control" readonly="" placeholder="Total"></td>                          
                        </tr>
                        <tr>
                          <td colspan="3" class="text-right"> <strong>Invoice Discount</strong></td>
                          <td><input type="text" name="invoice_discount" id="invoice_discount" class="form-control" placeholder="0" onblur="calcTotals()"></td>
                          <td><input type="text" name="totals" id="totals" class="form-control" placeholder="Total" readonly=""></td>
                        </tr>
                        <tr>
                          <td colspan="3" class="text-right"> <strong>Paid</strong></td>
                          <td colspan="2"><input type="text" name="paid" id="paid" class="form-control" placeholder="0" onblur="pay()"></td>
                        </tr>
                        <tr>
                          <td colspan="3" class="text-right"> <strong>Due</strong></td>
                          <td colspan="2"><input type="text" name="due" id="due" class="form-control" placeholder="0" readonly=""></td>
                        </tr>

                        <tr>
                          <td colspan="3" class="text-right"> <strong>Total Due</strong></td>
                          <td colspan="2"><input type="text" name="total_due" id="total_due" class="form-control" placeholder="0" readonly=""></td>
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
                <button type="submit" name="btnSend" class="btn btn-primary">Add Sale</button>

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

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->

<script>
  var products       = <?=json_encode($products);?>; 
  var products_options = "<option value=''> Select Product</option>";  
  
  $(document).ready(function(){ 
    // $(".add").on("click", function(e) {

    //   e.preventDefault();
    //   var tbody = $(".tbl tbody");      
    
    //  tbody.find("tr:eq(0)").clone().appendTo(tbody).find("input").val('');    
    
    //   $('tr.select2').remove();
    //   $('select.select2').removeAttr('data-select2-id');
    //   // $('select.select2').select2();
    // });  
    
    
    products.forEach(function (option) {
      products_options += '<option value="' + option.product_id + '" >' + option.product_name + '</option>';
    });
    var  i =0;
    $(".add").on("click", function(e) {    

      var html = '';   
      html += '<tr  name="line_items">'; 
      html += '<td class="abs"><select class="form-control  select2" name="product_id[]" required="" id="product">'; 
      html += products_options+'</select></td>';               
      html += '<td id="p_price"><input type="number" name="price[]" id="price" class="form-control" required="" placeholder="Price" step="0.01" style="width:100px;"></td>';
      html +='<td style="width:100px;"><input type="number" name="stock" id="stock" class="form-control" required="" placeholder="Stock" step="0.01" readonly=""></td>';
      html +='<td><input type="number" class="form-control" name="qty[]" id="qty" placeholder="Quantity" style="width:100px;"></td>';
      html +='td><input type="number" class="form-control row_disc" name="discount[]" id="discount" placeholder="Discount" style="width:100px;"></td>';
      html +='<td><input type="number" class="form-control row_disc" name="discount[]" id="discount" placeholder="Discount" style="width:100px;"></td>';
      html +='<td><input type="number" name="total[]" id="total" class="form-control prc row_total" required="" id="rate" placeholder="Total" step="0.01"></td>';
      html +='<td><button type="button" class="btn btn-danger remove"><i class="fas fa-trash"></i></button></td></tr>';
      $('#tbl-items-append tbody tr:last').after(html);  
      
      $('tr.select2').remove();
      $('select.select2').removeAttr('data-select2-id');
      $('select.select2').select2();  
    }); 
    
    
//     // on first focus (bubbles up to document), open the menu
// $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
//   $(this).closest(".select2-container").siblings('select:enabled').select2('open');
// });

// // steal focus during close - only capture once and stop propogation
// $('select.select2').on('select2:closing', function (e) {
//   $(e.target).data("select2").$selection.one('focus focusin', function (e) {
//     e.stopPropagation();
//   });
// });



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
    
//var value = parseInt(tbb) == NaN ? 0 : parseInt(tbb)

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
    var price = Number(tableRow.find("#price").val());  //get price textbox
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
        tableRow.find("#price").val(response[0].price);
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
            var due = response[0].due;

            $.ajax({
              url:'<?=base_url()?>Welcome/getPreviousPayments/'+customer_id,
              method: 'post',
              data: {customer_id: customer_id},
              dataType: 'json',
              success: function(response){
               var pmnt = response[0].previous_payment;
               var previous_payment = parseFloat(due-pmnt);
               $("#previous_balance").val(previous_payment);           
             }
           });


          }
        });  

        

      });

    </script>



  </body>
  </html>
