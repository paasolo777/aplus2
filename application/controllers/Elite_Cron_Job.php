<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Elite_Cron_Job extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set(get_system_timezone());
    }

    /**
     * This function is used to update date
     * This function is called by cron job once in a day at midnight 00:00
     */
    public function index()
    {
        $res = $this->db->where('date!=', date('Y-m-d'))->get('tbl_exam_module')->result_array();
        if (!empty($res)) {
            // print_r($res);
            $data = [
                'date' => date('Y-m-d'),
                'status' => 1
            ];
            $this->db->update('tbl_exam_module', $data);

            echo 'Exam Module Cronjob Time -' . date('Y-m-d H:i:s');
        }
        $res1 = $this->db->where('date_published!=', date('Y-m-d'))->get('tbl_daily_quiz')->result_array();
        if (!empty($res1)) {

            // echo $this->db->last_query();
            // echo 'done';
            $data1 = [
                'date_published' => date('Y-m-d'),

            ];
            $this->db->update('tbl_daily_quiz', $data1);
            echo 'Daily quiz Cronjob Time -' . date('Y-m-d H:i:s');
        }
    }
}
