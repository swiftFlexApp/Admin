<!-- SEARCH FORM -->
<form class="form-inline ml-3" method="POST" action="<?php echo base_url();?>Welcome/invoice_search">
  <div class="input-group input-group-sm">
    <input class="form-control form-control-navbar" type="search" placeholder="Invoice #" aria-label="Search" name="sale_id">
    <div class="input-group-append">
      <button class="btn btn-navbar" type="submit">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </div>
</form>