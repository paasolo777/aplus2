<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('create_and_manage_sub_category'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('create_and_manage_sub_category'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('create_sub_category'); ?></h4>
                                    </div>

                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <input type="hidden" name="type" value="<?= $this->uri->segment(1) ?>" required />
                                            <?php if (is_language_mode_enabled()) { ?>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-sm-12">
                                                        <label class="control-label"><?= lang('language'); ?> <small class="text-danger">*</small></label>
                                                        <select name="language_id" id="language_id" class="form-control" required>
                                                            <option value=""><?= lang('select_language'); ?></option>
                                                            <?php foreach ($language as $lang) { ?>
                                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-12">
                                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                                        <select id="maincat_id" name="maincat_id" class="form-control" required>
                                                            <option value=""><?= lang('select_main_category'); ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="row">
                                                    <div class="form-group col-md-12 col-sm-12">
                                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                                        <select id="maincat_id" name="maincat_id" class="form-control" required>
                                                            <option value=""><?= lang('select_main_category'); ?></option>
                                                            <?php foreach ($category as $cat) { ?>
                                                                <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-lg-4 col-sm-12">
                                                    <label class="control-label"><?= lang('sub_category_name'); ?> <small class="text-danger">*</small></label>
                                                    <input name="name" type="text" class="form-control" id="subcategory-name" placeholder="<?= lang('enter_sub_category_name'); ?>" required>
                                                </div>
                                                <div class="form-group col-md-6 col-lg-4 col-sm-12">
                                                    <label class="control-label"><?= lang('slug'); ?> <small class="text-danger">*</small></label>
                                                    <input name="slug" id="subcategory-slug" type="text" class="form-control" placeholder="<?= lang('enter_slug'); ?>" required>
                                                    <small class="text-danger d-block"><?= lang('only_english_character_number_hypens_allowed') ?></small>
                                                    <div class="badge badge-danger m-1" id="subcategory-slug-warning" style="display:none;"></div>
                                                </div>
                                                <div class="form-group col-md-6 col-lg-4 col-sm-12">
                                                    <label class="control-label"><?= lang('image'); ?></label>
                                                    <input id="file" name="file" type="file" accept="image/*" class="form-control">
                                                    <small class="text-danger"><?= lang('image_type_supported'); ?></small>
                                                    <p style="display: none" id="img_error_msg" class="badge badge-danger"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <input type="submit" name="btnadd" id="create-form-save-button" value="<?= lang('submit'); ?>" class="<?= BUTTON_CLASS ?>" />
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
                                        <h4><?= lang('sub_categories'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
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
                                                <button class='<?= BUTTON_CLASS ?> btn-block form-control' id='filter_btn'><?= lang('filter_data'); ?></button>
                                            </div>
                                        </div>
                                        <div id="toolbar">
                                            <?php if (has_permissions('delete', 'subcategories')) { ?>
                                                <button class="btn btn-danger" id="delete_multiple_subcategories" title="<?= lang('delete_selected_subcategory'); ?>"><em class='fa fa-trash'></em></button>
                                            <?php } ?>
                                        </div>
                                        <table aria-describedby="mydesc" class='table-striped' id='subcategory_list' data-toggle="table" data-url="<?= base_url() . 'Table/subcategory' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="row_order" data-sort-order="asc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "subcategory-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <?php if (is_language_mode_enabled()) { ?>
                                                        <th scope="col" data-field="language_id" data-sortable="true" data-visible="false"><?= lang('language_id'); ?></th>
                                                        <th scope="col" data-field="language" data-sortable="true"><?= lang('language'); ?></th>
                                                    <?php } ?>
                                                    <th scope="col" data-field="row_order" data-sortable="true" data-visible="false"><?= lang('order'); ?></th>
                                                    <th scope="col" data-field="maincat_id" data-sortable="true" data-visible='false'><?= lang('main_category_id'); ?></th>
                                                    <th scope="col" data-field="category_name" data-sortable="true"><?= lang('main_category'); ?></th>
                                                    <th scope="col" data-field="subcategory_name" data-sortable="true"><?= lang('subcategory_name'); ?></th>
                                                    <th scope="col" data-field="slug" data-sortable="true" data-visible="false">Slug</th>
                                                    <th scope="col" data-field="image" data-sortable="false"><?= lang('image'); ?></th>
                                                    <th scope="col" data-field="status" data-sortable="false"><?= lang('status'); ?></th>
                                                    <?php $type = $this->uri->segment(1);
                                                    if ($type == 'fun-n-learn-subcategory') { ?>
                                                        <th scope="col" data-field="no_of_que" data-sortable="false"><?= lang('total_fun_n_learn'); ?></th>
                                                    <?php } else if ($type == 'guess-the-word-subcategory') { ?>
                                                        <th scope="col" data-field="no_of_que" data-sortable="false"><?= lang('total_guess_the_word'); ?></th>
                                                    <?php } else { ?>
                                                        <th scope="col" data-field="no_of_que" data-sortable="false"><?= lang('total_question'); ?></th>
                                                    <?php } ?>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('edit_subcategory'); ?></h5>
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
                            <input type="hidden" name="type" value="<?= $this->uri->segment(1) ?>" required />

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
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                        <select id="update_maincat_id" name="maincat_id" class="form-control" required>
                                            <option value=""><?= lang('select_main_category'); ?></option>

                                        </select>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label class="control-label"><?= lang('main_category'); ?> <small class="text-danger">*</small></label>
                                        <select id="update_maincat_id" name="maincat_id" class="form-control" required>
                                            <option value=""><?= lang('select_main_category'); ?></option>
                                            <?php foreach ($category as $cat) { ?>
                                                <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('subcategory_name'); ?> <small class="text-danger">*</small></label>
                                    <input id="edit-subcategory-name" name="name" type="text" class="form-control" required placeholder="<?= lang('enter_subcategory_name'); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label class="control-label"><?= lang('slug'); ?> <small class="text-danger">*</small></label>
                                    <input name="slug" id="edit-subcategory-slug" type="text" class="form-control" placeholder="<?= lang('enter_slug'); ?>" required>
                                    <small class="text-danger d-block"><?= lang('only_english_character_number_hypens_allowed') ?></small>
                                    <div class="badge badge-danger m-1" id="edit-subcategory-slug-warning" style="display:none;"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
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
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('status'); ?></label><br />
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
                                <input name="btnupdate" type="submit" id="edit-form-save-button" value="<?= lang('save_changes'); ?>" class="<?= BUTTON_CLASS ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php base_url() . include 'footer.php'; ?>

    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
        var type = '<?= $this->uri->segment(1) ?>';
        $('#language_id').on('change', function(e) {
            var language_id = $('#language_id').val();
            $.ajax({
                type: 'POST',
                url: base_url + 'get_categories_of_language',
                data: 'language_id=' + language_id + '&type=' + type,
                beforeSend: function() {
                    $('#maincat_id').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#maincat_id').html(result);
                }
            });
        });
        $('#update_language_id').on('change', function(e, row_language_id, row_category) {
            var language_id = $('#update_language_id').val();

            $.ajax({
                type: 'POST',
                url: base_url + 'get_categories_of_language',
                data: 'language_id=' + language_id + '&type=' + type,
                beforeSend: function() {
                    $('#update_maincat_id').html('<option value=""><?= lang('please_wait'); ?></option>');
                },
                success: function(result) {
                    $('#update_maincat_id').html(result).trigger("change");
                    if (language_id == row_language_id && row_category != 0)
                        $('#update_maincat_id').val(row_category).trigger("change", [row_category]);
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
    </script>

    <script type="text/javascript">
        $('#filter_btn').on('click', function(e) {
            $('#subcategory_list').bootstrapTable('refresh');
        });
        $('#delete_multiple_subcategories').on('click', function(e) {
            sec = 'tbl_subcategory';
            is_image = 1;
            table = $('#subcategory_list');
            delete_button = $('#delete_multiple_subcategories');
            selected = table.bootstrapTable('getSelections');
            ids = "";
            $.each(selected, function(i, e) {
                ids += e.id + ",";
            });
            ids = ids.slice(0, -1);
            if (ids == "") {
                alert("<?= lang('please_select_subcategory_to_delete'); ?>");
            } else {
                if (confirm("<?= lang('sure_to_delete_all_subcategory'); ?>")) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'delete_multiple',
                        data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                        beforeSend: function() {
                            delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                        },
                        success: function(result) {
                            if (result == 1) {
                                alert("<?= lang('subcategory_deleted_successfully'); ?>");
                            } else {
                                alert("<?= lang('not_delete_subcategory_try_again'); ?>");
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
        $('#removeImage').on('click', function(e) {
            table = "tbl_subcategory";
            id = $(this).data("id");
            image = $(this).data("image");
            removeImage(id, image, table)
            $('#subcategory_list').bootstrapTable('refresh');
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
                $("input[name=status][value=1]").prop('checked', true);
                if ($(row.status).text() == 'Deactive')
                    $("input[name=status][value=0]").prop('checked', true);
                <?php if (is_language_mode_enabled()) { ?>
                    if (row.language_id == 0) {
                        $('#update_maincat_id').val(row.maincat_id);
                    } else {
                        $('#update_language_id').val(row.language_id).trigger("change", [row.language_id, row.maincat_id]);
                    }
                <?php } else { ?>
                    $('#update_maincat_id').val(row.maincat_id);
                <?php } ?>
                $('#edit-subcategory-name').val(row.subcategory_name);
                $('#edit-subcategory-slug').val(row.slug);
                var event = new Event('change');
            }
        };
    </script>

    <script type="text/javascript">
        $(document).on('click', '.delete-data', function() {
            if (confirm("<?= lang('sure_to_delete_subcategory_releated_data_deleted'); ?>")) {
                id = $(this).data("id");
                image = $(this).data("image");
                $.ajax({
                    url: base_url + 'delete_subcategory',
                    type: "POST",
                    data: 'id=' + id + '&image_url=' + image,
                    success: function(result) {
                        if (result) {
                            $('#subcategory_list').bootstrapTable('refresh');
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
                "type": '<?= $this->uri->segment(1) ?>',
                "language": $('#filter_language').val(),
                "category": $('#filter_category').val(),
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


    <script>
        const getSubCategorySlug = (subCategoryElement, slugElement) => {
            subCategoryElement.keyup(function() {
                let editId = slugElement.parent().parent().parent().find('#edit_id').val();
                $.ajax({
                    type: "POST",
                    url: base_url + 'get-subcategory-slug',
                    data: {
                        'id': editId,
                        'category_name': $(this).val()
                    },
                    beforeSend: function() {
                        slugElement.attr('readonly', true).val('<?= lang('please_wait'); ?>')
                    },
                    success: function(slug) {
                        if (slug != null) {
                            slugElement.removeAttr('readonly');
                            slugElement.val(slug);
                        }
                    }
                });
            })
        }
        getSubCategorySlug($('#subcategory-name'), $('#subcategory-slug'))
        getSubCategorySlug($('#edit-subcategory-name'), $('#edit-subcategory-slug'))
    </script>


</body>

</html>