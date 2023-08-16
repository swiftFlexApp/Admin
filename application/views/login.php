<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  foreach ($app as $data) {
    ?>  
    <title>Login :: <?php echo $data['app_name']; ?></title>
    <?php
  }
  ?>
  <?php
  $this->load->file('assets/includes/top_links.php');
  //$this->load->file('lic.php');
  ?>

</head>
<body style="background-image: url('assets/images/login.jpg'); background-size: cover;">
  <style type="text/css">
    .login{
      background: #EAEDED;
      padding-left: 40px; 
      padding-right: 40px; 
      border-radius: 0 0 20px 20px  ;
      box-shadow: 0 20px 40px 0 rgba(0, 0, 0, 0.6), 0 12px 40px 0 rgba(0, 0, 0, 0.32);

    }
    .login2{
      background: #1F618D;
      padding-left: 40px; 
      padding-right: 40px; 
      padding: 30px; 
      border-radius:  20px 20px 0 0 ;
      box-shadow: 0 20px 40px 0 rgba(0, 0, 0, 0.6), 0 12px 40px 0 rgba(0, 0, 0, 0.32);

    }
  </style>

  <section >
    <p>&nbsp;</p>
    <div class="container" >

     <div class="row">
      <div class="col-md-3 col-sm-3"></div>
      <div class="col-md-6 col-sm-6 login2" >
        <h4 style="color: white; width: 100%;" align="center"><?php echo $app[0]['app_name']; ?></h4>
      </div>
      <div class="col-md-3 col-sm-3"></div>
      <div class="col-md-3 col-sm-3"></div>

      <div class="col-md-6 col-sm-6 login" style="border: 5px solid #1F618D;">
       <div class="text-center">
        <img src="<?php echo base_url();?>assets/uploads/company/<?php echo $app[0]['logo']; ?>" class="rounded img-fluid" alt="logo" style="height: 100px; border-radius: 10px;">
      </div>
      <!-- Login FORM HERE -->
      <form id="appointment-form" role="form" method="POST" action="<?php echo base_url();?>Welcome/login">

       <!-- SECTION TITLE -->

       <div class="section-title wow fadeInUp">

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

        <!--- end success message -->
        <h4 align="center">Member Login</h4>
      </div>

      <div class="col-md-12 col-sm-12">      
        <div class="input-group input-group-md">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email" style="background: #fff;" required>
          <span class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </span>      
        </div>
      </div>
      <p></p>
      <div class="col-md-12 col-sm-12">
        <div class="input-group input-group-md">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="background: #fff;" required>
          <span class="input-group-append">
            <button type="button" class="btn btn-default btn-flat fa">
              <i toggle="#password" class=" fa-fw fa-eye field-icon toggle-password"></i>
            </button>
          </span>
        </div>
      </div>

      <p align="center">&nbsp;</p>
      <div class="col-md-12 col-sm-12">
        <label for="password">&nbsp; <span class="strdngr">&nbsp;</span></label>

        <div class="col-4" style="float: right;">
          <button type="submit" name="btnLogin" id="cf-submit" class="btn btn-primary btn-block form-control">Sign In</button>
        </div>
        <br>
        <br>
        <br>
        <!-- <p align="center">Developed By: <a href="http://www.solutioncorridor.com"><strong>Solution Corridor (Digital Consultant)</strong></a></p> -->
        <p align="center"><?php $this->load->file('version.php'); ?></p>
        <br>
      </div>
    </div>
  </form>
</div>

<div class="col-md-3 col-sm-3"></div>

</div>
</div>
</section>

<?php
$this->load->file('assets/includes/footer_links.php');
?>

<script type="text/javascript">
  $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
</script>

</body>
</html>
<!-- border:5px solid #1F618D; -->