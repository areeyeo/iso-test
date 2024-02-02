<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <!-- <div class="overlay">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div> -->
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal">Competence</h4>
    </div>
    <div class="modal-body">
      <!-- <div class="progress mb-3" style="display: none;">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0"
          aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
      </div> -->
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
          <select class="form-control" name="objective_evaluation" id="objective_evaluation">
            <option value="option1">Top Management</option>
            <option value="option2">Information Security Management Representative (ISMR)</option>
            <option value="option3">Information Assurance (IA)</option>
            <option value="option4">Document Control</option>
            <option value="option5">Other (Working Team)</option>
          </select>
          <h6 class="gray-text mt-2 p-2" name="evaluation_detail" id="evaluation_detail">คำอธิบายเพิ่มเติม</h6>
        </div>
        <div class="form-group">
          <h6>Training Plan</h6>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="exampleInputFile" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="file">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
          <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
        </div>
        <input type="text" id="url_route" name="url_route" hidden>
        <input type="text" id="check_type" name="check_type" hidden>
        <input type="text" id="id_" name="id_" hidden>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="submit" value="Submit">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
        </div>
      </form>
    </div>
  </div>
</div>



<script>
  $(document).ready(function() {
    $(".overlay").hide();
  });

  $("#form_crud").on('submit', function(e) {
    e.preventDefault();
    const urlRouteInput = document.getElementById("url_route");
    action_(urlRouteInput.value, 'form_crud');
  });
</script>
<script>
  $(document).ready(function() {
    $(".overlay").hide();
  });

  $("#form_crud").on('submit', function(e) {
    e.preventDefault();
    const urlRouteInput = document.getElementById("url_route");
    action_(urlRouteInput.value, 'form_crud');
  });

  document.getElementById('objective_evaluation').addEventListener('change', function() {
    var selectedOption = this.value;
    var descriptionDetail = document.getElementById('evaluation_detail');

    switch (selectedOption) {
      case 'option1':
        descriptionDetail.innerText = 'คำอธิบายสำหรับ Top Management';
        break;
      case 'option2':
        descriptionDetail.innerText = 'คำอธิบายสำหรับ Information Security Management Representative (ISMR)';
        break;
      case 'option3':
        descriptionDetail.innerText = 'คำอธิบายสำหรับ Information Assurance (IA)';
        break;
      case 'option4':
        descriptionDetail.innerText = 'คำอธิบายสำหรับ Document Control';
        break;
      case 'option5':
        descriptionDetail.innerText = 'คำอธิบายสำหรับ Other (Working Team)';
        break;
      default:
        descriptionDetail.innerText = 'รอใส่คำอธิบายเพิ่มเติม';
        break;
    }
  });
</script>