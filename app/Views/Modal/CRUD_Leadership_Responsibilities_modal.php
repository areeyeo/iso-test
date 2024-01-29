<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="overlay">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header bg-primary">
            <h4 class="modal-title" id="title_modal" name="title_modal">ISMS Roles & Responsibilities</h4>
        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_crud_responsibilities" action="javascript:void(0)" method="post" enctype="multipart/form-data">
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
                    <h6>Roles</h6>
                    <div class="form-group">
                        <select class="form-control" name="roles_select" id="roles_select">
                            <option value="1" id="1">Top Management</option>
                            <option value="2" id="2">ISMC : Information Security Management Committee</option>
                            <option value="3" id="3">Internal Audit</option>
                            <option value="4" id="4">ISMR : Information Security Management Representative</option>
                            <option value="5" id="5">Document Control</option>
                            <option value="6" id="6">Working Team</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <h6 class="gray-text" name="roles_detail" id="roles_detail"> </h6>
                    </div>
                </div>
                <div class="form-group">
                    <h6>Responsibilities</h6>
                    <textarea class="form-control scrollbar-new" id="responsibilities" name="responsibilities" class="form-control" placeholder="Enter Responsibilities ..." rows="3"></textarea>
                </div>
                <div class="form-group">
                    <h6>Name - Last Name</h6>
                    <input type="text" id="name_lastname" name="name_lastname" class="form-control" placeholder="Enter Name - Last Name ...">
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="submit" value="Submit">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(".overlay").hide();
        updateDescription();
    });

    $("#form_crud_responsibilities").on('submit', function(e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_crud_responsibilities');
    });
</script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
<script>
    var roles_select = document.getElementById("roles_select");

    function updateDescription() {
        if (roles_select.value === '1') {
            $(".modal-content #roles_detail").text('description 1');
        } else if (roles_select.value === '2') {
            $(".modal-content #roles_detail").text('description 2');
        } else if (roles_select.value === '3') {
            $(".modal-content #roles_detail").text('description 3');
        } else if (roles_select.value === '4') {
            $(".modal-content #roles_detail").text('description 4');
        } else if (roles_select.value === '5') {
            $(".modal-content #roles_detail").text('description 5');
        } else if (roles_select.value === '6') {
            $(".modal-content #roles_detail").text('description 6');
        }
    }
    roles_select.addEventListener("change", function() {
        updateDescription();
    });
</script>
<style>
    /* CSS เพิ่มเติมสำหรับ scrollbar แบบไอโฟน */
    .scrollbar-new {
        overflow: auto;
        scrollbar-width: thin;
        scrollbar-color: #ADB5BD transparent;
    }

    /* CSS เพิ่มเติมสำหรับ Webkit (Chrome, Safari, Edge) */
    .scrollbar-new::-webkit-scrollbar {
        width: 6px;
    }

    .scrollbar-new::-webkit-scrollbar-thumb {
        background-color: #ADB5BD;
    }
</style>