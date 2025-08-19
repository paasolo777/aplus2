<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subcategory extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
        $this->category_type = $this->config->item('category_type');
    }

    public function index()
    {
        if (!has_permissions('read', 'subcategories')) {
            redirect('/', 'refresh');
        } else {
            if ($this->input->post('btnadd')) {
                $type_name = $this->input->post('type');
                if (!has_permissions('create', 'subcategories')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Subcategory_model->add_data();
                    if ($data == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else if ($data === 3) {
                        $this->session->set_flashdata('error', lang('slug_already_exists'));
                    } else if ($data === 4) {
                        $this->session->set_flashdata('error', lang('slug_is_required'));
                    } else {
                        $this->session->set_flashdata('success', lang('subcategory_created_successfully'));
                    }
                }
                redirect($type_name, 'refresh');
            }
            if ($this->input->post('btnupdate')) {
                $type_name = $this->input->post('type');
                if (!has_permissions('update', 'subcategories')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Subcategory_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else if ($data1 === 3) {
                        $this->session->set_flashdata('error', lang('slug_already_exists'));
                    } else if ($data1 === 4) {
                        $this->session->set_flashdata('error', lang('slug_is_required'));
                    } else {
                        $this->session->set_flashdata('success', lang('subcategory_updated_successfully'));
                    }
                }
                redirect($type_name, 'refresh');
            }
            $this->result['language'] = $this->Language_model->get_data();
            $type_name = $this->uri->segment(1);
            $type = $this->category_type[$type_name];
            $this->result['category'] = $this->Category_model->get_data($type);
            $this->load->view('sub_category', $this->result);
        }
    }

    public function delete_subcategory()
    {
        if (!has_permissions('delete', 'subcategories')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image_url = $this->input->post('image_url');
            $this->Subcategory_model->delete_data($id, $image_url);
            echo TRUE;
        }
    }

    public function get_slug()
    {
        if (!has_permissions('read', 'categories')) {
            redirect('/', 'refresh');
        } else {
            $this->load->helper('url');
            $category_name = $this->input->post('category_name');
            $editId = $this->input->post('id');

            // Check if the category name is in English and contains only letters, numbers,spaces and hyphens
            if (!preg_match('/^[a-z0-9- ]+$/i', $category_name)) {
                echo '';
                return;
            }

            $slug = url_title($category_name, 'dash', TRUE);

            if ($this->Subcategory_model->is_unique_slug($slug, $editId) != 0) {
                $counter = 1;
                $original_slug = $slug;
                while ($this->Subcategory_model->is_unique_slug($slug, $editId) != 0) {
                    $slug = $original_slug . '-' . $counter;
                    $counter++;
                }
            }
            echo $slug;
        }
    }

    public function verify_slug()
    {
        if (!has_permissions('read', 'categories')) {
            redirect('/', 'refresh');
        } else {
            $slug = $this->input->post('slug');
            $id = $this->input->post('id');
            $slug = trim($slug);
            if (!preg_match('/^[a-z0-9-]+$/i', $slug)) {
                echo 3; // Code 
                return false;
            } else if (!$this->Subcategory_model->is_unique_slug($slug, $id)) {
                echo FALSE;
                return false;
            }
            echo TRUE;
            return false;
        }
    }
}
