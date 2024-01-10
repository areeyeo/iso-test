<div class="modal-dialog modal-xl">
  <div class="modal-content">
    <div class="overlay">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div>
    <div class="modal-header bg-danger">
      <h4 class="modal-title">Reject</h4>
    </div>
    <div class="modal-body">
      <form class="mb-3" id="form_reject" action="javascript:void(0)" method="post" enctype="multipart/form-data">
        <div>
          <h6>Description</h6>
        </div>
        <div>
          <h6 class="gray-text" name="description" id="description">คำอธิบาย</h6>
        </div>
        <div class="form-group">
          <h6>Note</h6>
          <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="text" id="text"></textarea>
        </div>
        <input type="text" id="status" name="status" hidden>
        <div class="input-group date" id="reservationdat_modified" data-target-input="nearest" hidden>
          <input type="text" class="form-control datetimepicker-input gray-text" data-target="#reservationdat_modified"
            name="modified_date" id="modified_date" />
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="submit" value="Submit">CONFIRM</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
        </div>
      </form>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<script src="<?= base_url('plugins/moment/moment.min.js'); ?>"></script>
<!-- date-range-picker -->
<script src="<?= base_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<script>
  $(document).ready(function () {
    $(".overlay").hide();

    $("#form_reject").on('submit', function (e) {
      e.preventDefault();
      var data = <?php echo json_encode($data); ?>;

      store_alert_note_reject(data.id_version); // Call the function to handle the submission
    });

  });
  function store_alert_note_reject(id_version) {

    var formData = new FormData($("#form_reject")[0]);
    var loadingIndicator = Swal.fire({
      title: 'Loading...',
      allowEscapeKey: false,
      allowOutsideClick: false,
      showConfirmButton: false,
      onOpen: () => {
        Swal.showLoading();
      }
    });
    $.ajax({
      url: '<?= base_url("context/status_update_reject/") ?>' + id_version,
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        // Show loading indicator here
        loadingIndicator;
      },
    }).done(function (response) {
      if (response.success) {
        Swal.fire({
          title: response.message,
          icon: 'success',
          allowOutsideClick: false,
          allowEscapeKey: false,
          showConfirmButton: false
        });
        setTimeout(() => {
          if (response.reload) {
            window.location.reload();
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
      Swal.fire({
        title: "เกิดข้อผิดพลาดในการส่งข้อมูล",
        text: "โปรดลองอีกครั้งในภายหลัง",
        icon: 'error',
        showConfirmButton: true
      });
    });
  }
</script>

<script>
  //Date picker
  $('#reservationdat_modified').datetimepicker({
    format: 'DD/MM/YYYY',
  });
</script>