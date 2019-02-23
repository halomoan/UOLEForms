<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class forms_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_form($key)
    {
        $query = $this->db->get_where('forms',array('id' => $key));


        if ($query->num_rows() > 0)
        {
            return $query->result_array()[0];
        }
        else
        {
            return FALSE;
        }
    }

    public function update_form($data)
    {
        $where = "id = 1";

        return $this->db->update('forms', $data, $where);
    }
}
?>