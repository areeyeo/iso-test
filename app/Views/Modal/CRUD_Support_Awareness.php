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

<head>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title" id="title_modal" name="title_modal">Awareness</h4>
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
          <div class="form-group mt-2">
            <h6>Course</h6>
            <input class="form-control gray-text" type="text" placeholder="Text..." name="course" id="course"
              required></input>
          </div>
          <div class="form-group mt-2">
            <h6>Detail</h6>
            <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="detail" id="detail"
              required></textarea>
          </div>
          <div class="form-group">
            <h6>Date</h6>
            <div class="input-group date" id="date" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input gray-text" data-target="#date" name="date"
                id="date" required />
              <div class="input-group-append" data-target="#date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="d-flex align-items-center">
              <h6 class="mt-2">Attach Files&nbsp;</h6>
              <i class="far fa-question-circle text-primary" data-toggle="tooltip"
                title="Attached files include media, list of names, pre-test and post-test scores."></i>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="exampleInputFiles" accept=".docx, .pdf, .xlsx, .doc"
                data-max-size="20971520" name="files_[]" multiple>
              <label class="custom-file-label" for="exampleInputFiles">Choose files</label>
            </div>
            <h6 class="gray-text">.doc, .xls, .pdf (20 MB per file)</h6>
            <div id="fileNamesContainer" class="file-names-container"></div>
            <div id="fileNamesContainer2" class="file-names-container"></div>
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
      var urlRouteInput = document.getElementById("url_route");
      action_(urlRouteInput.value, 'form_crud');
    });

    $('#date').datetimepicker({
      format: 'DD/MM/YYYY',
    });
  </script>
  <script>
    var file_array = [];
    var file_array2 = [];

    document.getElementById('exampleInputFiles').addEventListener('change', function () {
      var fileInput = this;
      var fileNamesContainer = document.getElementById('fileNamesContainer');
      var files = fileInput.files;
      for (var i = 0; i < files.length; i++) {
        file_array.push(files[i]);
      }
      create_file();
    });

    function deleteFile(file, id_container) {
      var index = file_array.indexOf(file);
      file_array.splice(index, 1);
      document.getElementById(id_container).remove();
    }
    function deleteFile2(id_file, id_container) { 
      file_array2.forEach(element => {
        if(element.id_files == id_file){
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
        fileIcons.addEventListener('click', function () {
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
    $(document).ready(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>