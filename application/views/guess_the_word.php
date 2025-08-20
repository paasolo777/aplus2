<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('questions_for_guess_the_word'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('create_and_manage_guess_the_word'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('create_questions'); ?></h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-danger text-small">
                                            <ul>
                                                <li> <strong><?= lang('note'); ?> : -</strong> <?= lang('guess_the_word_officially_supported_in_english_language_only'); ?></li>
                                            </ul>
                                        </div>
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <?php
                                            $sess_language_id = '0';
                                            $sess_category = '0';
                                            $sess_subcategory = '0';
                                            if ($this->session->userdata()) {
                                                $type = $this->uri->segment(1);
                                                $sess_data = $this->session->userdata("$type");
                                                if (!empty($sess_data)) {
                                                    $sess_language_id = $sess_data['language_id'];
                                                    $sess_category = $sess_data['category'];
                                                    $sess_subcategory = $sess_data['subcategory'];
                                                }
                                            }
                                            ?>
                                            <div class="row">
                                                <?php if (is_language_mode_enabled()) { ?>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="control-label"><?= lang('language'); ?> <small class="text-danger">*</small></label>
                                                        <select name="language_id" id="language_id" class="form-control" required>
                                                            <option value=""><?= lang('select_language'); ?></option>
                                                            <?php foreach ($language as $lang) { ?>
                                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                                        <select id="category" name="category" class="form-control" required>
                                                            <option value=""><?= lang('select_main_category'); ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="control-label"><?= lang('sub_category'); ?></label>
                                                        <select id="subcategory" name="subcategory" class="form-control">
                                                            <option value=""><?= lang('select_sub_category'); ?></option>
                                                        </select>
                                                    </div>

                                                <?php } else { ?>
                                                    <div class="form-group col-md-6 col-sm-12">
                                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                                        <select id="category" name="category" class="form-control" required>
                                                            <option value=""><?= lang('select_main_category'); ?></option>
                                                            <?php foreach ($category as $cat) { ?>
                                                                <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-12">
                                                        <label class="control-label"><?= lang('sub_category'); ?></label>
                                                        <select id="subcategory" name="subcategory" class="form-control">
                                                            <option value=""><?= lang('select_sub_category'); ?></option>
                                                        </select>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="control-label"><?= lang('question'); ?> <small class="text-danger">*</small></label>
                                                    <textarea id="question" name="question" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('image_for_question'); ?> <small><?= lang('if_any'); ?></small></label>
                                                    <input id="file" name="file" type="file" accept="image/png,image/jpg,image/jpeg" class="form-control">
                                                    <small class="text-danger"><?= lang('image_type_supported'); ?></small>
                                                    <p style="display: none" id="img_error_msg" class="alert alert-danger"></p>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('answer'); ?> <small class="text-danger">*</small></label>
                                                    <input class="form-control" type="text" name="answer" required placeholder="<?= lang('enter_answer'); ?>">
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
                                        <h4><?= lang('questions_for_quiz'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php if (is_language_mode_enabled()) { ?>
                                                <div class="form-group col-md-3">
                                                    <select id="filter_language" class="form-control" required>
                                                        <option value=""><?= lang('select_language'); ?></option>
                                                        <?php foreach ($language as $lang) { ?>
                                                            <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <select id="filter_category" class="form-control" required>
                                                        <option value=""><?= lang('select_main_category'); ?></option>

                                                    </select>
                                                </div>
                                            <?php } else { ?>
                                                <div class="form-group col-md-3">
                                                    <select id="filter_category" class="form-control" required>
                                                        <option value=""><?= lang('select_main_category'); ?></option>
                                                        <?php foreach ($category as $cat) { ?>
                                                            <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                            <div class='form-group col-md-3'>
                                                <select id='filter_subcategory' class='form-control' required>
                                                    <option value=''><?= lang('select_sub_category'); ?></option>
                                                </select>
                                            </div>
                                            <div class='form-group col-md-3'>
                                                <button class='<?= BUTTON_CLASS ?> btn-block form-control' id='filter_btn'><?= lang('filter_data'); ?></button>
                                            </div>

                                        </div>
                                        <div id="toolbar">
                                            <?php if (has_permissions('delete', 'guess_the_word')) { ?>
                                                <button class="btn btn-danger" id="delete_multiple_questions" title="<?= lang('delete_selected_questions'); ?>"><em class='fa fa-trash'></em></button>
                                            <?php } ?>
                                        </div>
                                        <table aria-describedby="mydesc" class='table-striped' id='question_list' data-toggle="table" data-url="<?= base_url() . 'Table/guess_the_word' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "question-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="category" data-sortable="true" data-visible='false'><?= lang('main_category'); ?></th>
                                                    <th scope="col" data-field="subcategory" data-sortable="true" data-visible='false'><?= lang('sub_category'); ?></th>
                                                    <?php if (is_language_mode_enabled()) { ?>
                                                        <th scope="col" data-field="language_id" data-sortable="true" data-visible='false'><?= lang('language_id'); ?></th>
                                                        <th scope="col" data-field="language" data-sortable="true" data-visible='true'><?= lang('language'); ?></th>
                                                    <?php } ?>
                                                    <th scope="col" data-field="image" data-sortable="false"><?= lang('image'); ?></th>
                                                    <th scope="col" data-field="question" data-sortable="true"><?= lang('question'); ?></th>
                                                    <th scope="col" data-field="answer" data-sortable="true"><?= lang('answer'); ?></th>
                                                    <th scope="col" data-field="operate" data-sortable="false" data-events="actionEvents"><?= lang('operate'); ?></th>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('edit_question'); ?></h5>
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
                                        <select name="language_id" id="update_language_id" class="form-control" required>
                                            <option value=""><?= lang('select_language'); ?></option>
                                            <?php foreach ($language as $lang) { ?>
                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                        <select id="edit_category" name="category" class="form-control" required>
                                            <option value=""><?= lang('select_main_category'); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="control-label"><?= lang('sub_category'); ?></label>
                                        <select id="edit_subcategory" name="subcategory" class="form-control">
                                            <option value=""><?= lang('select_sub_category'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                        <select id="edit_category" name="category" class="form-control" required>
                                            <option value=""><?= lang('select_main_category'); ?></option>
                                            <?php foreach ($category as $cat) { ?>
                                                <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="control-label"><?= lang('sub_category'); ?></label>
                                        <select id="edit_subcategory" name="subcategory" class="form-control">
                                            <option value=""><?= lang('select_sub_category'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>


                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('question'); ?> <small class="text-danger">*</small></label>
                                    <textarea id="edit_question" name="question" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="control-label"><?= lang('image'); ?> <small><?= lang('leave_it_blank'); ?></small></label>
                                    <input id="update_file" name="update_file" type="file" accept="image/png,image/jpg,image/jpeg" class="form-control">
                                    <small class="text-danger"><?= lang('image_type_supported'); ?></small>
                                    <p style="display: none" id="up_img_error_msg" class="alert alert-danger"></p>
                                    <div class="m-2" id="imageView" style="display: none">
                                        <img id="setImage" src="" alt="logo" width="40" height="40">
                                        <button type="button" class="btn btn-sm btn-danger" data-id="" data-image='' id="removeImage"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="control-label"><?= lang('answer'); ?> <small class="text-danger">*</small></label>
                                    <input id="edit_answer" name="answer" class="form-control" type="text" required placeholder="<?= lang('enter_answer'); ?>">
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
        $('#removeImage').on('click', function(e) {
            table = "tbl_guess_the_word";
            id = $(this).data("id");
            image = $(this).data("image");
            removeImage(id, image, table)
            $('#question_list').bootstrapTable('refresh');
        });
        window.actionEvents = {
            'click .edit-data': function(e, value, row, index) {
                $('#edit_id').val(row.id);
                $('#image_url').val(row.image_url);
                $('#imageView').hide('fast');
                if (row.image_url) {
                    $('#imageView').show('fast');
                    $('#setImage').attr('src', row.image_url);
                    $('#removeImage').attr('data-image', row.image_url);
                    $('#removeImage').attr('data-id', row.id);
                }
                $('#edit_question').val(row.question);
                //                    $('#update_language_id').val(row.language_id);
                <?php if (is_language_mode_enabled()) { ?>
                    if (row.language_id == 0) {
                        $('#update_language_id').val(row.language_id);
                        $('#edit_category').html(category_options);
                        $('#edit_category').val(row.category).trigger("change", [row.category, row.subcategory]);
                    } else {
                        $('#update_language_id').val(row.language_id).trigger("change", [row.language_id, row.category, row.subcategory]);
                    }
                <?php } else { ?>
                    $('#edit_category').val(row.category).trigger("change", [row.category, row.subcategory]);
                <?php } ?>
                $('#edit_subcategory').val(row.subcategory);
                $('#edit_answer').val(row.answer);

            }
        };
    </script>

    <script type="text/javascript">
        $('#filter_btn').on('click', function(e) {
            $('#question_list').bootstrapTable('refresh');
        });
        $('#delete_multiple_questions').on('click', function(e) {
            var base_url = "<?php echo base_url(); ?>";
            sec = 'tbl_guess_the_word';
            is_image = 1;
            table = $('#question_list');
            delete_button = $('#delete_multiple_questions');
            selected = table.bootstrapTable('getSelections');
            ids = "";
            $.each(selected, function(i, e) {
                ids += e.id + ",";
            });
            ids = ids.slice(0, -1);
            if (ids == "") {
                alert("<?= lang('please_select_questions_to_delete'); ?>");
            } else {
                if (confirm("<?= lang('sure_to_delete_all_questions'); ?>")) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'delete_multiple',
                        data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                        beforeSend: function() {
                            delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                        },
                        success: function(result) {
                            if (result == 1) {
                                alert("<?= lang('questions_deleted_successfully'); ?>");
                            } else {
                                alert("<?= lang('not_delete_question_try_again'); ?>");
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
        $(document).on('click', '.delete-data', function() {
            if (confirm("<?= lang('sure_to_delete_questions'); ?>")) {
                var base_url = "<?php echo base_url(); ?>";
                id = $(this).data("id");
                image = $(this).data("image");
                $.ajax({
                    url: base_url + 'delete_guess_word',
                    type: "POST",
                    data: 'id=' + id + '&image_url=' + image,
                    success: function(result) {
                        if (result) {
                            $('#question_list').bootstrapTable('refresh');
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
                "category": $('#filter_category').val(),
                "subcategory": $('#filter_subcategory').val(),
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }
    </script>

    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
        var type = 'guess-the-word-subcategory';
        var sess_language_id = '<?= $sess_language_id ?>';
        var sess_category = '<?= $sess_category ?>';
        var sess_subcategory = '<?= $sess_subcategory ?>';
        $(document).ready(function() {
            if (sess_language_id != '0' || sess_category != '0') {
                <?php if (is_language_mode_enabled()) { ?>
                    $('#language_id').val(sess_language_id).trigger("change", [sess_language_id, sess_category, sess_subcategory]);
                <?php } else { ?>
                    $('#category').val(sess_category).trigger("change", [sess_category, sess_subcategory]);
                <?php } ?>
            }
        });
        $('#language_id').on('change', function(e, row_language_id, row_category, row_subcategory) {
            var language_id = $('#language_id').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_categories_of_language',
                data: 'language_id=' + language_id + '&type=' + type,
                beforeSend: function() {
                    $('#category').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#category').html(result).trigger("change");
                    if (language_id == row_language_id && row_category != 0)
                        $('#category').val(row_category).trigger("change", [row_category, row_subcategory]);
                }
            });
        });

        $('#update_language_id').on('change', function(e, row_language_id, row_category, row_subcategory) {
            var language_id = $('#update_language_id').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_categories_of_language',
                data: 'language_id=' + language_id + '&type=' + type,
                beforeSend: function() {
                    $('#edit_category').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#edit_category').html(result);
                    if (language_id == row_language_id && row_category != 0)
                        $('#edit_category').val(row_category).trigger("change", [row_category, row_subcategory]);
                }
            });
        });

        $('#filter_language').on('change', function(e) {
            var language_id = $('#filter_language').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_categories_of_language',
                data: 'language_id=' + language_id + '&type=' + type,
                beforeSend: function() {
                    $('#filter_category').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#filter_category').html(result);
                }
            });
        });

        category_options = '';
        <?php
        $category_options = "<option value=''>" . lang('select_main_category') . "</option>";
        foreach ($category as $cat) {
            $category_options .= "<option value=" . $cat->id . ">" . $cat->category_name . "</option>";
        }
        ?>
        category_options = "<?= $category_options; ?>";

        $('#category').on('change', function(e, row_category, row_subcategroy) {
            var category_id = $('#category').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_subcategories_of_category',
                data: 'category_id=' + category_id,
                beforeSend: function() {
                    $('#subcategory').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#subcategory').html(result);
                    if (category_id == row_category && row_subcategroy != 0)
                        $('#subcategory').val(row_subcategroy);
                }
            });
        });

        $('#edit_category').on('change', function(e, row_category, row_subcategroy) {
            var category_id = $('#edit_category').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_subcategories_of_category',
                data: 'category_id=' + category_id,
                beforeSend: function() {
                    $('#edit_subcategory').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#edit_subcategory').html(result);
                    if (category_id == row_category && row_subcategroy != 0)
                        $('#edit_subcategory').val(row_subcategroy);
                }
            });
        });

        $('#filter_category').on('change', function(e) {
            var category_id = $('#filter_category').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_subcategories_of_category',
                data: 'category_id=' + category_id,
                beforeSend: function() {
                    $('#filter_subcategory').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#filter_subcategory').html(result);
                }
            });
        });
    </script>

    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;

        $("#file").change(function(e) {
            var file, img;

            if ((file = this.files[0])) {
                img = new Image();

                //checks only image which are not png or jpg
                if (file.type !== 'image/png' && file.type !== 'image/jpeg' && file.type !== 'image/jpg') {
                    $('#file').val('');
                    $('#img_error_msg').html('<?= lang(IMAGE_ALLOW_PNG_JPG_MSG); ?>');
                    $('#img_error_msg').show().delay(3000).fadeOut();
                }

                //gets error when uploading any file rather than image
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

                //checks only image which are not png or jpg
                if (file.type !== 'image/png' && file.type !== 'image/jpeg' && file.type !== 'image/jpg') {
                    $('#update_file').val('');
                    $('#up_img_error_msg').html('<?= lang(IMAGE_ALLOW_PNG_JPG_MSG); ?>');
                    $('#up_img_error_msg').show().delay(3000).fadeOut();
                }

                //gets error when uploading any file rather than image
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