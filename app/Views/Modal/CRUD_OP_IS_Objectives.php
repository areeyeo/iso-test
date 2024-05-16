<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <div class="modal-header bg-primary">
            <h4 class="modal-title" id="title_modal" name="title_modal">IS Objectives Operations</h4>
        </div>
        <form class="mb-3" id="form_crud_is_objectives" action="javascript:void(0)" method="post" enctype="multipart/form-data">
            <div class="modal-body">

                <h6>Description</h6>
                <h6 class="gray-text" name="description_detail" id="description_detail">
                    รอใส่คำอธิบายเพิ่มเติม
                </h6>
                <div class="row">
                    <div class="form-group mt-3 col-6">
                        <h6>OBJ No.</h6>
                        <input class="form-control gray-text" type="text" placeholder="Text..." name="obj_no" id="obj_no" readonly></input>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <h6>Planning Name</h6>
                    <input class="form-control gray-text" type="text" placeholder="Text..." name="planning_name" id="planning_name"></input>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <h6>Start date</h6>
                            <div class="input-group date" id="start_date_is_objective" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input gray-text" data-target="#start_date_is_objective" name="start_date_is_objective" id="start_date_is_objective" />
                                <div class="input-group-append" data-target="#start_date_is_objective" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <h6>End date</h6>
                            <div class="input-group date" id="end_date_is_objective" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input gray-text" data-target="#end_date_is_objective" name="end_date_is_objective" id="end_date_is_objective" />
                                <div class="input-group-append" data-target="#end_date_is_objective" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <h6>Responsible Person</h6>
                    <input class="form-control gray-text" type="text" placeholder="Text..." name="owner" id="owner"></input>
                </div>
                <div class="row">
                    <div class="form-group mt-3 col-6">
                        <h6>Status (%)</h6>
                        <div class="input-group">
                            <input class="form-control gray-text" type="number" id="status" name="status" min="0" max="100">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <h6>Evaluation</h6>
                    <input class="form-control gray-text" type="text" placeholder="Text..." name="evaluation" id="evaluation"></input>
                </div>
                <div class="form-group mt-4">
                    <h6>Result</h6>
                    <textarea class="form-control" type="text" name="result" id="result" rows="3" placeholder="Text..."></textarea>
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
<script>
    $(function() {
        $('#start_date_is_objective').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        $('#end_date_is_objective').datetimepicker({
            format: 'DD/MM/YYYY',
        });
    });
</script>
<script>
    $("#form_crud_is_objectives").on('submit', function(e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_crud_is_objectives');
    });
</script>