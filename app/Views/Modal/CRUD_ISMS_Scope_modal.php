<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="overlay">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div>
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal">ISMS Scope</h4>
    </div>
    <div class="modal-body">
      <form class="mb-3" id="form_scope_crud" action="javascript:void(0)" method="post" enctype="multipart/form-data">
        <div>
          <h6>Description</h6>
        </div>
        <div>
          <h6 class="gray-text" name="description_detail" id="description_detail">
            รอใส่คำอธิบายเพิ่มเติม
          </h6>
        </div>
        <div class="form-group">
          <h6>Location</h6>
          <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="location" id="location"></textarea>
        </div>
        <div class="form-group">
          <h6>Organization</h6>
          <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="organization" id="organization"></textarea>
        </div>
        <div class="form-group">
          <h6>System Service</h6>
          <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="system_service" id="system_service"></textarea>
        </div>
        <div class="form-group">
          <h6>Scope Statement</h6>
          <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="scope_statement" id="scope_statement"></textarea>
        </div>
        <input type="text" id="url_route" name="url_route" hidden>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="submit_scope" value="Submit">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $(".overlay").hide();
    });

    $("#form_scope_crud").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_scope_crud');
    });
</script>