<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Badges extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->config('quiz');
    }

    public function index()
    {
        if (!has_permissions('read', 'badges_settings')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'badges_settings')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Badges_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('badge_updated_successfully'));
                    }
                }
                redirect('badges-settings');
            }
            $badges = [
                'dashing_debut',
                'combat_winner',
                'clash_winner',
                'most_wanted_winner',
                'ultimate_player',
                'quiz_warrior',
                'super_sonic',
                'flashback',
                'brainiac',
                'big_thing',
                'elite',
                'thirsty',
                'power_elite',
                'sharing_caring',
                'streak'
            ];
            foreach ($badges as $row) {
                $this->result[$row] = $this->db->select('badge_icon,badge_reward,badge_counter')->where('type', $row)->get('tbl_badges')->row_array();
            }
            $this->load->view('badges_settings', $this->result);
        }
    }

    public function edit_data($id)
    {
        if (!has_permissions('read', 'badges_settings')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('update', 'badges_settings')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $data1 = $this->Badges_model->update_data();
                    if ($data1 == FALSE) {
                        $this->session->set_flashdata('error', lang(IMAGE_ALLOW_MSG));
                    } else {
                        $this->session->set_flashdata('success', lang('badge_updated_successfully'));
                    }
                }
                redirect('badges-settings/' . $id);
            }
            $badges = [
                'dashing_debut',
                'combat_winner',
                'clash_winner',
                'most_wanted_winner',
                'ultimate_player',
                'quiz_warrior',
                'super_sonic',
                'flashback',
                'brainiac',
                'big_thing',
                'elite',
                'thirsty',
                'power_elite',
                'sharing_caring',
                'streak'
            ];
            foreach ($badges as $row) {
                $otherBadgeData = $this->db->select('badge_icon,badge_reward,badge_counter')->where('type', $row)->get('tbl_badges')->row_array();
                $this->result[$row] = $otherBadgeData;
            }
            $this->load->view('badges_settings', $this->result);
        }
    }
}
