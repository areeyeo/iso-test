<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <h4 class="modal-title" id="title_modal" name="title_modal">Planning</h4>
    </div>
    <div class="modal-body">
      <form class="mb-3" id="form_crud_planning" action="javascript:void(0)" method="post" enctype="multipart/form-data">
        <h6>Description</h6>
        <h6 class="gray-text" name="description_detail" id="description_detail">
          รอใส่คำอธิบายเพิ่มเติม
        </h6>
        <div class="row">
          <div class="form-group mt-2 col-12">
            <h6>Objective and Evaluation</h6>
            <select class="form-control" name="objective_evaluation" id="objective_evaluation">
            </select>
            <h6 class="gray-text mt-2" name="evaluation_detail" id="evaluation_detail"></h6>
          </div>
        </div>
        <div class="form-group mt-2">
          <h6>Planning Name</h6>
          <input class="form-control gray-text" type="text" placeholder="Text..." name="project_name" id="project_name"></input>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <h6>Start date</h6>
              <div class="input-group date" id="start_date" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input gray-text" data-target="#start_date" name="start_date" id="start_date" />
                <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <h6>End date</h6>
              <div class="input-group date" id="end_date" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input gray-text" data-target="#end_date" name="end_date" id="end_date" />
                <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <h6>Owner</h6>
              <input class="form-control gray-text" type="text" placeholder="Text..." name="owner" id="owner"></input>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <h6>Date of Evaluation</h6>
              <div class="input-group date" id="date_of_evaluation" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input gray-text" data-target="#date_of_evaluation" name="date_of_evaluation" id="date_of_evaluation" />
                <div class="input-group-append" data-target="#date_of_evaluation" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <h6>Evaluation Methods</h6>
              <textarea name="evaluation_methods" id="evaluation_methods" cols="20" rows="5" class="form-control gray-text" placeholder="Text..."></textarea>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <h6>Attach File</h6>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="file">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
              <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
            </div>
          </div>
        </div>
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
  $('#start_date').datetimepicker({
    format: 'DD/MM/YYYY',
  });
  $('#end_date').datetimepicker({
    format: 'DD/MM/YYYY',
  });
  $('#date_of_evaluation').datetimepicker({
    format: 'DD/MM/YYYY',
  });
</script>

<script>
  $(document).ready(function() {
    $(".overlay").hide();
  });

  $("#form_crud_planning").on('submit', function(e) {
    e.preventDefault();
    var selectedOption = document.getElementById('objective_evaluation').value;
    if (selectedOption == 0) {
      Swal.fire({
        title: 'Without Objective Evaluation data, please add Objective Evaluation before proceeding.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        confirmButtonText: "Submit",
      })
    } else {
      const urlRouteInput = document.getElementById("url_route");
      action_(urlRouteInput.value, 'form_crud_planning');
    }

  });

  function handleObjectiveEvaluationChange() {
    var selectedOption = document.getElementById('objective_evaluation').value;
    var descriptionDetail = document.getElementById('evaluation_detail');
    var select_objective = <?php echo json_encode($objective); ?>;

    select_objective.forEach(element_objective => {
      if (selectedOption == element_objective.id_objective) {
        descriptionDetail.innerHTML = element_objective.evaluation;
      }
    })
  }

  document.getElementById('objective_evaluation').addEventListener('change', handleObjectiveEvaluationChange);
</script>
<script>
  $(function() {
    bsCustomFileInput.init();
  });
</script>