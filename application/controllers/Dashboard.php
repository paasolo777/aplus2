<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public $toDate;
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLoggedIn')) {
            redirect('/');
        }
        $this->load->helper('password_helper');
        $this->load->config('quiz');

        $this->category_type = $this->config->item('category_type');

        date_default_timezone_set(get_system_timezone());
        $this->toDate = date('Y-m-d');

        $this->NO_IMAGE = base_url() . LOGO_IMG_PATH . is_settings('half_logo');
    }

    public function index()
    {
        $this->result['count_category'] = $this->db->where('type', 1)->count_all_results('tbl_category');
        $query = $this->db->select('COUNT(tbl_subcategory.id) as total')->from('tbl_subcategory')->join('tbl_category', 'tbl_category.id = tbl_subcategory.maincat_id AND tbl_category.type = 1')->get();
        $result = $query->row();
        $this->result['count_subcategory'] = $result->total ?? 0;
        $this->result['count_question'] = $this->db->count_all('tbl_question');
        $this->result['count_user'] = $this->db->count_all('tbl_users');
        $this->result['count_live_contest'] = $this->db->where('start_date<=', $this->toDate)->where('end_date>', $this->toDate)->count_all_results('tbl_contest');
        $this->result['count_fun_n_learn'] = $this->db->count_all('tbl_fun_n_learn');
        $this->result['count_guess_the_word'] = $this->db->count_all('tbl_guess_the_word');
        $this->result['count_system_user'] = $this->db->where('status', 0)->count_all_results('tbl_authenticate');

        $year_data = $this->db->query("SELECT DISTINCT YEAR(date_registered) as year FROM tbl_users")->result();
        $this->result['years'] = array();
        foreach ($year_data as $row) {
            $this->result['years'][] = $row->year;
        }

        $year = date('Y');

        $register_month_sql = "SELECT m.name AS month_name,(SELECT COUNT(id) FROM tbl_users u WHERE status = 1 AND YEAR(u.date_registered) = {$year} AND MONTHNAME(date_registered) = m.name) AS user_count FROM tbl_month_week m WHERE m.type = 1";
        $month_register_query = $this->db->query($register_month_sql)->result();
        $this->result['month_data'] = $month_register_query;

        $register_week_sql = "SELECT day_name,COUNT(u.id) AS user_count FROM (SELECT 'Monday' AS day_name UNION ALL SELECT 'Tuesday' UNION ALL SELECT 'Wednesday' UNION ALL SELECT 'Thursday' UNION ALL SELECT 'Friday' UNION ALL SELECT 'Saturday' UNION ALL SELECT 'Sunday') AS days LEFT JOIN tbl_users u ON DAYNAME(u.date_registered) = days.day_name AND u.status = 1 AND YEARWEEK(u.date_registered, 1) = YEARWEEK(CURDATE(), 1) GROUP BY day_name ORDER BY FIELD(day_name, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
        $week_register_query = $this->db->query($register_week_sql)->result();
        $this->result['week_data'] = $week_register_query;

        $day_register_sql = "SELECT DATE_FORMAT(dates.hour, '%Y-%m-%d %H:00:00') AS hour,COALESCE(COUNT(u.id), 0) AS user_count,DATE_FORMAT(dates.hour, '%H') AS day_name FROM (SELECT '" . $this->toDate . "' + INTERVAL a.a HOUR AS hour FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12 UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15 UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18 UNION ALL SELECT 19 UNION ALL SELECT 20 UNION ALL SELECT 21 UNION ALL SELECT 22 UNION ALL SELECT 23 ) a ) dates LEFT JOIN tbl_users u ON dates.hour = DATE_FORMAT(u.date_registered, '%Y-%m-%d %H:00:00') AND DATE(u.date_registered) = '" . $this->toDate . "' AND u.status = 1 GROUP BY hour, day_name ORDER BY hour";
        $day_register_query = $this->db->query($day_register_sql)->result();
        $this->result['day_data'] = $day_register_query;

        $this->load->view('dashboard', $this->result);
    }

    public function edit_accounts_rights()
    {
        if (!has_permissions('read', 'users_accounts_rights')) {
            redirect('/');
        } else {
            $id = $this->input->post('id');
            $this->result['fetched_data'] = $this->User_model->get_user_rights($id);
            $this->result['system_modules'] = $this->config->item('system_modules');
            $this->load->view('edit_accounts_rights', $this->result, false);
        }
    }

    public function users_accounts_rights()
    {
        if (!has_permissions('read', 'users_accounts_rights')) {
            redirect('/');
        } else {
            if ($this->input->post('btnadd')) {
                if (!has_permissions('create', 'users_accounts_rights')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $username = $this->input->post('username');
                    $data = $this->db->where('auth_username', $username)->get('tbl_authenticate')->result();
                    if (!empty($data)) {
                        $this->session->set_flashdata('error', $username . ' ' . lang('is_already_exists'));
                    } else {
                        $this->User_model->add_user_rights();
                        $this->session->set_flashdata('success', lang('user_created_successfully'));
                    }
                }
                redirect('user-accounts-rights');
            } else if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'users_accounts_rights')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $this->User_model->update_user_rights();
                    $this->session->set_flashdata('success', lang('user_updated_successfully'));
                }
                redirect('user-accounts-rights');
            }
            $this->result['system_modules'] = $this->config->item('system_modules');
            $this->load->view('users_accounts_rights', $this->result);
        }
    }

    public function battle_statistics($id)
    {
        $this->result['general_stat'] = $this->User_model->general_statistics($id);
        $this->result['battle_stat'] = $this->User_model->battle_statistics($id);
        $this->load->view('battle_statistics', $this->result);
    }

    public function global_leaderboard()
    {
        if (!has_permissions('read', 'leaderboard')) {
            redirect('/');
        } else {
            $this->load->view('leaderboard_global');
        }
    }

    public function monthly_leaderboard()
    {
        if (!has_permissions('read', 'leaderboard')) {
            redirect('/');
        } else {
            $this->load->view('leaderboard_monthly');
        }
    }

    public function daily_leaderboard()
    {
        if (!has_permissions('read', 'leaderboard')) {
            redirect('/');
        } else {
            $this->load->view('leaderboard_daily');
        }
    }

    public function get_subcategories_of_category()
    {
        $category_id = $this->input->post('category_id');
        $data = $this->db->where('maincat_id', $category_id)
            ->order_by('row_order', 'ASC')->get('tbl_subcategory')->result();
        if ($this->input->post('sortable')) {
            $options = '';
            foreach ($data as $option) {
                if (!empty($option->image)) {
                    $options .= "<li id='" . $option->id . "'><img src='" . SUBCATEGORY_IMG_PATH . $option->image . "' height=30 > " . $option->subcategory_name . "</li>";
                } else {
                    $options .= "<li id='" . $option->id . "'><img src='" . $this->NO_IMAGE . "' height=30 > " . $option->subcategory_name . "</li>";
                }
            }
        } else {
            $options = '<option value="">' . lang('select_sub_category') . '</option>';
            foreach ($data as $option) {
                $optionName = $option->is_premium == 1 ? $option->subcategory_name . ' - Premium' : $option->subcategory_name;
                $options .= "<option value=" . $option->id . " data-is-premium='" . $option->is_premium . "'>" . $optionName . "</option>";
            }
        }
        echo $options;
    }

    public function get_categories_of_language()
    {

        $type_name = $this->input->post('type');
        $type = $this->category_type[$type_name];
        if ($this->input->post('language_id')) {
            $language_id = $this->input->post('language_id');
            $this->db->where('language_id', $language_id);
        }
        $data = $this->db->where('type', $type)->order_by('row_order', 'ASC')->get('tbl_category')->result();
        if ($this->input->post('sortable')) {
            $options = '';
            foreach ($data as $option) {
                if (!empty($option->image)) {
                    $options .= "<li id='" . $option->id . "'><img src='" . CATEGORY_IMG_PATH . $option->image . "' height=30 > " . $option->category_name . "</li>";
                } else {
                    $options .= "<li id='" . $option->id . "'><img src='" . $this->NO_IMAGE . "' height=30 > " . $option->category_name . "</li>";
                }
            }
        } else {
            $options = '<option value="">' . lang('select_main_category') . '</option>';
            foreach ($data as $option) {
                $optionName = $option->is_premium == 1 ? $option->category_name . ' - Premium' : $option->category_name;
                $options .= "<option value=" . $option->id . " data-is-premium='" . $option->is_premium . "'>" . $optionName . "</option>";
            }
        }
        echo $options;
    }

    public function delete_multiple()
    {
        $ids = $this->input->post('ids');
        $table = $this->input->post('sec');
        $is_image = $this->input->post('is_image');
        $data = $this->Setting_model->delete_multiple($ids, $is_image, $table);
        echo $data;
    }

    public function users()
    {
        if (!has_permissions('read', 'users')) {
            redirect('/');
        } else {
            if ($this->input->post('btnupdate')) {
                if (!has_permissions('update', 'users')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $this->User_model->update_user();
                    $this->session->set_flashdata('success', lang('user_updated_successfully'));
                }
                redirect('users');
            } else if ($this->input->post('btnupdateCoins')) {
                if (!has_permissions('update', 'users')) {
                    $this->session->set_flashdata('error', lang(PERMISSION_ERROR_MSG));
                } else {
                    $this->User_model->update_user_coin();
                    $this->session->set_flashdata('success', lang('user_coins_added_successfully'));
                }
                redirect('users');
            }
            $this->load->view('users');
        }
    }

    public function delete_accounts_rights()
    {
        if (!has_permissions('delete', 'users_accounts_rights')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $this->User_model->delete_user_rights($id);
            echo TRUE;
        }
    }

    public function getYearForMonthChart($year)
    {
        $queryData = $this->result['month_data'] = $this->db->query("SELECT m.name as month_name, (SELECT COUNT(id) AS user_count FROM tbl_users WHERE YEAR(date_registered) = $year AND MONTHNAME(date_registered) = m.name GROUP BY MONTH(date_registered)) as user_count FROM tbl_month_week m WHERE m.type=1")->result();
        $mLable = $mData = array();
        foreach ($queryData as $mD) {
            $mLable[] = $mD->month_name;
            $mData[] = ($mD->user_count == NULL) ? 0 : (int) $mD->user_count;
        }
        $maxMonthData = $mData ? max($mData) : 0;
        $stepSizeMonth = $maxMonthData > 10 ? round($maxMonthData / 10) : 1; // Change 10 to the number of steps you want

        $data['mName'] = $mLable;
        $data['mD'] = $mData;
        $data['stepSizeMonth'] = $stepSizeMonth;

        echo json_encode($data);
    }

    public function get_subcategories_of_language()
    {
        $type_name = $this->input->post('type');
        $type = $this->category_type[$type_name];
        if ($this->input->post('language_id')) {
            $language_id = $this->input->post('language_id');
            $this->db->where('language_id', $language_id);
        }
        $category_data = $this->db->select('GROUP_CONCAT(id SEPARATOR ",") as id')->where('type', $type)->order_by('id', 'DESC')->get('tbl_category')->row_array();
        $options = '';
        if ($category_data['id'] != null) {
            $data = $this->db->where_in('maincat_id', explode(',', $category_data['id']))->order_by('id', 'DESC')->get('tbl_subcategory')->result();
            if ($this->input->post('sortable')) {
                foreach ($data as $option) {

                    $options .= "<li id='" . $option->id . "'><img src='" . $this->NO_IMAGE . "' height=30 > " . $option->subcategory_name . "</li>";
                }
            } else {
                $options = '<option value="">' . lang('select_main_category') . '</option>';
                foreach ($data as $option) {
                    $options .= "<option value=" . $option->id . ">" . $option->subcategory_name . "</option>";
                }
            }
        }
        echo $options;
    }

    public function removeImage()
    {
        if (!has_permissions('delete', 'remove_image')) {
            echo FALSE;
        } else {
            $id = $this->input->post('id');
            $table = $this->input->post('table');
            $image = $this->input->post('image');
            $data = $this->Setting_model->removeImage($id, $image, $table);
            echo $data;
        }
    }
}
