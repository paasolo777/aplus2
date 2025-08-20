<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('user_statustics_details'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('statustics_details_for'); ?> <?= $battle_stat[0]->name ? $battle_stat[0]->name : 0; ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <?php if (!empty($general_stat)) { ?>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h5><?= lang('general_statistics'); ?></h5>
                                                    <hr>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-4"><?= lang('questions_answered'); ?>: <?= $general_stat[0]->questions_answered ? $general_stat[0]->questions_answered : 0; ?></label>
                                                        <label class="control-label col-md-4"><?= lang('correct_answers'); ?>: <?= $general_stat[0]->correct_answers ? $general_stat[0]->correct_answers : 0; ?></label>
                                                        <label class="control-label col-md-4"><?= lang('best_position'); ?>: <?= $general_stat[0]->best_position ? $general_stat[0]->best_position : 0; ?></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-4"><?= lang('strong_category'); ?>: <?= $general_stat[0]->strong_category ? $general_stat[0]->strong_category : 0; ?></label>
                                                        <label class="control-label col-md-4"><?= lang('weak_category'); ?>: <?= $general_stat[0]->weak_category ? $general_stat[0]->weak_category : 0; ?></label>
                                                    </div>
                                                    <hr>
                                                </div>

                                            <?php } ?>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <h5><?= lang('battle_statistics'); ?></h5>
                                                <hr>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-4"><?= lang('victories'); ?>: <?= $battle_stat[0]->Victories ? $battle_stat[0]->Victories : 0; ?></label>
                                                    <label class="control-label col-md-4"><?= lang('drawn'); ?>: <?= $battle_stat[0]->Drawn ? $battle_stat[0]->Drawn : 0; ?></label>
                                                    <label class="control-label col-md-4"><?= lang('loose'); ?>: <?= $battle_stat[0]->Loose ? $battle_stat[0]->Loose : 0; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <input type="hidden" id="user_id" name="user_id" value="<?= $this->uri->segment(2) ?>" />
                                        <table aria-describedby="mydesc" class='table-striped' id='battle_statistics' data-toggle="table" data-url="<?= base_url() . 'Table/battle_statistics' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="id" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "statistics-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="state" data-checkbox="true"></th>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="opponent_id" data-sortable="true" data-visible="false"><?= lang('opponent_id'); ?></th>
                                                    <th scope="col" data-field="opponent_name"><?= lang('opponent_name'); ?></th>
                                                    <th scope="col" data-field="mystatus"><?= lang('my_status'); ?></th>
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
                "user_id": $('#user_id').val(),
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