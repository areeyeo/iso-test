<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="overlay">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div>
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
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
        <div class="form-group">
          <h6 id="topic_title_select" name="topic_title_select"></h6>
          <select class="form-control gray-text" name="iss" id="iss">
          </select>
        </div>
        <div>
          <h6 class="gray-text" name="description" id="description"></h6>
        </div>
        <div class="form-group">
          <h6>Effect</h6>
          <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="effect" id="effect"></textarea>
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

  $("#form_crud").on('submit', function (e) {
    e.preventDefault();
    const urlRouteInput = document.getElementById("url_route");
    action_(urlRouteInput.value, 'form_crud');
  });
</script>
<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>

<script>
  $(function () {
    //Date picker
    $('#reservationdate_deadline').datetimepicker({
      format: 'DD/MM/YYYY',
    });

    //Date range as a button
    $('#daterange-btn').daterangepicker({
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },)
  })
</script>

<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>
