<!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo number_format($count_business['count_business']); ?></h3>
                <p>No of Business Acc.</p>
              </div>
              <div class="icon">
                <i class="fa fa-people-carry"></i>
              </div>
              <a href="<?php echo base_url(); ?>Welcome/list_business" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo number_format($count_individuals['count_individuals']); ?><sup style="font-size: 20px"></sup></h3>
                <p>No of Individuals Acc.</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url(); ?>Welcome/list_individuals" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo number_format($total_debit['total_debit']); ?></h3>
                <p>Total Debits</p>
              </div>
              <div class="icon">                
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="javascript:void()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo number_format($total_received['total_received']); ?></h3>
                <p>Total Credits</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="javascript:void()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
        </div>
        <!-- /.row -->

        