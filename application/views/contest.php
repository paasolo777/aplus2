<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('create_and_manage_contest'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('create_and_manage_contest'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('create_contest'); ?></h4>
                                    </div>

                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                                            <div class="row">
                                                <?php if (is_language_mode_enabled()) { ?>
                                                    <div class="form-group col-sm-12 col-md-4">
                                                        <label class="control-label"><?= lang('language'); ?> <small class="text-danger">*</small></label>
                                                        <select id="language_id" name="language_id" class="form-control" required>
                                                            <option value=""><?= lang('select_language'); ?></option>
                                                            <?php foreach ($language as $lang) { ?>
                                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4">
                                                        <label class="control-label"><?= lang('name'); ?> <small class="text-danger">*</small></label>
                                                        <input name="name" type="text" class="form-control" placeholder="<?= lang('enter_contest_name'); ?>" required>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-md-4">
                                                        <label class="control-label"><?= lang('image'); ?> <small class="text-danger">*</small></label>
                                                        <input id="file" name="file" type="file" accept="image/*" required class="form-control">
                                                        <small class="text-danger"><?= lang('image_type_supported'); ?></small>
                                                        <p style="display: none" id="img_error_msg" class="badge badge-danger"></p>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="form-group col-md-6 col-sm-12">
                                                        <label class="control-label"><?= lang('name'); ?> <small class="text-danger">*</small></label>
                                                        <input name="name" type="text" class="form-control" placeholder="Enter Contest Name" required>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-12">
                                                        <label class="control-label"><?= lang('image'); ?> <small class="text-danger">*</small></label>
                                                        <input id="file" name="file" type="file" accept="image/*" required class="form-control">
                                                        <small class="text-danger"><?= lang('image_type_supported'); ?></small>
                                                        <p style="display: none" id="img_error_msg" class="badge badge-danger"></p>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('contest_start_and_end_date'); ?> <small class="text-danger">*</small></label>
                                                    <input type="text" id="date" name="date" required class="form-control">
                                                    <input type="hidden" id="start_date" name="start_date" required="" value="">
                                                    <input type="hidden" id="end_date" name="end_date" required="" value="">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label class="control-label"><?= lang('entry_fee_points'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" id="entry" name="entry" required class="form-control" placeholder="<?= lang('these_points_will_deducted_from_users_wallet'); ?>" min='0'>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="top_users" class="control-label"><?= lang('distribute_prize_to_top_users'); ?> <small class="text-danger">*</small></label>
                                                    <input type="number" id="top_users" name="top_users" required class="form-control" placeholder="<?= lang('for_instance_top_users_will_gettong_prize'); ?>" min='1'>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-12">
                                                    <label for="description" class="control-label"><?= lang('description'); ?> <small class="text-danger">*</small></label>
                                                    <textarea id="description" name="description" required class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row" id="top_winner">

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
                                        <h4><?= lang('contests'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                    </div>

                                    <div class="card-body">
                                        <?php if (is_language_mode_enabled()) { ?>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <select id="filter_language" class="form-control" required>
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
                                            <?php if (has_permissions('delete', 'manage_contest')) { ?>
                                                <button class="btn btn-danger" id="delete_multiple_contests" title="<?= lang('delete_selected_contests'); ?>"><em class='fa fa-trash'></em></button>
                                            <?php } ?>
                                        </div>
                                        <table aria-describedby="mydesc" class='table-striped' id='contest_list' data-toggle="table" data-url="<?= base_url() . 'Table/contest' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "contest-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="status" data-sortable="false"><?= lang('status'); ?></th>
                                                    <th scope="col" data-field="name" data-sortable="true"><?= lang('name'); ?></th>
                                                    <th scope="col" data-field="start_date" data-sortable="true"><?= lang('start_date'); ?></th>
                                                    <th scope="col" data-field="end_date" data-sortable="true"><?= lang('end_date'); ?></th>
                                                    <th scope="col" data-field="image" data-sortable="false"><?= lang('image'); ?></th>
                                                    <th scope="col" data-field="description" data-sortable="false" data-visible="false"><?= lang('description'); ?></th>
                                                    <th scope="col" data-field="entry" data-sortable="true"><?= lang('entry'); ?></th>
                                                    <th scope="col" data-field="top_users" data-sortable="true"><?= lang('top_users'); ?></th>
                                                    <th scope="col" data-field="participants" data-sortable="true"><?= lang('participants'); ?></th>
                                                    <th scope="col" data-field="total_question" data-sortable="true"><?= lang('questions'); ?></th>
                                                    <th scope="col" data-field="prize_status" data-sortable="false"><?= lang('prize_status'); ?></th>
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
                    <h5 class="modal-title"><?= lang('edit_contest'); ?></h5>
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
                                        <select id="edit_language_id" name="language_id" class="form-control" required>
                                            <?php foreach ($language as $lang) { ?>
                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('name'); ?> <small class="text-danger">*</small></label>
                                    <input type="text" name="name" id="update_name" placeholder="<?= lang('enter_contest_name'); ?>" class='form-control' required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label for="update_date" class="control-label"><?= lang('contest_start_and_end_date'); ?> <small class="text-danger">*</small></label>
                                    <input type="text" id="update_date" name="date" required class="form-control">
                                    <input type='hidden' name="start_date" id="update_start_date" value='' />
                                    <input type='hidden' name="end_date" id="update_end_date" value='' />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('description'); ?> <small class="text-danger">*</small></label>
                                    <textarea name="description" id="update_description" placeholder="<?= lang('short_description'); ?>" class='form-control' required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label for="image" class="control-label"><?= lang('image'); ?> <small><?= lang('leave_it_blank'); ?></small> </label>
                                    <input type="file" name="update_file" id="update_file" class="form-control" accept="image/*" aria-required="true">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-sm-12">
                                    <label for="entry" class="control-label"><?= lang('entry_fee_points'); ?> <small class="text-danger">*</small></label>
                                    <input type="number" id="update_entry" name="entry" required class="form-control" placeholder="These points will be deducted from users wallet" min='0'>
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
        $('#delete_multiple_contests').on('click', function(e) {
            var base_url = "<?php echo base_url(); ?>";
            sec = 'tbl_contest';
            is_image = 1;
            table = $('#contest_list');
            delete_button = $('#delete_multiple_contests');
            selected = table.bootstrapTable('getSelections');
            ids = "";
            $.each(selected, function(i, e) {
                ids += e.id + ",";
            });
            ids = ids.slice(0, -1);
            if (ids == "") {
                alert("<?= lang('please_select_contest_to_delete'); ?>");
            } else {
                if (confirm("<?= lang('sure_to_delete_all_contests'); ?>")) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'delete_multiple',
                        data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                        beforeSend: function() {
                            delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                        },
                        success: function(result) {
                            if (result == 1) {
                                alert("<?= lang('contest_deleted_successfully'); ?>");
                            } else {
                                alert("<?= lang('not_delete_contest_try_again'); ?>");
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
            if (confirm("<?= lang('sure_to_delete_contest_releated_data_deleted'); ?>")) {
                var base_url = "<?php echo base_url(); ?>";
                id = $(this).data("id");
                image = $(this).data("image");
                $.ajax({
                    url: base_url + 'delete_contest',
                    type: "POST",
                    data: 'id=' + id + '&image_url=' + image,
                    success: function(result) {
                        if (result) {
                            $('#contest_list').bootstrapTable('refresh');
                        } else {
                            var PERMISSION_ERROR_MSG = "<?= lang(PERMISSION_ERROR_MSG); ?>";
                            ErrorMsg(PERMISSION_ERROR_MSG);
                        }
                    }
                });
            }
        });
    </script>

    <script>
        window.actionEvents = {
            'click .edit-data': function(e, value, row, index) {
                $('#edit_id').val(row.id);
                $('#image_url').val(row.image_url);
                $('#update_name').val(row.name);
                $('#edit_language_id').val(row.language_id);
                $('#update_description').val(row.description);
                $('#update_start_date').val(row.start_date);
                $('#update_end_date').val(row.end_date);
                $('#update_entry').val(row.entry);
                $('#update_date').data('daterangepicker').setStartDate(row.start_date);
                $('#update_date').data('daterangepicker').setEndDate(row.end_date);

            },
            'click .edit-status': function(e, value, row, index) {
                $('#update_id').val(row.id);
                $("input[name=status][value=1]").prop('checked', true);
                if ($(row.status).text() == 'Deactive')
                    $("input[name=status][value=0]").prop('checked', true);
            }
        };
    </script>

    <script>
        $('#top_users').on('blur input', function() {
            var no_of = $(this).val();
            var myHtml = "";

            $('div#top_winner').empty();
            for (var i = 1; i <= no_of; i++) {
                myHtml = "<div class='form-group col-md-2 col-sm-4 col-xs-12'>";
                myHtml += "<input name='points[]' type='number' placeholder='" + i + " <?= lang('winner_prize'); ?>' min='0' required class='form-control'>";
                myHtml += "<input name='winner[]' type='hidden' value=" + i + ">";
                myHtml += "<div>";
                for (var j = 6; j <= no_of; j++) {
                    if (i == j) {
                        myHtml += "<br/>";
                    }
                }
                $('div#top_winner').append(myHtml);
            }
        });
    </script>

    <script>
        $('#date, #update_date').daterangepicker({
            "showDropdowns": true,
            timePicker: true,
            alwaysShowCalendars: true,
            ranges: {
                'Today': [moment(), moment()],
                'Tommorow': [moment().add(1, 'days'), moment().add(1, 'days')],
                'Coming 7 Days': [moment(), moment().add(6, 'days')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
            },
            startDate: moment(),
            endDate: moment().add(6, 'days'),
            "locale": {
                "format": "DD/MM/YYYY h:m:s A",
                "separator": " - "
            }
        });
        $('#update_date').daterangepicker({
            "showDropdowns": true,
            alwaysShowCalendars: true,
            timePicker: true,
            ranges: {
                'Today': [moment(), moment()],
                'Tommorow': [moment().add(1, 'days'), moment().add(1, 'days')],
                'Coming 7 Days': [moment(), moment().add(6, 'days')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
            },
            "locale": {
                "format": "YYYY/MM/DD h:m:s A",
                "separator": " - "
            }
        });
        var drp = $('#date').data('daterangepicker');
        $('#start_date').val(drp.startDate.format('YYYY-MM-DD h:m:s A'));
        $('#end_date').val(drp.endDate.format('YYYY-MM-DD h:m:s A'));
    </script>
    <script>
        $('#date').on('apply.daterangepicker', function(ev, picker) {
            var drp = $('#date').data('daterangepicker');
            $('#start_date').val(drp.startDate.format('YYYY-MM-DD HH:mm:ss'));
            $('#end_date').val(drp.endDate.format('YYYY-MM-DD HH:mm:ss'));
        });
        $('#update_date').on('apply.daterangepicker', function(ev, picker) {
            var udrp = $('#update_date').data('daterangepicker');
            $('#update_start_date').val(udrp.startDate.format('YYYY-MM-DD HH:mm:ss'));
            $('#update_end_date').val(udrp.endDate.format('YYYY-MM-DD HH:mm:ss'));
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
    </script>

    <script type="text/javascript">
        function queryParams(p) {
            return {
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search,
                language_id: $('#filter_language').val()
            };
        }
        $('#filter_btn').on('click', function(e) {
            $('#contest_list').bootstrapTable('refresh');
        });
    </script>
</body>

</html>