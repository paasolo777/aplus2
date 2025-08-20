<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('payment_requests'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('payment_requests'); ?> <small> <?= lang('users_payment_requests_details'); ?></small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <input type="hidden" name="multiple_ids" id="multiple_ids" />
                                            <div class="row justify-content-center">
                                                <div class="form-group col-md-4 col-lg-3 col-sm-12">
                                                    <a href="javascript:void(0)" class="btn btn-warning form-control" id="get_multiple_data_btn"><?= lang('get_selected_requested'); ?></a>
                                                </div>
                                                <div class="form-group col-md-3 col-lg-3 col-sm-12">
                                                    <select id="multiple_status" name='status' class='form-control' required>
                                                        <option value=''><?= lang('select_status'); ?></option>
                                                        <option value='0'><?= lang('pending'); ?></option>
                                                        <option value='1'><?= lang('completed'); ?></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3 col-lg-2 col-sm-12">
                                                    <input type="submit" name="btnadd" value="<?= lang('submit'); ?>" class="<?= BUTTON_CLASS ?> form-control" />
                                                </div>
                                            </div>
                                        </form>
                                        <hr>

                                        <input type="hidden" id="user_id" name="user_id" value="<?= $this->uri->segment(2) ?>" />
                                        <table aria-describedby="mydesc" class='table-striped' id='requests_list' data-toggle="table" data-url="<?= base_url() . 'Table/payment_requests_list' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "leaderboard-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="name" data-sortable="true"><?= lang('name'); ?></th>
                                                    <th scope="col" data-field="uid" data-sortable="true" data-visible="false"><?= lang('uid'); ?></th>
                                                    <th scope="col" data-field="payment_type" data-sortable="true"><?= lang('payment_type'); ?></th>
                                                    <th scope="col" data-field="payment_address" data-sortable="true"><?= lang('payment_address'); ?></th>
                                                    <th scope="col" data-field="payment_amount" data-sortable="true"><?= lang('payment_amount'); ?></th>
                                                    <th scope="col" data-field="coin_used" data-sortable="true"><?= lang('coin_used'); ?></th>
                                                    <th scope="col" data-field="details" data-sortable="false"><?= lang('details'); ?></th>
                                                    <th scope="col" data-field="status" data-sortable="false"><?= lang('status'); ?></th>
                                                    <th scope="col" data-field="date" data-sortable="true"><?= lang('date'); ?></th>
                                                    <th scope="col" data-field="status_date" data-sortable="true"><?= lang('status_date'); ?></th>
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
                    <h5 class="modal-title"><?= lang('edit_payment_request'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type='hidden' name="edit_id" id="edit_id" value="" />
                            <input type='hidden' name="edit_user_id" id="edit_user_id" value="" />
                            <input type="hidden" name="uid" id="uid" />
                            <input type='hidden' name="coin_used" id="coin_used" value='' />
                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('details'); ?></label>
                                    <textarea id="details" name="details" class="form-control" required></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 col-sm-12">
                                    <label class="control-label"><?= lang('status'); ?></label><br />
                                    <div id="status" class="btn-group">
                                        <label class="btn btn-warning">
                                            <input type="radio" name="status" value="0"> <?= lang('pending'); ?>
                                        </label>
                                        <label class="btn btn-success">
                                            <input type="radio" name="status" value="1"> <?= lang('completed'); ?>
                                        </label>
                                        <label class="btn btn-danger">
                                            <input type="radio" name="status" value="2"> <?= lang('invalid_details'); ?>
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

    <?php base_url() . include 'footer.php'; ?>

    <script type="text/javascript">
        $('#get_multiple_data_btn').on('click', function(e) {
            table = $('#requests_list');
            selected = table.bootstrapTable('getSelections');
            ids = "";
            $.each(selected, function(i, e) {
                ids += e.id + ",";
            });
            ids = ids.slice(0, -1);
            $('#multiple_ids').val(ids);
        });
    </script>

    <script type="text/javascript">
        window.actionEvents = {
            'click .edit-data': function(e, value, row, index) {
                $('#edit_id').val(row.id);
                $("input[name=status][value=" + row.status1 + "]").prop('checked', true);
                $("#details").val(row.details);
                $('#coin_used').val(row.coin_used);
                $('#edit_user_id').val(row.user_id);
                $('#uid').val(row.uid);
            }
        };
    </script>
    <script type="text/javascript">
        function queryParams(p) {
            return {
                'user_id': $('#user_id').val(),
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