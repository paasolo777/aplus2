<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('in_app_users'); ?>| <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('in_app_users'); ?> <small><?= lang('user_in_app_details'); ?></small></h1>
                        <?php
                        if ($this->uri->segment(2)) {
                        ?>
                            <div class="section-header-breadcrumb">
                                <a href="<?= base_url('users') ?>" class="footer_dev_link text-decoration-none">
                                    <h6>
                                        <i class="fa fa-arrow-left"></i>
                                        <?= lang('back'); ?>
                                    </h6>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table aria-describedby="mydesc" class='table-striped' id='in_app_user_list' data-toggle="table" data-url="<?= base_url() . 'Table/in_app_user_list' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "in-app-user-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="name" data-sortable="true"><?= lang('name'); ?></th>
                                                    <th scope="col" data-field="pay_from" data-sortable="true" data-formatter="fromFormatter"><?= lang('from'); ?></th>
                                                    <th scope="col" data-field="transaction_id" data-sortable="true"><?= lang('transaction_id'); ?></th>
                                                    <th scope="col" data-field="product_id" data-sortable="true"><?= lang('product_id'); ?></th>
                                                    <th scope="col" data-field="amount" data-sortable="true"><?= lang('coins'); ?></th>
                                                    <th scope="col" data-field="date" data-sortable="true"><?= lang('date'); ?></th>
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

    <script type="text/javascript">
        window.actionEvents = {};
    </script>
    <script type="text/javascript">
        function queryParams(p) {
            return {
                'user_id': '<?= $this->uri->segment(2) ?>',
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }

        function fromFormatter(value, row) {
            var icon = (row.pay_from == 1) ? '<label class="badge badge-success"><?= lang('android') ?></label>' : '<label class="badge badge-danger"><?= lang('ios') ?></label>';
            return icon;
        }
    </script>

</body>

</html>