<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Multi_Match extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
        date_default_timezone_set(get_system_timezone());

        $this->quiz_type = 6;

        $this->result['language'] = $this->Language_model->get_data();
        $this->result['category'] = $this->Category_model->get_data($this->quiz_type);
    }

    public function index()
    {
        if (!has_permissions('read', 'multi_match')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'multi_match')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Multi_Match_model->add_data();
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
                redirect('multi-match');
            } else if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'multi_match')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Multi_Match_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_updated_successfully'));
                    }
                }
                redirect('multi-match');
            }
            $this->load->view('multi_match_questions_create', $this->result);
        }
    }

    public function manage_questions()
    {
        if (!has_permissions('read', 'multi_match')) {
            redirect('/');
        } else {
            $this->load->view('multi_match_questions_manage', $this->result);
        }
    }

    public function edit_questions($id)
    {
        if (!has_permissions('read', 'multi_match')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'multi_match')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {

                    $data1 = $this->Multi_Match_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_updated_successfully'));
                    }
                }
                redirect('manage-multi-match');
            }
            $this->result['data'] = $this->Multi_Match_model->get_data($id);
            $this->load->view('multi_match_questions_create', $this->result);
        }
    }

    public function delete_questions()
    {
        if (!has_permissions('delete', 'multi_match')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Multi_Match_model->delete_data($id, $image_url);
            echo TRUE;
        }
    }

    public function import_questions()
    {
        if (!has_permissions('read', 'multi_match_import_question')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'multi_match_import_question')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Multi_Match_model->import_data();
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
                redirect('multi-match-import-questions');
            }
            $this->load->view('multi_match_import_questions', $this->result);
        }
    }

    public function question_reports()
    {
        if (!has_permissions('read', 'multi_match_question_report')) {
            redirect('/');
        } else {
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'multi_match_question_report')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Multi_Match_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_updated_successfully'));
                    }
                }
                redirect('multi-match-question-reports');
            }
            $this->load->view('multi_match_question_reports', $this->result);
        }
    }

    public function edit_question_reports($id)
    {
        if (!has_permissions('read', 'multi_match_question_report')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'multi_match_question_report')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Multi_Match_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_updated_successfully'));
                    }
                }
                redirect('multi-match-question-reports');
            }
            $this->result['data'] = $this->Multi_Match_model->get_data($id);
            $this->load->view('multi_match_questions_create', $this->result);
        }
    }

    public function delete_question_report()
    {
        if (!has_permissions('delete', 'multi_match_question_report')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $this->Multi_Match_model->delete_question_report($id);
            echo TRUE;
        }
    }
}
