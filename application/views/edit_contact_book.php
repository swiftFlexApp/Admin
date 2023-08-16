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
  <title>Edit Contact Book</title>
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
            <h1 class="m-0 text-dark">Edit Contact Book</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="<?php echo base_url(); ?>Welcome/ad_contact_book" class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i>&nbsp;Add Contact Book</a>&nbsp;
              <a href="<?php echo base_url(); ?>Welcome/list_contact_book" class="btn btn-sm btn-primary"><i class="fa fa-list"></i>&nbsp;List Contact Book</a>
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

            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header bg-secondary">
                <h3 class="card-title">Edit Contact Book Form</h3>
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


              <?php
              foreach($result as $cb)
              {
                ?>
               <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Welcome/update_contact_book" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $cb['id']; ?>">
                <div class="card-body">
                  <div class="row">
                 
                  <div class="col-md-6 col-sm-6">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $cb['name']; ?>" placeholder="Name">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Phone No 1</label>
                    <input type="number" class="form-control" id="contact" name="contact" placeholder="Phone No 1" value="<?php echo $cb['contact']; ?>" minlength="11" maxlength="11">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Phone No 2</label>
                    <input type="number" class="form-control" id="contact2" name="contact2" placeholder="Phone No 2" value="<?php echo $cb['contact2']; ?>" minlength="11" maxlength="11">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">Phone No 3</label>
                    <input type="number" class="form-control" id="contact3" name="contact3" placeholder="Phone No 3" value="<?php echo $cb['contact3']; ?>"  minlength="11" maxlength="11">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label for="title">WhatsApp No</label>
                    <input type="number" class="form-control" id="whatsapp_no" name="whatsapp_no" placeholder="WhatsApp No" value="<?php echo $cb['whatsapp_no']; ?>"  minlength="11" maxlength="11">
                  </div>

                  <div class="col-md-4 col-sm-4">
                    <label for="title">Picture</label>
                    <input type="file" class="form-control" id="picture" name="picture">
                  </div>
                  <div class="col-md-2 col-sm-2">
                    <label for="title">&nbsp;&nbsp;&nbsp;</label>
                   <img src="<?php echo base_url('assets/uploads/contact_book/'); ?><?php echo $cb['picture']; ?>" style="width:100px; height: 100px;">
                  </div>

                  <div class="col-md-12 col-sm-12">
                    <label for="detail">Detail</label>
                    <textarea class="form-control" rows="5" id="detail" name="detail" placeholder="Detail"><?php echo $cb['detail']; ?></textarea>
                  </div>                
                </div>
                </div>
                <!-- /.card-body -->
                <div class="" align="center">
                  <!-- <button type="submit" name="btnCancel" class="btn btn-danger">Cancel</button> -->
                  <a class="btn btn-danger" href="<?php echo base_url('welcome/dashboard');?>">Cancel</a>
                  <button type="submit" name="btnSend" class="btn btn-primary ">Update Contact</button>
                </div>
                <br>
                <!-- /.card-footer -->
              </form>
              <?php
            }
            ?>
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
