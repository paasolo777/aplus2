<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('monthly_leaderboard_details'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('monthly_leaderboard_details'); ?> <small><?= lang('view_month_wise_leaderboard'); ?></small></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                                <?php
                                                $yearArray = range(2020, date('Y'));
                                                ?>
                                                <label class="control-label" for="year"><?= lang('select_filter_by_year'); ?></label>
                                                <select name="year" id="year" class="form-control">
                                                    <?php foreach ($yearArray as $year) { ?>
                                                        <option value="<?= $year; ?>"><?= $year; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                                <?php
                                                $monthArray = array(
                                                    "01" => "January",
                                                    "02" => "February",
                                                    "03" => "March",
                                                    "04" => "April",
                                                    "05" => "May",
                                                    "06" => "June",
                                                    "07" => "July",
                                                    "08" => "August",
                                                    "09" => "September",
                                                    "10" => "October",
                                                    "11" => "November",
                                                    "12" => "December",
                                                );
                                                ?>
                                                <label class="control-label" for="month"><?= lang('select_filter_by_month'); ?></label>
                                                <select name="month" id="month" class="form-control">
                                                    <?php foreach ($monthArray as $key => $month) { ?>
                                                        <option value="<?= $key; ?>"><?= $month; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                                <label class="col-xs-12"><?= lang('filter'); ?></label>
                                                <button type="button" class="<?= BUTTON_CLASS ?> form-control" name="submit" id="filler_btn"><?= lang('filter_now'); ?></button>
                                            </div>
                                        </div>
                                        <input type="hidden" id="user_id" name="user_id" value="<?= $this->uri->segment(2) ?>" />
                                        <table aria-describedby="mydesc" class='table-striped' id='monthly_leaderboard' data-toggle="table" data-url="<?= base_url() . 'Table/monthly_leaderboard' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="user_rank" data-sort-order="asc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "leaderboard-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="id" data-sortable="true" data-align="center"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="user_id" data-sortable="true" data-visible="false"><?= lang('user_id'); ?></th>
                                                    <th scope="col" data-field="name" data-sortable="true"><?= lang('name'); ?></th>
                                                    <th scope="col" data-field="email" data-sortable="true"><?= lang('email'); ?></th>
                                                    <th scope="col" data-field="score" data-sortable="true"><?= lang('score'); ?></th>
                                                    <th scope="col" data-field="user_rank" data-sortable="true"><?= lang('rank'); ?></th>
                                                    <th scope="col" data-field="last_updated" data-sortable="true"><?= lang('last_updated'); ?></th>
                                                    <th scope="col" data-field="date_created" data-sortable="true"><?= lang('date_created'); ?></th>
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

    <script>
        $(document).ready(function() {
            var today = new Date();
            document.getElementById("year").value = today.getFullYear();
            document.getElementById("month").value = ('0' + (today.getMonth() + 1)).slice(-2);
            $('#monthly_leaderboard').bootstrapTable('refresh');
            $('#monthly_leaderboard').show();
        });
    </script>

    <script type="text/javascript">
        window.actionEvents = {};
    </script>
    <script type="text/javascript">
        function queryParams(p) {
            return {
                "year": $('#year').val(),
                "month": $('#month').val(),
                "user_id": $('#user_id').val(),
                sort: p.sort,
                order: p.order,
                offset: p.offset,
                limit: p.limit,
                search: p.search
            };
        }
        $('#filler_btn').on('click', function() {
            $('#monthly_leaderboard').bootstrapTable('refresh');
            $('#monthly_leaderboard').show();
        });
    </script>

</body>

</html>