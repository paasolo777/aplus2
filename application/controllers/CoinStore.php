<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CoinStore extends CI_Controller
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
        if (!has_permissions('read', 'coin_store_settings')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'coin_store_settings')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data = $this->Coin_Store_model->add_data();
                    if ($data == FALSE) {
                        $failedResponseData = array(
                            'error' => lang('product_id_already_exists'),
                            'title' => $this->input->post('title'),
                            'coins' => $this->input->post('coins'),
                            'product_id' => $this->input->post('product_id'),
                            'description' => $this->input->post('description'),
                        );
                        $this->session->set_flashdata($failedResponseData);
                        redirect('coin-store-settings');
                    } else if ($data === 2) {
                        $failedResponseData = array(
                            'error' => lang('file_upload_failed'),
                            'title' => $this->input->post('title'),
                            'coins' => $this->input->post('coins'),
                            'product_id' => $this->input->post('product_id'),
                            'description' => $this->input->post('description'),
                        );
                        $this->session->set_flashdata($failedResponseData);
                        redirect('coin-store-settings');
                    } else {
                        $this->session->set_flashdata('success', lang('data_created_successfully'));
                        redirect('coin-store-settings');
                    }
                }
            } else if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'coin_store_settings')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Coin_Store_model->update_data();
                    if ($data1 == FALSE) {
                        $failedResponseData = array(
                            'error' => lang('product_id_already_exists'),
                        );
                        $this->session->set_flashdata($failedResponseData);
                        redirect('coin-store-settings');
                    } else if ($data1 === 2) {
                        $failedResponseData = array(
                            'error' => lang('file_upload_failed'),
                        );
                        $this->session->set_flashdata($failedResponseData);
                        redirect('coin-store-settings');
                    } else {
                        $this->session->set_flashdata('success', lang('data_updated_successfully'));
                        redirect('coin-store-settings');
                    }
                }
            } else if ($this->input->post('btnupdatestatus')) {
                if (!has_permissions('update', 'coin_store_settings')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Coin_Store_model->update_status();
                    $this->session->set_flashdata('success', lang('status_updated_successfully'));
                    redirect('coin-store-settings');
                }
            }
            $this->result['is_ads'] = 0;
            $query =  $this->db->where('type', '1')->get('tbl_coin_store');
            if ($query->num_rows() > 0) {
                $this->result['is_ads'] = 1;
            }
            $this->load->view('coin_store_settings', $this->result);
        }
    }

    public function deleteCoinStoreData()
    {
        if (!has_permissions('delete', 'coin_store_settings')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $image = $this->input->post('image_url');
            $this->Coin_Store_model->delete_data($id, $image);
            echo TRUE;
        }
    }
}
