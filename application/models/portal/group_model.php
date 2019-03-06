<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class group_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function delete_group($key)
    {

        $this->db->where('id', $key);
        $res = $this->db->delete('groups');
        if ($res) {
            $dbmsg = array( 'status' => true, 'msg' => 'success to delete the record: ' . $key );
        } else {
            $dbmsg = array( 'status' => false, 'msg' => 'failed to delete the record: ' . $key );
        }
        return $dbmsg;

//        if ($this->db->_error_message()) {
//            $result = 'Error! ['.$this->db->_error_message().']';
//        } else if (!$this->db->affected_rows()) {
//            $result = 'Error! ID ['.$id.'] not found';
//        } else {
//            $result = 'Success';
//        }
    }

    public function update_form($data)
    {
        $where = "id = 1";

        return $this->db->update('forms', $data, $where);
    }
}
?>