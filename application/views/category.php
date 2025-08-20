<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('create_and_manage_main_category'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('create_and_manage_main_category'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('create_main_category'); ?></h4>
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
                                                <div class="form-group col-md-6 col-lg-4 col-sm-12 ">
                                                    <label class="control-label"><?= lang('category_name'); ?> <small class="text-danger">*</small></label>
                                                    <input name="name" id="category-name" type="text" class="form-control" placeholder="<?= lang('enter_category_name'); ?>" required>
                                                </div>
                                                <div class="form-group col-md-6 col-lg-4 col-sm-12 ">
                                                    <label class="control-label"><?= lang('slug'); ?> <small class="text-danger">*</small></label>
                                                    <input name="slug" id="category-slug" type="text" class="form-control" placeholder="<?= lang('enter_slug'); ?>" required>
                                                    <small class="text-danger d-block"><?= lang('only_english_character_number_hypens_allowed') ?></small>
                                                    <div class="badge badge-danger m-1" id="category-slug-warning" style="display:none;"></div>
                                                </div>
                                                <div class="form-group col-md-6 col-lg-4 col-sm-12 ">
                                                    <label class="control-label"><?= lang('image'); ?></label>
                                                    <input id="file" name="file" type="file" accept="image/*" class="form-control">
                                                    <small class="text-danger"><?= lang('image_type_supported'); ?></small>
                                                    <p style="display: none" id="img_error_msg" class="badge badge-danger"></p>
                                                </div>
                                                <div class="form-group col-md-2 col-sm-12">
                                                    <label class="control-label"><?= lang('is_premium'); ?></label><br>
                                                    <input type="checkbox" id="is_premium_switch" data-plugin="switchery">

                                                    <input type="hidden" id="is_premium" name="is_premium" value="0">
                                                </div>

                                                <div class="form-group col-md-4 col-lg-2 col-sm-12 is_premium_coins_div" style="display: none;">
                                                    <label class="control-label"><?= lang('coins'); ?></label>
                                                    <input name="coins" type="number" min="1" class="form-control is_premium_coin" placeholder="<?= lang('enter_coins'); ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <input type="submit" name="btnadd" value="<?= lang('submit'); ?>" id="create-form-save-button" class="<?= BUTTON_CLASS ?>" />
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
                                        <h4><?= lang('categories'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                    </div>

                                    <div class="card-body">
                                        <?php if (is_language_mode_enabled()) { ?>
                                            <div class="row">
                                                <div class='form-group col-md-3'>
                                                    <select id='filter_language' class='form-control' required>
                                                        <option value=""><?= lang('select_language'); ?></option>
                                                        <?php foreach ($language as $lang) { ?>
                                                            <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class='form-group col-md-3'>
                                                    <button class='<?= BUTTON_CLASS ?> btn-block form-control' id='filter_btn'><?= lang('filter_data'); ?></button>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div id="toolbar">
                                            <?php if (has_permissions('delete', 'categories')) { ?>
                                                <button class="btn btn-danger" id="delete_multiple_categories" title="<?= lang('delete_selected_categories'); ?>"><em class='fa fa-trash'></em></button>
                                            <?php } ?>
                                        </div>
                                        <table aria-describedby="mydesc" class='table-striped' id='category_list' data-toggle="table" data-url="<?= base_url() . 'Table/category' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="row_order" data-sort-order="asc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "category-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <?php if (is_language_mode_enabled()) { ?>
                                                        <th scope="col" data-field="language_id" data-sortable="true" data-visible="false"><?= lang('language_id'); ?></th>
                                                        <th scope="col" data-field="language" data-sortable="true"><?= lang('language'); ?></th>
                                                    <?php } ?>
                                                    <th scope="col" data-field="row_order" data-sortable="true" data-visible="false"><?= lang('order'); ?></th>
                                                    <th scope="col" data-field="category_name" data-sortable="true"><?= lang('category_name'); ?></th>
                                                    <th scope="col" data-field="slug" data-sortable="true" data-visible="false"><?= lang('slug'); ?></th>
                                                    <th scope="col" data-field="image" data-sortable="false"><?= lang('image'); ?></th>
                                                    <th scope="col" data-field="is_premium" data-sortable="false" data-formatter="isPremiumFormatter"><?= lang('is_premium'); ?></th>
                                                    <th scope="col" data-field="coins" data-sortable="false"><?= lang('coins'); ?></th>
                                                    <?php $type = $this->uri->segment(1);
                                                    if ($type == 'fun-n-learn-category') { ?>
                                                        <th scope="col" data-field="no_of_que" data-sortable="false"><?= lang('total_fun_n_learn'); ?></th>
                                                    <?php } else if ($type == 'guess-the-word-category') { ?>
                                                        <th scope="col" data-field="no_of_que" data-sortable="false"><?= lang('total_guess_the_word'); ?></th>
                                                    <?php } else { ?>
                                                        <th scope="col" data-field="no_of_que" data-sortable="false"><?= lang('total_question'); ?></th>
                                                    <?php } ?>
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
                    <h5 class="modal-title"><?= lang('edit_main_category'); ?></h5>
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
                                    <label class="control-label"><?= lang('category_name'); ?> <small class="text-danger">*</small></label>
                                    <input id="edit-category-name" name="name" type="text" class="form-control" required placeholder="<?= lang('enter_category_name'); ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label class="control-label"><?= lang('slug'); ?> <small class="text-danger">*</small></label>
                                    <input name="edit_slug" id="edit-category-slug" type="text" class="form-control" placeholder="<?= lang('enter_slug'); ?>" required>
                                    <small class="text-danger d-block"><?= lang('only_english_character_number_hypens_allowed'); ?></small>
                                    <div class="badge badge-danger m-1" id="edit-category-slug-warning" style="display:none;"></div>
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
                                <div class="form-group col-md-4 col-sm-12">
                                    <label class="control-label"><?= lang('is_premium'); ?></label><br>
                                    <input type="checkbox" id="edit_is_premium_switch" data-plugin="switchery">

                                    <input type="hidden" id="edit_is_premium" name="edit_is_premium" value="0">
                                </div>
                                <div class="form-group col-md-8 col-sm-12 edit_is_premium_coins_div" style="display: none;">
                                    <label class="control-label"><?= lang('coins'); ?></label>
                                    <input name="edit_coins" type="number" min="1" class="form-control edit_coins" placeholder="<?= lang('enter_coins'); ?>">
                                </div>
                            </div>

                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('close'); ?></button>
                                <input name="btnupdate" type="submit" value="<?= lang('save_changes'); ?>" id="edit-form-save-button" class="<?= BUTTON_CLASS ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php base_url() . include 'footer.php'; ?>

    <script type="text/javascript">
        $('[data-plugin="switchery"]').each(function(index, element) {
            var init = new Switchery(element, {
                size: 'small',
                color: '#1abc9c',
                secondaryColor: '#f1556c'
            });
        });

        var changeIsPremiumSwitch = document.querySelector('#is_premium_switch');
        changeIsPremiumSwitch.onchange = function() {
            if (changeIsPremiumSwitch.checked) {
                $('#is_premium').val(1);
                $('.is_premium_coins_div').show(300).find('.is_premium_coin').attr('required', true);
            } else {
                $('#is_premium').val(0);
                $('.is_premium_coins_div').find('.is_premium_coin').removeAttr('required');
                $('.is_premium_coins_div').hide();
            }
        };

        var changeEditIsPremiumSwitch = document.querySelector('#edit_is_premium_switch');
        changeEditIsPremiumSwitch.onchange = function() {
            if (changeEditIsPremiumSwitch.checked) {
                $('#edit_is_premium').val(1);
                $('.edit_is_premium_coins_div').show(300).find('.edit_coins').attr('required', true).val("");
            } else {
                $('#edit_is_premium').val(0);
                $('.edit_is_premium_coins_div').find('.edit_coins').removeAttr('required').val("");
                $('.edit_is_premium_coins_div').hide();
            }
        };

        $('#filter_btn').on('click', function(e) {
            $('#category_list').bootstrapTable('refresh');
        });
        $('#delete_multiple_categories').on('click', function(e) {
            var base_url = "<?php echo base_url(); ?>";
            sec = 'tbl_category';
            is_image = 1;
            table = $('#category_list');
            delete_button = $('#delete_multiple_categories');
            selected = table.bootstrapTable('getSelections');
            ids = "";
            $.each(selected, function(i, e) {
                ids += e.id + ",";
            });
            ids = ids.slice(0, -1);
            if (ids == "") {
                alert("<?= lang("please_select_category_to_delete"); ?>");
            } else {
                if (confirm("<?= lang("sure_to_delete_all_category"); ?>")) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'delete_multiple',
                        data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                        beforeSend: function() {
                            delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                        },
                        success: function(result) {
                            if (result == 1) {
                                alert("<?= lang("category_deleted_successfully"); ?>");
                            } else {
                                alert("<?= lang("not_delete_category_try_again"); ?>");
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
            table = "tbl_category";
            id = $(this).data("id");
            image = $(this).data("image");
            removeImage(id, image, table)
            $('#category_list').bootstrapTable('refresh');
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
                $('#edit-category-slug').val(row.slug);
                $('#language_id').val(row.language_id);
                $('#edit-category-name').val(row.category_name);
                var event = new Event('change');

                if (row.is_premium == 1) {
                    $('#edit_is_premium').val(1);
                    var checkbox = $('#edit_is_premium_switch');
                    checkbox.prop('checked', true);
                    checkbox.get(0).dispatchEvent(new Event('change'));
                    $('.edit_coins').val(row.coins);
                } else {
                    $('#edit_is_premium').val(0);
                    var checkbox = $('#edit_is_premium_switch');
                    checkbox.prop('checked', false);
                    checkbox.get(0).dispatchEvent(new Event('change'));
                    $('.edit_coins').val("");
                }
            }
        };
    </script>

    <script type="text/javascript">
        $(document).on('click', '.delete-data', function() {
            if (confirm("<?= lang("sure_to_delete_category_releated_data_deleted"); ?>")) {
                var base_url = "<?php echo base_url(); ?>";
                id = $(this).data("id");
                image = $(this).data("image");
                $.ajax({
                    url: base_url + 'delete_category',
                    type: "POST",
                    data: 'id=' + id + '&image_url=' + image,
                    success: function(result) {
                        if (result) {
                            $('#category_list').bootstrapTable('refresh');
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

        function isPremiumFormatter(value, row) {
            let html = "";
            if (row.is_premium == 1) {
                html = "<span class='badge badge-success'><?= lang('yes'); ?></span>";
            } else {
                html = "<span class='badge badge-danger'><?= lang('no'); ?></span>";
            }
            return html;
        }
    </script>


    <script>
        var base_url = "<?php echo base_url(); ?>";

        const getCategorySlug = (categoryElement, slugElement) => {
            categoryElement.keyup(function() {
                let editId = slugElement.parent().parent().parent().find('#edit_id').val();
                $.ajax({
                    type: "POST",
                    url: base_url + 'get-category-slug',
                    data: {
                        'id': editId,
                        'category_name': $(this).val()
                    },
                    beforeSend: function() {
                        slugElement.attr('readonly', true).val("<?= lang('please_wait'); ?>")
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
        getCategorySlug($('#category-name'), $('#category-slug'))
        getCategorySlug($('#edit-category-name'), $('#edit-category-slug'))
    </script>
</body>

</html>