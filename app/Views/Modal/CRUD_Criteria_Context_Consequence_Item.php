<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <!-- title ชื่อเดียวกับ Tap -->
      <h5 class="modal-title" id="title_modal" name="title_modal">Opportunity</h5>
    </div>
    <div class="modal-body">
      <form class="mb-3" id="form_crud_item" action="javascript:void(0)" method="post" enctype="multipart/form-data">
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
          <div class="form-group mt-3">
            <h6>Consequence Name</h6>
            <input class="form-control gray-text" type="text" name="consequencename" id="consequencename" disabled></input>
          </div>
          <div class="form-group mt-3">
            <h6>Impact Level</h6>
            <input class="form-control gray-text" type="number" name="impactlevel" id="impactlevel" disabled></input>
          </div>
          <div class="form-group mt-3">
            <h6>Name</h6>
            <input class="form-control gray-text" type="text" name="name" id="name"></input>
          </div>
          <div class="form-group mt-3">
            <h6>Description</h6>
            <textarea class="form-control" type="text" name="description" id="description"></textarea>
          </div>
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

  $("#form_crud_item").on('submit', function(e) {
    e.preventDefault();
    const urlRouteInput = document.getElementById("url_route");
    action_(urlRouteInput.value, 'form_crud_item');
  });
</script>