<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal">SOA</h4>
    </div>
    <div class="modal-body">
      <form class="mb-3" id="form_crud_soa" action="javascript:void(0)" method="post" enctype="multipart/form-data">
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
          <h6>Control</h6>
          <input class="form-control gray-text" type="text" placeholder="Text..." name="control" id="control"  required></input>
        </div>
        <div class="form-group mt-2">
          <h6>Exclusion</h6>
          <select class="form-control" aria-label="Default" id="exclusion" name="exclusion" required>
            <option value="null" selected>Select Option</option>
            <option value="Y">Yes</option>
            <option value="N">No</option>
          </select>
        </div>
        <div class="form-group mt-2">
          <h6>Justification</h6>
          <textarea class="form-control gray-text" rows="2" placeholder="Text..." name="justification" id="justification" required ></textarea>
        </div>
        <div class="form-group mt-2">
          <h6>How to</h6>
          <textarea class="form-control gray-text" rows="2" placeholder="Text..." name="how_to" id="how_to" required></textarea>
        </div>
        <input type="text" id="url_route" name="url_route" hidden>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="submit" value="Submit">SAVE</button>
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

  $("#form_crud_soa").on('submit', function(e) {
    e.preventDefault();
    const select_exclusion = document.getElementById("exclusion");
    if (select_exclusion.value == "null") {
      Swal.fire("Oops!", "Please Select Exclusion", "error");
    } else {
      const urlRouteInput = document.getElementById("url_route");
      action_(urlRouteInput.value, 'form_crud_soa');
    }
  });
</script>