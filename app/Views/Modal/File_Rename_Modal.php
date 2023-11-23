<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="overlay">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div>
    <div class="modal-header bg-primary">
      <h4 class="modal-title">Rename File</h4>
    </div>
    <div class="modal-body">
      <form class="mb-3" id="form_rename_file" action="javascript:void(0)" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <h6>File Name (old)</h6>
        <input type="text" name="oldnameFile" id="oldnameFile" class="form-control" disabled>
        <input type="text" name="oldname" id="oldname" class="form-control" hidden>
      </div>
      <div class="form-group">
        <h6>Enter New Name File</h6>
        <input type="text"  name="namefile" id="namefile" class="form-control">
      </div>
      <input type="text" id="id_files" name="id_files" hidden>
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
    $(document).ready(function () {
        $(".overlay").hide();
    });

    $("#form_rename_file").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_rename_file');
    });
</script>