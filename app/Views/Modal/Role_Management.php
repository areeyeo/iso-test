<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="overlay preloader">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header ">
            <h4 class="modal-title" id="title_modal" name="title_modal"></h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div class="modal-body">
            <form class="mb-3" id="form_role" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name Role</label>
                    <input type="text" class="form-control" placeholder="Enter Name Role ..." id="namerole"
                        name="namerole" required>
                </div>
                <input type="text" id="id_" name="id_" hidden>
                <input type="text" id="params" name="params" hidden>
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
        // Attach the event handler to the form's submit event
        $("#form_role").on('submit', function (e) {
            e.preventDefault();
            store_alert(); // Call the function to handle the submission
        });

        // Ajax form submission with image
        function store_alert() {
            var id_ = document.getElementById("id_").value;
            var params = document.getElementById("params").value;

            var url_link;
            if (params == '1') {
                url_link = 'rolelist/create';
            } else if (params == '2') {
                url_link = 'rolelist/edit/' + id_;
            }
            var loadingIndicator = Swal.fire({
                title: 'Loading...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: () => {
                    Swal.showLoading();
                }
            });
            var formData = new FormData($("#form_role")[0]);
            $.ajax({
                url: '<?= base_url("database/") ?>' + url_link,
                type: "POST",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function () {
                    // Show loading indicator here
                    loadingIndicator;
                },
            })
                .done(function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            if (response.reload) {
                                window.location.reload();
                            }
                        }, 2000);
                    } else {
                        var mes = "";
                        if (response.validator.name_role) {
                            mes += 'กรุณากรอกชื่อ role ขนาดมากกว่า 2 ตัวอักษร' + '<br>';
                        }
                        Swal.fire({
                            title: mes,
                            icon: 'error',
                            showConfirmButton: true
                        });
                    }
                })
                .fail(function (xhr, status, error) {
                    Swal.fire({
                        title: error,
                        icon: 'error',
                        showConfirmButton: true
                    });
                });
        }
    });
</script>