<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('coins_store_settings'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('coins_store_settings'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('title'); ?> <small class="text-danger">*</small></label>
                                                    <input type="text" name="title" required class="form-control" placeholder="<?= lang('title'); ?>" value="<?= $this->session->flashdata('title'); ?>" />
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('coins'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" min="0" name="coins" required class="form-control" placeholder="<?= lang('coins'); ?>" value="<?= $this->session->flashdata('coins'); ?>" />
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('product_id'); ?> <small class="text-danger">*</small></label>
                                                    <input type="text" name="product_id" required class="form-control" placeholder="<?= lang('product_id'); ?>" value="<?= $this->session->flashdata('product_id'); ?>" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('description'); ?> <small class="text-danger">*</small></label>
                                                    <textarea name="description" cols="50" rows="2" required class="form-control" placeholder="<?= lang('description'); ?>"><?= $this->session->flashdata('description'); ?></textarea>
                                                </div>
                                                <div class="form-group col-md-4 col-sm-12">
                                                    <label class="control-label"><?= lang('image'); ?></label>
                                                    <input id="file" name="file" type="file" accept="image/*" class="form-control">
                                                    <small class="text-danger"><?= lang('svg_image_type_supported'); ?></small>
                                                    <p style="display: none" id="img_error_msg" class="alert alert-danger"></p>
                                                </div>
                                                <?php
                                                if (!$is_ads) {
                                                ?>
                                                    <div class="form-group col-md-4 col-sm-12">
                                                        <label class="control-label"><?= lang('type'); ?></label>
                                                        <select name="type" class="form-control">
                                                            <option value=""><?= lang('select_type'); ?></option>
                                                            <option value="1"><?= lang('ads'); ?></option>
                                                        </select>
                                                    </div>
                                                <?php
                                                }
                                                ?>
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
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4><?= lang('coin_store'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                </div>

                                <div class="card-body">
                                    <div id="toolbar">
                                        <?php if (has_permissions('delete', 'coin_store')) { ?>
                                            <button class="btn btn-danger" id="delete_multiple_coin_store" title="<?= lang('delete_selected_coin_store_data'); ?>"><em class='fa fa-trash'></em></button>
                                        <?php } ?>
                                    </div>
                                    <table aria-describedby="mydesc" class='table-striped' id='coin_store_list' data-toggle="table" data-url="<?= base_url() . 'Table/coin_store' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-fixed-columns="true" data-fixed-number="1" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "category-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                        <thead>
                                            <tr>
                                                <th scope="col" data-field="state" data-checkbox="true"></th>
                                                <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                <th scope="col" data-field="title" data-sortable="true"><?= lang('title'); ?></th>
                                                <th scope="col" data-field="coins" data-sortable="true"><?= lang('coins'); ?></th>
                                                <th scope="col" data-field="product_id" data-sortable="true"><?= lang('product_id'); ?></th>
                                                <th scope="col" data-field="status" data-sortable="true"><?= lang('status'); ?></th>
                                                <th scope="col" data-field="image" data-sortable="false"><?= lang('image'); ?></th>
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
                    <h5 class="modal-title"><?= lang('edit_coin_store'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" id="edit-form" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type='hidden' name="edit_id" id="edit-id" value="" />
                            <input type="hidden" name='image_url' id="image-url" value="" />
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('title'); ?> <small class="text-danger">*</small></label>
                                    <input id="edit-title" name="title" type="text" class="form-control" required placeholder="<?= lang('title'); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('coins'); ?> <small class="text-danger">*</small></label>
                                    <input id="edit-coins" name="coins" type="text" class="form-control" required placeholder="<?= lang('coins'); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('product_id'); ?> <small class="text-danger">*</small></label>
                                    <input id="edit-product-id" name="product_id" type="text" class="form-control" required placeholder="<?= lang('product_id'); ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('type'); ?></label>
                                    <select name="type" id="edit-type" class="form-control">
                                        <option value=""><?= lang('select_type'); ?></option>
                                        <option value="1"><?= lang('ads'); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('description'); ?> <small class="text-danger">*</small></label>
                                    <textarea id="edit-description" name="description" class="form-control" required placeholder="<?= lang('description'); ?>"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('image'); ?></label>
                                    <input id="update_file" name="edit_file" type="file" accept="image/*" class="form-control">
                                    <small class="text-danger"><?= lang('svg_image_type_supported'); ?></small>
                                    <p style="display: none" id="up_img_error_msg" class="alert alert-danger"></p>
                                </div>
                            </div>
                            <div class="mt-1 mb-3" style="display: none;" id="image-tag-div">
                                <img src='' height=50, width=50 id="edit-image-tag">
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

    <div class="modal fade" tabindex="-1" role="dialog" id="updateStatusModal">
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
                        <form method="post" id="update-status-form" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type='hidden' name="edit_id" id="edit-coin-store-id" value="" />

                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12">
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
                                <input name="btnupdatestatus" type="submit" value="<?= lang('save_changes'); ?>" class="<?= BUTTON_CLASS ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php base_url() . include 'footer.php'; ?>

</body>
<script type="text/javascript">
    $('[data-plugin="switchery"]').each(function(index, element) {
        var init = new Switchery(element, {
            size: 'small',
            color: '#1abc9c',
            secondaryColor: '#f1556c'
        });
    });

    $('#filter_btn').on('click', function(e) {
        $('#slider_list').bootstrapTable('refresh');
    });
    $('#delete_multiple_coin_store').on('click', function(e) {
        var base_url = "<?php echo base_url(); ?>";
        sec = 'tbl_coin_store';
        is_image = 1;
        table = $('#coin_store_list');
        delete_button = $('#delete_multiple_coin_store');
        selected = table.bootstrapTable('getSelections');
        ids = "";
        $.each(selected, function(i, e) {
            ids += e.id + ",";
        });
        ids = ids.slice(0, -1);
        if (ids == "") {
            alert("<?= lang('please_select_data_to_delete'); ?>");
        } else {
            if (confirm("<?= lang('sure_to_delete_all_data'); ?>")) {
                $.ajax({
                    type: "POST",
                    url: base_url + 'delete_multiple',
                    data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                    beforeSend: function() {
                        delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                    },
                    success: function(result) {
                        if (result == 1) {
                            alert("<?= lang('data_deleted_successfully'); ?>");
                        } else {
                            alert("<?= lang('not_delete_data_try_again'); ?>");
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
            $('#edit-id').val(row.id);
            $('#edit-type').val(row.type);
            $('#image-url').val(row.image_url);
            $('#edit-title').val(row.title);
            $('#edit-coins').val(row.coins);
            $('#edit-product-id').val(row.product_id);
            if (row.image_url) {
                $('#image-tag-div').show().find('#edit-image-tag').attr('src', row.image_url);
            } else {
                $('#image-tag-div').hide().find('#edit-image-tag').attr('src', '');
            }
            $('#edit-description').val(row.description);
        },
        'click .status-update': function(e, value, row, index) {
            $('#edit-coin-store-id').val(row.id);
            if (row.status_db == 1) {
                // $("input[name=status][value=0]").prop('checked', false);
                $("input[name=status][value=1]").prop('checked', true);
            } else {
                // $("input[name=status][value=1]").prop('checked', false);
                $("input[name=status][value=0]").prop('checked', true);
            }
        }

    };
</script>

<script type="text/javascript">
    $(document).on('click', '.delete-data', function() {
        if (confirm("<?= lang('sure_to_delete_data'); ?>")) {
            var base_url = "<?php echo base_url(); ?>";
            id = $(this).data("id");
            image = $(this).data("image");
            $.ajax({
                url: base_url + 'delete-coin-store-data',
                type: "POST",
                data: 'id=' + id + '&image_url=' + image,
                success: function(result) {
                    if (result) {
                        $('#coin_store_list').bootstrapTable('refresh');
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
</script>

</html>