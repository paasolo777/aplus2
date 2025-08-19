<?php

defined('BASEPATH') || exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Table extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->database();
        date_default_timezone_set(get_system_timezone());
        $this->toDate = date('Y-m-d');
        $this->toDateTime = date('Y-m-d H:i:s');

        $this->load->config('quiz');

        $this->category_type = $this->config->item('category_type');

        $this->NO_IMAGE = base_url() . LOGO_IMG_PATH . is_settings('half_logo');
    }

    public function languages_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('*');
        $this->db->where('type', 1);
        $this->db->from('tbl_languages');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('id', $search)
                ->or_like('language', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $operate = "";
            $operate .= '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            if ($row->default_active != 1) {
                $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';
            }

            $bulkData['rows'][] = [
                'id' => $row->id,
                'language' => $row->language,
                'code' => $row->code,
                'status' => $row->status,
                'default_active' => $row->default_active,
                'operate' => $operate,
            ];
        }
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function category_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $type_name = $this->get('type');
        $type = $this->category_type[$type_name];

        switch ($type) {
            case 2:
                $subQuery = 'tbl_fun_n_learn';
                break;
            case 3:
                $subQuery = 'tbl_guess_the_word';
                break;
            case 4:
                $subQuery = 'tbl_audio_question';
                break;
            case 5:
                $subQuery = 'tbl_maths_question';
                break;
            case 6:
                $subQuery = 'tbl_multi_match';
                break;
            default:
                $subQuery = 'tbl_question';
                break;
        }
        $no_of_que = ", (SELECT COUNT(id) FROM $subQuery q WHERE q.category = c.id) AS no_of_que";

        $this->db->select('c.*,l.language, ' . $no_of_que . '');
        $this->db->where('c.type', $type);
        $this->db->from('tbl_category c');
        $this->db->join('tbl_languages l', 'l.id = c.language_id', 'left');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('c.language_id', $language_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('c.id', $search)
                ->or_like('c.category_name', $search)
                ->or_like('l.language', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? CATEGORY_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';


            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'language_id' => $row->language_id,
                'language' => $row->language,
                'row_order' => $row->row_order,
                'category_name' => $row->category_name,
                'slug' => $row->slug,
                'image' => (!empty($image)) ? '<a href=' . base_url() . $image . '  data-lightbox="' . lang('category_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'is_premium' => $row->is_premium,
                'coins' => $row->coins,
                'no_of_que' => $row->no_of_que,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function subcategory_get()
    {
        $sort = $this->get('sort') ?? 'row_order';
        $order = $this->get('order') ?? 'ASC';

        $type_name = $this->get('type');
        $type = $this->category_type[$type_name];

        switch ($type) {
            case 2:
                $subQuery = 'tbl_fun_n_learn';
                break;
            case 3:
                $subQuery = 'tbl_guess_the_word';
                break;
            case 4:
                $subQuery = 'tbl_audio_question';
                break;
            case 5:
                $subQuery = 'tbl_maths_question';
                break;
            case 6:
                $subQuery = 'tbl_multi_match';
                break;
            default:
                $subQuery = 'tbl_question';
                break;
        }
        $no_of_que = ", (SELECT COUNT(id) FROM $subQuery q WHERE q.subcategory = s.id) AS no_of_que";

        $this->db->select('s.*,l.language,c.category_name' . $no_of_que . '');
        $this->db->where('c.type', $type);
        $this->db->from('tbl_subcategory s');
        $this->db->join('tbl_languages l', 'l.id = s.language_id', 'left');
        $this->db->join('tbl_category c', 'c.id = s.maincat_id');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('s.language_id', $language_id);
        }

        if ($this->get('category') && $this->get('category') != '') {
            $category_id = $this->get('category');
            $this->db->where('s.maincat_id', $category_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('s.id', $search)
                ->or_like('s.subcategory_name', $search)
                ->or_like('c.category_name', $search)
                ->or_like('l.language', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? SUBCATEGORY_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'language_id' => $row->language_id,
                'language' => $row->language,
                'maincat_id' => $row->maincat_id,
                'category_name' => $row->category_name,
                'row_order' => $row->row_order,
                'subcategory_name' => $row->subcategory_name,
                'slug' => $row->slug,
                'image' => (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="' . lang('subcategory_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'is_premium' => $row->is_premium,
                'coins' => $row->coins,
                'status' => ($row->status) ? "<span class='badge badge-success'>" . lang('active') . "</span>" : "<span class='badge badge-danger'>" . lang('deactive') . "</span>",
                'no_of_que' => $row->no_of_que,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function question_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('q.*, l.language');
        $this->db->from('tbl_question q');
        $this->db->join('tbl_languages l', 'l.id = q.language_id', 'left');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('q.language_id', $language_id);
        }
        if ($this->get('category') && $this->get('category') != '') {
            $this->db->where('q.category', $this->get('category'));
        }
        if ($this->get('subcategory') && $this->get('subcategory') != '') {
            $this->db->where('q.subcategory', $this->get('subcategory'));
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('q.id', $search)
                ->or_like('question', $search)
                ->or_like('optiona', $search)
                ->or_like('optionb', $search)
                ->or_like('optionc', $search)
                ->or_like('optiond', $search)
                ->or_like('optione', $search)
                ->or_like('answer', $search)
                ->or_like('l.language', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="' . base_url() . "create-questions/" . $row->id . '" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            if (is_settings('latex_mode')) {
                $question = "<textarea class='editor-questions-inline'>" . $row->question . "</textarea>";
                $optiona = "<textarea class='editor-questions-inline'>" . $row->optiona . "</textarea>";
                $optionb = "<textarea class='editor-questions-inline'>" . $row->optionb . "</textarea>";
                $optionc = $row->optionc ? "<textarea class='editor-questions-inline'>" . $row->optionc . "</textarea>" : "-";
                $optiond = $row->optiond ? "<textarea class='editor-questions-inline'>" . $row->optiond . "</textarea>" : "-";
                $optione = $row->optione ? "<textarea class='editor-questions-inline'>" . $row->optione . "</textarea>" : "-";
                $note = $row->note ? "<textarea class='editor-questions-inline'>" . $row->note . "</textarea>" : "-";
            } else {
                $question = $row->question;
                $optiona = $row->optiona;
                $optionb = $row->optionb;
                $optionc = $row->optionc ? $row->optionc : "-";
                $optiond = $row->optiond ? $row->optiond : "-";
                $optione = $row->optione ? $row->optione : "-";
                $note = $row->note ? $row->note : "-";
            }

            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'category' => $row->category,
                'subcategory' => $row->subcategory,
                'language_id' => $row->language_id,
                'language' => $row->language,
                'image' => (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="' . lang('question_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'question_type' => $row->question_type,
                'question' => $question ?? '',
                'optiona' => $optiona,
                'optionb' => $optionb,
                'optionc' => $optionc,
                'optiond' => $optiond,
                'optione' => $optione,
                'note' => $note,
                'level' => $row->level,
                'answer' => $row->answer,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function question_reports_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('qr.*, u.name, q.category, q.subcategory, q.language_id, q.image, q.question, q.question_type, q.optiona, q.optionb, q.optionc, q.optiond, q.optione, q.answer, q.level, q.note');
        $this->db->from('tbl_question_reports qr');
        $this->db->join('tbl_users u', 'u.id = qr.user_id');
        $this->db->join('tbl_question q', 'q.id = qr.question_id');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('qr.id', $search)
                ->or_like('message', $search)
                ->or_like('u.name', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="' . base_url() . "question-reports/" . $row->question_id . '" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            if (is_settings('latex_mode')) {
                $question = "<textarea class='editor-questions-inline'>" . $row->question . "</textarea>";
            } else {
                $question = $row->question;
            }

            $bulkData['rows'][] = [
                'id' => $row->id,
                'question_id' => $row->question_id,
                'question' => $row->question,
                'user_id' => $row->user_id,
                'name' => $row->name,
                'message' => $row->message,
                'date' => date('d-M-Y h:i A', strtotime($row->date)),
                'image_url' => $image,
                'category' => $row->category,
                'subcategory' => $row->subcategory,
                'language_id' => $row->language_id,
                'question_type' => $row->question_type,
                'question' => $question ?? '',
                'level' => $row->level,
                'answer' => $row->answer,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function question_without_premium_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('q.*, l.language');
        $this->db->from('tbl_question q');
        $this->db->join('tbl_languages l', 'l.id = q.language_id', 'left');
        $this->db->join('tbl_category c', 'c.id = q.category', 'left');
        $this->db->join('tbl_subcategory sc', 'sc.id = q.subcategory', 'left');
        $this->db->where('c.is_premium', 0);

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('q.language_id', $language_id);
        }
        if ($this->get('category') && $this->get('category') != '') {
            $this->db->where('q.category', $this->get('category'));
        }
        if ($this->get('subcategory') && $this->get('subcategory') != '') {
            $this->db->where('q.subcategory', $this->get('subcategory'));
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('q.id', $search)
                ->or_like('question', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';
            if (is_settings('latex_mode')) {
                $question = "<textarea class='editor-questions-inline'>" . $row->question . "</textarea>";
            } else {
                $question = $row->question;
            }

            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'category' => $row->category,
                'subcategory' => $row->subcategory,
                'language_id' => $row->language_id,
                'language' => $row->language,
                'image' => (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="' . lang('question_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'question_type' => $row->question_type,
                'question' => $question ?? '',
                'answer' => $row->answer,
                'level' => $row->level,
                'operate' => $operate,
            ];
        }
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function multi_match_question_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('ms.*, l.language');
        $this->db->from('tbl_multi_match ms');
        $this->db->join('tbl_languages l', 'l.id = ms.language_id', 'left');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('ms.language_id', $language_id);
        }
        if ($this->get('category') && $this->get('category') != '') {
            $this->db->where('ms.category', $this->get('category'));
        }
        if ($this->get('subcategory') && $this->get('subcategory') != '') {
            $this->db->where('ms.subcategory', $this->get('subcategory'));
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('ms.id', $search)
                ->or_like('question', $search)
                ->or_like('optiona', $search)
                ->or_like('optionb', $search)
                ->or_like('optionc', $search)
                ->or_like('optiond', $search)
                ->or_like('optione', $search)
                ->or_like('l.language', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $count = 1;
        $tempRow = array();
        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? MULTIMATCH_QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="' . base_url() . "multi-match/" . $row->id . '" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $tempRow['image_url'] = $image;
            $tempRow['id'] = $row->id;
            $tempRow['category'] = $row->category;
            $tempRow['subcategory'] = $row->subcategory;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['language'] = $row->language;
            $tempRow['image'] = (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="' . lang('question_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >';
            $tempRow['question_type'] = $row->question_type;
            $tempRow['answer_type'] = $row->answer_type;

            $question = $row->question;
            $optiona = $row->optiona;
            $optionb = $row->optionb;
            $optionc = $row->optionc ? $row->optionc : "-";
            $optiond = $row->optiond ? $row->optiond : "-";
            $optione = $row->optione ? $row->optione : "-";
            $note = $row->note ? $row->note : "-";

            $tempRow['question'] = $question ?? '';
            $tempRow['optiona'] = $optiona;
            $tempRow['optionb'] = $optionb;
            $tempRow['optionc'] = $optionc;
            $tempRow['optiond'] = $optiond;
            $tempRow['optione'] = $optione;
            $tempRow['note'] = $note;
            $tempRow['level'] = $row->level;
            $tempRow['answer'] = $row->answer;
            $tempRow['operate'] = $operate;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function multi_match_question_reports_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('qr.*, u.name, q.category, q.subcategory, q.language_id, q.image, q.question, q.question_type, q.optiona, q.optionb, q.optionc, q.optiond, q.optione, q.answer, q.level, q.note');
        $this->db->from('tbl_multi_match_question_reports qr');
        $this->db->join('tbl_users u', 'u.id = qr.user_id');
        $this->db->join('tbl_multi_match q', 'q.id = qr.question_id');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('qr.id', $search)
                ->or_like('u.name', $search)
                ->or_like('q.question', $search)
                ->or_like('q.optiona', $search)
                ->or_like('q.optionb', $search)
                ->or_like('q.optionc', $search)
                ->or_like('q.optiond', $search)
                ->or_like('q.optione', $search)
                ->or_like('l.language', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = array();
        $bulkData['total'] = $total;
        $rows = array();
        $count = 1;
        $tempRow = array();

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? MULTIMATCH_QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="' . base_url() . "multi-match-question-reports/" . $row->question_id . '" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $tempRow['id'] = $row->id;
            $tempRow['question_id'] = $row->question_id;
            $tempRow['question'] = $row->question;
            $tempRow['user_id'] = $row->user_id;
            $tempRow['name'] = $row->name;
            $tempRow['message'] = $row->message;
            $tempRow['date'] = date('d-M-Y h:i A', strtotime($row->date));

            $tempRow['image_url'] = $image;
            $tempRow['category'] = $row->category;
            $tempRow['subcategory'] = $row->subcategory;
            $tempRow['language_id'] = $row->language_id;
            $tempRow['question_type'] = $row->question_type;
            $question = $row->question;
            $tempRow['question'] = $question ?? '';
            $tempRow['level'] = $row->level;
            $tempRow['answer'] = $row->answer;
            $tempRow['operate'] = $operate;

            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }

        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function contest_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select("c.*,(select count(contest_id) FROM tbl_contest_prize cp WHERE cp.contest_id=c.id) as top_users,(SELECT COUNT('id') from tbl_contest_leaderboard cl where cl.contest_id = c.id ) as participants,(SELECT COUNT('id') from tbl_contest_question q where q.contest_id=c.id) as total_question");
        $this->db->from('tbl_contest c');

        if ($this->get('language_id') && $this->get('language_id') != '') {
            $language_id = $this->get('language_id');
            $this->db->where('c.language_id', $language_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('id', $search)
                ->or_like('name', $search)
                ->or_like('description', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? CONTEST_IMG_PATH . $row->image : '';
            $operate = "<a class='btn btn-icon btn-sm btn-primary edit-data' data-id='" . $row->id . "' data-image='" . $image . "' data-toggle='modal' data-target='#editDataModal' title='" . lang('edit') . "'><i class='fas fa-edit'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-success edit-status' data-id='" . $row->id . "' data-toggle='modal' data-target='#editStatusModal' title='" . lang('edit_status') . "'><i class='fas fa-edit'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-danger delete-data' data-id='" . $row->id . "' data-image='" . $image . "' title='" . lang('delete') . "'><i class='fas fa-trash'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-warning' href='" . base_url() . "contest-leaderboard/" . $row->id . "' title='" . lang('view_top_users') . "'><i class='fas fa-list'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-info' href='contest-prize-distribute/" . $row->id . "' title='" . lang('ready_to_distribute_prize') . "'><i class='fas fa-bullhorn'></i></a>";

            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'language_id' => $row->language_id,
                'name' => $row->name,
                'start_date' => $row->start_date,
                'end_date' => $row->end_date,
                'image' => "<a data-fancybox='" . lang('contest_gallery') . "' href='" . $image . "' data-lightbox='" . $row->name . "'><img src='" . $image . "' title='" . $row->name . "' width='50'/></a>",
                'description' => $row->description,
                'entry' => $row->entry,
                'top_users' => '<a class="btn btn-xs btn-warning" href="' . base_url() . 'contest-prize/' . $row->id . '" title="' . lang('view_prize') . '">' . $row->top_users . '</a>',
                'participants' => $row->participants,
                'total_question' => $row->total_question,
                'status' => ($row->status) ? "<label class='badge badge-success'>" . lang('active') . "</label>" : "<label class='badge badge-danger'>" . lang('deactive') . "</label>",
                'prize_status' => ($row->prize_status == 0) ? '<label class="badge badge-warning">' . lang('not_distributed') . '</label>' : '<label class="badge badge-success">' . lang('distributed') . '</label>',
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function contest_question_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('tq.*, tc.name');
        $this->db->from('tbl_contest_question tq');
        $this->db->join('tbl_contest tc', 'tc.id = tq.contest_id');

        if ($this->get('contest_id') && $this->get('contest_id') != '') {
            $this->db->where('tq.contest_id', $this->get('contest_id'));
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('tq.id', $search)
                ->or_like('question', $search)
                ->or_like('optiona', $search)
                ->or_like('optionb', $search)
                ->or_like('optionc', $search)
                ->or_like('optiond', $search)
                ->or_like('optione', $search)
                ->or_like('answer', $search)
                ->or_like('tc.name', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? CONTEST_QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'contest_id' => $row->contest_id,
                'name' => $row->name,
                'image' => (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="' . lang('question_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'question' => $row->question,
                'question_type' => $row->question_type,
                'optiona' => $row->optiona,
                'optionb' => $row->optionb,
                'optionc' => $row->optionc,
                'optiond' => $row->optiond,
                'optione' => $row->optione,
                'answer' => $row->answer,
                'note' => $row->note,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function contest_prize_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $contest_id = $this->get('contest_id');

        $this->db->select('p.*, c.name');
        $this->db->where('p.contest_id', $contest_id);
        $this->db->from('tbl_contest_prize p');
        $this->db->join('tbl_contest c', 'c.id = p.contest_id');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('id', $search)
                ->or_like('points', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $bulkData['rows'][] = [
                'id' => $row->id,
                'name' => $row->name,
                'top_winner' => $row->top_winner,
                'points' => $row->points,
                'operate' => $operate,
            ];
        }
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function contest_leaderboard_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $contest_id = $this->get('contest_id');

        $sub_query = "SELECT s.*, @user_rank := @user_rank + 1 user_rank FROM ( SELECT c.* FROM tbl_contest_leaderboard c join tbl_users u on u.id = c.user_id where contest_id='" . $contest_id . "') s, (SELECT @user_rank := 0) init ORDER BY score DESC ";

        $this->db->select('r.*, u.name, u.profile');
        $this->db->from("($sub_query) r");
        $this->db->join('tbl_users u', 'u.id = r.user_id', 'inner');
        $this->db->where('contest_id', $contest_id);
        $this->db->where('u.status', 1);

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('id', $search)->or_like('score', $search)->or_like('user_id', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $bulkData['rows'][] = [
                'id' => $row->id,
                'name' => $row->name,
                'user_id' => $row->user_id,
                'contest_id' => $row->contest_id,
                'questions_attended' => $row->questions_attended,
                'correct_answers' => $row->correct_answers,
                'score' => $row->score,
                'user_rank' => $row->user_rank,
                'last_updated' => $row->last_updated,
                'date_created' => $row->date_created,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function fun_n_learn_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('f.*,l.language,(select count(id) from tbl_fun_n_learn_question q where q.fun_n_learn_id = f.id ) as no_of_que');
        $this->db->from('tbl_fun_n_learn f');
        $this->db->join('tbl_languages l', 'l.id = f.language_id', 'left');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('f.language_id', $language_id);
        }
        if ($this->get('category') && $this->get('category') != '') {
            $this->db->where('f.category', $this->get('category'));
        }
        if ($this->get('subcategory') && $this->get('subcategory') != '') {
            $this->db->where('f.subcategory', $this->get('subcategory'));
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('f.id', $search)
                ->or_like('f.title', $search)
                ->or_like('l.language', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $operate = "<a class='btn btn-icon btn-sm btn-warning' href='" . base_url() . "fun-n-learn-questions/" . $row->id . "' title='" . lang('add_question') . "'><i class='fas fa-plus'></i></a>";
            $operate .= '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= "<a class='btn btn-icon btn-sm btn-success edit-status' data-id='" . $row->id . "' data-toggle='modal' data-target='#editStatusModal' title='" . lang('edit_status') . "'><i class='fas fa-edit'></i></a>";
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $bulkData['rows'][] = [
                'id' => $row->id,
                'language_id' => $row->language_id,
                'category' => $row->category,
                'subcategory' => $row->subcategory,
                'language' => $row->language,
                'title' => $row->title,
                'content_type' => $row->content_type,
                'content_data' => $row->content_data,
                'detail' => $row->detail,
                'no_of_que' => $row->no_of_que,
                'status' => ($row->status) ? "<label class='badge badge-success'>" . lang('active') . "</label>" : "<label class='badge badge-danger'>" . lang('deactive') . "</label>",
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function fun_n_learn_question_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('tq.*');
        $this->db->from("tbl_fun_n_learn_question tq");
        $this->db->join('tbl_fun_n_learn tc', 'tc.id = tq.fun_n_learn_id');

        if ($this->get('fun_n_learn_id') && $this->get('fun_n_learn_id') != '') {
            $fun_n_learn_id = $this->get('fun_n_learn_id');
            $this->db->where('tq.fun_n_learn_id', $fun_n_learn_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('tq.id', $search)
                ->or_like('question', $search)
                ->or_like('optiona', $search)
                ->or_like('optionb', $search)
                ->or_like('optionc', $search)
                ->or_like('optiond', $search)
                ->or_like('optione', $search)
                ->or_like('answer', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? FUN_LEARN_QUESTION_IMG_PATH . $row->image : '';

            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image=' . $image . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'fun_n_learn_id' => $row->fun_n_learn_id,
                'question' => $row->question,
                'question_type' => $row->question_type,
                'optiona' => $row->optiona,
                'optionb' => $row->optionb,
                'optionc' => $row->optionc,
                'optiond' => $row->optiond,
                'optione' => $row->optione,
                'answer' => $row->answer,
                'image' => (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="' . lang('question_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function guess_the_word_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('g.*, l.language');
        $this->db->from('tbl_guess_the_word g');
        $this->db->join('tbl_languages l', 'l.id = g.language_id', 'left');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('g.language_id', $language_id);
        }
        if ($this->get('category') && $this->get('category') != '') {
            $this->db->where('g.category', $this->get('category'));
        }
        if ($this->get('subcategory') && $this->get('subcategory') != '') {
            $this->db->where('g.subcategory', $this->get('subcategory'));
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('g.id', $search)
                ->or_like('g.question', $search)
                ->or_like('g.answer', $search)
                ->or_like('l.language', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? GUESS_WORD_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'language_id' => $row->language_id,
                'language' => $row->language,
                'category' => $row->category,
                'subcategory' => $row->subcategory,
                'image' => (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="' . lang('question_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'question' => $row->question,
                'answer' => $row->answer,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function audio_question_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('q.*, l.language');
        $this->db->from('tbl_audio_question q');
        $this->db->join('tbl_languages l', 'l.id = q.language_id', 'left');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('q.language_id', $language_id);
        }
        if ($this->get('category') && $this->get('category') != '') {
            $this->db->where('q.category', $this->get('category'));
        }
        if ($this->get('subcategory') && $this->get('subcategory') != '') {
            $this->db->where('q.subcategory', $this->get('subcategory'));
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('q.id', $search)
                ->or_like('question', $search)
                ->or_like('optiona', $search)
                ->or_like('optionb', $search)
                ->or_like('optionc', $search)
                ->or_like('optiond', $search)
                ->or_like('optione', $search)
                ->or_like('answer', $search)
                ->or_like('l.language', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            if ($row->audio_type != '1') {
                $path = base_url() . QUESTION_AUDIO_PATH;
            } else {
                $path = "";
            }
            $audio_url = (!empty($row->audio) && $row->audio_type == 2) ? QUESTION_AUDIO_PATH . $row->audio : $row->audio;
            $audio = (!empty($row->audio)) ? (($row->audio_type == 2) ? $path . $row->audio : $row->audio) : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-audio="' . QUESTION_AUDIO_PATH . $row->audio . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $bulkData['rows'][] = [
                'audio_url' => $audio_url,
                'id' => $row->id,
                'category' => $row->category,
                'subcategory' => $row->subcategory,
                'language_id' => $row->language_id,
                'language' => $row->language,
                'audio' => '<audio id=' . $row->id . '><source src="' . $audio . '" type="audio/mpeg"></audio><a data-id=' . $row->id . ' class="btn btn-icon btn-sm btn-primary playbtn fa fa-play"></a>',
                'question' => $row->question,
                'question_type' => $row->question_type,
                'audio_type' => $row->audio_type,
                'optiona' => $row->optiona,
                'optionb' => $row->optionb,
                'optionc' => $row->optionc,
                'optiond' => $row->optiond,
                'optione' => $row->optione,
                'answer' => $row->answer,
                'note' => $row->note,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function maths_question_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('q.*, l.language');
        $this->db->from('tbl_maths_question q');
        $this->db->join('tbl_languages l', 'l.id = q.language_id', 'left');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('q.language_id', $language_id);
        }
        if ($this->get('category') && $this->get('category') != '') {
            $this->db->where('q.category', $this->get('category'));
        }
        if ($this->get('subcategory') && $this->get('subcategory') != '') {
            $this->db->where('q.subcategory', $this->get('subcategory'));
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('q.id', $search)
                ->or_like('q.question', $search)
                ->or_like('q.optiona', $search)
                ->or_like('q.optionb', $search)
                ->or_like('q.optionc', $search)
                ->or_like('q.optiond', $search)
                ->or_like('q.optione', $search)
                ->or_like('q.answer', $search)
                ->or_like('l.language', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? MATHS_QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="' . base_url() . "create-maths-questions/" . $row->id . '" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'category' => $row->category,
                'subcategory' => $row->subcategory,
                'language_id' => $row->language_id,
                'language' => $row->language,
                'image' => (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="' . lang('question_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'question_type' => $row->question_type,
                'answer' => $row->answer,
                'question' => "<textarea class='editor-questions-inline'>" . $row->question . "</textarea>",
                'optiona' => "<textarea class='editor-questions-inline'>" . $row->optiona . "</textarea>",
                'optionb' => "<textarea class='editor-questions-inline'>" . $row->optionb . "</textarea>",
                'optionc' => "<textarea class='editor-questions-inline'>" . $row->optionc . "</textarea>",
                'optiond' => "<textarea class='editor-questions-inline'>" . $row->optiond . "</textarea>",
                'optione' => "<textarea class='editor-questions-inline'>" . $row->optione . "</textarea>",
                'note' => "<textarea class='editor-questions-inline'>" . $row->note . "</textarea>",
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function exam_module_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('em.*,l.language,(select count(emq.id) from tbl_exam_module_question emq where emq.exam_module_id = em.id ) as no_of_que');
        $this->db->from('tbl_exam_module em');
        $this->db->join('tbl_languages l', 'l.id = em.language_id', 'left');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('em.language_id', $language_id);
        }
        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('em.id', $search)
                ->or_like('em.title', $search)
                ->or_like('l.language', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $operate = "<a class='btn btn-icon btn-sm btn-warning' href='" . base_url() . "exam-module-questions/" . $row->id . "' title='" . lang('add_question') . "'><i class='fas fa-plus'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-info' href='" . base_url() . "exam-module-questions-list/" . $row->id . "' title='" . lang('list_questions') . "'><i class='fas fa-list'></i></a>";
            $operate .= '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= "<a class='btn btn-icon btn-sm btn-success edit-status' data-id='" . $row->id . "' data-toggle='modal' data-target='#editStatusModal' title='" . lang('edit_status') . "'><i class='fas fa-edit'></i></a>";
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';
            if ($this->toDate >= $row->date) {
                $operate .= "<a class='btn btn-icon btn-sm btn-warning' href='" . base_url() . "exam-module-result/" . $row->id . "' title='" . lang('result') . "'><i class='fas fa-list-alt'></i></a>";
            }
            $bulkData['rows'][] = [
                'id' => $row->id,
                'language_id' => $row->language_id,
                'language' => $row->language,
                'title' => $row->title,
                'date' => $row->date,
                'exam_key' => $row->exam_key,
                'duration' => $row->duration,
                'no_of_que' => $row->no_of_que,
                'status' => ($row->status) ? "<label class='badge badge-success'>" . lang('active') . "</label>" : "<label class='badge badge-danger'>" . lang('deactive') . "</label>",
                'answer_again' => ($row->answer_again) ? "<label class='badge badge-success'>" . lang('yes') . "</label>" : "<label class='badge badge-danger'>" . lang('no') . "</label>",
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function exam_module_questions_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('emq.*');
        $this->db->from("tbl_exam_module_question emq");
        $this->db->join('tbl_exam_module em', 'em.id = emq.exam_module_id');

        if ($this->get('exam_module_id') && $this->get('exam_module_id') != '') {
            $exam_module_id = $this->get('exam_module_id');
            $this->db->where('emq.exam_module_id', $exam_module_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('emq.id', $search)
                ->or_like('question', $search)
                ->or_like('optiona', $search)
                ->or_like('optionb', $search)
                ->or_like('optionc', $search)
                ->or_like('optiond', $search)
                ->or_like('optione', $search)
                ->or_like('answer', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? EXAM_QUESTION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="' . base_url() . "exam-module-questions-edit/" . $row->id . '" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            if (is_settings('exam_latex_mode')) {
                $question = "<textarea class='editor-questions-inline'>" . $row->question . "</textarea>";
                $optiona = "<textarea class='editor-questions-inline'>" . $row->optiona . "</textarea>";
                $optionb = "<textarea class='editor-questions-inline'>" . $row->optionb . "</textarea>";
                $optionc = $row->optionc ? "<textarea class='editor-questions-inline'>" . $row->optionc . "</textarea>" : "-";
                $optiond = $row->optiond ? "<textarea class='editor-questions-inline'>" . $row->optiond . "</textarea>" : "-";
                $optione = $row->optione ? "<textarea class='editor-questions-inline'>" . $row->optione . "</textarea>" : "-";
            } else {
                $question = $row->question;
                $optiona = $row->optiona;
                $optionb = $row->optionb;
                $optionc = $row->optionc ? $row->optionc : "-";
                $optiond = $row->optiond ? $row->optiond : "-";
                $optione = $row->optione ? $row->optione : "-";
            }

            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'exam_module_id' => $row->exam_module_id,
                'image' => (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="' . lang('question_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'marks' => $row->marks,
                'question_type' => $row->question_type,
                'question' => $question,
                'optiona' => $optiona,
                'optionb' => $optionb,
                'optionc' => $optionc,
                'optiond' => $optiond,
                'optione' => $optione,
                'answer' => $row->answer,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function exam_module_result_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $exam_module_id = $this->get('exam_module_id');

        $sub_query = "SELECT emr.*, u.id AS u_id, u.name AS u_name, @user_rank := @user_rank + 1 AS rank FROM (SELECT * FROM tbl_exam_module_result WHERE exam_module_id = $exam_module_id) emr LEFT JOIN tbl_users u ON u.id = emr.user_id,(SELECT @user_rank := 0) init ORDER BY CAST(obtained_marks AS SIGNED) DESC, CAST(total_duration AS SIGNED) ASC";
        $this->db->select('r.*, u_name, rank');
        $this->db->from("($sub_query) r");
        $this->db->join('tbl_users u', 'u.id = r.u_id', 'left');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('r.id', $search)
                ->or_like('total_duration', $search)
                ->or_like('obtained_marks', $search)
                ->or_like('u.name', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-eye"></i></a>';

            $captured_res = '';
            if ($row->rules_violated == 1) {
                $captured = json_decode($row->captured_question_ids);
                if (!(empty($captured))) {
                    $captured_res = $this->db->query("SELECT id, question FROM tbl_exam_module_question WHERE id IN (" . implode(',', $captured) . ")")->result();
                }
            }
            $bulkData['rows'][] = [
                'id' => $row->id,
                'exam_module_id' => $row->exam_module_id,
                'user_id' => $row->user_id,
                'u_name' => $row->u_name,
                'rank' => $row->rank,
                'obtained_marks' => $row->obtained_marks,
                'total_duration' => $row->total_duration,
                'statistics' => $row->statistics,
                'rules_violated' => ($row->rules_violated) ? '<a class="edit-captured" data-toggle="modal" data-target="#editCapturedModal"><label class="badge badge-success">Yes</label></a>' : '<label class="badge badge-danger">No</label>',
                'captured_question_ids' => $row->captured_question_ids,
                'captured_que' => (!empty($captured_res)) ? json_encode($captured_res) : '',
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function users_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('*');
        $this->db->from('tbl_users');

        if ($this->get('status') != '') {
            $status = $this->get('status');
            $this->db->where('status', $status);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('id', $search)
                ->or_like('name', $search)
                ->or_like('mobile', $search)
                ->or_like('email', $search)
                ->or_like('date_registered', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        $icon = array(
            'email' => 'far fa-envelope-open',
            'gmail' => 'fab fa-google-plus-square text-danger',
            'fb' => 'fab fa-facebook-square text-primary',
            'mobile' => 'fa fa-phone-square',
            'apple' => 'fab fa-apple'
        );

        foreach ($res as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= "<a class='btn btn-icon btn-sm btn-success' href='" . base_url() . "monthly-leaderboard/" . $row->id . "' title='" . lang('monthly_leaderboard') . "'><i class='fas fa-th'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-info' href='" . base_url() . "battle-statistics/" . $row->id . "' title='" . lang('user_statistics') . "'><i class='fas fa-chart-pie'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-warning' href='" . base_url() . "activity-tracker/" . $row->id . "' title='" . lang('track_activities') . "'><i class='far fa-chart-bar'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-primary' href='" . base_url() . "payment-requests/" . $row->id . "' title='" . lang('payment_requests') . "'><i class='fas fa-rupee-sign'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-info admin-coin' data-id='" . $row->id . "' data-toggle='modal' data-target='#coinsmodal' title='" . lang('coins') . "'><i class='fas fa-coins'></i></a>";
            $operate .= "<a class='btn btn-icon btn-sm btn-success' href='" . base_url() . "in-app-users/" . $row->id . "' title='" . lang('in_app_history') . "'><i class='fas fa-database'></i></a>";

            if (filter_var($row->profile, FILTER_VALIDATE_URL) === FALSE) {
                // Not a valid URL. Its a image only or empty
                $profile = (!empty($row->profile)) ? base_url() . USER_IMG_PATH . $row->profile : '';
            } else {
                /* if it is a ur than just pass url as it is */
                $profile = $row->profile;
            }
            $bulkData['rows'][] = [
                'id' => $row->id,
                'profile' => (!empty($row->profile)) ? "<a data-lightbox='" . lang('profile_picture') . "' href='" . $profile . "'><img src='" . $profile . "' width='80'></a>" : lang('no_image'),
                'name' => $row->name,
                'email' =>   $row->email,
                'mobile' =>  $row->mobile,
                'fcm_id' => $row->fcm_id,
                'type' => (isset($row->type) && $row->type != '') ? '<em class="' . $icon[trim($row->type)] . ' fa-2x"></em>' : '<em class="' . $icon['email'] . ' fa-2x"></em>',
                'coins' => $row->coins,
                'refer_code' => $row->refer_code,
                'friends_code' => $row->friends_code,
                'remove_ads' => ($row->remove_ads) ? "<label class='badge badge-success'>" . lang('yes') . "</label>" : "<label class='badge badge-danger'>" . lang('no') . "</label>",
                'date_registered' => date('d-M-Y h:i A', strtotime($row->date_registered)),
                'status' => ($row->status) ? "<label class='badge badge-success'>" . lang('active') . "</label>" : "<label class='badge badge-danger'>" . lang('deactive') . "</label>",
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function in_app_user_list_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('ua.*, u.name');
        $this->db->from("tbl_users_in_app ua");
        $this->db->join('tbl_users u', 'u.id = ua.user_id', 'left');

        if ($this->get('user_id') && $this->get('user_id') != '') {
            $user_id = $this->get('user_id');
            $this->db->where('ua.user_id', $user_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('ua.id', $search)
                ->or_like('product_id', $search)
                ->or_like('transaction_id', $search)
                ->or_like('amount', $search)
                ->or_like('ua.date', $search)
                ->or_like('u.name', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $bulkData['rows'][] = [
                'id' => $row->id,
                'name' => $row->name,
                'pay_from' => $row->pay_from,
                'product_id' => $row->product_id,
                'transaction_id' => $row->transaction_id,
                'amount' => $row->amount,
                'date' => $row->date,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function tracker_list_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('t.*, u.name');
        $this->db->from("tbl_tracker t");
        $this->db->join('tbl_users u', 'u.id = t.user_id', 'left');

        if ($this->get('user_id') && $this->get('user_id') != '') {
            $user_id = $this->get('user_id');
            $this->db->where('t.user_id', $user_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('t.id', $search)
                ->or_like('t.points', $search)
                ->or_like('t.date', $search)
                ->or_like('u.name', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        $type_key = array(
            "wonQuizZone" => lang('wonQuizZone'),
            "wonBattle" => lang('wonBattle'),
            "usedSkiplifeline" =>  lang('usedSkiplifeline'),
            "usedAudiencePolllifeline" => lang('usedAudiencePolllifeline'),
            "usedResetTimerlifeline" => lang('usedResetTimerlifeline'),
            "used5050lifeline" =>  lang('used5050lifeline'),
            "usedHintLifeline" => lang('usedHintLifeline'),
            "rewardByScratchingCard" => lang('rewardByScratchingCard'),
            "boughtCoins" => lang('boughtCoins'),
            "watchedRewardAd" => lang('watchedRewardAd'),
            "wonAudioQuiz" => lang('wonAudioQuiz'),
            "wonDailyQuiz" => lang('wonDailyQuiz'),
            "wonTrueFalse" => lang('wonTrueFalse'),
            "wonFunNLearn" => lang('wonFunNLearn'),
            "wonGuessTheWord" => lang('wonGuessTheWord'),
            "wonGroupBattle" => lang('wonGroupBattle'),
            "playedGroupBattle" => lang('playedGroupBattle'),
            "playedContest" => lang('playedContest'),
            "playedBattle" => lang('playedBattle'),
            "redeemedAmount" => lang('redeemedAmount'),
            "welcomeBonus" => lang('welcomeBonus'),
            "wonContest" => lang('wonContest'),
            "redeemRequest" => lang('redeemRequest'),
            "reversedByAdmin" => lang('reversedByAdmin'),
            "referredCodeToFriend" => lang('referredCodeToFriend'),
            "usedReferCode" => lang('usedReferCode'),
            "reviewAnswers" => lang('reviewAnswers'),
            "wonMathQuiz" => lang('wonMathQuiz'),
            "wonMultiMatch" => lang('wonMultiMatch'),
            "adminAdded" => lang('adminAdded'),
            "watchedAds" => lang('watchedAds'),
            "reviewAnswerLbl" => lang('reviewAnswerLbl'),
            "referCodeToFriend" => lang('referCodeToFriend')
        );

        foreach ($res1 as $row) {
            $bulkData['rows'][] = [
                'id' => $row->id,
                'uid' => $row->uid,
                'name' => $row->name,
                'points' => $row->points,
                'type' => (isset($type_key[$row->type])) ? $type_key[$row->type] : $row->type,
                'date' => $row->date,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function payment_requests_list_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('pr.*, u.name');
        $this->db->from("tbl_payment_request pr");
        $this->db->join('tbl_users u', 'u.id = pr.user_id', 'left');

        if ($this->get('user_id') && $this->get('user_id') != '') {
            $user_id = $this->get('user_id');
            $this->db->where('pr.user_id', $user_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('pr.id', $search)
                ->or_like('pr.payment_type', $search)
                ->or_like('pr.payment_address', $search)
                ->or_like('pr.payment_amount', $search)
                ->or_like('pr.coin_used', $search)
                ->or_like('pr.date', $search)
                ->or_like('pr.status_date', $search)
                ->or_like('u.name', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';

            $paymentAddress = '';
            $payment_address = json_decode($row->payment_address);
            for ($i = 0; $i < count($payment_address); $i++) {
                $paymentAddress .= $payment_address[$i] . '<br/>';
            }

            $bulkData['rows'][] = [
                'id' => $row->id,
                'user_id' => $row->user_id,
                'name' => $row->name,
                'uid' => $row->uid,
                'payment_address' => $paymentAddress,
                'payment_type' => $row->payment_type,
                'payment_amount' => $row->payment_amount,
                'coin_used' => $row->coin_used,
                'details' => $row->details,
                'status1' => $row->status,
                'status' => ($row->status) ? (($row->status == 1) ? "<label class='badge badge-success'>" . lang('completed') . "</label>" : "<label class='badge badge-danger'>" . lang('invalid_details') . "</label>") : "<label class='badge badge-warning'>" . lang('pending') . "</label>",
                'date' => $row->date,
                'status_date' => $row->status_date,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function battle_statistics_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select("bs.*, (SELECT name FROM tbl_users u WHERE u.id = bs.user_id1) AS user_1, (SELECT name FROM tbl_users u WHERE u.id = bs.user_id2) AS user_2");
        $this->db->from('tbl_battle_statistics bs');

        if ($this->get('user_id')) {
            $user_id = $this->get('user_id');
            $this->db->group_start()->where('bs.user_id1', $user_id)->or_where('bs.user_id2', $user_id)->group_end();
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('bs.id', $search)
                ->or_like('u.name', $search)
                ->group_end();
        }

        $this->db->group_by('bs.date_created');

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            if ($row->is_drawn == 1) {
                $mystatus = lang('draw');
            } else {
                $mystatus = ($row->winner_id == $user_id) ? lang('won') : lang('lost');
            }
            $bulkData['rows'][] = [
                'id' => $row->id,
                'opponent_id' => ($row->user_id1 == $user_id) ? $row->user_id2 : $row->user_id1,
                'opponent_name' => ($row->user_id1 == $user_id) ? $row->user_2 : $row->user_1,
                'mystatus' => $mystatus,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function global_leaderboard_get()
    {
        $sort = $this->get('sort') ?? 'r.user_rank';
        $order = $this->get('order') ?? 'ASC';

        $this->db->select('r.*, u.email, u.name,u.status');
        $this->db->from("(SELECT s.*, @user_rank := @user_rank + 1 AS user_rank FROM (SELECT m.id, m.user_id, SUM(m.score) AS score,MAX(last_updated) as last_updated FROM tbl_leaderboard_monthly m JOIN tbl_users u ON u.id = m.user_id GROUP BY m.user_id) s, (SELECT @user_rank := 0) init ORDER BY s.score DESC,s.last_updated ASC) r", false);
        $this->db->join('tbl_users u', 'u.id = r.user_id');
        $this->db->where('u.status', 1);

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('score', $search)
                ->or_like('u.name', $search)
                ->or_like('u.email', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $bulkData['rows'][] = [
                'id' => $row->user_rank,
                'user_id' => $row->user_id,
                'name' => $row->name,
                'email' => $row->email,
                'score' => $row->score,
                'user_rank' => $row->user_rank,
                'date' => $row->last_updated,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function daily_leaderboard_get()
    {
        $sort = $this->get('sort') ?? 'r.user_rank';
        $order = $this->get('order') ?? 'ASC';

        $this->db->select('id, user_id, score, date_created, @user_rank := @user_rank + 1 AS user_rank', false);
        $this->db->from("(SELECT @user_rank := 0) init, tbl_leaderboard_daily d");
        $this->db->where('DATE(date_created)', $this->toDate);
        $this->db->order_by('score', 'DESC');
        $subQuery = $this->db->get_compiled_select();

        $this->db->select('r.*, u.email, u.name, u.profile');
        $this->db->from("($subQuery) r");
        $this->db->join('tbl_users u', 'u.id = r.user_id');
        $this->db->where('u.status', 1);

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('r.score', $search)
                ->or_like('r.date_created', $search)
                ->or_like('u.name', $search)
                ->or_like('u.email', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $bulkData['rows'][] = [
                'id' => $row->user_rank,
                'user_id' => $row->user_id,
                'name' => $row->name,
                'email' => $row->email,
                'score' => $row->score,
                'user_rank' => $row->user_rank,
                'date_created' => date('d-M-Y h:i A', strtotime($row->date_created)),
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function monthly_leaderboard_get()
    {
        $sort = $this->get('sort') ?? 'r.user_rank';
        $order = $this->get('order') ?? 'ASC';

        $year = $this->get('year');
        $month = $this->get('month');

        $sub_query = "SELECT s.*, @user_rank := @user_rank + 1 user_rank FROM ( SELECT m.id, user_id, SUM(score) as score,date_created, MAX(last_updated) as last_updated FROM tbl_leaderboard_monthly m join tbl_users u on u.id = m.user_id WHERE YEAR(last_updated)=$year AND MONTH(last_updated)=$month AND u.status=1 GROUP BY user_id) s, (SELECT @user_rank := 0) init ORDER BY score DESC, last_updated ASC";

        $this->db->select('r.*,u.email, u.name, u.profile');
        $this->db->from("($sub_query) r");
        $this->db->join('tbl_users u', 'u.id = r.user_id');

        if ($this->get('user_id') && $this->get('user_id') != '') {
            $user_id = $this->get('user_id');
            $this->db->where('r.user_id', $user_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('r.score', $search)
                ->or_like('r.date_created', $search)
                ->or_like('u.name', $search)
                ->or_like('u.email', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $bulkData['rows'][] = [
                'id' => $row->user_rank,
                'name' => $row->name,
                'email' => $row->email,
                'user_id' => $row->user_id,
                'score' => $row->score,
                'user_rank' => $row->user_rank,
                'last_updated' => date("d-m-Y H:m:s", strtotime($row->last_updated)),
                'date_created' => date("d-m-Y H:m:s", strtotime($row->date_created)),
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function system_langauge_get()
    {
        $offset = 0;
        $limit = 10;
        $sort = 'language_name';
        $order = 'DESC';

        if ($this->get('offset'))
            $offset = $this->get('offset');
        if ($this->get('limit'))
            $limit = $this->get('limit');

        if ($this->get('sort'))
            $sort = $this->get('sort');
        if ($this->get('order'))
            $order = $this->get('order');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
        }

        $res = panel_languages();

        if (!empty($search)) {
            $res = array_filter($res, function ($item) use ($search) {
                return stripos($item, $search) !== false; // Case-insensitive search
            });
        }

        if ($sort == 'language_name') {
            if ($order == 'ASC') {
                sort($res);
            } else {
                rsort($res);
            }
        }

        $totalRows = count($res);
        $slicedData = array_slice($res, $offset, $limit);

        $bulkData = array();
        $rows = array();
        $count = $offset + 1;
        $bulkData['total'] = $totalRows;

        $tempRow = array();
        foreach ($slicedData as $row) {
            $title = $row;
            $operate = '';
            $user_current_language = get_user_permissions($this->session->userdata('authId'))['language'] ?? 'english';
            if ($row != $user_current_language && ($row != 'en' && $row != 'english' && $row != 'sample_file')) {
                $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-lang=' . $row . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';
            }
            $operate .= '<a class="btn btn-icon btn-sm btn-warning view-data" href="' . base_url() . "new-labels/" . $row . '" ><i class="fa fa-eye"></i></a>';

            $tempRow['no'] = $count;
            $tempRow['name'] = $row;
            $tempRow['title'] = $title;
            $tempRow['operate'] = $operate;
            $rows[] = $tempRow;
            $count++;
        }
        $bulkData['rows'] = $rows;
        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function app_system_langauge_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->where('app_version!=', '0.0.0');
        $this->db->from('tbl_upload_languages');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('id', $search)
                ->or_like('name', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];
        foreach ($res1 as $key => $row) {
            $file = $row->name;
            $operate = '';
            $operate .= '<a class="btn btn-icon btn-sm btn-primary edit-data" data-toggle="modal" data-target="#editDataModalApp" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            if ($row->app_default == 0) {
                $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-app-data" data-lang=' . $file . '><i class="fa fa-trash"></i></a>';
            }
            $operate .= '<a class="btn btn-icon btn-sm btn-warning view-data" href="' . base_url() . "new-labels/app/" . $file . '" ><i class="fa fa-eye"></i></a>';

            $bulkData['rows'][] = [
                'no' => ($offset ?? 0) + $key + 1,
                'name' => $file,
                'title' => $row->title,
                'app_default' => $row->app_default,
                'app_version' => $row->app_version,
                'app_status' => $row->app_status,
                'app_rtl_support' => $row->app_rtl_support,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function web_system_langauge_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->where('web_version!=', '0.0.0');
        $this->db->from('tbl_upload_languages');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('id', $search)
                ->or_like('name', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $key => $row) {
            $file = $row->name;
            $operate = '';
            $operate .= '<a class="btn btn-icon btn-sm btn-primary edit-data" data-toggle="modal" data-target="#editDataModalWeb" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            if ($row->web_default == 0) {
                $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-web-data" data-lang=' . $file . '><i class="fa fa-trash"></i></a>';
            }
            $operate .= '<a class="btn btn-icon btn-sm btn-warning view-data" href="' . base_url() . "new-labels/web/" . $file . '" ><i class="fa fa-eye"></i></a>';
            $bulkData['rows'][] = [
                'no' => ($offset ?? 0) + $key + 1,
                'name' => $file,
                'title' => $row->title,
                'web_default' => $row->web_default,
                'web_version' => $row->web_version,
                'web_status' => $row->web_status,
                'web_rtl_support' => $row->web_rtl_support,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function notification_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('*');
        $this->db->from('tbl_notifications');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('id', $search)
                ->or_like('title', $search)
                ->or_like('message', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? NOTIFICATION_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image=' . $image . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';
            $bulkData['rows'][] = [
                'id' => $row->id,
                'title' => $row->title,
                'message' => $row->message,
                'users' => ucwords($row->users),
                'type' => ucwords($row->type),
                'type_id' => ucwords($row->type_id),
                'date_sent' => date('d-m-Y', strtotime($row->date_sent)),
                'image' => (!empty($row->image)) ? '<a href=' . base_url() . $image . ' data-lightbox="' . lang('image') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function user_account_get()
    {
        $sort = $this->get('sort') ?? 'auth_id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('*');
        $this->db->where('status', 0);
        $this->db->from('tbl_authenticate');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('auth_id', $search)
                ->or_like('auth_username', $search)
                ->or_like('role', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];
        foreach ($res1 as $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->auth_id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->auth_id . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';
            $bulkData['rows'][] = [
                'id' => $row->auth_id,
                'auth_username' => $row->auth_username,
                'role' => $row->role,
                'permissions' => json_decode($row->permissions, 1),
                'created' => date('d-m-Y H:m a', strtotime($row->created)),
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function coin_store_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('cs.*');
        $this->db->from('tbl_coin_store cs');

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('cs.id', $search)
                ->or_like('title', $search)
                ->or_like('coins', $search)
                ->or_like('product_id', $search)
                ->or_like('description', $search)
                ->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);
        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? COIN_STORE_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary status-update" data-id=' . $row->id . ' data-toggle="modal" data-target="#updateStatusModal" title="' . lang('status') . '"><i class="fa fa-toggle-on"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image=' . $image . ' title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $bulkData['rows'][] = [
                'id' => $row->id,
                'type' => $row->type,
                'title' => $row->title,
                'coins' => $row->coins,
                'product_id' => $row->product_id,
                'description' => $row->description,
                'image_url' => $image,
                'status' => ($row->status) ? "<label class='badge badge-success'>" . lang('active') . "</label>" : "<label class='badge badge-danger'>" . lang('deactive') . "</label>",
                'status_db' => $row->status,
                'image' => (!empty($image)) ? '<a href=' . base_url() . $image . '  data-lightbox="Coin Store Images"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function web_home_settings_get()
    {
        $sort = $this->get('sort') ?? 'w.id';
        $order = $this->get('order') ?? 'ASC';

        $settings = [
            'section1_heading',
            'section1_title1',
            'section1_title2',
            'section1_title3',
            'section1_image1',
            'section1_image2',
            'section1_image3',
            'section1_desc1',
            'section1_desc2',
            'section1_desc3',
            'section2_heading',
            'section2_title1',
            'section2_title2',
            'section2_title3',
            'section2_title4',
            'section2_desc1',
            'section2_desc2',
            'section2_desc3',
            'section2_desc4',
            'section2_image1',
            'section2_image2',
            'section2_image3',
            'section2_image4',
            'section3_heading',
            'section3_title1',
            'section3_title2',
            'section3_title3',
            'section3_title4',
            'section3_image1',
            'section3_image2',
            'section3_image3',
            'section3_image4',
            'section3_desc1',
            'section3_desc2',
            'section3_desc3',
            'section3_desc4'
        ];

        $this->db->select('w.*, l.language');
        $this->db->from('tbl_web_settings w');
        $this->db->join('tbl_languages l', 'l.id = w.language_id', 'left');
        $this->db->where_in('w.type', $settings);

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('w.language_id', $language_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('w.id', $search)
                ->or_like('l.language', $search)->group_end();
        }

        $this->db->group_by('w.language_id');
        $this->db->order_by($sort, $order);

        $total_query = clone $this->db;

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $res = $query->result();

        $total = $total_query->get()->num_rows();
        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res as $key => $row) {
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" href="' . base_url() . "web-home-settings/" . $row->language_id . '" data-id=' . $row->id . 'title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $bulkData['rows'][] = [
                'id' => $row->id,
                'no' =>  $offset + $key + 1,
                'language_id' => $row->language_id,
                'language' => $row->language,
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }

    public function slider_get()
    {
        $sort = $this->get('sort') ?? 'id';
        $order = $this->get('order') ?? 'DESC';

        $this->db->select('s.*,l.language');
        $this->db->from('tbl_slider s');
        $this->db->join('tbl_languages l', 'l.id = s.language_id', 'left');

        if ($this->get('language') && $this->get('language') != '') {
            $language_id = $this->get('language');
            $this->db->where('s.language_id', $language_id);
        }

        if ($this->get('search')) {
            $search = $this->db->escape_like_str($this->get('search'));
            $this->db->group_start()->like('s.id', $search)
                ->or_like('s.title', $search)
                ->or_like('s.description', $search)
                ->or_like('l.language', $search)->group_end();
        }

        $total = $this->db->count_all_results('', false);
        $this->db->order_by($sort, $order);

        if ($this->get('limit')) {
            $offset = $this->get('offset');
            $limit = $this->get('limit');
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        $res1 = $query->result();

        $bulkData = [
            'total' => $total,
            'rows' => []
        ];

        foreach ($res1 as $row) {
            $image = (!empty($row->image)) ? SLIDER_IMG_PATH . $row->image : '';
            $operate = '<a class="btn btn-icon btn-sm btn-primary edit-data" data-id=' . $row->id . ' data-toggle="modal" data-target="#editDataModal" title="' . lang('edit') . '"><i class="fa fa-edit"></i></a>';
            $operate .= '<a class="btn btn-icon btn-sm btn-danger delete-data" data-id=' . $row->id . ' data-image="' . $image . '" title="' . lang('delete') . '"><i class="fa fa-trash"></i></a>';

            $bulkData['rows'][] = [
                'image_url' => $image,
                'id' => $row->id,
                'language_id' => $row->language_id,
                'language' => $row->language,
                'description' => $row->description,
                'title' => $row->title,
                'image' => (!empty($image)) ? '<a href=' . base_url() . $image . '  data-lightbox="' . lang('slider_images') . '"><img src=' . base_url() . $image . ' height=50, width=50 ></a>' : '<img src=' . $this->NO_IMAGE . ' height=30 >',
                'operate' => $operate,
            ];
        }

        echo json_encode($bulkData, JSON_UNESCAPED_UNICODE);
    }
}
