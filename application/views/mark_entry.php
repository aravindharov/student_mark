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
                <form id="addData" action="" method="post">
                  <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>" />
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
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $x=0;
                      $i=1;
                      foreach($students as $val){
                       ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td><input type="text" class="form-control" name="regno[<?= $x;?>]" value="<?= $val['regno']; ?>" readonly></td>
                          <td><input type="hidden" name="id[<?= $x;?>]" value="<?= $val['id']; ?>"><input type="hidden" name="mark_id[<?= $x;?>]" value="<?= $val['mark_id']; ?>"><input type="text" class="form-control" value="<?= $val['name']; ?>" readonly><span class="invalid-feedback"></span></td>
                          <td><input type="number" class="form-control" id="mark1_<?php echo $val['id']?>" name="mark1[<?= $x;?>]" onkeyup="calculation(<?= $val['id']?>);" onchange="calculation(<?= $val['id']?>);" placeholder="Max. 100" min="0" max="100" value="<?php echo !empty($val['mark1'])?$val['mark1']:0; ?>"><span class="invalid-feedback"></span></td>
                          <td><input type="number" class="form-control" id="mark2_<?php echo $val['id']?>" name="mark2[<?= $x;?>]" onkeyup="calculation(<?= $val['id']?>);" onchange="calculation(<?= $val['id']?>);" placeholder="Max. 100" min="0" max="100" value="<?php echo !empty($val['mark2'])?$val['mark2']:0; ?>"><span class="invalid-feedback"></span></td>
                          <td><input type="number" class="form-control" id="mark3_<?php echo $val['id']?>" name="mark3[<?= $x;?>]" onkeyup="calculation(<?= $val['id']?>);" onchange="calculation(<?= $val['id']?>);" placeholder="Max. 100" min="0" max="100" value="<?php echo !empty($val['mark3'])?$val['mark3']:0; ?>"></td>
                          <td><input type="text" class="form-control" id="total_<?php echo $val['id']?>" name="total[<?= $x;?>]" value="<?php echo !empty($val['total'])?$val['total']:0; ?>" readonly><span class="invalid-feedback"></span></td>
                          <td><input type="text" class="form-control" id="avg_<?php echo $val['id']?>" name="avg[<?= $x;?>]" value="<?php echo !empty($val['avg'])?$val['avg']:0; ?>" readonly><span class="invalid-feedback"></span></td>
                        </tr>
                        <?php
                        $i++;
                        $x++;
                      } ?>
                      </tbody>
                      <?php
                    }
                    ?>
                  </table>
                  <div class="container-footer">
                    <button type="submit" class="btn btn-primary" id="save">Submit</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
                  </div>
                </form>
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
<script src="<?php echo asset_url ?>plugins/ajax_upload/js/jquery.ui.widget.js"></script>
<script src="<?php echo asset_url ?>plugins/ajax_upload/js/jquery.iframe-transport.js"></script>
<script src="<?php echo asset_url ?>plugins/ajax_upload/js/jquery.fileupload.js"></script>
<script src="<?php echo asset_url ?>plugins/ajax_upload/js/jquery.fileupload-process.js"></script>
<script src="<?php echo asset_url ?>plugins/ajax_upload/js/jquery.fileupload-validate.js"></script>
<script type="text/javascript">
  $('.datePicker').datepicker({
    // rtl: KTUtil.isRTL(),
    todayHighlight: true,
    orientation: "bottom left",
    format:"dd/mm/yyyy",
    autoclose:true

    // templates: arrows
  });
  function calculation(id){
    var avg=0;
    var mark1=$('#mark1_'+id).val();
    var mark2=$('#mark2_'+id).val();
    var mark3=$('#mark3_'+id).val();
    var total=parseInt(mark1)+parseInt(mark2)+parseInt(mark3);
    if(!isNaN(total)){
      if(total=='')
      {
        total=0;
      }
    }
    else
    {
      total=0;
    }
    avg=total/3;
    $('#total_'+id).val(total.toFixed(2));
    $('#avg_'+id).val(avg.toFixed(2));
  }
  $("#addData").on("submit", function(event) {
    var dat=new FormData( this );

    $('#save').addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

    var x = 0;
    var err = '';
    $('#loader').show();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url; ?>home/add_marklist_process",
      dataType: "json",
      //  data: data11,
      data: dat,
      cache: false,
      dataType: 'json',   //No I18N
      processData: false, // Don't process the files
      contentType: false, // Set cont
      success: function(html) {
        $('input').removeClass('is-invalid');
        $('textarea').removeClass('is-invalid');
        $('select').removeClass('is-invalid');
        $('#error_add').empty();
        if (html.status == 0) {
          $('input').removeClass('is-invalid');
          $('textarea').removeClass('is-invalid');
          $('select').removeClass('is-invalid');
          $('.invalid-feedback').html('');
          var s = 0;
          $.each(html.message, function(k, v) {
            err += '<p class="kt-font-danger">' + v + '</p>';
            if (s < 1) {
            $("#addData [name='" + k + "'] ~span.invalid-feedback").focus();
            s++;
            }
            var k1 = $("#addData [name='" + k + "'] ~span.invalid-feedback");
            
            k1.html(v);
            $("#addData [name='"+k+"']").addClass( "is-invalid" );
            /*swal.fire({
            title: 'Please fill valid data',
            html: $('<div>').html(err),
            confirmButtonText: "Ok",
            confirmButtonClass: "btn btn-success",
            });*/ 

          });

        }
        else {
          $('#loader').hide();
          swal.fire({

            position: 'center',
            type: 'success',
            title: html.message,
            showConfirmButton: false,
            timer: 2000

          }).then(function() {

            location.reload();

          });

        }
      },
      complete: function(data) {
        $('#loader').hide();
        $('#save').removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
        $("#addData [name='submit']").attr('disabled',false);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        swal.fire({
          title: "Please try again!",
          timer: 2000,

          onOpen: function() {

            swal.showLoading()

          }
        });
      }
    });
      return false;
  });
  function edit_student(id) {
    $.ajax({

      type: "POST",
      url: "<?php echo site_url; ?>home/edit_student",
      dataType: "json",
      data:'  id='+id+'&<?php echo  $this->security->get_csrf_token_name(); ?>=<?php echo  $this->security->get_csrf_hash(); ?>',
      success: function(html){
         // alert(html.phaRate);
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        if(html.status==0)
        {
          alert('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> '+html.message+'</div>');
        }
        else
        {
          $('#id').val(html.data['id']);
          $('#name').val(html.data['name']);
          $('#dob').val(html.data['dob']);
          $('#mobile_no').val(html.data['mobile_no']);
          $('#addmodal').modal('show');
        }
      },

      complete: function (data) {
        $('#loader').hide();
      },
      error: function(jqXHR, textStatus, errorThrown) { alert('Please try again'); }
    });
  }
  function delete_student(id) {
    $.ajax({

      type: "POST",
      url: "<?php echo site_url; ?>home/delete_student",
      dataType: "json",
      data:'  id='+id+'&<?php echo  $this->security->get_csrf_token_name(); ?>=<?php echo  $this->security->get_csrf_hash(); ?>',
      success: function(html){
         // alert(html.phaRate);
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        if(html.status==0)
        {
          alert('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> '+html.message+'</div>');
        }
        else
        {
          swal.fire({
            position: 'center',
            type: 'success',
            title: html.message,
            showConfirmButton: false,
            timer: 2000

          }).then(function() {

            location.reload();

          });
        }
      },
      complete: function (data) {
        $('#loader').hide();
      },
      error: function(jqXHR, textStatus, errorThrown) { alert('Please try again'); }
    });
  }
</script>