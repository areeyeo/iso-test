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

  #ipnonconformity,
  #ipobservation,
  #ipopportunity,
  #zzzz {
    display: none;
  }
</style>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal">Audit Result</h4>
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
          <h6>Audit Report No.</h6>
          <select id="tags-reportname" multiple="multiple" class="form-control">
          </select>
        </div>
        <div class="form-group mt-3">
          <h6>Audit Result Type</h6>
          <select class="form-select form-control" aria-label="Default select example" name="auditresulttype" id="auditresulttype">
            <option selected>Select Audit Result Type</option>
            <option value="1">Nonconformity Issues</option>
            <option value="2">Observation Issues</option>
            <option value="3">Opportunity Issues</option>
          </select>
        </div>
        <div class="form-group mt-3" id="ipnonconformity">
          <h6>Nonconformity Issue</h6>
          <input class="form-control gray-text" type="text" placeholder="Text..." name="nonconformity" id="nonconformity"></input>
        </div>
        <div class="form-group mt-3" id="ipobservation">
          <h6>Observation Issue</h6>
          <input class="form-control gray-text" type="text" placeholder="Text..." name="observation" id="observation"></input>
        </div>
        <div class="form-group mt-3" id="ipopportunity">
          <h6>Opportunity Issue</h6>
          <input class="form-control gray-text" type="text" placeholder="Text..." name="opportunity" id="opportunity"></input>
        </div>
        <div class="form-group mt-3" id="zzzz">
          <h6>Level of Nonconformity</h6>
          <select class="form-select form-control" aria-label="Default select example" name="levelnonconformity" id="levelnonconformity">
            <option selected>Select Level of Nonconformity</option>
            <option value="major">Major</option>
            <option value="minor">Minor</option>
          </select>
        </div>
        <div class="form-group mt-3">
          <h6>Detail</h6>
          <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="detail" id="detail"></textarea>
        </div>
        <div class="form-group mt-3">
          <h6>Requirements/Control</h6>
          <input class="form-control gray-text" placeholder="Text..." name="control" id="control"></input>
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

<!-- backdrop -->
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

<!-- show input -->
<script>
  $(document).ready(function() {
    $('#auditresulttype').change(function() {
      var selectedOption = $(this).val();

      $('#ipnonconformity').hide();
      $('#ipobservation').hide();
      $('#ipopportunity').hide();
      $('#zzzz').hide();

      if (selectedOption === '1') {
        $('#ipnonconformity').show();
        $('#zzzz').show();
      } else if (selectedOption === '2') {
        $('#ipobservation').show();
      } else if (selectedOption === '3') {
        $('#ipopportunity').show();
      }
    });
  });
</script>

<!-- select seacrh -->
<script>
  $(document).ready(function() {
    var selectData = ["AR_001 รายงานโปรเจคตัวอย่างที่ 1", "AR_002 รายงานโปรเจคตัวอย่างที่ 2", "AR_003 รายงานโปรเจคตัวอย่างที่ 3", "AR_004 รายงานโปรเจคตัวอย่างที่ 4", "AR_005 รายงานโปรเจคตัวอย่างที่ 5"];
    $('#tags-reportname').select2({
      data: selectData,
      placeholder: "Select or Search",
      tags: false,
      tokenSeparators: [',', ' '],
      width: '100%',
      maximumSelectionLength: 1
    });
  });

  $("#form_crud").on('submit', function(e) {
    e.preventDefault();
    const urlRouteInput = document.getElementById("url_route");
    action_(urlRouteInput.value, 'form_crud');
  });
</script>
