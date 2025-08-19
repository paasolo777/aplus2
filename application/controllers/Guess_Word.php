<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Guess_Word extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
        $this->category_type = $this->config->item('category_type');
        $this->quiz_type = 3;
    }

    public function index()
    {
        if (!has_permissions('read', 'guess_the_word')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'guess_the_word')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Guess_Word_model->add_data();
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success',  lang('question_created_successfully'));
                    }
                    $type = $this->uri->segment(1);
                    $setData["$type"] = [
                        'language_id' => ($this->input->post('language_id')) ? $this->input->post('language_id') : 0,
                        'category' => $this->input->post('category'),
                        'subcategory' => $this->input->post('subcategory')
                    ];
                    $this->session->set_userdata($setData);
                }
                redirect('guess-the-word', 'refresh');
            }
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'guess_the_word')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Guess_Word_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('question_updated_successfully'));
                    }
                }
                redirect('guess-the-word', 'refresh');
            }
            $this->result['language'] = $this->Language_model->get_data();
            $this->result['category'] = $this->Category_model->get_data($this->quiz_type);
            $this->result['language_english'] = $this->Language_model->get_english_lang();  // get the english us and uk language data
            $this->load->view('guess_the_word', $this->result);
        }
    }

    public function delete_guess_word()
    {
        if (!has_permissions('delete', 'guess_the_word')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Guess_Word_model->delete_data($id, $image_url);
            echo TRUE;
        }
    }
}
