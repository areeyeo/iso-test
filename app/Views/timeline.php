<title>
    <?= $text_path ?> Timeline
</title>

<style>
    .col-lg-custome {
        -ms-flex: 0 0 16.666667%;
        flex: 1 0 19.666667%;
        max-width: 20.666667%;
    }

    .dropdown-submenu:hover .dropdown-menu {
        display: block;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        left: -100%;
        margin-top: 0;
        border-radius: 10px;
    }


    .button-table {
        border-color: transparent;
        background-color: transparent;
    }

    .icon-custome {
        float: right !important;
    }
</style>
<?php
$sortOrder = 'newest'; // Set a default value
$sortStatus = '0'; // Set a default value
$new_old = "";
$old_new = "hidden";
if (isset($_GET['sort'])) {
    $sortOrder = $_GET['sort'];

    if ($sortOrder === 'newest') {
        $new_old = "";
        $old_new = "hidden";
        usort($TimelineModels, function ($a, $b) {
            return strtotime($b['date_timeline']) - strtotime($a['date_timeline']);
        });
    } elseif ($sortOrder === 'oldest') {
        $new_old = "hidden";
        $old_new = "";
        usort($TimelineModels, function ($a, $b) {
            return strtotime($a['date_timeline']) - strtotime($b['date_timeline']);
        });
    }
}
$filter_all = "";
$filter_modi = "hidden";
$filter_reject_review = "hidden";
$filter_reject_approve = "hidden";
// Filter the timeline items based on the selected status_id
if (isset($_GET['status_id'])) {
    $statusId = $_GET['status_id'];
    if ($statusId !== 'all') {
        if ($statusId === '0') {
            $filter_all = "hidden";
            $filter_modi = "";
            $filter_reject_review = "hidden";
            $filter_reject_approve = "hidden";
            $filteredTimelineModels = array_filter($TimelineModels, function ($item) {
                $excludedStatusIds = [5, 6];
                return !in_array($item['status_id'], $excludedStatusIds);
            });

        } else {
            if ($statusId === '5') {
                $filter_all = "hidden";
                $filter_modi = "hidden";
                $filter_reject_review = "";
                $filter_reject_approve = "hidden";
            } else if ($statusId === '6') {
                $filter_all = "hidden";
                $filter_modi = "hidden";
                $filter_reject_review = "hidden";
                $filter_reject_approve = "";
            }
            $filteredTimelineModels = array_filter($TimelineModels, function ($item) use ($statusId) {
                return $item['status_id'] == $statusId;
            });
        }

    } else {
        $filteredTimelineModels = $TimelineModels; // Show all items if 'All status' is selected
    }
} else {
    $filteredTimelineModels = $TimelineModels; // Default to showing all items
}
?>

