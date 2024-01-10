<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="overlay">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div>
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
    </div>
    <div class="modal-body">
      <form class="mb-3" id="form_crud" action="javascript:void(0)" method="post" enctype="multipart/form-data">
        <div>
          <h6>Description</h6>
        </div>
        <div>
          <h6 class="gray-text" name="description_detail" id="description_detail">
            รอใส่คำอธิบายเพิ่มเติม
          </h6>
        </div>
        <div>
          <h6 class="gray-text" name="description" id="description"></h6>
        </div>
        <div class="form-group">
          <h6>Attach File</h6>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="exampleInputFile" accept=".docx, .pdf, .xlsx , .doc"
              data-max-size="20971520" name="file">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
          <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
        </div>
        <input type="text" id="check" name="check">
        <input type="text" id="id_" name="id_">
        <input type="text" id="params" name="params">
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="submit" value="Submit">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
        </div>
      </form>
    </div>
  </div>
</div>



<script>
  $(document).ready(function () {
    $(".overlay").hide();

    $("#form_crud").on('submit', function (e) {
      e.preventDefault();
      var data = <?php echo json_encode($data); ?>;
      store_alert(data.id_version, data.status); // Call the function to handle the submission
    });

  }); function store_alert(id_version, status_version) {
    var params = document.getElementById("params").value;
    var check = document.getElementById("check").value;
    //--params 2 = create--//
    //--params 3 = edit--//
    if (params == '2') {
      if (check == '6') {
        var url_link = 'leadership_is_policy/store/' + id_version + '/' + status_version;
      }
    } else if (params == '3') {
      var url_link = 'leadership_is_policy/edit/' + id_version + '/' + status_version;
    }


    var formData = new FormData($("#form_crud")[0]);
    $.ajax({
      url: '<?= base_url("leadership/policy/") ?>' + url_link,
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
              window.location.href = '<?= site_url("leadership/policy/") ?>' + response.id_version;
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

<script>
  $(function () {
    //Date picker
    $('#reservationdate_deadline').datetimepicker({
      format: 'DD/MM/YYYY',
    });

    //Date range as a button
    $('#daterange-btn').daterangepicker({
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },)
  })
</script>

<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>