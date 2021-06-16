<?php
$this->load->view('header');
?>
<link rel="stylesheet" href="<?php echo asset_url; ?>plugins/ajax_upload/css/style.css?v=1" rel="stylesheet"/>
<style type="text/css">
/*input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}*/
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student Management
            </h1>
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
          <div class="col-sm-10">
            <div class="card">
              <div class="card-body">
                  <table class="table table-striped- table-bordered table-hover table-checkable">
                    <?php
                    if ($students!=false) {
                      ?>
                      <thead>
                        <tr>
                          <td>S.No.</td>
                          <td>Register No.</td>
                          <td>Name</td>
                          <td>Mark1</td>
                          <td>Mark2</td>
                          <td>Mark3</td>
                          <td>Total</td>
                          <td>Avg</td>
                          <td>Rank</td>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      
                      $i=1;
                      foreach($students as $val){
                       ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td><?= $val['regno']; ?></td>
                          <td><?= $val['name']; ?></td>
                          <td><?= $val['mark1']; ?></td>
                          <td><?= $val['mark2']; ?></td>
                          <td><?= $val['mark3']; ?></td>
                          <td><?= $val['total']; ?></td>
                          <td><?= $val['avg']; ?></td>
                          <td><?= $val['rank']; ?></td>
                        </tr>
                        <?php
                        $i++;
                      } ?>
                      </tbody>
                      <?php
                    }
                    ?>
                  </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
$this->load->view('footer');
?>
