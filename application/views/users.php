<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('user_details'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('user_details'); ?> <small><?= lang('view_update'); ?> </small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table aria-describedby="mydesc" class='table-striped' id='user_list' data-toggle="table" data-url="<?= base_url() . 'Table/users' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-maintain-selected="true" data-pagination-successively-size="3" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "user-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="id" data-sortable="true" data-align="center"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="profile" data-sortable="false"><?= lang('profile'); ?></th>
                                                    <th scope="col" data-field="name" data-sortable="true"><?= lang('name'); ?></th>
                                                    <th scope="col" data-field="email" data-sortable="true"><?= lang('email'); ?></th>
                                                    <th scope="col" data-field="mobile" data-sortable="true"><?= lang('mobile'); ?></th>
                                                    <th scope="col" data-field="type" data-sortable="false"><?= lang('type'); ?></th>
                                                    <th scope="col" data-field="coins" data-sortable="true"><?= lang('coins'); ?></th>
                                                    <th scope="col" data-field="refer_code" data-sortable="true" data-visible="false"><?= lang('refer_code'); ?></th>
                                                    <th scope="col" data-field="friends_code" data-sortable="true" data-visible="false"><?= lang('friends_code'); ?></th>
                                                    <th scope="col" data-field="remove_ads" data-sortable="true" data-visible="false" data-align="center"><?= lang('remove_ads'); ?></th>
                                                    <th scope="col" data-field="fcm_id" data-sortable="true" data-visible="false"><?= lang('fcm_id'); ?></th>
                                                    <th scope="col" data-field="status" data-sortable="false"><?= lang('status'); ?></th>
                                                    <th scope="col" data-field="date_registered" data-sortable="true"><?= lang('register_date'); ?></th>
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
                    <h5 class="modal-title"><?= lang('update_status'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type='hidden' name="edit_id" id="edit_id" value="" />
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
                                <input name="btnupdate" type="submit" value="<?= lang('save_changes'); ?>" class="<?= BUTTON_CLASS ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //---- -->
    <div class="modal fade" tabindex="-1" role="dialog" id='coinsmodal'>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('add_coins_to_user'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type='hidden' name="user_id_coin" id="user_id_coin" value='' />
                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('coins'); ?></label><br />
                                    <div id="status" class="btn-group">
                                        <input class="form-control" type="number" name="coins" id="coins" value="" min=1 placeholder="<?= lang('enter_coins'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('close'); ?></button>
                                <input name="btnupdateCoins" type="submit" value="<?= lang('save_changes'); ?>" class="<?= BUTTON_CLASS ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- //------------------- -->



    <?php base_url() . include 'footer.php'; ?>

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

    <script type="text/javascript">
        window.actionEvents = {
            'click .edit-data': function(e, value, row, index) {
                $('#edit_id').val(row.id);
                $("input[name=status][value=1]").prop('checked', true);
                if ($(row.status).text() == 'Deactive')
                    $("input[name=status][value=0]").prop('checked', true);
            },
            'click .admin-coin': function(e, value, row, index) {
                $('#user_id_coin').val(row.id);
                // $('#coins').val(row.coins);
            }
        };
    </script>

</body>

</html>