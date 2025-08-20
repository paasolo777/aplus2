<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('exam_module_result'); ?> | <?php echo (is_settings('app_name')) ? is_settings('app_name') : "" ?></title>

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
                        <h1><?= lang('exam_module_result'); ?></h1>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <?php if ($exam) { ?>
                                            <h4><?= lang('exam'); ?> : <?= $exam[0]->title ?></h4>
                                        <?php } ?>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" id="exam_module_id" name="exam_module_id" value="<?= $this->uri->segment(2) ?>" />
                                        <table aria-describedby="mydesc" class='table-striped' id='result_list' data-toggle="table" data-url="<?= base_url() . 'Table/exam_module_result' ?>" data-click-to-select="true" data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200,All]" data-search="true" data-toolbar="#toolbar" data-show-columns="true" data-show-refresh="true" data-trim-on-search="false" data-mobile-responsive="true" data-sort-name="obtained_marks" data-sort-order="desc" data-pagination-successively-size="3" data-maintain-selected="true" data-show-export="true" data-export-types='["csv","excel","pdf"]' data-export-options='{ "fileName": "question-list-<?= date('d-m-y') ?>" }' data-query-params="queryParams">
                                            <thead>
                                                <tr>
                                                    <th scope="col" data-field="id" data-sortable="true"><?= lang('id'); ?></th>
                                                    <th scope="col" data-field="exam_module_id" data-sortable="true" data-visible='false'><?= lang('exam_module_id'); ?></th>
                                                    <th scope="col" data-field="user_id" data-sortable="true" data-visible='false'><?= lang('user_id'); ?></th>
                                                    <th scope="col" data-field="u_name" data-sortable="true"><?= lang('name'); ?></th>
                                                    <th scope="col" data-field="rank" data-sortable="true"><?= lang('rank'); ?></th>
                                                    <th scope="col" data-field="obtained_marks" data-sortable="true"><?= lang('obtain_marks'); ?></th>
                                                    <th scope="col" data-field="total_duration" data-sortable="true"><?= lang('duration'); ?></th>
                                                    <th scopr="col" data-field="rules_violated" data-sortable="false" data-events="actionEvents"><?= lang('rules_violated'); ?></th>
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
                    <h5 class="modal-title"><?= lang('result_details'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row" id="result">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editCapturedModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= lang('captured_questions'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row" id="capturedres">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php base_url() . include 'footer.php'; ?>

    <script type="text/javascript">
        window.actionEvents = {
            'click .edit-data': function(e, value, row, index) {
                var statstics = JSON.parse(row.statistics);
                var data = '<table class="table">';
                data += '<thead><tr><th><?= lang('marks'); ?></th><th><?= lang('correct_answer'); ?></th><th><?= lang('incorrect_answer'); ?></th></tr></thead>';
                data += '<tbody>';
                $.each(statstics, function(index, value) {
                    data += '<tr><td>' + value['mark'] + '</td><td>' + value['correct_answer'] + '</td><td>' + value['incorrect'] + '</td></tr>';
                });
                data += '</tbody>';
                data += '</table>';
                $('#result').html(data);
            },
            'click .edit-captured': function(e, value, row, index) {
                var captured_que = JSON.parse(row.captured_que);
                var data = '<table class="table">';
                data += '<thead><tr><th><?= lang('id'); ?></th><th><?= lang('question'); ?></th></tr></thead>';
                data += '<tbody>';
                $.each(captured_que, function(index, value) {
                    data += '<tr><td>' + value['id'] + '</td><td>' + value['question'] + '</td></tr>';
                });
                data += '</tbody>';
                data += '</table>';
                $('#capturedres').html(data);
            }
        };
    </script>

    <script type="text/javascript">
        function queryParams(p) {
            return {
                "exam_module_id": $('#exam_module_id').val(),
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