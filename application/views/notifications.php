<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('send_notifications'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('send_notifications_for_users'); ?> <small><?= lang('to_all_or_selected'); ?></small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <div class="card-body">
                                                <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                    <textarea id="selected_list" name="selected_list" style='display:none'></textarea>
                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <label class="control-label"><?= lang('select_users'); ?></label>
                                                            <select name='users' id='users' class='form-control'>
                                                                <option value='all'><?= lang('all'); ?></option>
                                                                <option value='selected'><?= lang('selected_only'); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <label class="control-label"><?= lang('type'); ?> <small class="text-danger">*</small></label>
                                                            <select name="type" id="type" class="form-control" required>
                                                                <option value="default"><?= lang('default'); ?></option>
                                                                <option value="main-category"><?= lang('quiz_zone_category'); ?></option>
                                                                <option value="fun-n-learn-category"><?= lang('fun_n_learn_category'); ?></option>
                                                                <option value="guess-the-word-category"><?= lang('guess_the_word_category'); ?></option>
                                                                <option value="audio-question-category"><?= lang('audio_questions_category'); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <label class="control-label"><?= lang('title'); ?> <small class="text-danger">*</small></label>
                                                            <input type="text" name="title" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <label class="control-label"><?= lang('message'); ?> <small class="text-danger">*</small></label>
                                                            <textarea id="message" name="message" required class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <input name="include_image" id="include_image" type="checkbox"> <?= lang('include_image'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <input type="file" name="file" id="file" accept="image/*" style='display:none;' class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="row float-right">
                                                        <div class="form-group col-md-12 col-sm-12">
                                                            <input type="submit" name="btnadd" class="<?= BUTTON_CLASS ?> btn-block" value="<?= lang('submit'); ?>" />
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <div class="card-body">
                                                <button type='button' id='get_selections' class='<?= BUTTON_CLASS ?>'><?= lang('get_selected_users'); ?></button>
                                                <div id="toolbar">
                                                    <select name="filter_status" id="filter_status" class="form-control">
                                                        <option value=""><?= lang('all'); ?></option>
                                                        <option value="1"><?= lang('active'); ?></option>
                                                        <option value="0"><?= lang('deactive'); ?></option>
                                                    </select>
                                                </div>
                                                <table aria-describedby="mydesc" class='table-striped' id='users_list' data-toggle="table" data-url="<?= base_url() . 'Table/users' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-fixed-columns="true" data-fixed-number="1" data-fixed-right-number="1" data-trim-on-search="false" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-mobile-responsive="true" data-maintain-selected="true" data-show-export="false" data-export-types='["txt","excel"]' data-export-options='{ "fileName": "user-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams_1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" data-field="state" data-events="inputEvent" data-checkbox="true"></th>
                                                            <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                            <th scope="col" data-field="name" data-sortable="true"><?= lang('name'); ?></th>
                                                            <th scope="col" data-field="email" data-sortable="true"><?= lang('email'); ?></th>
                                                            <th scope="col" data-field="status" data-sortable="false"><?= lang('status'); ?></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('notifications'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="toolbar1">
                                            <?php if (has_permissions('delete', 'send_notification')) { ?>
                                                <button class="btn btn-danger" id="delete_multiple_notifications" title="<?= lang('delete_selected_notifications'); ?>"><em class='fa fa-trash'></em></button>
                                            <?php } ?>
                                        </div>
                                        <table aria-describedby="mydesc" class='table-striped' id='notification_list' data-toggle="table" data-url="<?= base_url() . 'Table/notification' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar1" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-sort-name="id" data-sort-order="desc" data-mobile-responsive="true" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "notification-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="title" data-sortable="true"><?= lang('title'); ?></th>
                                                    <th scope="col" data-field="message" data-sortable="true"><?= lang('message'); ?></th>
                                                    <th scope="col" data-field="image" data-sortable="false"><?= lang('image'); ?></th>
                                                    <th scope="col" data-field="users" data-sortable="true" data-visible="false"><?= lang('users'); ?></th>
                                                    <th scope="col" data-field="type" data-sortable="true"><?= lang('type'); ?></th>
                                                    <th scope="col" data-field="type_id" data-sortable="true"><?= lang('main_category_id'); ?></th>
                                                    <th scope="col" data-field="date_sent" data-sortable="true"><?= lang('date_sent'); ?></th>
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


    <?php base_url() . include 'footer.php'; ?>

    <!-- jQuery -->


    <script type="text/javascript">
        function queryParams_1(p) {
            return {
                "status": $('#filter_status').val(),
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }

        function queryParams(p) {
            return {
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }
    </script>

    <script type="text/javascript">
        $table = $('#users_list');
        var checkedID = [];
        window.inputEvent = {
            'change :checkbox': function(e, value, row, index) {
                row.state = $(e.target).prop('checked')
                if ($(e.target).is(":checked")) {
                    checkedID.push(row.id);
                } else {
                    checkedID = checkedID.filter(function(data) {
                        return data !== row.id;
                    });
                }
            }
        }
        $(function() {
            $('#get_selections').click(function() {
                selected = $table.bootstrapTable('getSelections');
                var arr = Object.values(selected);
                var i;
                var final_selection = [];
                for (i = 0; i < arr.length; ++i) {
                    final_selection.push(arr[i]['id']);
                }
                let mArray = [...final_selection, ...checkedID];
                let mergedArr = [...new Set(mArray)]
                $('textarea#selected_list').val(final_selection);
            });


            $('#users_list').on('load-success.bs.table', function(e, data, status) {
                $.each(checkedID, function(element, ID) {
                    let row = data.rows.find(function(row) {
                        return ID == row.id;
                    });
                    let index = data.rows.indexOf(row);
                    if (index > -1) {
                        row.state = true;
                        $('#users_list').bootstrapTable('updateRow', {
                            index: index,
                            row: row
                        })
                    }
                });
            })
        });
    </script>

    <script type="text/javascript">
        $('#delete_multiple_notifications').on('click', function(e) {
            var base_url = "<?php echo base_url(); ?>";
            sec = 'tbl_notifications';
            is_image = 1;
            table = $('#notification_list');
            delete_button = $('#delete_multiple_notifications');
            selected = table.bootstrapTable('getSelections');
            ids = "";
            $.each(selected, function(i, e) {
                ids += e.id + ",";
            });
            ids = ids.slice(0, -1);
            if (ids == "") {
                alert("<?= lang('please_select_notification_to_delete'); ?>");
            } else {
                if (confirm("<?= lang('sure_to_delete_all_notification'); ?>")) {
                    $.ajax({
                        type: "POST",
                        url: base_url + 'delete_multiple',
                        data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                        beforeSend: function() {
                            delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                        },
                        success: function(result) {
                            if (result == 1) {
                                alert("<?= lang('notification_deleted_successfully'); ?>");
                            } else {
                                alert("<?= lang('not_delete_notification_try_again'); ?>");
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
        window.actionEvents = {};
    </script>

    <script type="text/javascript">
        $(document).on('click', '.delete-data', function() {
            if (confirm("<?= lang('sure_to_delete_notification'); ?>")) {
                var base_url = "<?php echo base_url(); ?>";
                id = $(this).data("id");
                image = $(this).data("image");
                $.ajax({
                    url: base_url + 'delete_notification',
                    type: "POST",
                    data: 'id=' + id + '&image=' + image,
                    success: function(result) {
                        if (result) {
                            $('#notification_list').bootstrapTable('refresh');
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
        $("#filter_status").change(function() {
            $('#users_list').bootstrapTable('refresh');
        });
        $("#include_image").change(function() {
            if (this.checked) {
                $('#file').show('fast');
            } else {
                $('#file').val('');
                $('#file').hide('fast');
            }
        });
    </script>

</body>

</html>