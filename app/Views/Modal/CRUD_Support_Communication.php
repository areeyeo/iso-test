<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/dist/css/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/dist/css/bootstrap-icons.css">

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
        <!-- <div class="overlay">
      <i class="fas fa-2x fa-sync fa-spin"></i>
    </div> -->
        <div class="modal-header bg-primary">
          <h4 class="modal-title" id="title_modal" name="title_modal">Communication</h4>
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
            <div>
              <h6 class="gray-text" name="description" id="description"></h6>
            </div>
            <div class="form-group mt-2">
              <h6>What to communicate</h6>
              <input class="form-control gray-text" type="text" placeholder="Text..." name="whattocommunicate" id="whattocommunicate"></input>
            </div>
            <div class="form-group mt-2">
              <h6>Detail</h6>
              <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="detail" id="detail"></textarea>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group mt-2">
                  <h6>Communicator</h6>
                  <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="communicator" id="communicator"></textarea>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group mt-2">
                  <h6>Communicate with whom</h6>
                  <textarea onInput="handleInput(event)" class="form-control gray-text" rows="3" placeholder="Text..." name="communicatewithwhom" id="communicatewithwhom"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group mt-2">
                  <h6>When to communicate</h6>
                  <textarea class="form-control gray-text" rows="3" placeholder="Text..." name="whentocommunicate" id="whentocommunicate"></textarea>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group mt-2">
                  <h6>How to communicate</h6>
                  <textarea onInput="handleInput(event)" class="form-control gray-text" rows="3" placeholder="Text..." name="howtocommunicate" id="howtocommunicate"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <h6>Attachment file</h6>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="attachmentfile" accept=".docx, .pdf, .xlsx , .doc" data-max-size="20971520" name="attachmentfile">
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
      $(document).ready(function() {
        $(".overlay").hide();
      });

      $("#form_crud").on('submit', function(e) {
        e.preventDefault();
        const urlRouteInput = document.getElementById("url_route");
        action_(urlRouteInput.value, 'form_crud');
      });
    </script>
    <script>
      let previousLength = 0;

      const handleInput = (event) => {
        const bullet = "\u2022";
        const newLength = event.target.value.length;
        const characterCode = event.target.value.substr(-1).charCodeAt(0);

        if (newLength > previousLength) {
          if (characterCode === 10) {
            event.target.value = `${event.target.value}${bullet} `;
          } else if (newLength === 1) {
            event.target.value = `${bullet} ${event.target.value}`;
          }
        }

        previousLength = newLength;
      }
    </script>
    <script>
      $(function () {
        bsCustomFileInput.init();
      });
    </script>