<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Questions extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
        date_default_timezone_set(get_system_timezone());

        $this->quiz_type = 1;

        $this->result['language'] = $this->Language_model->get_data();
        $this->result['category'] = $this->Category_model->get_data($this->quiz_type);
    }

    public function index()
    {
        if (!has_permissions('read', 'questions')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'questions')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Question_model->add_data();
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_created_successfully'));
                    }
                    $type = $this->uri->segment(1);
                    $setData["$type"] = [
                        'language_id' => ($this->input->post('language_id')) ? $this->input->post('language_id') : 0,
                        'category' => $this->input->post('category'),
                        'subcategory' => $this->input->post('subcategory')
                    ];
                    $this->session->set_userdata($setData);
                }
                redirect('create-questions');
            } else if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'questions')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Question_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_updated_successfully'));
                    }
                }
                redirect('create-questions');
            }
            $this->load->view('questions_create', $this->result);
        }
    }

    public function manage_questions()
    {
        if (!has_permissions('read', 'questions')) {
            redirect('/');
        } else {
            $this->load->view('questions_manage', $this->result);
        }
    }

    public function edit_questions($id)
    {
        if (!has_permissions('read', 'questions')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'questions')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Question_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_updated_successfully'));
                    }
                }
                redirect('manage-questions');
            }
            $this->result['data'] = $this->Question_model->get_data($id);
            $this->load->view('questions_create', $this->result);
        }
    }

    public function delete_questions()
    {
        if (!has_permissions('delete', 'questions')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Question_model->delete_data($id, $image_url);
            echo TRUE;
        }
    }

    public function import_questions()
    {
        if (!has_permissions('read', 'import_question')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'import_question')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Question_model->import_data();
                    if ($data['error_code'] == "1") {
                        $this->session->set_flashdata('success', lang('csv_file_successfully_imported'));
                    } else if ($data['error_code'] == "0") {
                        if ($data['error'] != '') {
                            $this->session->set_flashdata('error', $data['error']);
                        } else {
                            $this->session->set_flashdata('error',  lang('please_upload_data_in_csv_file'));
                        }
                    } else if ($data['error_code'] == "2") {
                        if ($data['error'] != '') {
                            $this->session->set_flashdata('error', $data['error']);
                        } else {
                            $this->session->set_flashdata('error', lang('please_fill_all_the_data_in_csv_file'));
                        }
                    } else {
                        $this->session->set_flashdata('error', $data['error']);
                    }
                }
                redirect('import-questions');
            }
            $this->load->view('import_questions', $this->result);
        }
    }

    public function daily_quiz()
    {
        if (!has_permissions('read', 'daily_quiz')) {
            redirect('/');
        } else {
            $this->load->view('daily_quiz', $this->result);
        }
    }

    public function add_daily_quiz()
    {
        if (!has_permissions('update', 'daily_quiz')) {
            $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
        } else {
            $language_id = $this->input->post('language_id');
            $question_ids = $this->input->post('question_ids');
            $daily_quiz_date = $this->input->post('daily_quiz_date');
            $this->Question_model->add_daily_quiz($language_id, $question_ids, $daily_quiz_date);
            $this->session->set_flashdata('success', lang('daily_quiz_created_successfully'));
        }
        return TRUE;
    }

    public function get_daily_quiz()
    {
        $selected_date = $this->input->post('selected_date');
        $language_id = $this->input->post('language_id');
        $html = "";
        $data = $this->db->where('date_published', $selected_date)->where('language_id', $language_id)->get('tbl_daily_quiz')->result();
        if ($data) {
            foreach ($data as $row) {
                $language_id = $row->language_id;
            }
            $questions = $response = array();
            $questions = $data[0]->questions_id;
            $query = $this->db->query("SELECT id, question FROM tbl_question WHERE id IN (" . $questions . ") ORDER BY FIELD(id," . $questions . ")");
            $res = $query->result();
            foreach ($res as $question) {
                $setquestion = (is_settings('latex_mode')) ? "<textarea class='editor-questions-inline'>" . $question->question . "</textarea>" : $question->question;
                $html .= "<li id=" . $question->id . " class='ui-state-default ui-sortable-handle'>" . $question->id . "<a class='btn btn-danger btn-sm remove-row float-right'>x</a>. " . $setquestion . "</li>";
            }
            $response['error'] = false;
            $response['language_id'] = $language_id;
            $response['questions_list'] = $html;
        } else {
            $response['error'] = false;
            $response['questions_list'] = $html;
            $response['language_id'] = '';
        }
        print_r(json_encode($response));
    }

    public function question_reports()
    {
        if (!has_permissions('read', 'question_report')) {
            redirect('/');
        } else {
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'questions')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Question_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_updated_successfully'));
                    }
                }
                redirect('question-reports');
            }
            $this->load->view('question_reports', $this->result);
        }
    }

    public function edit_question_reports($id)
    {
        if (!has_permissions('read', 'questions')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'questions')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Question_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_updated_successfully'));
                    }
                }
                redirect('question-reports');
            }
            $this->result['data'] = $this->Question_model->get_data($id);
            $this->load->view('questions_create', $this->result);
        }
    }

    public function delete_question_report()
    {
        if (!has_permissions('delete', 'question_report')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $this->Question_model->delete_question_report($id);
            echo TRUE;
        }
    }
}
