<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal">Competence</h4>
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
        <div class="form-group mt-2">
          <h6>Role</h6>
          <select class="form-control" name="role" id="role" onchange="change_option()">
            <option value="Top Management">Top Management</option>
            <option value="Information Security Management Representative (ISMR)">Information Security Management
              Representative (ISMR)</option>
            <option value="Information Assurance (IA)">Information Assurance (IA)</option>
            <option value="Document Control">Document Control</option>
            <option value="Other (Working Team)">Other (Working Team)</option>
          </select>
          <h6 class="gray-text mt-2 p-2" name="role_details" id="role_details">คำอธิบายเพิ่มเติม</h6>
        </div>
        <div class="form-group">
          <h6>Training Plan</h6>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="exampleInputFile" accept=".docx, .pdf, .xlsx , .doc"
              data-max-size="20971520" name="file">
            <label class="custom-file-label" for="customFile" id="label_file">Choose file</label>
          </div>
          <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
        </div>
        <input type="text" id="url_route" name="url_route" hidden>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="submit" value="Submit">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $("#form_crud").on('submit', function (e) {
    e.preventDefault();
    const urlRouteInput = document.getElementById("url_route");
    action_(urlRouteInput.value, 'form_crud');
  });

  function change_option() {
    var descriptionDetail = document.getElementById('role_details');
    var role = document.getElementById('role');

    switch (role.value) {
      case 'Top Management':
        descriptionDetail.innerText = 'คำอธิบายสำหรับ Top Management';
        break;
      case 'Information Security Management Representative (ISMR)':
        descriptionDetail.innerText = 'คำอธิบายสำหรับ Information Security Management Representative (ISMR)';
        break;
      case 'Information Assurance (IA)':
        descriptionDetail.innerText = 'คำอธิบายสำหรับ Information Assurance (IA)';
        break;
      case 'Document Control':
        descriptionDetail.innerText = 'คำอธิบายสำหรับ Document Control';
        break;
      case 'Other (Working Team)':
        descriptionDetail.innerText = 'คำอธิบายสำหรับ Other (Working Team)';
        break;
      default:
        descriptionDetail.innerText = 'รอใส่คำอธิบายเพิ่มเติม';
        break;
    }
  }

</script>
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>