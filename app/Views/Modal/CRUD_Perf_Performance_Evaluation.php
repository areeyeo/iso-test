<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <!-- <div class="overlay">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div> -->
        <div class="modal-header bg-primary">
            <h4 class="modal-title" id="title_modal" name="title_modal">Performance Evaluation</h4>
        </div>
        <div class="modal-body" style="padding: 0% 0% 0% 1%;">
            <div class="row">
                <div class="col-4 p-4" style="background-color: #E2F0FF;">
                    <div class="form-group">
                        <div style="color: #0062FF; font-weight: 500; font-size: 10pt;">OBJ No.</div>
                        <div class="mb-3" style=" color: #0062FF; font-size: 16pt;" name="obj_no_detail" id="obj_no_detail"></div>
                    </div>
                    <div class="form-group">
                        <div style=" color: #0062FF; font-size: 13pt;">Objective</div>
                        <div style=" color: #666666; font-size: 11pt;" class="mb-3" name="objective" id="objective"></div>
                    </div>
                    <div class="form-group">
                        <div style=" color: #0062FF; font-size: 13pt;">Evaluation</div>
                        <div style=" color: #666666; font-size: 11pt;" class="mb-3" name="evaluation" id="evaluation"></div>
                    </div>
                </div>
                <div class="col-8">
                    <form class="mb-3" id="form_edit_performance_evaluation" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                        <div class="p-3">
                            <div class="form-group">
                                <div style=" font-size: 13pt;">Planning</div>
                                <div style=" color: #666666; font-size: 11pt;" class="mb-3" name="planning" id="planning"></div>
                            </div>
                            <div class="form-group mt-3 row">
                                <div class="col-6">
                                    <div style=" font-size: 13pt;">Start Date</div>
                                    <div style=" color: #666666; font-size: 11pt;" name="startdate_detail" id="startdate_detail"></div>
                                </div>
                                <div class="col-6">
                                    <div style=" font-size: 13pt;">End Date</div>
                                    <div style=" color: #666666; font-size: 11pt;" name="enddate_detail" id="enddate_detail"></div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div style=" font-size: 13pt;">Who Shall Monitor</div>
                                <div style=" color: #666666; font-size: 11pt;" class="mb-3" name="who_detail" id="who_detail"></div>
                            </div>
                            <div class="form-group mt-3">
                                <div style=" font-size: 13pt;">Methods For Monitoring</div>
                                <div style=" color: #666666; font-size: 11pt;" class="mb-3" name="methods_detail" id="methods_detail"></div>
                            </div>
                            <div class="form-group mt-3">
                                <div style=" font-size: 13pt;">When to Evaluated</div>
                                <div style=" color: #666666; font-size: 11pt;" class="mb-3" name="when_evaluated_detail" id="when_evaluated_detail"></div>
                            </div>

                            <div class="form-group mt-3">
                                <h6>Actual</h6>
                                <input class="form-control gray-text" type="date" name="actual" id="actual"></input>
                            </div>
                            <div class="form-group mt-3">
                                <h6>Criteria</h6>
                                <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="criteria" id="criteria"></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <h6>Result</h6>
                                <select class="form-select form-control" aria-label="Default select example" id="evaluation_results" name="evaluation_results">
                                    <option value="0">Select Result</option>
                                    <option value="1">Pass</option>
                                    <option value="2">Fail</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" id="url_route" name="url_route" hidden>
                        <div class="mb-4" style="display: flex; justify-content: center;">
                            <button type="submit" class="btn btn-success" name="submit" value="Submit" style="margin-right: 20%;">SAVE</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#form_edit_performance_evaluation").on('submit', function(e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        const evaluation_results = document.getElementById("evaluation_results").value;

        if (evaluation_results == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select result!'
            });
            return;
        }
        action_(urlRouteInput.value, 'form_edit_performance_evaluation');
    });
</script>