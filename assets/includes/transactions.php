        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Last Transactions</h5>                
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <span id="controlPanel" style="text-align: center;"></span>

                    <div class="col-12">
                      <table id="example1" class="table table-bordered table-striped">
                       <thead>
                        <tr>
                         <th>Ref #</th>
                         <th>Date</th>
                         <th>Detail</th>
                         <th>Amount</th>
                         <th>Status</th>
                       </tr>
                     </thead>
                     <tbody>
                       <?php
                       foreach ($result as $s) {
                         ?>

                         <tr>
                           <td><a target="_blank" href="<?php echo base_url();?>Welcome/invoice?sale_id=<?php echo $s['id']; ?>">
                            <?php echo $s['id']; ?></a></td>
                            <td>
                              <?php 
                              $date = date_create($s['date']);
                              echo date_format($date, "d-m-Y");
                              ?>
                            </td>
                            <td>From <strong><?php echo $s['user_from']; ?></strong><br>to<br>
                            <strong><?php echo $s['user_to']; ?></strong>
                            </td>
                            <td><?php echo number_format($s['amount']); ?></td>
                            <td><?php 
                            echo $s['status']; ?>

                          <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>

                </div>



                <!-- /.row -->
              </div>
              <!-- ./card-body -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->