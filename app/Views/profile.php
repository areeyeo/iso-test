<title>Profile</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <h3 class="profile-username text-center">
                                <?php echo session()->get('username'); ?>
                            </h3>

                            <p class="text-muted text-center">
                                <?php echo session()->get('group'); ?>
                            </p>

                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Projects <span class="float-right badge bg-primary">
                                            <?= count($data) ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Tasks <span class="float-right badge bg-info">
                                            <?php
                                            $projects = $data; // Assuming $data is your array of projects
                                            $condition = '4'; // Replace with the condition you want to check
                                            
                                            // Use array_filter to keep only elements that do not match the condition
                                            $filteredProjects = array_filter($projects, function ($project) use ($condition) {
                                                return $project['status'] !== $condition;
                                            });

                                            // Count the filtered projects
                                            $count = count($filteredProjects);

                                            echo $count;
                                            ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Completed Projects <span class="float-right badge bg-success">
                                            <?php
                                            $projects = $data; // Assuming $data is your array of projects
                                            $count = 0;

                                            foreach ($projects as $project) {
                                                if ($project['status'] == '4') {
                                                    $count++;
                                                }
                                            }
                                            echo $count;
                                            ?>
                                        </span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Firstname</strong>

                            <p class="text-muted">
                                <?php echo session()->get('name'); ?>
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Lastname</strong>

                            <p class="text-muted">
                                <?php echo session()->get('lastname'); ?>
                            </p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Email</strong>

                            <p class="text-muted">
                                <?php echo session()->get('email'); ?>
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Role</strong>

                            <p class="text-muted">
                                <?php echo session()->get('role'); ?>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#edit_profile"
                                        data-toggle="tab">Edit Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#change_password"
                                        data-toggle="tab">Change Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="edit_profile">
                                    <form id="user-update" action="javascript:void(0)" method="post" name="user_update">
                                        <div class="card-body">
                                            <input type="hidden" name="id_" id="id_"
                                                value="<?php echo $users['id_user']; ?>">
                                            <label>Firstname</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="name" class="form-control" id="name"
                                                    value="<?php echo $users['name_user']; ?>" placeholder="Firstname">
                                            </div>
                                            <label>Lastname</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="last" class="form-control" id="last"
                                                    value="<?php echo $users['lastname_user']; ?>"
                                                    placeholder="Lastname">
                                            </div>
                                            <label>Email</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                                <input type="text" name="email" class="form-control" id="email"
                                                    value="<?php echo $users['email_user']; ?>" placeholder="Email">
                                            </div>
                                            <label>Group</label>
                                            <div class="input-group mb-3">
                                                <select selected="selected" name="group" class="form-control" id="group"
                                                    required>
                                                    <?php if ($groups): ?>
                                                        <?php foreach ($groups as $rowgroup): ?>
                                                            <?php if ($rowgroup['id_group'] == $users['group']): ?>
                                                                <option selected="selected"
                                                                    value="<?php echo $rowgroup['id_group']; ?>">
                                                                    <?php echo $rowgroup['name_group']; ?>
                                                                </option>
                                                            <?php else: ?>
                                                                <option value="<?php echo $rowgroup['id_group']; ?>">
                                                                    <?php echo $rowgroup['name_group']; ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <!-- Add an image preview element -->
                                            <label for="profile-picture">Profile Picture</label>
                                            <div class="form-group">
                                                <a for="profile-picture" id="check_pic">No Picture</a>
                                                <img id="image-preview" name="image-preview"
                                                    src="data:image/png;base64, <?php echo $users['image_profile']; ?>"
                                                    alt="Profile Picture" style="max-width: 150px;" class="img-circle">
                                            </div>
                                            <div class="form-group">
                                                <button type="button" id="remove-image" class="btn btn-danger">Remove
                                                    Picture</button>
                                            </div>
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" id="profile-picture"
                                                    name="profile_picture" accept="image/*">
                                            </div>
                                            <input type="hidden" name="have_pictures" id="have_pictures">
                                            <div class="input-group mb-3">
                                                <input type="checkbox" name="activated" id="activated"
                                                    data-bootstrap-switch data-off-color="danger"
                                                    data-on-color="success">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="change_password">
                                    <form id="user-changepass" action="<?php echo base_url('/user_update'); ?>"
                                        method="post" name="user_update">
                                        <div class="card-body">
                                            <input type="hidden" name="id_" id="id_"
                                                value="<?php echo $users['id_user']; ?>">
                                            <label>Old Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" name="old_password" class="form-control"
                                                    id="old_password" placeholder="********">
                                            </div>
                                            <label>Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" name="password" class="form-control"
                                                    id="password" placeholder="********">
                                            </div>
                                            <label>Confirm Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" name="confirm_password" class="form-control"
                                                    id="confirm_password" placeholder="********">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="<?= base_url('dist/js/adminlte.min.js'); ?>"></script>
