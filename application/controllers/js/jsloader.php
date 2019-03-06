<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jsloader extends MY_Controller  {

    public function __construct()
    {
        parent::__construct();

    }


    public function index()
    {
    }


    public function groups()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $this->lang->load('portal/groups');
            $this->load->view('portal/groups/groups_js');
        }
    }
}
