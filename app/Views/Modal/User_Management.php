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
            <form class="mb-3" id="form_user" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                <div id="act" name="act">
                    <h5>Activated</h5>
                    <input type="checkbox" name="activated" id="activated" data-bootstrap-switch data-off-color="danger"
                        data-on-color="success">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name ..." id="name" name="name"
                                required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Enter Last Name ..." id="last"
                                name="last" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter Email ..." id="email" name="email"
                        required>
                </div>
                <label>Password</label>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="********">
                </div>
                <label>Confirm Password</label>
                <div class="input-group mb-3">
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                        placeholder="********">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Group</label>
                            <select class="form-control gray-text" name="group_select" id="group_select">
                                <?php foreach ($data_group as $item): ?>
                                    <option value="<?= $item['id_group'] ?>" id="<?= $item['id_group'] ?>">
                                        <?= $item['name_group'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control gray-text" name="role_select" id="role_select">
                                <?php foreach ($data_role as $role): ?>
                                    <option value="<?= $role['id_role'] ?>" id="<?= $role['id_role'] ?>">
                                        <?= $role['name_role'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" id="date_time" name="date_time">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Create Date Time</label>
                            <input type="text" class="form-control" placeholder="Enter Name ..." id="create_date"
                                name="create_date" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Update Date Time</label>
                            <input type="text" class="form-control" placeholder="Enter Last Name ..." id="update_date"
                                name="update_date" disabled>
                        </div>
                    </div>
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
        $("#form_user").on('submit', function (e) {
            e.preventDefault();
            store_alert(); // Call the function to handle the submission
        });

        // Check Password
        if ($("#form_user").length > 0) {
            $("#form_user").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 8,
                        passwordcheck: true
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        passwordcheck: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long",
                        passwordcheck: "Password should include at least one upper case letter, one lower case letter, one number, and one special character"
                    },
                    confirm_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long",
                        passwordcheck: "Password should include at least one upper case letter, one lower case letter, one number, and one special character",
                        equalTo: "Your password no match"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            })

            $.validator.addMethod("passwordcheck", function (value) {
                return /[a-z]/.test(value)
                    && /[A-Z]/.test(value)
                    && /[0-9]/.test(value)
                    && /[#$@!%&*?]/.test(value)
            });
        }

        // Ajax form submission with image
        function store_alert() {
            var id_ = document.getElementById("id_").value;
            var params = document.getElementById("params").value;

            var url_link;
            if (params == '1') {
                url_link = 'userlist/create';
            } else if (params == '2') {
                url_link = 'userlist/edit/' + id_;
            }

            var formData = new FormData($("#form_user")[0]);
            var loadingIndicator = Swal.fire({
                title: 'Loading...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: () => {
                    Swal.showLoading();
                }
            });
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
                        if (response.validator.name) {
                            mes += 'กรุณากรอกชื่อขนาดมากกว่า 2 ตัวอักษร' + '<br>';
                        }
                        if (response.validator.last) {
                            mes += 'กรุณากรอกนามสกุลขนาดมากกว่า 2 ตัวอักษร' + '<br>';
                        }
                        if (response.validator.email) {
                            mes += 'อีเมล์นี้ถูกใช้งานไปแล้ว กรุณาเปลี่ยนอีเมล์' + '<br>';
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