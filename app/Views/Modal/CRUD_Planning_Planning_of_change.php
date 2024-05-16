<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal">Planning of Changes ISMS</h4>
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
          <h6>Name Planning of Change ISMS</h6>
          <input class="form-control gray-text" type="text" placeholder="Text..." name="nameplan" id="nameplan"></input>
        </div>
        <div class="form-group mt-2">
          <h6>Plan Origin</h6>
          <textarea class="form-control gray-text" rows="2" placeholder="Text..." name="planorigin" id="planorigin"></textarea>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <h6>Start date</h6>
              <input class="form-control gray-text" type="date" name="start_date" id="start_date"></input>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <h6>End date</h6>
              <input class="form-control gray-text" type="date" name="end_date" id="end_date"></input>
            </div>
          </div>
        </div>
        <div class="form-group">
          <h6>Owner</h6>
          <input class="form-control gray-text" type="text" placeholder="Text..." name="owner" id="owner"></input>
        </div>
        <div class="form-group">
          <h6>Evaluation</h6>
          <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="evaluation" id="evaluation"></textarea>
        </div>
        <div class="form-group">
          <h6>Attach File</h6>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="exampleInputFile" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="file">
            <label class="custom-file-label" for="customFile" id="customFile">Choose file</label>
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
  $(function() {
    bsCustomFileInput.init();
  });

  $("#form_crud").on('submit', function(e) {
    e.preventDefault();
    const urlRouteInput = document.getElementById("url_route");
    action_(urlRouteInput.value, 'form_crud');
  });
</script>