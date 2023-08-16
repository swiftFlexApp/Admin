<!DOCTYPE html>
<html>
<head>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
  <title>Role Permissions</title>
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
            <h1 class="m-0 text-dark">Role Permissions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url(); ?>Welcome/roles" class="btn btn-sm btn-primary"><i class="fa fa-list"></i>&nbsp;Roles
                </a>&nbsp; 
              </li>
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
            <div class="card">
              <div class="card-header bg-secondary">
                <h3 class="card-title"><?php echo $role[0]['role_name'];?></h3>
                <span id="controlPanel" style="text-align: right;"></span>
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


                <table id="example" class="table table-bordered table-striped">
                 <thead>
                  <tr>
                   <th>Sr #</th>
                   <th>Module</th>
                   <th>Sub Module</th>
                   <th>View</th>
                   <th>Add</th>
                   <th>Edit</th>
                   <th>Delete</th>
                 </tr>
               </thead>
               <tbody>
               </tbody>
               <?php 
               foreach ($modules as $mm) {?>
                <tr>
                  <td><?php echo $mm['module_id']; ?></td>
                  <td colspan="6"><strong><?php echo $mm['module_name']; ?></strong></td>
                </tr>
                <?php
                foreach ($sub_module as $sb) {
                  foreach($sb as $sub)
                  {
                    if($sub['module_id'] == $mm['module_id'])
                      { ?>
                        <tr>
                          <td></td>
                          <td></td>
                          <td><?php echo $sub['operation_name']; ?></td>
                          <td><input type="checkbox" name="view[]"></td>
                          <td><input type="checkbox" name="add[]"></td>
                          <td><input type="checkbox" name="edit[]"></td>
                          <td><input type="checkbox" name="delete[]"></td>
                        </tr>

                        <?php
                      }
                    }
                  }
                  ?>

                  <?php
                }
                ?>                
             </tbody>
           </table>


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
