<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="overlay">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header bg-primary">
            <h4 class="modal-title" id="title_modal" name="title_modal"></h4>
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
                <div class="form-group" id="form-group-file">
                    <h6>Attach File</h6>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile"
                            accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="file">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
                </div>
                <div class="form-group" id="form-group-text">
                    <h6>Note</h6>
                    <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="text"
                        id="text"></textarea>
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