<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="overlay">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div>
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal">Note</h4>
    </div>
    <div class="modal-body">
      <form class="mb-3" id="form_crud_note" action="javascript:void(0)" method="post" enctype="multipart/form-data">
        <div>
          <h6>Description</h6>
        </div>
        <div>
          <h6 class="gray-text" name="description_detail" id="description_detail">
            รอใส่คำอธิบายเพิ่มเติม
          </h6>
        </div>
        <div class="form-group">
          <h6>Note</h6>
          <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="text" id="text"></textarea>
        </div>
        <input type="text" id="check" name="check" hidden>
        <input type="text" id="id_" name="id_" hidden>
        <input type="text" id="params" name="params" hidden>
        <input type="text" id="modified" name="modified" hidden>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="submit_note" value="Submit">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?= base_url('plugins/moment/moment.min.js'); ?>"></script>
<!-- date-range-picker -->
<script src="<?= base_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>

<script>
  $(document).ready(function () {
    $(".overlay").hide();

    $("#form_crud_note").on('submit', function (e) {
      e.preventDefault();
      var data = <?php echo json_encode($data); ?>;
      update_note(data.id_version, data.status); // Call the function to handle the submission
    });

  }); function update_note(id_version, status_version) {
    var params = document.getElementById("params").value;
    var check = document.getElementById("check").value;
    //--params 2 = create--//
    //--params 3 = edit--//
    if (params == '10') {
      if (check == '10') {
        var url_link = 'note_create/' + id_version + '/' + status_version;
      } else if (check == '11') {
        var url_link = 'note_update/' + id_version + '/' + status_version;
      } else {
        
      }
    } 


    var formData = new FormData($("#form_crud_note")[0]);
    $.ajax({
      url: '<?= base_url("context/") ?>' + url_link,
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      xhr: function () {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function (evt) {
          if (evt.lengthComputable) {
            var percentComplete = (evt.loaded / evt.total) * 100;
            $(".overlay").show();
            setTimeout(() => {

            }, 2000);
          }
        }, false);
        return xhr;
      },

    })
      .done(function (response) {

        setTimeout(() => {
        }, 2000);
        if (response.success) {
          Swal.fire({
            title: response.message,
            icon: 'success',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false
          });
          setTimeout(() => {
            $(".overlay").hide();

            if (response.reload) {
              window.location.reload();
            } else {
              window.location.href = '<?= site_url("context/") ?>' + response.id_version;
            }
          }, 2000);
        } else {
          Swal.fire({
            title: response.message,
            icon: 'error',
            showConfirmButton: true
          });
        }
      }).fail(function (jqXHR, textStatus, errorThrown) {
        // กรณีเกิด Error ใน Ajax Request
        console.log("Error:", textStatus, errorThrown);
        Swal.fire({
          title: "เกิดข้อผิดพลาดในการส่งข้อมูล",
          text: "โปรดลองอีกครั้งในภายหลัง",
          icon: 'error',
          showConfirmButton: true
        });
      });
  }
</script>