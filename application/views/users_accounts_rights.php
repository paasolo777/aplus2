<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('user_account_and_rights'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('user_account_and_rights'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="form-group col-md-4 col-sm-6 col-12">
                                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <label class="control-label"><?= lang('username'); ?> <small class="text-danger">*</small></label>
                                                            <input type="text" name="username" class="form-control" required placeholder="<?= lang('enter_username'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <label class="control-label"><?= lang('password'); ?> <small class="text-danger">*</small></label>
                                                            <input type="password" name="password" class="form-control" required placeholder="<?= lang('enter_password'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12">
                                                            <label class="control-label"><?= lang('role'); ?> <small class="text-danger">*</small></label>
                                                            <select name="role" class="form-control" required>
                                                                <option value=""><?= lang('select_role'); ?></option>
                                                                <option value="editor"><?= lang('editor'); ?></option>
                                                                <option value="admin"><?= lang('admin'); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row float-right">
                                                        <div class="form-group col-12">
                                                            <input type="submit" name="btnadd" class="<?= BUTTON_CLASS ?> btn-block" value="<?= lang('submit'); ?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-8 col-sm-6 col-12">
                                                    <?php $actions = ['create', 'read', 'update', 'delete']; ?>
                                                    <table class="table tableres table-responsive permission-table" aria-describedby="mydesc">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><?= lang('module_permissions'); ?></th>
                                                                <?php foreach ($actions as $row) { ?>
                                                                    <th scope="col"><?= ucfirst($row) ?></th>
                                                                <?php }
                                                                ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($system_modules as $key => $value) {
                                                                $flag = 0;
                                                            ?>
                                                                <tr>
                                                                    <td><?= ucwords(str_replace('_', ' ', $key)) ?></td>
                                                                    <?php
                                                                    for ($i = 0; $i < count($actions); $i++) {
                                                                        $index = array_search($actions[$i], $value);
                                                                        if ($index !== false) {
                                                                    ?>
                                                                            <td>
                                                                                <input type="checkbox" checked name="<?= 'permissions[' . $key . '][' . $value[$index] . ']' ?>" data-plugin="switchery">
                                                                            </td>
                                                                        <?php } else { ?>
                                                                            <td></td>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </tr>
                                                            <?php } ?>

                                                        </tbody>
                                                    </table>
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
                                        <h4><?= lang('user_account_and_rights'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                    </div>
                                    <div class="card-body">
                                        <table aria-describedby="mydesc" class='table-striped' id='user_account_list' data-toggle="table" data-url="<?= base_url() . 'Table/user_account' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar1" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="auth_id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "user-account-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="id" data-sortable="true" data-align="center"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="auth_username" data-sortable="true"><?= lang('username'); ?></th>
                                                    <th scope="col" data-field="role" data-sortable="true"><?= lang('role'); ?></th>
                                                    <th scope="col" data-field="created" data-sortable="true"><?= lang('date_created'); ?></th>
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
                    <h5 class="modal-title">Edit User Accounts and Rights</h5>
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
                                <div class="form-group col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="control-label"><?= lang('username'); ?> <small class="text-danger">*</small></label>
                                            <input type="text" id="username" name="username" class="form-control" required placeholder="<?= lang('enter_username'); ?>">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="control-label"><?= lang('password'); ?> <small><?= lang('leave_it_blank'); ?></small> <small class="text-danger">*</small></label>
                                            <input type="password" name="password" class="form-control" placeholder="<?= lang('enter_password'); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label class="control-label"><?= lang('role'); ?></label>
                                            <select id="role" name="role" class="form-control" required>
                                                <option value="editor"><?= lang('editor'); ?></option>
                                                <option value="admin"><?= lang('admin'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12" id="edit_user">

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

    <!-- jQuery -->

    <script type="text/javascript">
        $('[data-plugin="switchery"]').each(function(index, element) {
            var init = new Switchery(element, {
                size: 'small',
                color: '#1abc9c',
                secondaryColor: '#f1556c'
            });
        });
    </script>

    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
        window.actionEvents = {
            'click .edit-data': function(e, value, row, index) {
                var edit_id = row.id;
                $('#edit_id').val(edit_id);
                $('#username').val(row.auth_username);
                $('#role').val(row.role);
                $.ajax({
                    url: base_url + 'edit_accounts_rights',
                    type: "POST",
                    data: 'id=' + edit_id,
                    success: function(result) {
                        $('#edit_user').html(result);
                    }
                });
            }
        };
    </script>

    <script type="text/javascript">
        $(document).on('click', '.delete-data', function() {
            if (confirm("<?= lang('sure_to_delete_user_account_and_rights') ?>")) {
                var base_url = "<?php echo base_url(); ?>";
                id = $(this).data("id");
                $.ajax({
                    url: base_url + 'delete_accounts_rights',
                    type: "POST",
                    data: 'id=' + id,
                    success: function(result) {
                        if (result) {
                            $('#user_account_list').bootstrapTable('refresh');
                        } else {
                            alert("<?= lang('not_delete_user_account_and_rights_try_again') ?>");
                        }
                    }
                });
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
                search: p.search
            };
        }
    </script>

</body>

</html>