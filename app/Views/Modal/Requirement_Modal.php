    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="overlay preloader">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            <div class="modal-header ">
                <h4 class="modal-title" id="title" name="title"><?php echo $data_requirement['topic_standart'] ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo $data_requirement['details'] ?>
            </div>
        </div>
    </div>
