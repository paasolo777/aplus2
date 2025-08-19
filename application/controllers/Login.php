<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login extends CI_Controller
{

    /**  This is default constructor of the class */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('password_helper');
        $this->load->library('session');

        $this->result['background_file'] = $this->db->where('type', 'background_file')->get('tbl_settings')->row_array();
    }

    /**  Index Page for this controller. */
    public function index()
    {
        $this->isLoggedIn();
    }

    /*     * This function used to check the user is logged in or not */

    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            $this->load->view('login', $this->result);
        } else {
            if (!empty($this->input->post('rememberMe'))) {
                //COOKIES for username
                setcookie("elite_user_login", $this->input->post('username'), time() + (10 * 365 * 24 * 60 * 60));
                //COOKIES for password
                setcookie("elite_userpassword", $this->input->post('password'), time() + (10 * 365 * 24 * 60 * 60));
            } else {
                if (isset($_COOKIE["elite_user_login"])) {
                    setcookie("elite_user_login", "");
                    if (isset($_COOKIE["elite_userpassword"])) {
                        setcookie("elite_userpassword", "");
                    }
                }
            }
            $json_file = 'assets/firebase_config.json';
            if (!file_exists($json_file)) {
                redirect('firebase-configurations');
            } else {
                redirect('dashboard');
            }
        }
    }

    /*     * * This function used to logged in user */

    public function loginMe()
    {
        $result = $this->Login_model->get_user();

        if ($result) {
            $sessionArray = array(
                'authName' => $result->auth_username,
                'authId' => $result->auth_id,
                'authRole' => $result->role,
                'authStatus' => $result->status,
                'isLoggedIn' => TRUE
            );
            $this->session->set_userdata($sessionArray);
            $this->isLoggedIn();
        } else {
            $this->session->set_flashdata('error', lang('invalid_username_or_password'));
            redirect('', 'refresh');
        }
        $this->load->view('login', $this->result);
    }

    public function checkOldPass()
    {
        $oldpass = $this->input->post('oldpass');

        //fetch old password from database
        $aname = $this->session->userdata('authName');
        $row = $this->db->where('auth_username', $aname)->get('tbl_authenticate')->row();
        if (verifyHashedPassword($oldpass, $row->auth_pass)) {
            echo json_encode("True");
        } else {
            echo json_encode("False");
        }
    }

    public function resetpassword()
    {
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('login');
        } else {
            if ($this->input->post('btnchange')) {
                if (!has_permissions('create', 'resetpassword')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $newpass = $this->input->post('newpassword');
                    $confirmpass = $this->input->post('confirmpassword');
                    if ($newpass == $confirmpass) {

                        $adminId = $this->session->userdata('authId');

                        $adminpass = getHashedPassword($confirmpass);
                        //change password
                        $this->Login_model->change_password($adminId, $adminpass);
                        $this->session->set_flashdata('success', lang('password_change_successfully'));
                    } else {
                        $this->session->set_flashdata('error', lang('new_and_confirm_password_not_match'));
                    }
                }
                redirect('resetpassword', 'refresh');
            }
            $this->load->view('changePassword', $this->result);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('isLoggedIn');
        $this->session->sess_destroy();
        redirect('');
    }
}
