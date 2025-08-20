<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('create_and_manage_fun_n_learn'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('create_and_manage_fun_n_learn'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('create_fun_n_learn'); ?></h4>
                                    </div>

                                    <div class="card-body">
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
                                                        <select name="language_id" id="create_language_id" class="form-control" required>
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
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('title'); ?> <small class="text-danger">*</small></label>
                                                    <input name="title" type="text" class="form-control" placeholder="<?= lang('enter_title'); ?>" required>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('content_type'); ?> <small class="text-danger">*</small></label>
                                                    <div>
                                                        <div class="form-check-inline bg-light p-2">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="content_type" value="1" checked required><?= lang('youtube_id'); ?>
                                                            </label>
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="content_type" value="2"><?= lang('pdf'); ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12" id="youtube_content">
                                                    <label class="control-label"><?= lang('youtube_id'); ?></label>
                                                    <input name="content_data" type="text" class="form-control" placeholder="<?= lang('youtube_id'); ?>">
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12" id="pdf_content">
                                                    <label class="control-label"><?= lang('pdf'); ?></label>
                                                    <input id="file" name="file" type="file" accept="pdf" class="form-control">
                                                    <small class="text-danger"><?= lang('file_type_supported'); ?></small>
                                                    <p style="display: none" id="file_error_msg" class="badge badge-danger"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="control-label"><?= lang('details'); ?></label>
                                                    <textarea id="detail" name="detail" class="form-control"></textarea>
                                                    <input name="img" type="file" accept="image/*" id="upload" style="display: none" onchange="">
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
                                        <h4><?= lang('fun_n_learn'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <?php if (is_language_mode_enabled()) { ?>
                                                <div class='form-group col-md-3'>
                                                    <select id='filter_language' class='form-control' required>
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
                                            <?php if (has_permissions('delete', 'fun_n_learn')) { ?>
                                                <button class="btn btn-danger" id="delete_multiple_fun_n_learn" title="<?= lang('delete_selected_fun_n_learn'); ?>"><em class='fa fa-trash'></em></button>
                                            <?php } ?>
                                        </div>
                                        <table aria-describedby="mydesc" class='table-striped' id='fun_n_learn_list' data-toggle="table" data-url="<?= base_url() . 'Table/fun_n_learn' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "fun-n-learn-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="status" data-sortable="false"><?= lang('status'); ?></th>
                                                    <th scope="col" data-field="category" data-sortable="true" data-visible='false'><?= lang('main_category'); ?></th>
                                                    <th scope="col" data-field="subcategory" data-sortable="true" data-visible='false'><?= lang('sub_category'); ?></th>
                                                    <?php if (is_language_mode_enabled()) { ?>
                                                        <th scope="col" data-field="language_id" data-sortable="true" data-visible="false"><?= lang('language_id'); ?></th>
                                                        <th scope="col" data-field="language" data-sortable="true"><?= lang('language'); ?></th>
                                                    <?php } ?>
                                                    <th scope="col" data-field="title" data-sortable="true"><?= lang('title'); ?></th>
                                                    <th scope="col" data-field="detail" data-sortable="false" data-visible='false'><?= lang('details'); ?></th>
                                                    <th scope="col" data-field="no_of_que" data-sortable="false"><?= lang('total_question'); ?></th>
                                                    <th scope="col" data-field="content_type" data-sortable="false" data-formatter="contentTypeFormatter"><?= lang('content_type'); ?></th>
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
                    <h5 class="modal-title"><?= lang('edit_fun_n_learn'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type='hidden' name="edit_id" id="edit_id" value="" />
                            <div class="row">
                                <?php if (is_language_mode_enabled()) { ?>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="control-label"><?= lang('language'); ?> <small class="text-danger">*</small></label>
                                        <select id="language_id" name="language_id" class="form-control" required>
                                            <?php foreach ($language as $lang) { ?>
                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                        <select id="edit_category" name="category" class="form-control" required>
                                            <option value=""><?= lang('select_main_category'); ?></option>
                                        </select>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                        <select id="edit_category" name="category" class="form-control" required>
                                            <option value=""><?= lang('select_main_category'); ?></option>
                                            <?php foreach ($category as $cat) { ?>
                                                <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('sub_category'); ?></label>
                                    <select id="edit_subcategory" name="subcategory" class="form-control">
                                        <option value=""><?= lang('select_sub_category'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('title'); ?> <small class="text-danger">*</small></label>
                                    <input id="title" name="title" type="text" class="form-control" placeholder="<?= lang('enter_title'); ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="control-label"><?= lang('content_type'); ?> <small class="text-danger">*</small></label>
                                    <div>
                                        <div class="form-check-inline bg-light p-2">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="edit_content_type" value="1" checked required><?= lang('youtube_id'); ?>
                                            </label>
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="edit_content_type" value="2"><?= lang('pdf'); ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-sm-12" id="edit_youtube_content">
                                    <label class="control-label"><?= lang('youtube_id'); ?></label>
                                    <input name="content_data" id="content_data" type="text" class="form-control" placeholder="<?= lang('youtube_id'); ?>">
                                </div>
                                <div class="form-group col-md-8 col-sm-12" id="edit_pdf_content">
                                    <label class="control-label"><?= lang('pdf'); ?></label>
                                    <input id="update_file" name="file" type="file" accept="pdf" class="form-control">
                                    <small class="text-danger"><?= lang('file_type_supported'); ?></small>
                                    <p style="display: none" id="update_file_error_msg" class="badge badge-danger"></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('details'); ?></label>
                                    <textarea id="edit_detail" name="detail" class="form-control"></textarea>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="editStatusModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('update_status'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type='hidden' name="update_id" id="update_id" value="" />

                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('status'); ?></label><br>
                                    <div id="status" class="btn-group">
                                        <label class="btn btn-default">
                                            <input type="radio" name="status" value="1"> <?= lang('active'); ?>
                                        </label>
                                        <label class="btn btn-danger">
                                            <input type="radio" name="status" value="0"> <?= lang('deactive'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('close'); ?></button>
                                <input name="btnupdatestatus" type="submit" value="<?= lang('save_changes'); ?>" class="<?= BUTTON_CLASS ?>">
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
            $('#fun_n_learn_list').bootstrapTable('refresh');
        });
        $('#delete_multiple_fun_n_learn').on('click', function(e) {
            var base_url = "<?php echo base_url(); ?>";
            sec = 'tbl_fun_n_learn';
            is_image = 0;
            table = $('#fun_n_learn_list');
            delete_button = $('#delete_multiple_fun_n_learn');
            selected = table.bootstrapTable('getSelections');
            ids = "";
            $.each(selected, function(i, e) {
                ids += e.id + ",";
            });
            ids = ids.slice(0, -1);
            if (ids == "") {
                alert("<?= lang('please_select_fun_n_learn_to_delete'); ?>");
            } else {
                if (confirm("<?= lang('sure_to_delete_all_fun_n_learn'); ?>")) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'delete_multiple',
                        data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                        beforeSend: function() {
                            delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                        },
                        success: function(result) {
                            if (result == 1) {
                                alert("<?= lang('fun_n_learn_deleted_successfully'); ?>");
                            } else {
                                alert("<?= lang('not_delete_fun_n_learn_try_again'); ?>");
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
        function contentTypeFormatter(value, row) {
            var content_type = (row.content_type == 1) ? ' <label class="badge badge-info">Youtube ID</label>' : (row.content_type == 2) ? '<label class="badge badge-info">PDF</label>' : '';
            return content_type;
        }
        window.actionEvents = {
            'click .edit-data': function(e, value, row, index) {
                $('#edit_id').val(row.id);
                <?php if (is_language_mode_enabled()) { ?>
                    if (row.language_id == 0) {
                        $('#language_id').val(row.language_id);
                        $('#edit_category').html(category_options);
                        $('#edit_category').val(row.category).trigger("change", [row.category, row.subcategory]);
                    } else {
                        $('#language_id').val(row.language_id).trigger("change", [row.language_id, row.category, row.subcategory]);
                    }
                <?php } else { ?>
                    $('#edit_category').val(row.category).trigger("change", [row.category, row.subcategory]);
                <?php } ?>
                $('#title').val(row.title);
                var detail = tinyMCE.get('edit_detail').setContent(row.detail);
                $('#edit_detail').val(detail);
                $('#edit_subcategory').val(row.subcategory);
                $("input[name=edit_content_type][value=" + row.content_type + "]").prop('checked', true).trigger('click');
                if (row.content_type == 0) {
                    $("input[name=edit_content_type][value=1]").prop('checked', true).trigger('click');
                } else if (row.content_type == 1) {
                    $('#content_data').val(row.content_data);
                }
            },
            'click .edit-status': function(e, value, row, index) {
                $('#update_id').val(row.id);
                $("input[name=status][value=1]").prop('checked', true);
                if ($(row.status).text() == 'Deactive')
                    $("input[name=status][value=0]").prop('checked', true);
            }
        };
    </script>

    <script type="text/javascript">
        $(document).on('click', '.delete-data', function() {
            if (confirm("<?= lang('sure_to_delete_fun_n_learn_releated_data_deleted'); ?>")) {
                var base_url = "<?php echo base_url(); ?>";
                id = $(this).data("id");
                $.ajax({
                    url: base_url + 'delete_fun_n_learn',
                    type: "POST",
                    data: 'id=' + id,
                    success: function(result) {
                        if (result) {
                            $('#fun_n_learn_list').bootstrapTable('refresh');
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
        var base_url = "<?php echo base_url(); ?>";
        var type = 'fun-n-learn-subcategory';

        var sess_language_id = '<?= $sess_language_id ?>';
        var sess_category = '<?= $sess_category ?>';
        var sess_subcategory = '<?= $sess_subcategory ?>';
        $(document).ready(function() {
            if (sess_language_id != '0' || sess_category != '0') {
                <?php if (is_language_mode_enabled()) { ?>
                    $('#create_language_id').val(sess_language_id).trigger("change", [sess_language_id, sess_category, sess_subcategory]);
                <?php } else { ?>
                    $('#category').val(sess_category).trigger("change", [sess_category, sess_subcategory]);
                <?php } ?>
            }
        });

        $('#create_language_id').on('change', function(e, row_language_id, row_category, row_subcategory) {
            var language_id = $('#create_language_id').val();
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

        $('#language_id').on('change', function(e, row_language_id, row_category, row_subcategory) {
            var language_id = $('#language_id').val();
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
        $(document).ready(function() {
            $(document).on('focusin', function(e) {
                if ($(e.target).closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
                    e.stopImmediatePropagation();
                }
            });

            var base_url = "<?php echo base_url(); ?>";
            tinymce.init({
                selector: '#detail',
                height: 150,
                menubar: true,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime table contextmenu paste code help wordcount'
                ],
                toolbar: 'insert | undo redo |  formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image removeformat | help',
                image_advtab: true,
                relative_urls: false,
                remove_script_host: false,
                file_picker_callback: function(callback, value, meta) {
                    if (meta.filetype == "media" || meta.filetype == "image") {

                        jQuery("#upload").trigger("click");
                        $("#upload").unbind('change');

                        jQuery("#upload").on("change", function() {
                            var file = this.files[0];
                            var reader = new FileReader();

                            var fd = new FormData();
                            var files = file;
                            fd.append("file", files);
                            fd.append('filetype', meta.filetype);

                            var filename = "";
                            jQuery.ajax({
                                url: base_url + "fun_learn_upload_img",
                                type: "post",
                                data: fd,
                                contentType: false,
                                processData: false,
                                async: false,
                                success: function(response) {
                                    filename = response;
                                }
                            });

                            reader.onload = function(e) {
                                callback("images/fun-n-learn/" + filename);
                            };
                            reader.readAsDataURL(file);
                        });
                    }
                },
                setup: function(editor) {
                    editor.on("change keyup", function(e) {
                        editor.save();
                        $(editor.getElement()).trigger('change');
                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('focusin', function(e) {
            if ($(event.target).closest(".mce-window").length) {
                e.stopImmediatePropagation();
            }
        });
        var base_url = "<?php echo base_url(); ?>";
        tinymce.init({
            selector: '#edit_detail',
            height: 150,
            menubar: true,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime table contextmenu paste code help wordcount'
            ],
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image removeformat | help',
            image_advtab: true,
            relative_urls: false,
            remove_script_host: false,
            file_picker_callback: function(callback, value, meta) {
                if (meta.filetype == "media" || meta.filetype == "image") {

                    jQuery("#upload").trigger("click");
                    $("#upload").unbind('change');

                    jQuery("#upload").on("change", function() {
                        var file = this.files[0];
                        var reader = new FileReader();

                        var fd = new FormData();
                        var files = file;
                        fd.append("file", files);
                        fd.append('filetype', meta.filetype);

                        var filename = "";
                        jQuery.ajax({
                            url: base_url + "fun_learn_upload_img",
                            type: "post",
                            data: fd,
                            contentType: false,
                            processData: false,
                            async: false,
                            success: function(response) {
                                filename = response;
                            }
                        });

                        reader.onload = function(e) {
                            callback("images/fun-n-learn/" + filename);
                        };
                        reader.readAsDataURL(file);
                    });
                }
            },
            setup: function(editor) {
                editor.on("change keyup", function(e) {
                    editor.save();
                    $(editor.getElement()).trigger('change');
                });
            }
        });
    </script>

    <script>
        $('#youtube_content').show('fast');
        $('#pdf_content').hide('fast');
        $('input[name="content_type"]').on("click", function(e) {
            var content_type = $(this).val();
            if (content_type == "1") {
                $('#youtube_content').show('fast');
                $('#pdf_content').hide('fast');
            } else if (content_type == "2") {
                $('#pdf_content').show('fast');
                $('#youtube_content').hide('fast');
            }
        });
        $('input[name="edit_content_type"]').on("click", function(e) {
            var content_type = $(this).val();
            if (content_type == "1") {
                $('#edit_youtube_content').show('fast');
                $('#edit_pdf_content').hide('fast');
            } else if (content_type == "2") {
                $('#edit_pdf_content').show('fast');
                $('#edit_youtube_content').hide('fast');
            }
        });
    </script>
    <script type="text/javascript">
        var _URL = window.URL || window.webkitURL;

        $("#file").change(function(e) {
            var file, img;
            file = this.files[0];
            var maxSize = 500 * 1024 * 1024; // 500MB

            if (file.type !== 'application/pdf') {
                $('#file').val('');
                $('#file_error_msg').html('<?= INVALID_FILE_TYPE; ?>');
                $('#file_error_msg').show().delay(3000).fadeOut();
                return;
            }
            if (file.size > maxSize) {
                $('#file').val('');
                $('#file_error_msg').html('<?= FILE_SIZE_EXCEEDED; ?>');
                $('#file_error_msg').show().delay(3000).fadeOut();
                return;
            }
        });


        $("#update_file").change(function(e) {
            var file, img;
            file = this.files[0];
            var maxSize = 500 * 1024 * 1024; // 500MB

            if (file.type !== 'application/pdf') {
                $('#update_file').val('');
                $('#update_file_error_msg').html('<?= INVALID_FILE_TYPE; ?>');
                $('#update_file_error_msg').show().delay(3000).fadeOut();
                return;
            }
            if (file.size > maxSize) {
                $('#update_file').val('');
                $('#update_file_error_msg').html('<?= FILE_SIZE_EXCEEDED; ?>');
                $('#update_file_error_msg').show().delay(3000).fadeOut();
                return;
            }
        });
    </script>
</body>

</html>