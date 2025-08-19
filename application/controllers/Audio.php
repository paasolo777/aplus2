<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Audio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
        $this->quiz_type = 4;
        $this->result['total_audio_time'] = $this->db->where('type', 'total_audio_time')->get('tbl_settings')->row_array();
    }

    public function index()
    {
        if (!has_permissions('read', 'audio_question')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'audio_question')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Audio_model->add_audio_data();
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', lang(AUDIO_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('audio_question_created_successfully'));
                    }
                }
                $type = $this->uri->segment(1);
                $setData["$type"] = [
                    'language_id' => ($this->input->post('language_id')) ? $this->input->post('language_id') : 0,
                    'category' => $this->input->post('category'),
                    'subcategory' => $this->input->post('subcategory')
                ];
                $this->session->set_userdata($setData);
                redirect('audio-question');
            } else if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'audio_question')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Audio_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(AUDIO_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('audio_question_updated_successfully'));
                    }
                }
                redirect('audio-question');
            }
            $this->result['language'] = $this->Language_model->get_data();
            $this->result['category'] = $this->Category_model->get_data($this->quiz_type);
            $this->load->view('audio_questions', $this->result);
        }
    }

    public function delete_audio_question()
    {
        if (!has_permissions('delete', 'audio_question')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $audio_url = $this->input->post('audio_url');
            $this->Audio_model->delete_data($id, $audio_url);
            echo TRUE;
        }
    }
}
