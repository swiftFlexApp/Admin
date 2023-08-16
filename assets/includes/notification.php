<?php
$email=$this->session->userdata('email');
$name=$this->session->userdata('name');
$pic=$this->session->userdata('pic');
?>
<!-- Notifications Dropdown Menu -->
<li class="nav-item">
  <div class="user-panel d-flex">      
    <div class="info">
      <a href="<?php echo base_url();?>Welcome/profile" class="d-block"><?php echo $name;?></a>
    </div>
    <div class="image">
      <img src="<?php echo base_url(); ?>assets/uploads/profile/<?php echo $pic;?>" class="img-circle elevation-2" alt="User Image">
    </div>
  </div>
</li>