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
  ?>

</head>
<body>


 <section>
  <p>&nbsp;</p>
  <div class="container">
  	<h1 align="center" style="padding-bottom: 20px;">Member Logn</h1>
   <div class="row">
    <div class="col-md-3 col-sm-3"></div>
    <div class="col-md-6 col-sm-6" style="background: #EAEDED; ; padding-left: 40px; padding-right: 40px; border-radius: 20px;  box-shadow: 0 20px 40px 0 rgba(0, 0, 0, 0.6), 0 12px 40px 0 rgba(0, 0, 0, 0.32);">
      <p>&nbsp;</p>
      <div class="text-center">
        <?php
        foreach ($app as $data) {
          ?>  
          <img src="<?php echo base_url();?>assets/uploads/company/<?php echo $data['logo']; ?>" class="rounded img-fluid" alt="logo" style="height: 100px; border-radius: 10px;">
          <?php
        }
        ?>

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

        <?php
        foreach ($app as $data) {
          ?>  
          <p>&nbsp;</p>
          <h4 align="center"><?php echo $data['app_name']; ?></h4>
          <?php
        }
        ?>    
      </div>

      <div class="wow fadeInUp">
        <div class="input-group mb-3">
         <input type="Email" class="form-control" id="email" name="email" placeholder="email" style="background: #fff;" required>
         <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3">
       <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="background: #fff;" required>
       <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>
    <p align="center">
      <a href="#">Forgot your Password?</a>
    </p>
    <div class="col-md-12 col-sm-12">
      <label for="password">&nbsp; <span class="strdngr">&nbsp;</span></label>

      <div class="col-4" style="float: right;">
        <button type="submit" name="btnLogin" id="cf-submit" class="btn btn-primary btn-block form-control">Sign In</button>
      </div>
      <br>
      <br>
      <p align="center">Powered by: <a href="http://solutioncorridor.com/">Solution Corridor (Digital Consultant)</a></p>          
      <?php $this->load->file('version.php'); ?>
      <br>  
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

</body>
</html>