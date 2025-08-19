<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
    }

    public function index()
    {
        if (!has_permissions('read', 'sliders')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'sliders')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Slider_model->add_data();
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_PNG_JPG_SVG_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('slider_created_successfully'));
                    }
                }
                redirect('sliders');
            }
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'sliders')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Slider_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_PNG_JPG_SVG_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('slider_updated_successfully'));
                    }
                }
                redirect('sliders');
            }
            $this->result['language'] = $this->Language_model->get_data();
            $this->load->view('sliders', $this->result);
        }
    }

    public function delete_sliders()
    {
        if (!has_permissions('delete', 'sliders')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Slider_model->delete_data($id, $image_url);
            echo TRUE;
        }
    }
}
