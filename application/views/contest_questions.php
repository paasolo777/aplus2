<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('questions_for_contest'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('create_and_manage_questions_for_contest'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('create_questions'); ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <div class="row">
                                                <?php if (is_language_mode_enabled()) { ?>
                                                    <div class="form-group col-md-6 col-sm-12">
                                                        <label class="control-label"><?= lang('language'); ?> <small class="text-danger">*</small></label>
                                                        <select id="language_id" class="form-control" required>
                                                            <option value=""><?= lang('select_language'); ?></option>
                                                            <?php foreach ($language as $lang) { ?>
                                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-12">
                                                        <label class="control-label"><?= lang('contest'); ?> <small class="text-danger">*</small></label>
                                                        <select name="contest_id" id="contest-data" class="form-control" required disabled>
                                                            <option value=""><?= lang('select_contest'); ?></option>
                                                            <option value="" data-no-data-found="true" selected>No Data Found</option>
                                                            <?php foreach ($contest as $cont) { ?>
                                                                <option value="<?= $cont->id ?>" data-language-id="<?= $cont->language_id ?>"><?= $cont->name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-group col-md-12 col-sm-12">
                                                        <label class="control-label"><?= lang('contest'); ?> <small class="text-danger">*</small></label>
                                                        <select name="contest_id" class="form-control" id="contest-data" required>
                                                            <option value=""><?= lang('select_contest'); ?></option>
                                                            <?php foreach ($contest as $cont) { ?>
                                                                <option value="<?= $cont->id ?>" data-language_id="<?= $cont->language_id ?>"><?= $cont->name ?></option>
                                                            <?php } ?>
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
                                                    <label class="control-label"><?= lang('question_type'); ?> <small class="text-danger">*</small></label>
                                                    <div>
                                                        <div class="form-check-inline bg-light p-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="question_type" value="1" checked required><?= lang('options'); ?>
                                                            </label>

                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="question_type" value="2"><?= lang('true_false'); ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('image_for_question'); ?> <small><?= lang('if_any'); ?></small></label>
                                                    <input id="file" name="file" type="file" accept="image/*" class="form-control">
                                                    <small class="text-danger"><?= lang('image_type_supported'); ?></small>
                                                    <p style="display: none" id="img_error_msg" class="badge badge-danger"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="control-label"><?= lang('option_a'); ?> <small class="text-danger">*</small></label>
                                                    <input class="form-control" type="text" id="a" name="a" required>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="control-label"><?= lang('option_b'); ?> <small class="text-danger">*</small></label>
                                                    <input class="form-control" type="text" id="b" name="b" required>
                                                </div>
                                            </div>
                                            <div id="tf">
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label class="control-label"><?= lang('option_c'); ?> <small class="text-danger">*</small></label>
                                                        <input class="form-control" type="text" id="c" name="c" required>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6">
                                                        <label class="control-label"><?= lang('option_d'); ?> <small class="text-danger">*</small></label>
                                                        <input class="form-control" type="text" id="d" name="d" required>
                                                    </div>
                                                </div>
                                                <?php if (is_option_e_mode_enabled()) { ?>
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-sm-12">
                                                            <label class="control-label"><?= lang('option_e'); ?> <small class="text-danger">*</small></label>
                                                            <input class="form-control" type="text" id="e" name="e" required>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="control-label"><?= lang('answer'); ?> <small class="text-danger">*</small></label>
                                                    <select name='answer' id='answer' class='form-control' required>
                                                        <option value=''><?= lang('select_right_answer'); ?></option>
                                                        <option value='a'><?= lang('a'); ?></option>
                                                        <option value='b'><?= lang('b'); ?></option>
                                                        <option class='ntf' value='c'><?= lang('c'); ?></option>
                                                        <option class='ntf' value='d'><?= lang('d'); ?></option>
                                                        <?php if (is_option_e_mode_enabled()) { ?>
                                                            <option class='ntf' value='e'><?= lang('e'); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="control-label"><?= lang('note'); ?></label>
                                                    <textarea name='note' class='form-control'></textarea>
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
                                        <h4><?= lang('questions_for_contest'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <select name="filter_contest" id="filter_contest" class="form-control" required>
                                                    <option value=""><?= lang('select_contest'); ?></option>
                                                    <?php foreach ($contest as $cont) { ?>
                                                        <option value="<?= $cont->id ?>"><?= $cont->name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class='form-group col-md-3'>
                                                <button class='<?= BUTTON_CLASS ?> btn-block form-control' id='filter_btn'><?= lang('filter_data'); ?></button>
                                            </div>
                                        </div>
                                        <div id="toolbar">
                                            <?php if (has_permissions('delete', 'manage_contest_question')) { ?>
                                                <button class="btn btn-danger" id="delete_multiple_questions" title="<?= lang('delete_selected_question'); ?>"><em class='fa fa-trash'></em></button>
                                            <?php } ?>
                                        </div>
                                        <table aria-describedby="mydesc" class='table-striped' id='question_list' data-toggle="table" data-url="<?= base_url() . 'Table/contest_question' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "question-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="contest_id" data-sortable="true" data-visible='false'><?= lang('contest_id'); ?></th>
                                                    <th scope="col" data-field="name" data-sortable="true" data-visible='true'><?= lang('contest_name'); ?></th>
                                                    <th scope="col" data-field="image" data-sortable="false"><?= lang('image'); ?></th>
                                                    <th scope="col" data-field="question" data-sortable="true"><?= lang('question'); ?></th>
                                                    <th scope="col" data-field="question_type" data-sortable="true" data-visible='false'><?= lang('question_type'); ?></th>
                                                    <th scope="col" data-field="optiona" data-sortable="true"><?= lang('option_a'); ?> </th>
                                                    <th scope="col" data-field="optionb" data-sortable="true"><?= lang('option_b'); ?></th>
                                                    <th scope="col" data-field="optionc" data-sortable="true"><?= lang('option_c'); ?></th>
                                                    <th scope="col" data-field="optiond" data-sortable="true"><?= lang('option_d'); ?></th>
                                                    <?php if (is_option_e_mode_enabled()) { ?>
                                                        <th scope="col" data-field="optione" data-sortable="true"><?= lang('option_e'); ?></th>
                                                    <?php } ?>
                                                    <th scope="col" data-field="answer" data-sortable="true" data-visible='false'><?= lang('answer'); ?></th>
                                                    <th scope="col" data-field="note" data-sortable="true" data-visible='false'><?= lang('note'); ?></th>
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
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('contest'); ?> <small class="text-danger">*</small></label>
                                    <select name="contest_id" id="contest_id" class="form-control" required>
                                        <option value=""><?= lang('select_contest'); ?></option>
                                        <?php foreach ($contest as $cont) { ?>
                                            <option value="<?= $cont->id ?>"><?= $cont->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('question'); ?> <small class="text-danger">*</small></label>
                                    <textarea id="edit_question" name="question" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="control-label"><?= lang('question_type'); ?> <small class="text-danger">*</small></label>
                                    <div>
                                        <div class="form-check-inline bg-light p-2">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="edit_question_type" value="1" checked required><?= lang('options'); ?>
                                            </label>

                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="edit_question_type" value="2"><?= lang('true_false'); ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="control-label"><?= lang('image'); ?> <small><?= lang('leave_it_blank'); ?></small></label>
                                    <input id="update_file" name="update_file" type="file" accept="image/*" class="form-control">
                                    <small class="text-danger"><?= lang('image_type_supported'); ?></small>
                                    <p style="display: none" id="up_img_error_msg" class="badge badge-danger"></p>
                                    <div class="m-2" id="imageView" style="display: none">
                                        <img id="setImage" src="" alt="logo" width="40" height="40">
                                        <button type="button" class="btn btn-sm btn-danger" data-id="" data-image='' id="removeImage"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="control-label"><?= lang('option_a'); ?> <small class="text-danger">*</small></label>
                                    <input class="form-control" type="text" id="edit_a" name="a" required>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="control-label"><?= lang('option_b'); ?> <small class="text-danger">*</small></label>
                                    <input class="form-control" type="text" id="edit_b" name="b" required>
                                </div>
                            </div>
                            <div id="edit_tf">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label class="control-label"><?= lang('option_c'); ?> <small class="text-danger">*</small></label>
                                        <input class="form-control" type="text" id="edit_c" name="c" required>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6">
                                        <label class="control-label"><?= lang('option_d'); ?> <small class="text-danger">*</small></label>
                                        <input class="form-control" type="text" id="edit_d" name="d" required>
                                    </div>
                                </div>
                                <?php if (is_option_e_mode_enabled()) { ?>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="control-label"><?= lang('option_e'); ?> <small class="text-danger">*</small></label>
                                            <input class="form-control" type="text" id="edit_e" name="e" required>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('answer'); ?> <small class="text-danger">*</small></label>
                                    <select name='answer' id='edit_answer' class='form-control' required>
                                        <option value=''><?= lang('select_right_answer'); ?></option>
                                        <option value='a'><?= lang('a'); ?></option>
                                        <option value='b'><?= lang('b'); ?></option>
                                        <option class='edit_ntf' value='c'><?= lang('c'); ?></option>
                                        <option class='edit_ntf' value='d'><?= lang('d'); ?></option>
                                        <?php if (is_option_e_mode_enabled()) { ?>
                                            <option class='edit_ntf' value='e'><?= lang('e'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('note'); ?></label>
                                    <textarea name='note' id="edit_note" class='form-control'></textarea>
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
            table = "tbl_contest_question";
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
                $('#contest_id').val(row.contest_id);
                $('#edit_question').val(row.question);
                var question_type = row.question_type;
                if (question_type == "2") {
                    $("input[name=edit_question_type][value=2]").prop('checked', true);
                    $('#edit_tf').hide('fast');
                    $('#edit_a').val(row.optiona);
                    $('#edit_b').val(row.optionb);
                    $('.edit_ntf').hide('fast');
                    $('#edit_c').removeAttr('required');
                    $('#edit_d').removeAttr('required');
                    $('#edit_e').removeAttr('required');
                } else {
                    $("input[name=edit_question_type][value=1]").prop('checked', true);
                    $('#edit_a').val(row.optiona);
                    $('#edit_b').val(row.optionb);
                    $('#edit_c').val(row.optionc);
                    $('#edit_d').val(row.optiond);
                    <?php if (is_option_e_mode_enabled()) { ?>
                        $('#edit_e').val(row.optione);
                    <?php } ?>
                    $('#edit_tf').show('fast');
                    $('.edit_ntf').show('fast');
                    $('#edit_c').attr("required", "required");
                    $('#edit_d').attr("required", "required");
                    $('#edit_e').attr("required", "required");
                }

                $('#edit_a').val(row.optiona);
                $('#edit_b').val(row.optionb);
                $('#edit_c').val(row.optionc);
                $('#edit_d').val(row.optiond);
                <?php if (is_option_e_mode_enabled()) { ?>
                    $('#edit_e').val(row.optione);
                <?php } ?>
                $('#edit_answer').val(row.answer.toLowerCase());
                $('#edit_note').val(row.note);

            }
        };
    </script>

    <script type="text/javascript">
        $('#filter_btn').on('click', function(e) {
            $('#question_list').bootstrapTable('refresh');
        });
        $('#delete_multiple_questions').on('click', function(e) {
            var base_url = "<?php echo base_url(); ?>";
            sec = 'tbl_contest_question';
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
                    url: base_url + 'delete_contest_questions',
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
                "contest_id": $('#filter_contest').val(),
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }
    </script>

    <script type="text/javascript">
        $('input[name="question_type"]').on("click", function(e) {
            var question_type = $(this).val();
            if (question_type == "2") {
                $('#tf').hide('fast');
                $('#a').val("<?= is_settings('true_value') ?>");
                $('#b').val("<?= is_settings('false_value') ?>");
                $('#c').removeAttr('required');
                $('#d').removeAttr('required');
                $('#e').removeAttr('required');
                $('.ntf').hide('fast');
            } else {
                $('#a').val('');
                $('#b').val('');
                $('#tf').show('fast');
                $('.ntf').show('fast');
                $('#c').attr("required", "required");
                $('#d').attr("required", "required");
                $('#e').attr("required", "required");
            }
        });
        $('input[name="edit_question_type"]').on("click", function(e) {
            var edit_question_type = $(this).val();
            if (edit_question_type == "2") {
                $('#edit_tf').hide('fast');
                $('#edit_a').val("<?= is_settings('true_value') ?>");
                $('#edit_b').val("<?= is_settings('false_value') ?>");
                $('#edit_c').removeAttr('required');
                $('#edit_d').removeAttr('required');
                $('#edit_e').removeAttr('required');
                $('.edit_ntf').hide('fast');
                $('#edit_answer').val('');
            } else {
                $('#edit_tf').show('fast');
                $('.edit_ntf').show('fast');
                $('#edit_c').attr("required", "required");
                $('#edit_d').attr("required", "required");
                $('#edit_e').attr("required", "required");
            }
        });
    </script>

    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;

        $("#file").change(function(e) {
            var file, img;

            if ((file = this.files[0])) {
                img = new Image();
                img.onerror = function() {
                    $('#file').val('');
                    $('#img_error_msg').html("<?= lang(INVALID_IMAGE_TYPE); ?>");
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
                    $('#up_img_error_msg').html("<?= lang(INVALID_IMAGE_TYPE); ?>");
                    $('#up_img_error_msg').show().delay(3000).fadeOut();
                };
                img.src = _URL.createObjectURL(file);
            }
        });


        $('#language_id').on('change', function() {
            let $this = $(this);
            $("#contest-data").val("").removeAttr('disabled').show();
            $("#contest-data").find('option').hide();

            if ($("#contest-data").find('option[data-language-id="' + $this.val() + '"]').length) {
                $("#contest-data").find('option[data-language-id="' + $this.val() + '"]').show();
            } else {
                $("#contest-data").find("option[data-no-data-found=true]").trigger('change').show();
                $("#contest-data").attr('disabled', true);
            }
        })
    </script>


</body>

</html>