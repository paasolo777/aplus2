<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('create_and_manage_contest_prize'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('create_and_manage_contest_prize'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= lang('create_contest_prize'); ?></h4>
                                    </div>

                                    <div class="card-body">
                                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                            <input type="hidden" id="contest_id" name="contest_id" value="<?= end($this->uri->segments) ?>" />
                                            <div class="form-group row">
                                                <div class="col-md-5 col-sm-12">
                                                    <?php
                                                    $max = ($max) ? ($max[0]->total + 1) : 1;
                                                    ?>
                                                    <label class="control-label"><?= lang('top_winner'); ?></label>
                                                    <input type="number" name="winner" value="<?= $max ?>" required class="form-control" readonly>
                                                </div>
                                                <div class="col-md-5 col-sm-12">
                                                    <label class="control-label"><?= lang('prize'); ?></label>
                                                    <input type="number" name="points" min="0" required class="form-control">
                                                </div>
                                                <div class="col-md-2 col-sm-12">
                                                    <label class="control-label">&nbsp;</label>
                                                    <input type="submit" name="btnadd" value="<?= lang('submit'); ?>" class="<?= BUTTON_CLASS ?> form-control" />
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
                                        <h4><?= lang('contest_prize'); ?> <small><?= lang('view_update_delete'); ?></small></h4>
                                    </div>

                                    <div class="card-body">
                                        <table aria-describedby="mydesc" class='table-striped' id='prize_list' data-toggle="table" data-url="<?= base_url() . 'Table/contest_prize' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "contest-prize-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="name" data-sortable="false"><?= lang('name'); ?></th>
                                                    <th scope="col" data-field="top_winner" data-sortable="true"><?= lang('top_winner'); ?></th>
                                                    <th scope="col" data-field="points" data-sortable="true"><?= lang('coins'); ?></th>
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
                    <h5 class="modal-title"><?= lang('edit_contest_prize'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                            <input type='hidden' name="edit_id" id="edit_id" value="" />

                            <div class="form-group">
                                <label for="winner"><?= lang('top_winner'); ?></label>
                                <input type="number" name="winner" id="winner" readonly class='form-control' required>
                            </div>
                            <div class="form-group">
                                <label for="points"><?= lang('prize'); ?></label>
                                <input type="number" name="points" id="points" class='form-control' min="0" required>
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
        window.actionEvents = {
            'click .edit-data': function(e, value, row, index) {
                $('#edit_id').val(row.id);
                $('#winner').val(row.top_winner);
                $('#points').val(row.points);
            }
        };
    </script>

    <script type="text/javascript">
        $(document).on('click', '.delete-data', function() {
            if (confirm("<?= lang('sure_to_delete_prize'); ?>")) {
                var base_url = "<?php echo base_url(); ?>";
                id = $(this).data("id");
                $.ajax({
                    url: base_url + 'delete_contest_prize',
                    type: "POST",
                    data: 'id=' + id,
                    success: function(result) {
                        if (result) {
                            $('#prize_list').bootstrapTable('refresh');
                            window.location.reload();
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
                "contest_id": $('#contest_id').val(),
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