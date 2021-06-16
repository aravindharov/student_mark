<?php
$this->load->view('header');
?>
<link rel="stylesheet" href="<?php echo asset_url; ?>plugins/ajax_upload/css/style.css?v=1" rel="stylesheet"/>

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
                <button class="btn btn-info" data-toggle="modal" data-target="#addmodal" role="button">Add Student</button>
                <table class="table table-striped- table-bordered table-hover table-checkable">
                  <?php
                  if ($students!=false) {?>
                    <thead>
                      <tr>
                        <td>S.No.</td>
                        <td>Name</td>
                        <td>Date of Birth</td>
                        <td>Age</td>
                        <td>Mobile No.</td>
                        <td>Document</td>
                        <td>Option</td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    foreach($students as $key=>$val){
                     ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $val['name']; ?></td>
                        <td><?= $val['dob']; ?></td>
                        <td><?= $val['age']; ?></td>
                        <td><?= $val['mobile_no']; ?></td>
                        <td><?php
                        if($val['file']!=false){
                          foreach ($val['file'] as $key1 => $value) {
                            echo '<a href="'.student_file_url.$value['studentFileName'].'" target="_blank" class="btn btn-primary" >'.$value['studentFileClient'].'</a> ';
                          }
                        }
                        ?></td>
                        <td><a href="javascript:void(0);" class="btn btn-warning" onclick="edit_student(<?php echo $val['id'];?>)" ><i class="la la-edit"></i></a> <a href="javascript:void(0);" onclick="delete_student(<?php echo $val['id'];?>)" class="btn btn-danger"><i class="la la-trash"></i></a> </td>
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
  <form id="addData" action="<?php echo site_url; ?>home/uploadfile" method="post">
    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?= $this->lang->line('add_zone')?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>" />
          <div class="modal-body">
            <div class="kt-scroll" data-scroll="true" >
              <input type="hidden" class="form-control " id="id" name="id" value="0">
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Name&nbsp;&nbsp;<sup><span class="fa fa-asterisk"></span></sup></label>
                <input type="text" class="form-control " id="name" name="name">
                <span class="invalid-feedback"></span>
              </div>
              <div class="form-group">
                <label for="message-text" class="form-control-label">Date of Birth&nbsp;&nbsp;<sup><span class="fa fa-asterisk"></span></sup></label>
                <input type="text" class="form-control datePicker" id="dob" name="dob">
                <span class="invalid-feedback"></span>
              </div>
              <div class="form-group">
                <label for="message-text" class="form-control-label">Mobile No.&nbsp;&nbsp;<sup><span class="fa fa-asterisk"></span></sup></label>
                <input type="text" class="form-control " id="mobile_no" name="mobile_no">
                <span class="invalid-feedback"></span>
              </div>
              <div class="form-group">
                <div class="">
                   <div class="" id="">
                      <div class="" >
                         <div class="upload" style="border: 1px solid #c1c1c1;">
                            <div id="drop">
                               <!-- Drop Here -->
                               <a class="btn btn-success"><i class="ace-icon fa fa-cloud-upload bigger-110"></i>Browse</a>
                               <input type="file" name="upl" multiple />
                            </div>
                            <ul>
                               <!-- The file uploads will be shown here -->
                            </ul>
                         </div>
                        
                      </div>
                   </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="save">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </form>
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
  $(function() {
   
       var ul = $('.upload ul');
   
       var i = 1;
       $('#drop a').click(function() {
           // Simulate a click on the file input button
           // to show the file browser dialog
           $(this).parent().find('input').click();
       });
       $('.drop a').click(function() {
           // Simulate a click on the file input button
           // to show the file browser dialog
           $(this).parent().find('input').click();
       });
   
       // Initialize the jQuery File Upload plugin
       $('.upload').fileupload({
   
           // This element will accept file drag/drop uploading
           dropZone: $('#drop'),
           acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
           dataType: 'json',
           // This function is called when a file is added to the queue;
           // either via the browse button, or via drag/drop:
           add: function(e, data) {
               i++;
   
               var tpl = $('<li class="working" id="li_' + i + '" ><input type="text" value="0"  class="imgCount" name="count[]" /><h6></h6><p></p><span></span></li>');
   
               // Append the file name and file size
               tpl.find('p').text(data.files[0].name)
                   .append('<i>' + formatFileSize(data.files[0].size) + '</i>');
   
               // Add the HTML to the UL element
               data.context = tpl.appendTo(ul);
   
               // Initialize the knob plugin
              // tpl.find('input').knob();
                tpl.find('input').knob({
                  'width':30,
                  'height':30,
                   readOnly: true,
                   fgColor: "#1dc9b7",
                   bgColor: "#fff",
                   thickness: 0.5
               });
               // Listen for clicks on the cancel icon
               tpl.find('span').click(function() {
   
                   if (tpl.hasClass('working')) {
                       jqXHR.abort();
                   }
   
                   tpl.fadeOut(function() {
                       tpl.remove();
                   });
   
               });
   
               // Automatically upload the file once it is added to the queue
               var jqXHR = data.submit();
   
           },
   
           progress: function(e, data) {
   
               // Calculate the completion percentage of the upload
               var progress = parseInt(data.loaded / data.total * 100, 10);
   
               // Update the hidden input field and trigger a change
               // so that the jQuery knob plugin knows to update the dial
               data.context.find('input').val(progress).change();
   
               if (progress == 100) {
   
                   data.context.removeClass('working');
               }
           },
   
           fail: function(e, data) {
   
               // Something has gone wrong!
               data.context.addClass('error');
               data.context.find('h6').text(e.error);
           },
   
           done: function(e, data) {
               $('.upload').append();
   
               var e1 = data.result;
   
               if (e1.status == 'error') {
                   var html = e1.error;
                   var noTagText = $(html).text();
                   data.context.append('<h5>' + noTagText + '</h5>');
   
                   data.context.find('h6').append('<img class="disp_img" src="<?= admin_temp_upload ?>no_img.png">');
   
                   data.context.addClass('error');
               } else {
   
                   if(e1.upload_data['is_image'])
                   {
                       data.context.find('h6').append('<img class="disp_img" src="<?= admin_temp_upload?>' + e1.upload_data['file_name'] + '">');
                   }
                   else
                   {
                       var ext=e1.upload_data['file_ext'];
                       ext= ext.substr(1);
                       if(ext == 'rar')
                       {
                           ext= 'zip';
                       }
                       if(ext == 'txt'||ext == 'srt' || ext=='rtf')
                       {
                           ext= 'srt';
                       }
                       var s= ext+'.svg';
                       data.context.find('h6').append('<img class="disp_img" src="<?= asset_url ?>media/files/' + s + '">');
                   }
                   
                   data.context.append('<input type="hidden" name="fileName[]" value="' + e1.upload_data['file_name'] + '">'+'<input type="hidden" name="clientName[]" value="' + e1.upload_data['client_name'] + '">'+'<input type="hidden" name="fileExtension[]" value="' + e1.upload_data['file_ext'] + '">'+'<input type="hidden" name="fileSize[]" value="' + e1.upload_data['file_size'] + '">'+'<input type="hidden" name="fileType[]" value="' + e1.upload_data['file_type'] + '">'+'<input type="hidden" name="imageHeight[]" value="' + e1.upload_data['image_height'] + '">'+'<input type="hidden" name="imageWidth[]" value="' + e1.upload_data['image_width'] + '">'+'<input type="hidden" name="imageType[]" value="' + e1.upload_data['image_type'] + '">'+'<input type="hidden" name="isImage[]" value="' + e1.upload_data['is_image'] + '">'+'<input type="hidden" name="origName[]" value="' + e1.upload_data['orig_name'] + '">'+'<input type="hidden" name="rawName[]" value="' + e1.upload_data['raw_name'] + '">'+'<input type="text" class="form-control" name="imgDesc[]">');
               }
   
           }
   
       });
   
       var removeElements = function(text, selector) {
           var wrapped = $("<div>" + text + "</div>");
           wrapped.find(selector).remove();
           return wrapped.html();
       }
   
       // Prevent the default action when a file is dropped on the window
       $(document).on('drop dragover', function(e) {
           e.preventDefault();
       });
   
       // Helper function that formats the file sizes
       function formatFileSize(bytes) {
           if (typeof bytes !== 'number') {
               return '';
           }
   
           if (bytes >= 1000000000) {
               return (bytes / 1000000000).toFixed(2) + ' GB';
           }
   
           if (bytes >= 1000000) {
               return (bytes / 1000000).toFixed(2) + ' MB';
           }
   
           return (bytes / 1000).toFixed(2) + ' KB';
       }
   
   });
  $("#addData").on("submit", function(event) {
    var dat=new FormData( this );

    $('#save').addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

    var x = 0;
    var err = '';
    $('#loader').show();
    $.ajax({
      type: "POST",
      url: "<?php echo site_url; ?>home/add_student_process",
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
          $('#error_add').empty();

          $('#error_add').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>' + err + '</div>');

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