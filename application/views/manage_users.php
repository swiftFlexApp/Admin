<!DOCTYPE html>
<html>
<head>
  <?php $this->load->file('assets/includes/top_links.php'); ?>
  <title>Manage Users</title>
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
            <h1 class="m-0 text-dark">Manage Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item active">Users Cars</li>
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
              <h3 class="card-title">Manage Users</h3>
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


            <table id="example1" class="table table-bordered table-striped">
         <thead>
          <tr>
           <th>Id</th> 
           <th>Pic</th>
           <th>User</th>
           <th>Login</th>         
           <th>Detail</th>         
           <th>Status</th>
           <th>Action</th>
         </tr>
       </thead>
       <tbody>
       <?php foreach ($result as $data) {?>
         <tr>

          <td>
            <?php echo $data['memberID']; ?>
          </td> 
          <td>
            <?php
            if (!empty($data['pic'])) {
              
              echo '<img src="'.base_url().'/assets/uploads/profile/'.$data['pic'].'" width="80px" height="80px" alt="No Pic">'; 
            }
            else{
              echo "No Pic";
            }
            ?> 
            
          </td>         
          <td>
            <strong style="color: blue;"><i class="fa fa-user"></i> <?php echo $data['username']; ?></strong><br>
            <i class="fa fa-phone"></i> <?php echo $data['phone']; ?>
          </td>
          <td>
            <i class="fa fa-envelope"></i> <?php echo $data['email']; ?><br>
            <i class="fa fa-lock"></i> <?php echo "*********" ?>
          </td>        
          <td>            
            <?php echo $data['detail']; ?>
          </td>        
          <td>            
            <?php echo $data['active']; ?>
          </td>


          <td>
            <form name="delForm" action="<?php echo base_url();?>Welcome/edit_user" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="user_id" value="<?php echo $data['memberID']; ?>">
              <input type="submit" name="btnEdit" value="Edit" class="btn btn-primary">
            </form>  

            <form name="delForm" action="<?php echo base_url();?>Welcome/delete_user" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="user_id" value="<?php echo $data['memberID']; ?>">
              <input type="submit" name="btnDelete" value="Delete" onClick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">
            </form>         
          </td>
        </tr>
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