<script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap Switch -->
<script src="<?= base_url('plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
<script src="<?= base_url('plugins/jquery-validation/additional-methods.min.js'); ?>"></script>
<script>
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', true);
    });

    $(document).ready(function () {
        $("#user-update").on('submit', function (e) {
            e.preventDefault();
            store_alert1(); // Call the function to handle the submission
        });
        $("#user-changepass").on('submit', function (e) {
            e.preventDefault();
            store_alert(); // Call the function to handle the submission
        });

        // Check Password
        if ($("#user-changepass").length > 0) {
            $("#user-changepass").validate({
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
            var url_link = 'passownuserlist/edit/' + id_;

            // Show loading indicator here
            var loadingIndicator = Swal.fire({
                title: 'Loading...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: () => {
                    Swal.showLoading();
                }
            });

            var formData = new FormData($("#user-changepass")[0]);
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
                        Swal.fire({
                            title: mes,
                            icon: 'error',
                            showConfirmButton: true
                        });
                    }
                })
                .fail(function (xhr, status, error) {
                    // Hide loading indicator here in case of failure
                    Swal.fire({
                        title: error,
                        icon: 'error',
                        showConfirmButton: true
                    });
                });
        }


        // Ajax form submission with image
        function store_alert1() {
            var id_ = document.getElementById("id_").value;
            var url_link = 'ownuserlist/edit/' + id_;

            // Show loading indicator here
            var loadingIndicator = Swal.fire({
                title: 'Loading...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                onOpen: () => {
                    Swal.showLoading();
                }
            });

            var formData = new FormData($("#user-update")[0]);
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
                    // Hide loading indicator here in case of failure
                    Swal.fire({
                        title: error,
                        icon: 'error',
                        showConfirmButton: true
                    });
                });
        }

    });
</script>
<script>
    $(document).ready(function () {

        // Function to update the image preview when a file is selected
        var image_preview = document.getElementById('image-preview');
        var check_pic = document.getElementById('check_pic');
        var remove_image = document.getElementById('remove-image');
        var have_pictures = document.getElementById('have_pictures');

        document.getElementById('profile-picture').addEventListener('change', function (event) {
            const fileInput = event.target;
            const imagePreview = document.getElementById('image-preview');

            if (fileInput.files.length > 0) {
                image_preview.style.display = "block";
                check_pic.style.display = "none";
                remove_image.style.display = "block";
                have_pictures.value = '1';


                const file = fileInput.files[0];
                const reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            } else {
                imagePreview.src = ''; // Clear the preview if no file is selected
            }
        });

        // Function to remove the selected profile picture
        document.getElementById('remove-image').addEventListener('click', function () {
            const fileInput = document.getElementById('profile-picture');
            const imagePreview = document.getElementById('image-preview');
            image_preview.style.display = "none";
            check_pic.style.display = "block";
            remove_image.style.display = "none";
            have_pictures.value = '0';

            // Clear the file input and image preview
            fileInput.value = ''; // Clear the selected file
            imagePreview.src = ''; // Clear the image preview
        });
    });
</script>
<script>
    $(document).ready(function () {
        var user_Data = <?php echo json_encode($users); ?>;
        var image_preview = document.getElementById('image-preview');
        var check_pic = document.getElementById('check_pic');
        var remove_image = document.getElementById('remove-image');
        var have_pictures = document.getElementById('have_pictures');

        if (user_Data.image_profile === null) {
            image_preview.style.display = "none";
            check_pic.style.display = "block";
            remove_image.style.display = "none";
            have_pictures.value = '0';
        } else {
            image_preview.style.display = "block";
            check_pic.style.display = "none";
            remove_image.style.display = "block";
            have_pictures.value = '1';

        }
    });

</script>