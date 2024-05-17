<style>
    .custom-file {
        margin-bottom: 10px;
    }

    .file-names-container {
        overflow: hidden;
    }

    .file-name {
        width: 370px;
        border: 1px solid #007bff;
        /* color: #007bff; */
        padding: 8px;
        border-radius: 5px;
        background-color: #fff;
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 10px;
        white-space: nowrap;
    }

    .file-info {
        display: flex;
        align-items: center;
    }

    .filename {
        max-width: '200px';
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-right: 5px;
        color: #495057;
    }

    .file-icon {
        margin-right: 3px;
        color: #007bff;

    }

    .file-icon-bin {
        margin-left: auto;
        color: #007bff;
    }

    .tooltip-inner {
        background-color: #F8F9FA;
        border: 1px solid #CED4DA;
        color: black;
    }
</style>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h4 class="modal-title" id="title_modal" name="title_modal">Minutes of Meeting</h4>
        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_crud_meeting" action="javascript:void(0)" method="post" enctype="multipart/form-data">
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
                <div class="form-group mt-3">
                    <h6>Meeting Date</h6>
                    <input class="form-control gray-text" type="date" placeholder="select date..." name="meetingdate" id="meetingdate"></input>
                </div>
                <div class="form-group">
                    <div class="d-flex align-items-center">
                        <h6 class="mt-2">Meeting Documents&nbsp;</h6>
                        <i class="far fa-question-circle text-primary" data-toggle="tooltip" title="More than 1 file can be attached."></i>
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="meeting_doc" accept=".docx, .pdf, .xlsx, .doc" data-max-size="20971520" name="meeting_doc[]" multiple>
                        <label class="custom-file-label">Choose files</label>
                    </div>
                    <h6 class="gray-text">.doc, .xls, .pdf (20 MB per file)</h6>
                    <div id="fileNamesContainer" class="file-names-container"></div>
                    <div id="fileNamesContainer2" class="file-names-container"></div>
                </div>
                <div class="form-group">
                    <h6>Meeting Minutes Documents</h6>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="meeting_minutes_doc" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="meeting_minutes_doc">
                        <label class="custom-file-label" for="customFile" id="label_meeting_minutes_doc">Choose file</label>
                    </div>
                    <h6 class="gray-text">.doc .xls .pdf (20 MB per file)</h6>
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
    $(function() {
        bsCustomFileInput.init();
    });
    $("#form_crud_meeting").on('submit', function(e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_crud_meeting');
    });
</script>
<script>
    var file_array = [];
    var file_array2 = [];

    document.getElementById('meeting_doc').addEventListener('change', function() {
        var fileInput = this;
        var fileNamesContainer = document.getElementById('fileNamesContainer');
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            file_array.push(files[i]);
        }
        create_file();
        $('#meeting_doc').val('');
    });

    function deleteFile(file, id_container) {
        var index = file_array.indexOf(file);
        file_array.splice(index, 1);
        document.getElementById(id_container).remove();
    }

    function deleteFile2(id_file, id_container) {
        file_array2.forEach(element => {
            if (element.id_files == id_file) {
                var index = file_array2.indexOf(element);
                file_array2.splice(index, 1);
            }
        });
        document.getElementById(id_container).remove();
    }

    function create_file() {
        // Clear previous content
        fileNamesContainer.innerHTML = '';
        file_array.forEach((element, i) => {
            var fileNameContainer = document.createElement('div');
            fileNameContainer.classList.add('file-name');

            fileNameContainer.id = 'fileNameContainer_' + i;

            var fileIcon = document.createElement('span');
            fileIcon.innerHTML = '<i class="far fa-file-alt"></i>';
            fileIcon.classList.add('file-icon');

            var fileInfo = document.createElement('span');
            fileInfo.classList.add('file-info');
            fileInfo.style.fontSize = '10pt';

            var fileName = document.createElement('span');
            fileName.textContent = element.name;
            fileName.className = 'filename';

            var fileIcons = document.createElement('span');
            fileIcons.innerHTML = '<i class="fas fa-trash-alt"></i>';
            fileIcons.classList.add('file-icon-bin');
            fileIcons.addEventListener('click', function() {
                deleteFile(i, 'fileNameContainer_' + i);
            });

            fileInfo.appendChild(fileIcon);
            fileInfo.appendChild(fileName);
            fileInfo.appendChild(fileIcons);

            fileNameContainer.appendChild(fileInfo);
            fileNamesContainer.appendChild(fileNameContainer);
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>