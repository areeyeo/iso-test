<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header" id="dynamicModalHeader">
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_request_modification" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                <div>
                    <h6>Description</h6>
                </div>
                <div>
                    <h6 class="gray-text" name="description_request_modify" id="description_request_modify">คำอธิบาย</h6>
                </div>
                <div class="form-group">
                    <h6>Note</h6>
                    <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="text_request_modify" id="text_request_modify"></textarea>
                </div>
                <input type="text" id="url_route" name="url_route" hidden>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="submit" value="Submit">CONFIRM</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.modal-content -->
</div>
<script src="<?= base_url('plugins/moment/moment.min.js'); ?>"></script>
<!-- date-range-picker -->
<script src="<?= base_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>

<script>
    $(document).ready(function () {
        $(".overlay").hide();
    });

    $("#form_request_modification").on('submit', function (e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_request_modification');
    });
</script>