<div class="modal-dialog ">
  <div class="modal-content">
    <div class="overlay preloader">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div>
    <div class="modal-header bg-primary">
      <h4 class="modal-title">Version Control</h4>
    </div>
    <div class="modal-body">

      <form class="mb-3" id="update_is" action="javascript:void(0)" method="post" enctype="multipart/form-data">
        <div>
          <h6>Description</h6>
        </div>
        <div>
          <h6 class="gray-text" name="description_detail" id="description_detail">
            รอใส่คำอธิบายเพิ่มเติม
          </h6>
        </div>
        <div class="form-group mt-3">
          <h6>Modified Date</h6>
          <div class="input-group date" id="reservationdat_modified" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input gray-text"
              data-target="#reservationdat_modified" name="modified" id="modified" />
            <div class="input-group-append" data-target="#reservationdat_modified" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <h6>Last Reviewed</h6>
          <div class="input-group date" id="reservationdate_reviewed" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input gray-text"
              data-target="#reservationdate_reviewed" name="reviewed" id="reviewed" />
            <div class="input-group-append" data-target="#reservationdate_reviewed" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <h6>Approved Date</h6>
          <div class="input-group date" id="reservationdate_approved" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input gray-text"
              data-target="#reservationdate_approved" name="approved" id="approved" />
            <div class="input-group-append" data-target="#reservationdate_approved" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
        <div class="form-group" id="announce_group">
          <h6>Announce Date</h6>
          <div class="input-group date" id="reservationdate_announce" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input gray-text"
              data-target="#reservationdate_announce" name="announce" id="announce" />
            <div class="input-group-append" data-target="#reservationdate_announce" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <h6>Status</h6>
          <div class="form-group">
            <select class="form-control" name="status" id="status">
              <option value="0" id="0">Draft</option>
              <option value="1" id="1">Pending_Review</option>
              <option value="2" id="2" style="color: #ffc107;">Reviewed</option>
              <option value="3" id="3">Pending_Approve</option>
              <option value="4" id="4" style="color: #28a745;">Approved</option>
              <option value="5" id="5" style="color: #dc3545;">Reject Review</option>
              <option value="6" id="6" style="color: #dc3545;">Reject Approved</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <h6 id="title_comment" name="title_comment" style="display: none;">Comment</h6>
          <textarea id="commentTextArea" class="form-control" name="commentTextArea" style="display: none;"></textarea>
        </div>
        <input type="text" id="id_" name="id_" hidden>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="submit_version" value="submit"
            id="submit_version">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
        </div>
      </form>
    </div>
  </div>
  <!-- /.modal-content -->
</div>

<script>
  $(document).ready(function () {
    // Attach the event handler only once when the document is ready
    $("#update_is").on('submit', function (event) {
      event.preventDefault();
      update_is(); // Call the function to handle the submission
    });
  });
</script>

<script>
  var statusSelect = document.getElementById("status");
  var commentTextArea = document.getElementById("commentTextArea");
  var title_comment = document.getElementById("title_comment");
  var approved = document.getElementById("approved");
  var reviewed = document.getElementById("reviewed");
  var modified = document.getElementById("modified");

  statusSelect.addEventListener("change", function () {
    modified.required = false;
    if (statusSelect.value === "5" || statusSelect.value === "6") { // ค่า "Reject" มี value เท่ากับ "5"
      commentTextArea.style.display = "block"; // แสดง textarea
      title_comment.style.display = "block"; // แสดง comment
      approved.required = false;
      reviewed.required = false;
      modified.required = true;
    } else if (statusSelect.value === "2") {
      commentTextArea.style.display = "none"; // ซ่อน textarea
      title_comment.style.display = "none"; // ซ่อน comment
      approved.required = false;
      reviewed.required = true;
    } else if (statusSelect.value === "4") {
      commentTextArea.style.display = "none"; // ซ่อน textarea
      title_comment.style.display = "none"; // ซ่อน comment
      approved.required = true;
      reviewed.required = false;
    } else {
      commentTextArea.style.display = "none"; // ซ่อน textarea
      title_comment.style.display = "none"; // ซ่อน comment
      approved.required = false;
      reviewed.required = false;
    }
  });
</script>

<script>
  $(function () {
    //Date picker
    $('#reservationdat_modified').datetimepicker({
      format: 'DD/MM/YYYY',
    });

    //Date picker
    $('#reservationdate_reviewed').datetimepicker({
      format: 'DD/MM/YYYY',
    });

    //Date picker
    $('#reservationdate_approved').datetimepicker({
      format: 'DD/MM/YYYY',
    });

    $('#reservationdate_announce').datetimepicker({
      format: 'DD/MM/YYYY',
    });

  })
</script>

<script>
  function check_status(status) {
    // เลือกฟิลด์และปุ่มที่ต้องการปิดใช้งาน
    var modifiedField = document.getElementById('modified');
    var reviewedField = document.getElementById('reviewed');
    var approvedField = document.getElementById('approved');
    var announce = document.getElementById('announce');
    var announceField = document.getElementById('announce_group');
    var statusSelect = document.getElementById('status');
    var submitButton = document.getElementById('submit_version');
    var commentTitle = document.getElementById('title_comment');
    var commentTextArea = document.getElementById('commentTextArea');
    // ตรวจสอบค่าของตัวแปร "status"
    if (status === '4') { // ค่า '4' หมายถึง 'Approved'
      // ปิดใช้งานฟิลด์และปุ่ม
      modifiedField.disabled = true;
      reviewedField.disabled = true;
      approvedField.disabled = true;
      submitButton.disabled = false;
      announceField.style.display = 'block';
      commentTitle.style.display = 'none';
      commentTextArea.style.display = 'none';
      commentTextArea.disabled = false;

    } else if (status === '5') {
      announceField.style.display = 'none';
      commentTitle.style.display = 'block';
      commentTextArea.style.display = 'block';
      commentTextArea.disabled = true;
      modifiedField.disabled = true;
      reviewedField.disabled = true;
      approvedField.disabled = true;
      submitButton.disabled = true;
    } else {
      // เปิดใช้งานฟิลด์และปุ่ม
      modifiedField.disabled = false;
      reviewedField.disabled = false;
      approvedField.disabled = false;
      submitButton.disabled = false;
      commentTextArea.disabled = false;
      commentTitle.style.display = 'none';
      commentTextArea.style.display = 'none';
      announceField.style.display = 'none';

    }
  }
</script>

<script>
  function update_is() {
    var formData = new FormData($("#update_is")[0]);

    // Show loading indicator here
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
      url: '<?= base_url("is/update_is") ?>',
      type: "POST",
      cache: false,
      data: formData,
      processData: false,
      contentType: false,
      dataType: "JSON",
      beforeSend: function () {
        // Show loading indicator here
        loadingIndicator;
      },
    }).done(function (response) {
      if (response.success) {
        Swal.fire({
          title: response.message,
          icon: 'success',
          showConfirmButton: false
        });

        if (response.reload) {
          setTimeout(() => {
            if (response.reload) {
              window.location.reload();
            } else {
              window.location.href = '<?= site_url("context/context_analysis") ?>' + response.id_version;
            }
          }, 2000);
        }
      } else {
        Swal.fire({
          title: response.message,
          icon: 'error',
          showConfirmButton: true
        });
      }
    });
  }

</script>