<body class="hold-transition sidebar-mini">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            <?= $text_path ?>
                            <button type="button" class="btn btn-secondary btn-xs" data-toggle="modal"
                                data-target="#modal-default" id="load-modal-button"
                                onclick="load_modal(1)">Requirement</button>
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url($url_allversion); ?>">
                                    <?= $text_path ?>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?= site_url($url_version); ?>">Version
                                    <?= $num_ver ?>
                                </a></li>
                            <li class="breadcrumb-item active">History</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Timelime example  -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">History</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <ul class="nav nav-pills" id="tabs-tab" role="tablist">
                                        <!-- แท็บ Timeline -->
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill"
                                                data-target="#pills-timeline" role="tab" aria-controls="pills-timeline"
                                                aria-selected="true" href="#internal">Timeline</a>
                                        </li>
                                        <!-- แท็บ Note -->
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="pills-note-tab" data-toggle="pill"
                                                data-target="#pills-note" role="tab" aria-controls="pills-note"
                                                aria-selected="false" href="#internal">Note</a>
                                        </li>
                                        <!-- ปุ่ม Sliders ที่อยู่ตรงกลางและชิดขวา -->
                                        <li class="nav-item ml-auto text-center" role="presentation">
                                            <button type="button" class="btn btn-tool" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-sliders-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <span class="dropdown-item dropdown-header">Sort by</span>
                                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                                    href="#" onclick="sortItems('oldest')">
                                                    <span>Old-New</span>
                                                    <i class="fas fa-check" <?= $old_new ?>></i>
                                                </a>
                                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                                    href="#" onclick="sortItems('newest')">
                                                    <span>New-Old</span>
                                                    <i class="fas fa-check" <?= $new_old ?>></i>
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <span class="dropdown-item dropdown-header">Filter by</span>
                                                <div class="dropdown-submenu">
                                                    <a class="dropdown-item dropdown-toggle" href="#">Status</a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                                            href="?sort=<?= $sortOrder ?>&status_id=all">
                                                            <span>All status</span>
                                                            <i class="fas fa-check" <?= $filter_all ?>></i>
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                                            href="?sort=<?= $sortOrder ?>&status_id=0">
                                                            <span>All Except Rejected</span>
                                                            <i class="fas fa-check" <?= $filter_modi ?>></i>
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                                            href="?sort=<?= $sortOrder ?>&status_id=5">
                                                            <span>Reject (Review) Only</span>
                                                            <i class="fas fa-check" <?= $filter_reject_review ?>></i>
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                                            href="?sort=<?= $sortOrder ?>&status_id=6">
                                                            <span>Reject (Approve) Only</span>
                                                            <i class="fas fa-check" <?= $filter_reject_approve ?>></i>
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-timeline" role="tabpanel"
                                            aria-labelledby="pills-timeline-tab">
                                            <section class="content mt-3">
                                                <div class="container-fluid">
                                                    <!-- Timelime example  -->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <!-- The time line -->
                                                            <?php if (!$filteredTimelineModels): ?>
                                                                <h1 style="text-align: center;">No data available</h1>
                                                            <?php else: ?>
                                                                <div class="timeline">
                                                                    <?php
                                                                    $currentDate = null;
                                                                    $type_ = null;
                                                                    $check = false;
                                                                    $check_id_user = false;
                                                                    $count = 0;
                                                                    foreach ($filteredTimelineModels as $timeline):
                                                                        $count++; //
                                                                        $date = $timeline['date_timeline'];
                                                                        $date_type = $timeline['type_timeline'];
                                                                        $id_user = $timeline['id_user'];
                                                                        if ($date_type !== $type_ || $id_user !== $check_id_user) {

                                                                            if ($check === true) {
                                                                                echo '</div>';
                                                                                echo '</div>';
                                                                                echo '</div>';
                                                                                $check = false;
                                                                            }
                                                                        }
                                                                        if ($date !== $currentDate):
                                                                            // สร้างแท็บใหม่เมื่อวันที่เปลี่ยน
                                                                            if ($check === true) {
                                                                                echo '</div>';
                                                                                echo '</div>';
                                                                                echo '</div>';
                                                                                $check = false;
                                                                            }

                                                                            echo '<div class="time-label">';
                                                                            echo '<span style="background-color: #ADB5BD;  color: #FFFFFF ;">' . $date . '</span>';
                                                                            echo '</div>';

                                                                            $currentDate = $date;
                                                                            $type_ = null;

                                                                        endif;
                                                                        ?>
                                                                        <!-- timeline item -->
                                                                        <?php
                                                                        if ($date_type !== $type_ || $id_user !== $check_id_user) {
                                                                            echo '<div>';

                                                                            if ($timeline['type_timeline'] == '1') {
                                                                                //modifiend
                                                                                echo "<i class='fas fa-pen bg-primary'></i>";
                                                                            } else if ($timeline['status_id'] == 5 || $timeline['status_id'] == 6 && $timeline['type_timeline'] == '2') {
                                                                                //note modifiend
                                                                                echo "<i class='fas fa-sync-alt fa-rotate-90 bg-danger'></i>";
                                                                            } else if ($timeline['type_timeline'] == '2') {
                                                                                //change status
                                                                                echo "<i class='fas fa-sync-alt fa-rotate-90 bg-success'></i>";
                                                                            } else if ($timeline['type_timeline'] == '3') {
                                                                                //note modifiend
                                                                                echo "<i class='fas fa-sticky-note fa-rotate-270 bg-warning'></i>";
                                                                            }

                                                                            echo '<div class="timeline-item" 
                                                                                style="background-color: #F8F9FA;">';
                                                                            echo '<h3 class="timeline-header">
                                                                                <button type="button" class="btn btn-tool" data-toggle="collapse" href="#collapseExample' . $count . '" onclick="changeIcon(this)">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </h3>';

                                                                            echo '<div class="collapse show" id="collapseExample' . $count . '" >';
                                                                        }
                                                                        ?>

                                                                        <div class="timeline-body" style="padding: 10px;">
                                                                            <?php
                                                                            $text_timeline = $timeline['text_timeline']; // ตัวอย่างข้อมูลที่มีใน $timeline['text_timeline']
                                                                    
                                                                            // แยกคำจากเว้นวรรค
                                                                            $words = explode(' ', $text_timeline);

                                                                            // สีคำแรก
                                                                            $first_word = "<span style='color: #007BFF; font-weight: bold;'>{$words[0]} {$words[1]}</span>";

                                                                            // รวมคำทั้งหมดใหม่
                                                                            $colored_text_timeline = $first_word . ' ' . implode(' ', array_slice($words, 2));
                                                                            if ($date_type !== $type_ || $id_user !== $check_id_user) {
                                                                                echo $colored_text_timeline . ' ';
                                                                                $check = true;
                                                                                $type_ = $date_type;
                                                                                $check_id_user = $id_user;
                                                                            } else {
                                                                                $first_word_length = strlen(strip_tags($first_word)); // คำนวณความยาวของ $first_word โดยไม่รวม HTML tags
                                                                    
                                                                                // สร้างสตริงที่มีเว้นวรรคตามความยาวของ $first_word แต่ไม่รวม $first_word ไปด้วย
                                                                                $spacing = str_repeat('&nbsp;&nbsp;', $first_word_length);

                                                                                // นำเว้นวรรคและคำอื่นๆ มาต่อกันและแสดงผลลัพธ์
                                                                                echo $spacing . ' ' . implode(' ', array_slice($words, 2)) . ' ';
                                                                            }
                                                                            if ($timeline['status_id'] == 0) {
                                                                                echo "<span class='badge bg-secondary'>Draft</span>";
                                                                            } else if ($timeline['status_id'] == 1) {
                                                                                echo "<span class='badge bg-info'>Pending Review</span>";
                                                                            } else if ($timeline['status_id'] == 2) {
                                                                                echo "<span class='badge bg-warning'>Review</span>";
                                                                            } else if ($timeline['status_id'] == 3) {
                                                                                echo "<span class='badge bg-info'>Pending Approved</span>";
                                                                            } else if ($timeline['status_id'] == 4) {
                                                                                echo "<span class='badge bg-success'>Approved</span>";
                                                                            } else if ($timeline['status_id'] == 5) {
                                                                                echo "<span class='badge bg-danger'>Reject_Review</span>";
                                                                            } else if ($timeline['status_id'] == 6) {
                                                                                echo "<span class='badge bg-danger'>Reject_Approved</span>";
                                                                            }

                                                                            if (($timeline['status_id'] == 5 || $timeline['status_id'] == 6) && $timeline['id_note'] !== null && $timeline['type_timeline'] !== '3') {
                                                                                echo ' and have note';
                                                                            }
                                                                            ?>
                                                                            <div style="float: right;">
                                                                                <i class="fas fa-clock"></i>
                                                                                <?= $timeline['time_timeline'] ?>
                                                                            </div>

                                                                        </div>
                                                                        <div class="clearfix"></div>
                                                                        <?php if ($timeline['id_note']): ?>
                                                                            <?php if ($timeline['type_timeline'] == '3'): ?>
                                                                                <div class="timeline-footer" style="padding: 10px;">
                                                                                    <a class="btn btn-warning btn-sm"
                                                                                        onclick="NoteDetail(<?= $timeline['id_note'] ?>)">View
                                                                                        Note</a>
                                                                                </div>
                                                                            <?php else: ?>
                                                                                <div class="timeline-footer" style="padding: 10px;">
                                                                                    <a class="btn btn-danger btn-sm"
                                                                                        onclick="NoteDetail(<?= $timeline['id_note'] ?>)">View
                                                                                        Note</a>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>

                                                                        <!-- END timeline item -->
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <i class="fas fa-clock bg-gray"></i>
                                                        </div>
                                                    </div> <!-- ปิดแท็บสุดท้าย -->
                                                <?php endif; ?>
                                        </div>

        </section>
    </div>
    <!-- /.timeline -->
    <!-- note -->
    <div class="tab-pane fade" id="pills-note" role="tabpanel" aria-labelledby="pills-note-tab">
        <section class="content mt-3">
            <div class="container-fluid">
                <!-- Note example  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- TheNote -->
                        <?php if (!$NoteModels): ?>
                            <h1 style="text-align: center;">No data available</h1>
                        <?php else: ?>
                            <div class="timeline">
                                <?php foreach ($NoteModels as $note): ?>
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            <div class="user-block">
                                                <?php if (session()->get('profile_image') == null): ?>
                                                    <img class="img-circle" src="<?= base_url('dist/img/avatar6.png'); ?>"
                                                        alt="User Image">
                                                <?php else: ?>
                                                    <img class="img-circle"
                                                        src="data:image/png;base64, <?php echo session()->get('profile_image'); ?>"
                                                        alt="User Image">
                                                <?php endif; ?>
                                                <?php foreach ($UserModels as $user):
                                                    if ($user['id_user'] == $note['id_user']) {
                                                        $u_f = $user['name_user'];
                                                        $u_l = $user['lastname_user'];
                                                    }
                                                endforeach; ?>
                                                <span class="username"><a href="#">
                                                        <?= $u_f ?>
                                                        <?= $u_l ?>
                                                    </a></span>
                                                <?php
                                                $date_vermodifiend = $note['date_modifiend'];
                                                //$date_vermodifiend = strtotime($date_vermodifiend);
                                                //$date_vermodifiend = date('d/m/Y',$date_vermodifiend);
                                                ?>
                                                <span class="description">Version Modified date :
                                                    <?= $date_vermodifiend ?>
                                                    <?php
                                                    if ($note['status_id'] == 0) {
                                                        echo "<span class='badge bg-secondary'>Draft</span>";
                                                    } else if ($note['status_id'] == 1) {
                                                        echo "<span class='badge bg-info'>Pending Review</span>";
                                                    } else if ($note['status_id'] == 2) {
                                                        echo "<span class='badge bg-warning'>Review</span>";
                                                    } else if ($note['status_id'] == 3) {
                                                        echo "<span class='badge bg-info'>Pending Approved</span>";
                                                    } else if ($note['status_id'] == 4) {
                                                        echo "<span class='badge bg-success'>Approved</span>";
                                                    } else if ($note['status_id'] == 5) {
                                                        echo "<span class='badge bg-danger'>Reject_Review</span>";
                                                    } else if ($note['status_id'] == 6) {
                                                        echo "<span class='badge bg-danger'>Reject_Approved</span>";
                                                    }
                                                    ?>
                                                </span>
                                                <?php
                                                $date_notecreate = $note['date_create'] . " " . $note['time_create'];
                                                $date_notecreate = strtotime($date_notecreate);
                                                $date_notecreate = date('d/m/Y h:i', $date_notecreate);
                                                ?>
                                                <span class="description"><small>
                                                        <?= $date_notecreate ?>
                                                    </small></span>
                                            </div>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button class="fas fa-ellipsis-h fa-rotate-90 button-table"
                                                    style="color: #adb5bd; border:none; background:none;" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    undefined=""></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        onclick="load_modal(10, 11, <?= $note['id_note'] ?>)"
                                                        data-toggle="modal" data-target="#modal-default">Edit</a>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmAlert(10, 12, 'ต้องการลบข้อมูลที่ 1 หรือไม่', 'question', <?= $note['id_note'] ?>)">Delete</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" onclick="load_modal(10, 10)" data-toggle="modal"
                                                        data-target="#modal-default">Create</a>
                                                </div>
                                            </div>

                                        </div>

                                        <div id="note-<?= $note['id_note'] ?>" class="card-body">
                                            <p>
                                                <?= $note['text'] ?>
                                            </p>
                                        </div>
                                        <div class="card-footer card-comments">
                                            <?php if ($NoteComment): ?>
                                                <?php foreach ($NoteComment as $notecomment): ?>
                                                    <?php if ($notecomment['id_note'] == $note['id_note']): ?>
                                                        <div class="card-comment">
                                                            <?php if (session()->get('profile_image') == null): ?>
                                                                <img class="img-circle" src="<?= base_url('dist/img/avatar6.png'); ?>"
                                                                    alt="User Image">
                                                            <?php else: ?>
                                                                <img class="img-circle"
                                                                    src="data:image/png;base64, <?php echo session()->get('profile_image'); ?>"
                                                                    alt="User Image">
                                                            <?php endif; ?>
                                                            <div class="comment-text">
                                                                <span class="username">
                                                                    <?php
                                                                    foreach ($UserModels as $user):
                                                                        if ($user['id_user'] == $notecomment['id_user']) {
                                                                            $uc_f = $user['name_user'];
                                                                            $uc_l = $user['lastname_user'];
                                                                        }
                                                                    endforeach;
                                                                    echo $uc_f . " " . $uc_l;

                                                                    $date_cnotecreate = $notecomment['date_activites'] . " " . $notecomment['time_activites'];
                                                                    $date_cnotecreate = strtotime($date_cnotecreate);
                                                                    $date_cnotecreate = date('d/m/Y h:i', $date_cnotecreate);
                                                                    ?>
                                                                    <span class="text-muted float-right">
                                                                        <?= $date_cnotecreate ?>
                                                                        <button class="fas fa-ellipsis-h fa-rotate-90 button-table"
                                                                            style="color: #adb5bd; border:none; background:none;"
                                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false" undefined=""></button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                            <a class="dropdown-item" href="#"
                                                                                onclick="confirmAlert(10, 13, 'ต้องการลบข้อมูลที่ 1 หรือไม่', 'question', <?= $notecomment['id_note_comment'] ?>)">Delete</a>
                                                                        </div>
                                                                    </span>
                                                                </span>
                                                                <?= $notecomment['text'] ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>


                                        <div class="card-footer">
                                            <form
                                                action="<?= base_url('/context/comment_note/' . $note['id_note'] . '/' . $note['id_version'] . '/' . $type . '/' . $num_ver . '') ?>"
                                                method="post">
                                                <?php if (session()->get('profile_image') == null): ?>
                                                    <img class="img-fluid img-circle img-sm"
                                                        src="<?= base_url('dist/img/avatar6.png'); ?>" alt="Alt Text">
                                                <?php else: ?>
                                                    <img class="img-fluid img-circle img-sm"
                                                        src="data:image/png;base64, <?php echo session()->get('profile_image'); ?>"
                                                        alt="Alt Text">
                                                <?php endif; ?>
                                                <div class="img-push">
                                                    <input type="text" id="text_c" name="text_c"
                                                        class="form-control form-control-sm"
                                                        placeholder="Press enter to post comment">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div> <!-- ปิดแท็บสุดท้าย -->
                <?php endif; ?>
            </div>
    </div>
    </div>
    </section>
    </div>
    <!-- /note -->
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    </div>

    <div class="modal fade" id="modal-default">
        <div id="modal1">
            <?= $this->include("Modal/Requirement_Modal"); ?>
        </div>
        <div id="modal_note">
            <?= $this->include("Modal/CRUD_Note"); ?>
        </div>
    </div>
    <!-- ChartJS -->
    <script src="<?= base_url('plugins/chart.js/Chart.min.js'); ?>"></script>
    <script>
        function NoteDetail(idnote = null) {
            $('#pills-note-tab').tab('show');
            $('html, content').animate({
                scrollTop: $("#note-" + idnote).offset().top
            }, 1000);
        }

        function load_modal(params, check, data) {

            modal1 = document.getElementById("modal1");
            modal_note = document.getElementById("modal_note");

            $(".modal-header #title_modal").text("Note");

            if (params == '1') {
                //--show modal requirment--//
                modal1.style.display = "block";
                modal_note.style.display = "none";
            }
            if (params == '10') {
                //--show modal note--//
                modal1.style.display = "none";
                modal_note.style.display = "block";

                var element = <?php echo json_encode($data); ?>;

                $(".modal-body #modified").val(element.modified_date);
                $(".modal-body #check").val(check);
                $(".modal-body #params").val(params);

                if (check == '11') {
                    $.ajax({
                        url: "<?php echo site_url('/context/note_edit/'); ?>" + data,
                        method: 'POST',
                        dataType: 'json',
                        success: function (data) {
                            $(".modal-body #text").val(data.text);
                            $(".modal-body #id_").val(data.id_note);
                        }
                    });
                }

            }
        }

        function confirmAlert(activite, check, title_, icon_alert, id_) {
            var status_id = <?php echo json_encode($data['status']); ?>;

            if (activite == '10') {
                if (check == '12') {
                    var url_link = 'note_delete/' + id_;
                } else if (check == '13') {
                    var url_link = 'notecomment_delete/' + id_;
                } else {
                    // Handle other cases if needed
                }
            }

            Swal.fire({
                title: title_,
                icon: icon_alert,
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                confirmButtonText: "Submit",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("context/") ?>' + url_link,
                        beforeSend: function () {
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
                            loadingIndicator;
                        },
                    }).done(function (response) {
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
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        }

    </script>

    <script>
        function sortItems(order) {
            window.location.href = `?sort=${order}`;
        }
    </script>
    <script>
        function changeIcon(button) {
            var icon = button.querySelector('i');
            if (icon.classList.contains('fa-minus')) {
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            } else {
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            }
        }
    </script>
    <script>
        var sortStatus = <?php echo json_encode($sortStatus); ?>;
    </script>