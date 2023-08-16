<!-- Left navbar links -->
<ul class="navbar-nav">

  <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
  </li>

  <li class="nav-item d-none d-sm-inline-block bg-danger">
    <a href="<?php echo base_url(); ?>Welcome/logout" class="nav-link" style="color:#fff;"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Logout</a>
  </li>&nbsp;

  <li class="nav-item d-none d-sm-inline-block bg-success">
    <a href="<?php echo base_url(); ?>Welcome/profile" class="nav-link"><i class="fas fa-user"></i>&nbsp;&nbsp;Profile</a>
  </li>&nbsp;

  <li class="nav-item d-none d-sm-inline-block bg-info">
    <a href="<?php echo base_url(); ?>Welcome/change_password" class="nav-link"><i class="fas fa-lock"></i>&nbsp;&nbsp;Change Password</a>
  </li>

</ul>

<!-- SEARCH FORM -->
<form class="form-inline ml-3" method="POST" action="<?php echo base_url();?>Reports/invoice_search">
  <div class="input-group input-group-sm">
    <input class="form-control form-control-navbar" type="search" placeholder="Invoice #" aria-label="Search" name="sale_id">
    <div class="input-group-append">
      <button class="btn btn-navbar" type="submit">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </div>
</form>


<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  });
</script>