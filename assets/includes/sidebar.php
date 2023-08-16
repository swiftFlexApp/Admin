<?php
$type=$this->session->userdata('type');
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- sidebar-dark-primary -->
  <!-- Brand Logo -->
  <a href="<?php echo base_url(); ?>Welcome/dashboard" class="brand-link">
    <img src="<?php echo base_url(); ?>assets/uploads/company/d02842a7a76d2b4581bc93abca1c70a0.jpeg" alt="Point of Sale" class="brand-image elevation-3"
    >
    <span class="brand-text font-weight-light">FlexApp</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Addd icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>Welcome/dashboard" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>            
          </li>
          
          <li class="nav-header" style="color: #fff;">ACCOUNTS</li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-industry"></i>
              <p>
                Business
                <i class="fas fa-angle-down right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/list_business" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>List Business</p>
                </a>            
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Individuals
                <i class="fas fa-angle-down right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/list_individuals" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>List Individuals</p>
                </a>            
              </li>
            </ul>
          </li>
          
          <li class="nav-header" style="color: #fff;">TRANSACTIONS</li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Withdrawal Requests
                <i class="fas fa-angle-down right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/withdrawal_requests" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Pending Requests</p>
                </a>            
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/approved_requests" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Approved Requests</p>
                </a>            
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/rejected_requests" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Rejected Requests</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Airtime2Cash
                <i class="fas fa-angle-down right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/airtime_cash" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Requests</p>
                </a>            
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/airtime_cash" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Approved Requests</p>
                </a>            
              </li>
            </ul>
          </li>
          
          <li class="nav-header" style="color: #fff;">FINANCE</li>
          


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-check-circle"></i>
              <p>
                Payroll
                <i class="fas fa-angle-down right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/pay_salary" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Pay Salary</p>
                </a>            
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/paid_salaries" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Paid Salaries</p>
                </a>            
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-check-circle"></i>
              <p>
                Report
                <i class="fas fa-angle-down right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/agent_report" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Agent Withdrawal</p>
                </a>            
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/paid_salaries" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Soft Banking</p>
                </a>            
              </li>
            </ul>
          </li>

          <li class="nav-header" style="color: #fff;">HRM</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Attendance
                <i class="fas fa-angle-down right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/attendance" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Add Attendance</p>
                </a>            
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/list_attendance" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>List Attendance</p>
                </a>            
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Staff
                <i class="fas fa-angle-down right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/ad_staff" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>Add Staff</p>
                </a>            
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/list_staff" class="nav-link">
                  <i class="nav-icon fas fa-angle-right"></i>
                  <p>List Staff</p>
                </a>            
              </li>
            </ul>
          </li>


          <li class="nav-header" style="color: #fff;">MANAGEMENT</li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>Welcome/reports" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Reports</p>
            </a>            
          </li>
          
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>Welcome/create_backup" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>Database Backup</p>
            </a>            
          </li>  


          <?php
          if ($type==0) {
           ?>

           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="fas fa-angle-down right"></i>                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/register" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/manage_users" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/roles" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Role Permissions</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Welcome/app_data" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>App Data</p>
                </a>
              </li>
            </ul>
          </li> 

          <?php
        }
        ?>




      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
