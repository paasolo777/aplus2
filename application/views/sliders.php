<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('create_and_manage_slider'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

    <?php base_url() . include 'include.php'; ?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <?php base_url() . include 'header.php'; ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= lang('create_and_manage_slider_for_web'); ?> <small class="text-small"><?= lang('note_that_this_will_directly_reflect_the_changes_in_web'); ?></small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('create_slider'); ?></h4>
                                    </div>

                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <input type="hidden" name="type" value="<?= $this->uri->segment(1) ?>" required />
                                            <?php if (is_language_mode_enabled()) { ?>
                                                <div class="row">
                                                    <div class="form-group col-md-12 col-sm-12">
                                                        <label class="control-label"><?= lang('language'); ?> <small class="text-danger">*</small></label>
                                                        <select name="language_id" class="form-control" required>
                                                            <option value=""><?= lang('select_language'); ?></option>
                                                            <?php foreach ($language as $lang) { ?>
                                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('image'); ?> <small class="text-danger">*</small></label>
                                                    <input id="file" name="file" type="file" accept="image/*" class="form-control" required>
                                                    <small class="text-danger"><?= lang('svg_image_type_supported'); ?></small>
                                                    <p style="display: none" id="img_error_msg" class="alert alert-danger"></p>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('title'); ?> <small class="text-danger">*</small></label>
                                                    <input name="title" type="text" class="form-control" placeholder="<?= lang('enter_title'); ?>" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="control-label"><?= lang('description'); ?> <small class="text-danger">*</small></label>
                                                    <textarea name="description" class="form-control" placeholder="<?= lang('enter_description'); ?>" required></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <input type="submit" name="btnadd" value="<?= lang('submit'); ?>" class="<?= BUTTON_CLASS ?>" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('sliders'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                    </div>

                                    <div class="card-body">
                                        <?php if (is_language_mode_enabled()) { ?>
                                            <div class="row">
                                                <div class='form-group col-md-4'>
                                                    <select id='filter_language' class='form-control' required>
                                                        <option value=""><?= lang('select_language'); ?></option>
                                                        <?php foreach ($language as $lang) { ?>
                                                            <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class='form-group col-md-4'>
                                                    <button class='<?= BUTTON_CLASS ?> btn-block form-control' id='filter_btn'><?= lang('filter_data'); ?></button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div id="toolbar">
                                            <?php if (has_permissions('delete', 'sliders')) { ?>
                                                <button class="btn btn-danger" id="delete_multiple_sliders" title="<?= lang('delete_selected_slider'); ?>"><em class='fa fa-trash'></em></button>
                                            <?php } ?>
                                        </div>
                                        <table aria-describedby="mydesc" class='table-striped' id='slider_list' data-toggle="table" data-url="<?= base_url() . 'Table/slider' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-fixed-columns="true" data-fixed-number="1" data-fixed-right-number="1" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "slider-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <?php if (is_language_mode_enabled()) { ?>
                                                        <th scope="col" data-field="language_id" data-sortable="true" data-visible="false"><?= lang('language_id'); ?></th>
                                                        <th scope="col" data-field="language" data-sortable="true"><?= lang('language'); ?></th>
                                                    <?php } ?>
                                                    <th scope="col" data-field="image" data-sortable="false"><?= lang('image'); ?></th>
                                                    <th scope="col" data-field="title" data-sortable="true"><?= lang('title'); ?></th>
                                                    <th scope="col" data-field="description" data-sortable="true"><?= lang('description'); ?></th>
                                                    <th scope="col" data-field="operate" data-sortable="false" data-events="actionEvents" data-force-hide="true"><?= lang('operate'); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editDataModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('edit_slider'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type='hidden' name="edit_id" id="edit_id" value="" />
                            <input type="hidden" name='image_url' id="image_url" value="" />
                            <?php if (is_language_mode_enabled()) { ?>
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="control-label"><?= lang('language'); ?> <small class="text-danger">*</small></label>
                                        <select id="language_id" name="language_id" class="form-control" required>
                                            <?php foreach ($language as $lang) { ?>
                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('image'); ?> <small><?= lang('leave_it_blank'); ?></small></label>
                                    <input id="update_file" name="update_file" type="file" accept="image/*" class="form-control">
                                    <small class="text-danger"><?= lang('svg_image_type_supported'); ?></small>
                                    <p style="display: none" id="up_img_error_msg" class="badge badge-danger"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('title'); ?> <small class="text-danger">*</small></label>
                                    <input id="title" name="title" type="text" class="form-control" required placeholder="<?= lang('enter_title'); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('description'); ?> <small class="text-danger">*</small></label>
                                    <textarea id="description" name="description" class="form-control" required placeholder="<?= lang('enter_description'); ?>"></textarea>
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('close'); ?></button>
                                <input name="btnupdate" type="submit" value="<?= lang('save_changes'); ?>" class="<?= BUTTON_CLASS ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php base_url() . include 'footer.php'; ?>

    <script type="text/javascript">
        $('#filter_btn').on('click', function(e) {
            $('#slider_list').bootstrapTable('refresh');
        });
        $('#delete_multiple_sliders').on('click', function(e) {
            var base_url = "<?php echo base_url(); ?>";
            sec = 'tbl_slider';
            is_image = 1;
            table = $('#slider_list');
            delete_button = $('#delete_multiple_sliders');
            selected = table.bootstrapTable('getSelections');
            ids = "";
            $.each(selected, function(i, e) {
                ids += e.id + ",";
            });
            ids = ids.slice(0, -1);
            if (ids == "") {
                alert("<?= lang('please_select_slider_to_delete'); ?>");
            } else {
                if (confirm("<?= lang('sure_to_delete_all_slider'); ?>")) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'delete_multiple',
                        data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                        beforeSend: function() {
                            delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                        },
                        success: function(result) {
                            if (result == 1) {
                                alert("<?= lang('slider_deleted_successfully'); ?>");
                            } else {
                                alert("<?= lang('not_delete_slider_try_again'); ?>");
                            }
                            delete_button.html('<i class="fa fa-trash"></i>');
                            table.bootstrapTable('refresh');
                        }
                    });
                }
            }
        });
    </script>

    <script type="text/javascript">
        window.actionEvents = {
            'click .edit-data': function(e, value, row, index) {
                $('#edit_id').val(row.id);
                $('#image_url').val(row.image_url);
                $('#language_id').val(row.language_id);
                $('#title').val(row.title);
                $('#description').val(row.description);
            }
        };
    </script>

    <script type="text/javascript">
        $(document).on('click', '.delete-data', function() {
            if (confirm('<?= lang('sure_to_delete_slider'); ?>')) {
                var base_url = "<?php echo base_url(); ?>";
                id = $(this).data("id");
                image = $(this).data("image");
                $.ajax({
                    url: base_url + 'delete_sliders',
                    type: "POST",
                    data: 'id=' + id + '&image_url=' + image,
                    success: function(result) {
                        if (result) {
                            $('#slider_list').bootstrapTable('refresh');
                        } else {
                            var PERMISSION_ERROR_MSG = "<?= lang(PERMISSION_ERROR_MSG); ?>";
                            ErrorMsg(PERMISSION_ERROR_MSG);
                        }
                    }
                });
            }
        });
    </script>

    <script type="text/javascript">
        function queryParams(p) {
            return {
                "language": $('#filter_language').val(),
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }
    </script>

    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;

        $("#file").change(function(e) {
            var file, img;

            if ((file = this.files[0])) {
                img = new Image();
                img.onerror = function() {
                    $('#file').val('');
                    $('#img_error_msg').html('<?= lang(INVALID_IMAGE_TYPE); ?>');
                    $('#img_error_msg').show().delay(3000).fadeOut();
                };
                img.src = _URL.createObjectURL(file);
            }
        });

        $("#update_file").change(function(e) {
            var file, img;

            if ((file = this.files[0])) {
                img = new Image();
                img.onerror = function() {
                    $('#update_file').val('');
                    $('#up_img_error_msg').html('<?= lang(INVALID_IMAGE_TYPE); ?>');
                    $('#up_img_error_msg').show().delay(3000).fadeOut();
                };
                img.src = _URL.createObjectURL(file);
            }
        });
    </script>

</body>

</html>