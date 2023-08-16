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
<title>User Roles</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed" onload="myFunction()" style="margin:0;">
  <div class="loader" id="loader"></div>
  <div class="wrapper" id="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <?php include 'assets/includes/top_navbar.php'; ?>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
    <?php include 'assets/includes/notification.php'; ?>
   </ul>
  </nav>
  <!-- /.navbar -->
  <?php include 'assets/includes/sidebar.php'; ?>

  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
     <div class="row mb-2">
      <div class="col-sm-6">
       <h1 class="m-0 text-dark">User Roles</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
       <?php //include 'assets_admin/includes/bills_bar.php'; ?>
      </div><!-- /.col -->
     </div><!-- /.row -->
    </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->


   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">          
     <div class="row">
      <div class="col-sm-12">
       <div class="card">
        <div class="card-header">
         <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
           <a class="nav-link active" href="#list_service" data-toggle="tab"><i class="fa fa-bars"></i> List Roles</a>
          </li>
          <li class="nav-item">
           <a class="nav-link" href="#ad_service" data-toggle="tab">
            <i class="fa fa-plus"></i> Add Role</a>
           </li>
          </ul>
         </div>
         <div class="tab-content pt-0">
          <div role="tabpanel" id="list_service" class="tab-pane fade show active">
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
           
           <table id="example1" class="table table-bordered table-striped">
            <thead>
             <tr>
              <th>Sr#</th>
              <th>Name</th>
              <th>Note</th>
              <th>Action</th>
             </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($roles as $key) { ?>
              <tr>
                <td><?php echo $key['role_id']; ?></td>
                <td><?php echo $key['role_name']; ?></td>
                <td><?php echo $key['role_note']; ?></td>
                <td>

                  <a href="<?php echo base_url(); ?>Welcome/role_permisions?role_id=<?php echo $key['role_id']; ?>" class="btn btn-sm btn-info">
                    <i class="fa fa-eye"></i>&nbsp;Permissions
                  </a>
                  
                  <a href="<?php echo base_url(); ?>Welcome/delete_role?role_id=<?php echo $key['role_id']; ?>" class="btn btn-sm btn-danger" onClick="return confirm('Are you sure you want to delete?')">
                    <i class="fa fa-trash"></i>&nbsp;Delete
                  </a>
                </td>
              </tr>
                <?php } ?>                        
            </tbody>
           </table>
          </div>
         </div>
         <div role="tabpanel" id="ad_service" class="tab-pane fade show">
          <form action="<?php echo base_url();?>Welcome/save_role" method="POST" enctype="multipart/form-data">
           <div class="card-body">
            <div class="row"> 

             <div class="col-md-12">
              <label><b>Role Name </b><span class="strdngr">*</span></label>
              <input type="text" name="role_name" placeholder="Role Name" class="form-control" required="">
             </div>

             <div class="col-md-12">
              <label><b>Detail </b></label>
              <textarea name="role_note" class="form-control" placeholder="Description"></textarea>
             </div>

            </div>                        

           </div>
           <div class="card-footer text-center">
            <button type="submit" name="btnService" class="btn btn-info">Add Role</button>
           </div>
          </form>
         </div>



        </div>
       </div>
      </div>      
     </div>

    </div>      
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

