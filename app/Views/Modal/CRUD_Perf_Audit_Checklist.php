<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
  .select2-container--default .select2-selection--multiple {
    border: 1px solid #ced4da !important;
  }

  .select2-selection__choice {
    background-color: #E2F0FF !important;
    border: 1px solid #E2F0FF !important;
    color: #0062FF !important;
  }

  .select2-selection__choice__remove {
    color: #0062FF !important;
  }
</style>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal">Audit Checklist</h4>
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
        <div class="form-group mt-3">
          <h6>Checklist</h6>
          <input class="form-control gray-text" type="text" placeholder="Text..." name="checklist" id="checklist"></input>
        </div>
        <div class="form-group mt-3">
          <h6>Program Name</h6>
          <select id="tags-projectnamechecklist" multiple="multiple" class="form-control">
          </select>
        </div>
        <div class="form-group">
          <h6>Attach File</h6>
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
          <button type="submit" class="btn btn-success" name="submit" value="Submit">SAVE</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- multi select -->
<script>
  $(document).ready(function() {
    var selectData = ["AP_001 โปรเจคตัวอย่างที่ 1", "AP_002 โปรเจคตัวอย่างที่ 2", "AP_003 โปรเจคตัวอย่างที่ 3", "AP_004 โปรเจคตัวอย่างที่ 4", "AP_005 โปรเจคตัวอย่างที่ 5"];
    $('#tags-projectnamechecklist').select2({
      data: selectData,
      placeholder: "Select or Search",
      tags: false,
      tokenSeparators: [',', ' '],
      width: '100%'
    });
  });

  $("#form_crud").on('submit', function(e) {
    e.preventDefault();
    const urlRouteInput = document.getElementById("url_route");
    action_(urlRouteInput.value, 'form_crud');
  });
</script>